<?php

namespace App\Controllers;

use App\Models\EventModel;

class HomeController extends BaseController
{
    public function index()
    {
        try {
            $eventModel = new EventModel();
            $events = $eventModel->findAll();
            
            log_message('info', 'HomeController: Page loaded, found ' . count($events) . ' events');
            
            $data = [
                'events' => $events,
                'title' => 'Home | Event Management System'
            ];
            
            return view('home', $data);
        } catch (\Exception $e) {
            log_message('error', 'HomeController Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load home page');
        }
    }
}
