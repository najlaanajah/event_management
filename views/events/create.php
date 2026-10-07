<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Event</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">
                Add New Event
            </h2>

            <?php if ($error): ?>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Event Name
                    </label>

                    <input
                        type="text"
                        name="event_name"
                        class="form-control"
                        maxlength="150"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Event Date
                    </label>

                    <input
                        type="date"
                        name="event_date"
                        class="form-control"
                        min="<?= date('Y-m-d') ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Venue
                    </label>

                    <input
                        type="text"
                        name="venue"
                        class="form-control"
                        maxlength="150"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Target Audience
                    </label>

                    <input
                        type="text"
                        name="target_audience"
                        class="form-control"
                        maxlength="150"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Estimated Budget (RM)
                    </label>

                    <input
                        type="number"
                        name="budget"
                        class="form-control"
                        min="0"
                        step="0.01"
                        value="0"
                        required>

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Save Event

                </button>

                <a
                    href="index.php"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>