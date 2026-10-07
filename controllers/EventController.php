<?php

require_once __DIR__ . '/../models/Event.php';

class EventController
{
    private $event;

    public function __construct()
    {
        $this->event = new Event();
    }

    // READ ALL
    public function getEvents()
    {
        return $this->event->getAll();
    }

    // READ ONE
    public function getEvent($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            return false;
        }

        return $this->event->getById($id);
    }

    // CREATE
    public function createEvent($data, $userId)
    {
        $eventName = trim($data['event_name'] ?? '');
        $eventDate = trim($data['event_date'] ?? '');
        $venue = trim($data['venue'] ?? '');
        $targetAudience = trim($data['target_audience'] ?? '');
        $budget = trim($data['budget'] ?? '0');

        // Required fields
        if (
            $eventName === '' ||
            $eventDate === '' ||
            $venue === '' ||
            $targetAudience === ''
        ) {
            return "Please fill in all required fields.";
        }

        // Length validation
        if (strlen($eventName) > 150) {
            return "Event name must not exceed 150 characters.";
        }

        if (strlen($venue) > 150) {
            return "Venue must not exceed 150 characters.";
        }

        if (strlen($targetAudience) > 150) {
            return "Target audience must not exceed 150 characters.";
        }

        // Date validation
        $dateObject = DateTime::createFromFormat(
            'Y-m-d',
            $eventDate
        );

        if (
            !$dateObject ||
            $dateObject->format('Y-m-d') !== $eventDate
        ) {
            return "Please enter a valid event date.";
        }

        if ($eventDate < date('Y-m-d')) {
            return "Event date cannot be in the past.";
        }

        // Budget validation
        if (!is_numeric($budget) || $budget < 0) {
            return "Budget must be a valid positive number.";
        }

        // User ID validation
        $userId = filter_var(
            $userId,
            FILTER_VALIDATE_INT
        );

        if (!$userId) {
            return "Invalid user.";
        }

        $result = $this->event->create(
            $eventName,
            $eventDate,
            $venue,
            $targetAudience,
            $budget,
            $userId
        );

        if (!$result) {
            return "Failed to create event.";
        }

        return true;
    }

    // UPDATE
    public function updateEvent($data)
    {
        $id = filter_var(
            $data['id'] ?? '',
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            return "Invalid event ID.";
        }

        $eventName = trim($data['event_name'] ?? '');
        $eventDate = trim($data['event_date'] ?? '');
        $venue = trim($data['venue'] ?? '');
        $targetAudience = trim(
            $data['target_audience'] ?? ''
        );
        $budget = trim($data['budget'] ?? '0');
        $status = $data['status'] ?? 'Pending';

        // Required fields
        if (
            $eventName === '' ||
            $eventDate === '' ||
            $venue === '' ||
            $targetAudience === ''
        ) {
            return "Please fill in all required fields.";
        }

        // Length validation
        if (strlen($eventName) > 150) {
            return "Event name must not exceed 150 characters.";
        }

        if (strlen($venue) > 150) {
            return "Venue must not exceed 150 characters.";
        }

        if (strlen($targetAudience) > 150) {
            return "Target audience must not exceed 150 characters.";
        }

        // Date validation
        $dateObject = DateTime::createFromFormat(
            'Y-m-d',
            $eventDate
        );

        if (
            !$dateObject ||
            $dateObject->format('Y-m-d') !== $eventDate
        ) {
            return "Please enter a valid event date.";
        }

        if ($eventDate < date('Y-m-d')) {
            return "Event date cannot be in the past.";
        }

        // Budget validation
        if (!is_numeric($budget) || $budget < 0) {
            return "Budget must be valid.";
        }

        // Status validation
        $allowedStatuses = [
            'Pending',
            'Approved',
            'Rejected'
        ];

        if (!in_array($status, $allowedStatuses, true)) {
            return "Invalid status.";
        }

        $result = $this->event->update(
            $id,
            $eventName,
            $eventDate,
            $venue,
            $targetAudience,
            $budget,
            $status
        );

        if (!$result) {
            return "Failed to update event.";
        }

        return true;
    }

    // DELETE
    public function deleteEvent($id)
    {
        $id = filter_var(
            $id,
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            return false;
        }

        return $this->event->delete($id);
    }
}
?>