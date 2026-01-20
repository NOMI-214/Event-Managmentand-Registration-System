<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'date', 'time', 'location', 'max_participants'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation rules
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'description' => 'required|min_length[10]',
        'date' => 'required|valid_date',
        'time' => 'required',
        'location' => 'required|min_length[3]|max_length[255]',
        'max_participants' => 'required|numeric|greater_than[0]'
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Event title is required',
            'min_length' => 'Title must be at least 3 characters',
            'max_length' => 'Title cannot exceed 255 characters'
        ],
        'description' => [
            'required' => 'Event description is required',
            'min_length' => 'Description must be at least 10 characters'
        ],
        'date' => [
            'required' => 'Event date is required',
            'valid_date' => 'Please provide a valid date'
        ],
        'time' => [
            'required' => 'Event time is required'
        ],
        'location' => [
            'required' => 'Event location is required',
            'min_length' => 'Location must be at least 3 characters'
        ],
        'max_participants' => [
            'required' => 'Maximum participants is required',
            'numeric' => 'Maximum participants must be a number',
            'greater_than' => 'Maximum participants must be greater than 0'
        ]
    ];

    /**
     * Get all upcoming events
     */
    public function getUpcomingEvents($limit = null)
    {
        $this->where('date >=', date('Y-m-d'));
        $this->orderBy('date', 'ASC');
        if ($limit) {
            $this->limit($limit);
        }
        
        return $this->findAll();
    }

    /**
     * Get all events with participant count (optimized - no N+1 query)
     */
    public function getEventsWithParticipantCount()
    {
        return $this->select('events.*, COUNT(registrations.id) as participant_count')
                    ->join('registrations', 'registrations.event_id = events.id', 'left')
                    ->groupBy('events.id')
                    ->orderBy('events.date', 'DESC')
                    ->findAll();
    }

    /**
     * Get event with participant count
     */
    public function getEventWithCount($eventId)
    {
        $result = $this->select('events.*, COUNT(registrations.id) as participant_count')
                       ->join('registrations', 'registrations.event_id = events.id', 'left')
                       ->where('events.id', $eventId)
                       ->groupBy('events.id')
                       ->first();
        
        if ($result) {
            $result['available_slots'] = $result['max_participants'] - $result['participant_count'];
        }
        
        return $result;
    }

    /**
     * Check if event still has available slots
     */
    public function hasAvailableSlots($eventId)
    {
        $event = $this->find($eventId);
        if (!$event) {
            return false;
        }
        
        $db = \Config\Database::connect();
        $count = $db->table('registrations')
                    ->where('event_id', $eventId)
                    ->countAllResults();
        
        return $count < $event['max_participants'];
    }

    /**
     * Search events by title or location
     */
    public function searchEvents($keyword, $limit = null)
    {
        $this->groupStart()
                ->like('title', $keyword)
                ->orLike('location', $keyword)
                ->orLike('description', $keyword)
             ->groupEnd()
             ->where('date >=', date('Y-m-d'))
             ->orderBy('date', 'ASC');
        
        if ($limit) {
            $this->limit($limit);
        }
        
        return $this->findAll();
    }
}
