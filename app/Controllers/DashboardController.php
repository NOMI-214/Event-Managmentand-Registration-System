<?php

namespace App\Controllers;

use App\Models\RegistrationModel;
use App\Models\EventModel;

class DashboardController extends BaseController
{
    public function index()
    {
        try {
            log_message('info', 'DashboardController::index() called');
            
            $userId = session()->get('user_id');
            
            if (!$userId) {
                log_message('warning', 'Dashboard accessed without authentication');
                session()->setFlashdata('error', 'Please login first');
                return redirect()->to('login');
            }
            
            log_message('info', 'Dashboard: User ' . $userId . ' accessing dashboard');
            
            $registrationModel = new RegistrationModel();
            $eventModel = new EventModel();
            
            $registrations = $registrationModel
                ->where('user_id', $userId)
                ->findAll();
            
            $events = [];
            if (!empty($registrations)) {
                foreach ($registrations as $reg) {
                    $event = $eventModel->find($reg['event_id']);
                    if ($event) {
                        $event['registered_at'] = $reg['created_at'];
                        $events[] = $event;
                    }
                }
            }
            
            log_message('info', 'Dashboard: User ' . $userId . ' has ' . count($events) . ' events');
            
            $data = [
                'title' => 'My Events | Event Management System',
                'events' => $events
            ];
            
            return view('user/dashboard', $data);
        } catch (\Exception $e) {
            log_message('error', 'DashboardController Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error loading dashboard');
            return redirect()->to('/');
        }
    }
}
