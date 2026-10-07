<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "controllers/EventController.php";

$controller = new EventController();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $result = $controller->createEvent(
        $_POST,
        $_SESSION['user_id']
    );

    if ($result === true) {

        header("Location: index.php");
        exit;

    } else {

        $error = $result;
    }
}

require_once "views/events/create.php";

?>