<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "controllers/EventController.php";

$controller = new EventController();

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {
    die("Invalid event ID.");
}

$event = $controller->getEvent($id);

if (!$event) {
    die("Event not found.");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $result = $controller->updateEvent($_POST);

    if ($result === true) {

        header("Location: index.php");
        exit;

    } else {

        $error = $result;
    }
}

require_once "views/events/edit.php";

?>