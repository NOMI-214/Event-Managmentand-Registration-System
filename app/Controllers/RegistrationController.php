<?php

namespace App\Controllers;

use App\Models\RegistrationModel;
use App\Models\EventModel;

class RegistrationController extends BaseController
{
    public function register($eventId)
    {
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('login')->with('error', 'Please login first');
        }
        
        $eventModel = new EventModel();
        $registrationModel = new RegistrationModel();
        
        $event = $eventModel->find($eventId);
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found');
        }
        
        // Check if already registered
        $existing = $registrationModel
            ->where('user_id', $userId)
            ->where('event_id', $eventId)
            ->first();
        
        if ($existing) {
            return redirect()->back()->with('error', 'You are already registered for this event');
        }
        
        // Register user
        $registrationModel->insert([
            'user_id' => $userId,
            'event_id' => $eventId,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        return redirect()->to('dashboard')->with('success', 'Successfully registered for the event!');
    }
    
    public function unregister($eventId)
    {
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('login');
        }
        
        $registrationModel = new RegistrationModel();
        
        $registrationModel
            ->where('user_id', $userId)
            ->where('event_id', $eventId)
            ->delete();
        
        return redirect()->to('dashboard')->with('success', 'Unregistered from event successfully');
    }
}
