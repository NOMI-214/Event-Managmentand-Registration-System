<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model
{
    protected $table = 'registrations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['event_id', 'name', 'email', 'phone'];
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'registered_at';

    // Validation rules
    protected $validationRules = [
        'event_id' => 'required|numeric',
        'name' => 'required|min_length[2]|max_length[255]',
        'email' => 'required|valid_email|max_length[255]',
        'phone' => 'required|min_length[10]|max_length[20]|regex_match[/^[0-9+\-\s()]+$/]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Full name is required',
            'min_length' => 'Name must be at least 2 characters',
            'max_length' => 'Name cannot exceed 255 characters'
        ],
        'email' => [
            'required' => 'Email address is required',
            'valid_email' => 'Please provide a valid email address',
            'max_length' => 'Email cannot exceed 255 characters'
        ],
        'phone' => [
            'required' => 'Phone number is required',
            'min_length' => 'Phone number must be at least 10 digits',
            'max_length' => 'Phone number cannot exceed 20 characters',
            'regex_match' => 'Phone number can only contain numbers, +, -, spaces, and parentheses'
        ],
        'event_id' => [
            'required' => 'Event ID is required',
            'numeric' => 'Invalid event ID'
        ]
    ];

    /**
     * Get all registrations for an event
     */
    public function getEventRegistrations($eventId)
    {
        return $this->where('event_id', $eventId)
                    ->orderBy('registered_at', 'DESC')
                    ->findAll();
    }

    /**
     * Check if email already registered for event
     */
    public function isEmailRegisteredForEvent($eventId, $email)
    {
        $count = $this->where('event_id', $eventId)
                      ->where('email', $email)
                      ->countAllResults();
        
        return $count > 0;
    }

    /**
     * Get all registrations with event details
     */
    public function getAllRegistrationsWithEvent()
    {
        return $this->select('registrations.*, events.title as event_title, events.date as event_date, events.location as event_location')
                    ->join('events', 'events.id = registrations.event_id')
                    ->orderBy('registrations.registered_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get registration count by event
     */
    public function getRegistrationCountByEvent($eventId)
    {
        return $this->where('event_id', $eventId)
                    ->countAllResults();
    }

    /**
     * Get recent registrations
     */
    public function getRecentRegistrations($limit = 10)
    {
        return $this->select('registrations.*, events.title as event_title')
                    ->join('events', 'events.id = registrations.event_id')
                    ->orderBy('registrations.registered_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
