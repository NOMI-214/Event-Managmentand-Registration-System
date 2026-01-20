<?php

namespace App\Controllers;

use App\Models\RegistrationModel;
use App\Models\EventModel;

class AdminParticipant extends BaseController
{
    protected $registrationModel;
    protected $eventModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->registrationModel = model(RegistrationModel::class);
        $this->eventModel = model(EventModel::class);
    }


    public function index()
    {
        $data = [
            'registrations' => $this->registrationModel->select('registrations.*, events.title as event_title, events.date')
                ->join('events', 'events.id = registrations.event_id')
                ->orderBy('registrations.registered_at', 'DESC')
                ->findAll(),
            'events' => $this->eventModel->orderBy('date', 'DESC')->findAll(),
        ];
        
        return view('admin/participants/index', $data);
    }

    public function byEvent($eventId)
    {
        $event = $this->eventModel->find($eventId);
        
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'event' => $event,
            'registrations' => $this->registrationModel->getEventRegistrations($eventId),
        ];
        
        return view('admin/participants/byEvent', $data);
    }

    public function delete($participantId)
    {
        $registration = $this->registrationModel->find($participantId);
        
        if (!$registration) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $this->registrationModel->delete($participantId);
        
        return redirect()->back()
            ->with('success', 'Participant deleted successfully!');
    }

    public function exportCSV()
    {
        $registrations = $this->registrationModel->select('registrations.*, events.title')
            ->join('events', 'events.id = registrations.event_id')
            ->findAll();

        $filename = 'participants_' . date('Y-m-d_H-i-s') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Headers
        fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Event', 'Registered At']);
        
        // Data
        foreach ($registrations as $reg) {
            fputcsv($output, [
                $reg['id'],
                $reg['name'],
                $reg['email'],
                $reg['phone'],
                $reg['title'],
                $reg['registered_at'],
            ]);
        }
        
        fclose($output);
        exit;
    }

    public function exportExcel()
    {
        $registrations = $this->registrationModel->select('registrations.*, events.title')
            ->join('events', 'events.id = registrations.event_id')
            ->findAll();

        $filename = 'participants_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        // Using simple HTML table export as XLSX
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $html = '<table>';
        $html .= '<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Event</th><th>Registered At</th></tr>';
        
        foreach ($registrations as $reg) {
            $html .= '<tr>';
            $html .= '<td>' . $reg['id'] . '</td>';
            $html .= '<td>' . $reg['name'] . '</td>';
            $html .= '<td>' . $reg['email'] . '</td>';
            $html .= '<td>' . $reg['phone'] . '</td>';
            $html .= '<td>' . $reg['title'] . '</td>';
            $html .= '<td>' . $reg['registered_at'] . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</table>';
        
        $this->generateXLSX($filename, $html);
        exit;
    }

    public function exportPDF()
    {
        $registrations = $this->registrationModel->select('registrations.*, events.title')
            ->join('events', 'events.id = registrations.event_id')
            ->findAll();

        $data = [
            'registrations' => $registrations,
        ];
        
        $html = view('admin/participants/pdf', $data);
        
        // Simple PDF generation
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="participants_' . date('Y-m-d_H-i-s') . '.pdf"');
        
        echo $html;
        exit;
    }

    public function exportEventCSV($eventId)
    {
        $event = $this->eventModel->find($eventId);
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $registrations = $this->registrationModel->getEventRegistrations($eventId);
        $filename = 'participants_' . str_replace(' ', '_', $event['title']) . '_' . date('Y-m-d_H-i-s') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Headers
        fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Registered At']);
        
        // Data
        foreach ($registrations as $reg) {
            fputcsv($output, [
                $reg['id'],
                $reg['name'],
                $reg['email'],
                $reg['phone'],
                $reg['registered_at'],
            ]);
        }
        
        fclose($output);
        exit;
    }

    public function exportEventExcel($eventId)
    {
        $event = $this->eventModel->find($eventId);
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $registrations = $this->registrationModel->getEventRegistrations($eventId);
        $filename = 'participants_' . str_replace(' ', '_', $event['title']) . '_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $html = '<table>';
        $html .= '<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Registered At</th></tr>';
        
        foreach ($registrations as $reg) {
            $html .= '<tr>';
            $html .= '<td>' . $reg['id'] . '</td>';
            $html .= '<td>' . $reg['name'] . '</td>';
            $html .= '<td>' . $reg['email'] . '</td>';
            $html .= '<td>' . $reg['phone'] . '</td>';
            $html .= '<td>' . $reg['registered_at'] . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</table>';
        
        $this->generateXLSX($filename, $html);
        exit;
    }

    public function exportEventPDF($eventId)
    {
        $event = $this->eventModel->find($eventId);
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $registrations = $this->registrationModel->getEventRegistrations($eventId);
        
        $data = [
            'event' => $event,
            'registrations' => $registrations,
        ];
        
        $html = view('admin/participants/eventPdf', $data);
        
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="participants_' . str_replace(' ', '_', $event['title']) . '_' . date('Y-m-d_H-i-s') . '.pdf"');
        
        echo $html;
        exit;
    }

    private function generateXLSX($filename, $html)
    {
        // Simple XLSX generation using HTML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<?mso-application progid="Excel.Sheet"?>';
        $xml .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"';
        $xml .= ' xmlns:x="urn:schemas-microsoft-com:office:excel"';
        $xml .= ' xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">';
        $xml .= '<Worksheet ss:Name="Participants">';
        $xml .= '<Table>' . $html . '</Table>';
        $xml .= '</Worksheet>';
        $xml .= '</Workbook>';
        
        echo $xml;
    }
}
