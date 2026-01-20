<?php

namespace App\Controllers;

use App\Models\EventModel;

class AdminEvent extends BaseController
{
    protected $eventModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->eventModel = model(EventModel::class);
    }


    public function index()
    {
        $data = [
            'events' => $this->eventModel->orderBy('date', 'DESC')->findAll(),
        ];
        
        return view('admin/events/index', $data);
    }

    public function create()
    {
        return view('admin/events/create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return redirect()->to('admin/events');
        }

        $eventData = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'date' => $_POST['date'] ?? '',
            'time' => $_POST['time'] ?? '',
            'location' => $_POST['location'] ?? '',
            'max_participants' => $_POST['max_participants'] ?? '',
        ];

        if ($this->eventModel->validate($eventData)) {
            $this->eventModel->save($eventData);
            return redirect()->to('admin/events')
                ->with('success', 'Event created successfully!');
        } else {
            return redirect()->back()
                ->with('errors', $this->eventModel->errors())
                ->withInput();
        }
    }

    public function edit($eventId)
    {
        $event = $this->eventModel->find($eventId);
        
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'event' => $event,
        ];
        
        return view('admin/events/edit', $data);
    }

    public function update($eventId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return redirect()->to('admin/events');
        }

        $event = $this->eventModel->find($eventId);
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $eventData = [
            'id' => $eventId,
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'date' => $_POST['date'] ?? '',
            'time' => $_POST['time'] ?? '',
            'location' => $_POST['location'] ?? '',
            'max_participants' => $_POST['max_participants'] ?? '',
        ];

        if ($this->eventModel->validate($eventData)) {
            $this->eventModel->save($eventData);
            return redirect()->to('admin/events')
                ->with('success', 'Event updated successfully!');
        } else {
            return redirect()->back()
                ->with('errors', $this->eventModel->errors())
                ->withInput();
        }
    }

    public function delete($eventId)
    {
        $event = $this->eventModel->find($eventId);
        
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $this->eventModel->delete($eventId);
        
        return redirect()->to('admin/events')
            ->with('success', 'Event deleted successfully!');
    }
}
