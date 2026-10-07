<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: register.php");
    exit;
}

require_once "controllers/EventController.php";

$controller = new EventController();
$events = $controller->getEvents();

require_once "views/events/index.php";

?>