<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - Event Management System</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center align-items-center"
         style="min-height: 100vh;">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        Event Management System
                    </h2>

                    <p class="text-center text-muted">
                        Please login to continue
                    </p>

                    <!-- Error message -->
                    <?php if (!empty($error)): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>

                    <?php endif; ?>


                    <!-- Login Form -->
                    <form method="POST"
                          action="">

                        <!-- Username -->
                        <div class="mb-3">

                            <label
                                for="username"
                                class="form-label">

                                Username

                            </label>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control"
                                placeholder="Enter username"
                                maxlength="50"
                                required>

                        </div>


                        <!-- Password -->
                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter password"
                                required>

                        </div>


                        <!-- Login Button -->
                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary">

                                Login

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>