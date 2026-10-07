<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Event Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h3 class="text-center mb-4">
                        Register
                    </h3>

                    <?php if (!empty($error)): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>

                    <?php endif; ?>


                    <?php if (!empty($success)): ?>

                        <div class="alert alert-success">
                            <?= htmlspecialchars($success) ?>
                        </div>

                    <?php endif; ?>


                    <form method="POST" action="register.php">

                        <!-- Username -->
                        <div class="mb-3">

                            <label class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                minlength="3"
                                maxlength="50"
                                required>

                        </div>


                        <!-- Password -->
                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                minlength="6"
                                required>

                        </div>


                        <!-- Register Button -->
                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Register

                        </button>

                    </form>


                    <div class="text-center mt-3">

                        <span>
                            Already have an account?
                        </span>

                        <a href="login.php">
                            Login here
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>