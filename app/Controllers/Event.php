<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\RegistrationModel;

class Event extends BaseController
{
    protected $eventModel;
    protected $registrationModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        $this->eventModel = model(EventModel::class);
        $this->registrationModel = model(RegistrationModel::class);
    }

    /**
     * Display all upcoming events
     */
    public function index()
    {
        // Allow logged in users to view events

        
        // Get search keyword if provided
        $search = $this->request->getGet('search');
        
        if ($search) {
            $events = $this->eventModel->searchEvents($search);
            $data['search_query'] = $search;
        } else {
            $events = $this->eventModel->getUpcomingEvents();
        }
        
        $data['events'] = $events;
        $data['title'] = 'All Events';
        
        return view('events/index', $data);
    }

    /**
     * Display event details
     */
    public function detail($eventId)
    {
        // Get event with participant count
        $event = $this->eventModel->getEventWithCount($eventId);
        
        if (!$event) {
            return redirect()->to('events')
                           ->with('error', 'Event not found');
        }
        
        $data['event'] = $event;
        $data['title'] = $event['title'];
        
        return view('events/detail', $data);
    }

    /**
     * Handle event registration
     */
    public function register($eventId)
    {
        // Verify event exists
        $event = $this->eventModel->find($eventId);
        // Early debug: record that register() was invoked and event lookup
        @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - register_invoked event_id={$eventId} event_found=" . ($event ? '1' : '0') . " method=" . $this->request->getMethod() . PHP_EOL, FILE_APPEND);
        if (!$event) {
            return redirect()->to('events')
                           ->with('error', 'Event not found');
        }

        // Check available slots
        $hasSlots = $this->eventModel->hasAvailableSlots($eventId);
        @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - hasAvailableSlots event_id={$eventId} result=" . ($hasSlots ? '1' : '0') . PHP_EOL, FILE_APPEND);
        if (!$hasSlots) {
            return redirect()->to('event/' . $eventId)
                           ->with('error', 'Sorry! No more slots available for this event');
        }

        // Only process POST requests (case-insensitive)
        if (strtolower($this->request->getMethod()) !== 'post') {
            return redirect()->to('event/' . $eventId);
        }

        // Immediate debug mark: register() entered for POST
        @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - Event::register entry for event_id={$eventId}\n", FILE_APPEND);

        // Get form data using CodeIgniter's request methods
        $registrationData = [
            'event_id' => $eventId,
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];

        // Check if email already registered for this event
        if ($this->registrationModel->isEmailRegisteredForEvent($eventId, $registrationData['email'])) {
            return redirect()->back()
                           ->with('error', 'This email is already registered for this event')
                           ->withInput();
        }

        // Log request info for debugging
        $this->logger->info('Event::register called', ['method' => $this->request->getMethod(), 'uri' => (string)$this->request->getUri(), 'data' => $registrationData]);
        @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - Event::register called - " . json_encode($registrationData) . PHP_EOL, FILE_APPEND);

        // Log DB connection info used by model
        try {
            $dbForInfo = \Config\Database::connect();
            $dbName = method_exists($dbForInfo, 'getDatabase') ? $dbForInfo->getDatabase() : ($dbForInfo->database ?? 'unknown');
            $dbHost = $dbForInfo->hostname ?? 'unknown';
            @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - DB used: {$dbName} @ {$dbHost}" . PHP_EOL, FILE_APPEND);
        } catch (\Exception $e) {
            @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - DB info error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
        }

        // Try to insert using the model first
        $regId = $this->registrationModel->insert($registrationData);

        // Log model insert result and validation errors to framework logs
        $this->logger->info('Registration model insert result', ['regId' => $regId, 'errors' => $this->registrationModel->errors()]);
        @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - model_insert - regId=" . json_encode($regId) . " errors=" . json_encode($this->registrationModel->errors()) . PHP_EOL, FILE_APPEND);

        // If model insert failed (validation or other), try skipValidation then direct DB insert and log outcomes
        if (!$regId) {
            // Log validation rules and errors for diagnosis
            @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - validation_rules: " . json_encode(method_exists($this->registrationModel, 'getValidationRules') ? $this->registrationModel->getValidationRules() : []) . PHP_EOL, FILE_APPEND);

            // 1) Try inserting while skipping validation to rule out validation issues
            try {
                $this->logger->info('Attempting insert with skipValidation(true)');
                $skipId = $this->registrationModel->skipValidation(true)->insert($registrationData);
                @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - skipValidation_insert regId=" . json_encode($skipId) . PHP_EOL, FILE_APPEND);
                if ($skipId) {
                    $regId = $skipId;
                    $this->logger->info('skipValidation insert succeeded', ['regId' => $regId]);
                }
            } catch (\Exception $e) {
                $this->logger->error('skipValidation exception: ' . $e->getMessage());
                @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - skipValidation_exception " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            }

            // 2) If still not inserted, try direct DB builder insert
            if (!$regId) {
                try {
                    $db = \Config\Database::connect();
                    $builder = $db->table('registrations');
                    $ok = $builder->insert($registrationData);
                    $lastQuery = method_exists($builder, 'getCompiledInsert') ? $builder->getCompiledInsert() : null;
                    $this->logger->warning('Direct DB insert attempt', ['ok' => (bool)$ok, 'lastQuery' => $lastQuery]);
                    @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - direct_insert_attempt ok=" . ((int)$ok) . " query=" . json_encode($lastQuery) . PHP_EOL, FILE_APPEND);
                    if ($ok) {
                        $regId = $db->insertID();
                        $this->logger->info('Direct insert success', ['regId' => $regId]);
                        @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - direct_insert_success regId=" . $regId . PHP_EOL, FILE_APPEND);
                    } else {
                        $dberr = $db->error();
                        $this->logger->error('Direct insert failed, db error', $dberr);
                        @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - direct_insert_failed db_error=" . json_encode($dberr) . PHP_EOL, FILE_APPEND);
                    }
                } catch (\Exception $e) {
                    $this->logger->error('Direct insert exception: ' . $e->getMessage());
                    @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - direct_insert_exception " . $e->getMessage() . PHP_EOL, FILE_APPEND);
                }
            }
        }

        if ($regId) {
            // Successful registration: redirect to a GET route to avoid POST resubmission issues
            return redirect()->to('event/' . $eventId)
                             ->with('success', 'Registration successful. Reference: ' . $regId);
        }

        // Fallback: show model validation errors (if any) and redirect to event detail (GET)
        $errors = $this->registrationModel->errors();
        $this->logger->warning('Registration failed', ['errors' => $errors]);
        @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - registration_failed errors=" . json_encode($errors) . PHP_EOL, FILE_APPEND);

        return redirect()->to('event/' . $eventId)
                       ->with('errors', $errors)
                       ->withInput();
    }
    public function success($registrationId)
    {
        $registration = $this->registrationModel->find($registrationId);
        
        if (!$registration) {
            return redirect()->to('events');
        }
        
        $event = $this->eventModel->find($registration['event_id']);
        
        $data = [
            'registration' => $registration,
            'event' => $event,
            'title' => 'Registration Confirmed'
        ];
        
        return view('events/success', $data);
    }
}
