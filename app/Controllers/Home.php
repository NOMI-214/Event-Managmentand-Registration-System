<?php

namespace App\Controllers;

use App\Models\EventModel;

class Home extends BaseController
{
    protected $eventModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->eventModel = model(EventModel::class);
    }


    public function index()
    {
        // Get upcoming events (limit 6 for homepage)
        $upcomingEvents = $this->eventModel->getUpcomingEvents(6);
        
        $data = [
            'upcomingEvents' => $upcomingEvents,
        ];
        
        return view('home', $data);
    }
}
