<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once "controllers/AuthController.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $auth = new AuthController();

    $result = $auth->register(
        $_POST['username'] ?? '',
        $_POST['password'] ?? ''
    );

    if ($result === true) {
        $success = "Registration successful. You can now login.";
    } else {
        $error = $result;
    }
}

require_once "views/auth/register.php";
?>