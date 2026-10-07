<?php

require_once __DIR__ . '/../models/Participant.php';

class ParticipantController
{
    private $participant;

    public function __construct()
    {
        $this->participant = new Participant();
    }

    // CSV UPLOAD
    public function uploadCSV($file, $eventId)
    {
        // Validate event ID
        $eventId = filter_var(
            $eventId,
            FILTER_VALIDATE_INT
        );

        if (!$eventId) {
            return "Invalid event ID.";
        }

        // Check if file exists
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return "Please upload a CSV file.";
        }

        // File size limit: 2MB
        $maxSize = 2 * 1024 * 1024;

        if ($file['size'] > $maxSize) {
            return "File size must not exceed 2MB.";
        }

        // Check file extension
        $fileName = $file['name'];
        $extension = strtolower(
            pathinfo($fileName, PATHINFO_EXTENSION)
        );

        if ($extension !== 'csv') {
            return "Only CSV files are allowed.";
        }

        // Open CSV file
        $handle = fopen($file['tmp_name'], 'r');

        if ($handle === false) {
            return "Unable to open CSV file.";
        }

        // Read header row
        $header = fgetcsv($handle);

        if ($header === false) {
            fclose($handle);
            return "CSV file is empty.";
        }

        // Remove BOM if present
        $header[0] = preg_replace(
            '/^\xEF\xBB\xBF/',
            '',
            $header[0]
        );

        // Expected CSV columns
        $expectedHeader = [
            'student_id',
            'student_name',
            'email'
        ];

        if ($header !== $expectedHeader) {
            fclose($handle);
            return "Invalid CSV format. Required columns: student_id, student_name, email.";
        }

        $rowNumber = 1;
        $successCount = 0;

        // Read CSV row by row
        while (($row = fgetcsv($handle)) !== false) {

            $rowNumber++;

            // Skip empty rows
            if (
                count($row) === 1 &&
                trim($row[0]) === ''
            ) {
                continue;
            }

            // Check number of columns
            if (count($row) !== 3) {
                fclose($handle);

                return "Invalid data at row {$rowNumber}.";
            }

            $studentId = trim($row[0]);
            $studentName = trim($row[1]);
            $email = trim($row[2]);

            // Required fields
            if (
                $studentId === '' ||
                $studentName === '' ||
                $email === ''
            ) {
                fclose($handle);

                return "Missing information at row {$rowNumber}.";
            }

            // Student ID length
            if (strlen($studentId) > 50) {
                fclose($handle);

                return "Student ID at row {$rowNumber} is too long.";
            }

            // Student name length
            if (strlen($studentName) > 150) {
                fclose($handle);

                return "Student name at row {$rowNumber} is too long.";
            }

            // Email validation
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                fclose($handle);

                return "Invalid email at row {$rowNumber}.";
            }

            if (strlen($email) > 150) {
                fclose($handle);

                return "Email at row {$rowNumber} is too long.";
            }

            // Insert participant
            $result = $this->participant->create(
                $eventId,
                $studentId,
                $studentName,
                $email
            );

            if (!$result) {
                fclose($handle);

                return "Failed to save participant at row {$rowNumber}.";
            }

            $successCount++;
        }

        fclose($handle);

        if ($successCount === 0) {
            return "No participant data found in CSV.";
        }

        return $successCount;
    }

    // GET PARTICIPANTS
    public function getParticipants($eventId)
    {
        $eventId = filter_var(
            $eventId,
            FILTER_VALIDATE_INT
        );

        if (!$eventId) {
            return [];
        }

        return $this->participant->getByEventId($eventId);
    }
}
?>