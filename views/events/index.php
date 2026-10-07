<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Event Dashboard</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <span class="navbar-brand">
            Event Management System
        </span>

        <div class="text-white">

            Welcome,
            <?= htmlspecialchars($_SESSION['username']) ?>

            <a
                href="logout.php"
                class="btn btn-light btn-sm ms-2">

                Logout

            </a>

        </div>

    </div>

</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">

        <h2>Event List</h2>

        <a
            href="create.php"
            class="btn btn-success">

            + Add Event

        </a>

        <a 
           href="upload.php" 
           class="btn btn-success">

           Upload Participants
           
        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Target Audience</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php if (count($events) > 0): ?>

                    <?php foreach ($events as $event): ?>

                        <tr>

                            <td>
                                <?= $event['id'] ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($event['event_name']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($event['event_date']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($event['venue']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($event['target_audience']) ?>
                            </td>

                            <td>
                                RM <?= number_format($event['budget'], 2) ?>
                            </td>

                            <td>

                                <?php if ($event['status'] === 'Approved'): ?>

                                    <span class="badge bg-success">
                                        Approved
                                    </span>

                                <?php elseif ($event['status'] === 'Rejected'): ?>

                                    <span class="badge bg-danger">
                                        Rejected
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>
                                <?= htmlspecialchars($event['username']) ?>
                            </td>

                            <td>

                                <a
                                    href="edit.php?id=<?= $event['id'] ?>"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <a
    href="delete.php?id=<?= $event['id'] ?>"
    class="btn btn-danger btn-sm"
    onclick="return confirm('Are you sure you want to delete this event?');">
    Delete
</a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="9"
                            class="text-center">

                            No events found.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="public/csss/script.js"></script>

</body>

</html>