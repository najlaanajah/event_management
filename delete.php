<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "controllers/EventController.php";

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if ($id) {

    $controller = new EventController();

    $controller->deleteEvent($id);
}

header("Location: index.php");
exit;
?>