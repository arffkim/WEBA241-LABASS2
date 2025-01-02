<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Redirecting...</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: 'You are not logged in. Please log in first.',
        }).then(() => {
            window.location.href = 'login.php';
        });
    </script>
    </body>
    </html>";
    exit;
}

// Fetch the event data if an ID is provided
if (isset($_GET['id'])) {
    $eventId = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM tbl_events_request WHERE id = ?");
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        echo "<script>
            alert('Event not found.');
            window.location.href = 'mainpage.php';
        </script>";
        exit;
    }
    $stmt->close();
} else {
    echo "<script>
        alert('No event ID provided.');
        window.location.href = 'mainpage.php';
    </script>";
    exit;
}

// Update event details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $location = $conn->real_escape_string($_POST['location']);
    $type = $conn->real_escape_string($_POST['type']);
    $dateFrom = $conn->real_escape_string($_POST['dateFrom']);
    $dateTo = $conn->real_escape_string($_POST['dateTo']);
    $days = intval($_POST['days']);

    $stmt = $conn->prepare("UPDATE tbl_events_request SET title = ?, description = ?, location = ?, type = ?, date_from = ?, date_to = ?, days = ? WHERE id = ?");
    $stmt->bind_param("ssssssii", $title, $description, $location, $type, $dateFrom, $dateTo, $days, $eventId);

    if ($stmt->execute()) {
        echo "<script>
            alert('Event updated successfully.');
            window.location.href = 'mainpage.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to update event.');
            window.history.back();
        </script>";
    }
    $stmt->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #f0f8ff, #e6f2ff);
            color: #333;
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        .navbar .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: #4a90e2;
        }

        .form-container {
            max-width: 800px;
            /* Increased width */
            margin: 60px auto;
            padding: 50px;
            /* Increased padding */
            background: #ffffff;
            border-radius: 20px;
            /* Larger border radius for a smoother look */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            /* Enhanced shadow for depth */
            transition: all 0.3s ease-in-out;
        }

        .form-container:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            /* Hover effect for interaction */
            transform: scale(1.02);
            /* Slight enlargement on hover */
        }

        .form-title {
            font-size: 2.5rem;
            /* Larger title font */
            font-weight: 700;
            color: #4a90e2;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #ddd;
            padding: 12px 20px;
            /* Increased padding for a more spacious feel */
            font-size: 1.1rem;
            /* Slightly larger text */
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 10px rgba(74, 144, 226, 0.6);
            /* More pronounced focus effect */
        }

        .btn-primary {
            background-color: #4a90e2;
            border: none;
            padding: 15px 25px;
            /* Larger button size */
            font-size: 1.2rem;
            /* Larger font */
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 12px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 25px;
        }

        .btn-primary:hover {
            background-color: #357ab8;
            box-shadow: 0 10px 20px rgba(53, 122, 184, 0.3);
            /* Enhanced hover shadow */
        }


        footer {
            background: #ffffff;
            text-align: center;
            padding: 15px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
            margin-top: auto;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
            color: #666;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
                margin: 20px;
            }

            .form-title {
                font-size: 1.8rem;
            }

            .btn-primary {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="mainpage.php">
                <img src="myevent.png" alt="MyEvent Logo" class="logo" style="max-height: 50px; margin-right: 10px;">
                <span class="fw-bold">MyEvent</span>
            </a>
        </div>
    </nav>

    <!-- Edit Event Form -->
    <div class="form-container">
        <h1 class="form-title">Edit Event</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Event Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="<?= htmlspecialchars($event['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                    required><?= htmlspecialchars($event['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location"
                    value="<?= htmlspecialchars($event['location']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="Conference" <?= $event['type'] == 'Conference' ? 'selected' : ''; ?>>Conference</option>
                    <option value="Workshop" <?= $event['type'] == 'Workshop' ? 'selected' : ''; ?>>Workshop</option>
                    <option value="Seminar" <?= $event['type'] == 'Seminar' ? 'selected' : ''; ?>>Seminar</option>
                    <option value="Other" <?= $event['type'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="dateFrom" class="form-label">Date From</label>
                <input type="date" class="form-control" id="dateFrom" name="dateFrom"
                    value="<?= $event['date_from']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="dateTo" class="form-label">Date To</label>
                <input type="date" class="form-control" id="dateTo" name="dateTo" value="<?= $event['date_to']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="days" class="form-label">Number of Days</label>
                <input type="number" class="form-control" id="days" name="days" value="<?= $event['days']; ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Event</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="m-0 text-muted">&copy; 2025 MyEvent. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>