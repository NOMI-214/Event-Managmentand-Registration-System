<?php

namespace App\Controllers;

use App\Models\EventModel;

class EventsController extends BaseController
{
    public function index()
    {
        try {
            log_message('info', 'EventsController::index() called');
            
            $eventModel = new EventModel();
            $events = $eventModel->findAll();
            
            log_message('info', 'EventsController: Loaded ' . count($events) . ' events');
            
            $data = [
                'events' => $events,
                'title' => 'All Events | Event Management System'
            ];
            
            return view('events/index', $data);
        } catch (\Exception $e) {
            log_message('error', 'EventsController Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load events');
        }
    }
    
    public function detail($id)
    {
        try {
            log_message('info', 'EventsController::detail() called with ID: ' . $id);
            
            $eventModel = new EventModel();
            $event = $eventModel->find($id);
            
            if (!$event) {
                log_message('warning', 'Event not found: ID ' . $id);
                return redirect()->to('events')->with('error', 'Event not found');
            }
            
            $data = [
                'event' => $event,
                'title' => htmlspecialchars($event['title']) . ' | Event Management System'
            ];
            
            return view('events/detail', $data);
        } catch (\Exception $e) {
            log_message('error', 'EventsController::detail Error: ' . $e->getMessage());
            return redirect()->to('events')->with('error', 'Failed to load event');
        }
    }
}
