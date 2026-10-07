<?php

require_once __DIR__ . '/../config/database.php';

class Event
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // READ
    public function getAll()
    {
        $sql = "SELECT events.*, users.username
                FROM events
                INNER JOIN users
                ON events.created_by = users.id
                ORDER BY events.event_date ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // READ ONE
    public function getById($id)
    {
        $sql = "SELECT * FROM events WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    // CREATE
    public function create(
        $eventName,
        $eventDate,
        $venue,
        $targetAudience,
        $budget,
        $createdBy
    ) {
        $sql = "INSERT INTO events
                (event_name, event_date, venue,
                 target_audience, budget, created_by)
                VALUES
                (:event_name, :event_date, :venue,
                 :target_audience, :budget, :created_by)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":event_name", $eventName);
        $stmt->bindParam(":event_date", $eventDate);
        $stmt->bindParam(":venue", $venue);
        $stmt->bindParam(":target_audience", $targetAudience);
        $stmt->bindParam(":budget", $budget);
        $stmt->bindParam(":created_by", $createdBy, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // UPDATE
    public function update(
        $id,
        $eventName,
        $eventDate,
        $venue,
        $targetAudience,
        $budget,
        $status
    ) {
        $sql = "UPDATE events
                SET event_name = :event_name,
                    event_date = :event_date,
                    venue = :venue,
                    target_audience = :target_audience,
                    budget = :budget,
                    status = :status
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":event_name", $eventName);
        $stmt->bindParam(":event_date", $eventDate);
        $stmt->bindParam(":venue", $venue);
        $stmt->bindParam(":target_audience", $targetAudience);
        $stmt->bindParam(":budget", $budget);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // DELETE
    public function delete($id)
    {
        $sql = "DELETE FROM events WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
?>