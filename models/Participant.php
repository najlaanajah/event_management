<?php

require_once __DIR__ . '/../config/database.php';

class Participant
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // CREATE PARTICIPANT
    public function create(
        $eventId,
        $studentId,
        $studentName,
        $email
    ) {
        $sql = "INSERT INTO participants
                (event_id, student_id, student_name, email)
                VALUES
                (:event_id, :student_id, :student_name, :email)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(
            ":event_id",
            $eventId,
            PDO::PARAM_INT
        );

        $stmt->bindParam(
            ":student_id",
            $studentId
        );

        $stmt->bindParam(
            ":student_name",
            $studentName
        );

        $stmt->bindParam(
            ":email",
            $email
        );

        return $stmt->execute();
    }

    // READ PARTICIPANTS BY EVENT
    public function getByEventId($eventId)
    {
        $sql = "SELECT *
                FROM participants
                WHERE event_id = :event_id
                ORDER BY id ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(
            ":event_id",
            $eventId,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
?>