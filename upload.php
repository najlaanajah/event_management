<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "controllers/ParticipantController.php";
require_once "controllers/EventController.php";

$participantController = new ParticipantController();
$eventController = new EventController();

$events = $eventController->getEvents();

$error = "";
$success = "";
$participants = [];
$selectedEventId = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $eventId = $_POST['event_id'] ?? '';

    $selectedEventId = $eventId;

    if (!isset($_FILES['csv_file'])) {

        $error = "Please select a CSV file.";

    } else {

        $result = $participantController->uploadCSV(
            $_FILES['csv_file'],
            $eventId
        );

        if (is_int($result)) {

            $success = $result . " participant(s) registered successfully.";

            // Get participants after successful upload
            $participants = $participantController->getParticipants(
                $eventId
            );

        } else {

            $error = $result;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Bulk Participant Registration</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">
                Bulk Participant Registration
            </h2>

            <?php if ($error): ?>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>

            <?php if ($success): ?>

                <div class="alert alert-success">
                    <?= htmlspecialchars($success) ?>
                </div>

            <?php endif; ?>

            <form
                method="POST"
                enctype="multipart/form-data">

                <div class="mb-3">

                    <label class="form-label">
                        Select Event
                    </label>

                    <select
                        name="event_id"
                        class="form-select"
                        required>

                        <option value="">
                            -- Select Event --
                        </option>

                        <?php foreach ($events as $event): ?>

                            <option
                                value="<?= htmlspecialchars($event['id']) ?>">

                                <?= htmlspecialchars($event['event_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        CSV File
                    </label>

                    <input
                        type="file"
                        name="csv_file"
                        class="form-control"
                        accept=".csv"
                        required>

                    <div class="form-text">
                        Only CSV files are allowed. Maximum file size: 2MB.
                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Upload CSV

                </button>

                <a
                    href="index.php"
                    class="btn btn-secondary">

                    Back

                </a>

            </form>

            <?php if (!empty($participants)): ?>

    <hr class="my-4">

    <h4 class="mb-3">
        Registered Participants
    </h4>

    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>
                    <th>No.</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($participants as $index => $participant): ?>

                    <tr>

                        <td>
                            <?= $index + 1 ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($participant['student_id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($participant['student_name']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($participant['email']) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

<?php endif; ?>

        </div>

    </div>

</div>

</body>

</html>