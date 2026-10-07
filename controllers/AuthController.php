<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    // LOGIN
    public function login($username, $password)
    {
        $username = trim($username);

        if ($username === "" || $password === "") {
            return "Username and password are required.";
        }

        $user = $this->user->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            return true;
        }

        return "Invalid username or password.";
    }

    // REGISTER
    public function register($username, $password)
    {
        $username = trim($username);
        $password = trim($password);

        // Check empty fields
        if ($username === "" || $password === "") {
            return "Username and password are required.";
        }

        // Check username length
        if (strlen($username) < 3 || strlen($username) > 50) {
            return "Username must be between 3 and 50 characters.";
        }

        // Check password length
        if (strlen($password) < 6) {
            return "Password must be at least 6 characters.";
        }

        // Check if username already exists
        if ($this->user->findByUsername($username)) {
            return "Username already exists.";
        }

        // Create new user
        if ($this->user->create($username, $password)) {
            return true;
        }

        return "Registration failed.";
    }
}
?>