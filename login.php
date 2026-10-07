<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once "controllers/AuthController.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $auth = new AuthController();

    $result = $auth->login(
        $_POST['username'] ?? '',
        $_POST['password'] ?? ''
    );

    if ($result === true) {
        header("Location: index.php");
        exit;
    }

    $error = $result;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Management - Login</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="text-center mb-4">
                        Event Management System
                    </h2>

                    <?php if ($error): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required
                                maxlength="50">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>