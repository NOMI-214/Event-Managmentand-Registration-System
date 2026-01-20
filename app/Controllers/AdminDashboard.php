<?php

namespace App\Controllers;

class AdminDashboard extends BaseController
{
    public function index()
    {
        $eventModel = model(\App\Models\EventModel::class);
        $registrationModel = model(\App\Models\RegistrationModel::class);
        
        $totalEvents = $eventModel->countAllResults();
        $totalRegistrations = $registrationModel->countAllResults();
        $upcomingEvents = $eventModel->where('date >=', date('Y-m-d'))->countAllResults();
        
        $data = [
            'totalEvents' => $totalEvents,
            'totalRegistrations' => $totalRegistrations,
            'upcomingEvents' => $upcomingEvents,
            'recentEvents' => $eventModel->orderBy('created_at', 'DESC')->limit(5)->findAll(),
            'recentRegistrations' => $registrationModel->select('registrations.*, events.title')
                ->join('events', 'events.id = registrations.event_id')
                ->orderBy('registrations.registered_at', 'DESC')
                ->limit(5)
                ->findAll(),
        ];
        
        return view('admin/dashboard', $data);
    }
}
