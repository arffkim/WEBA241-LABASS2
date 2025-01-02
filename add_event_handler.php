<?php
session_start();
include('db.php'); // Include your database connection file

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        "success" => false,
        "message" => "You are not logged in. Please log in first."
    ]);
    exit;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $location = $conn->real_escape_string($_POST['location']);
    $type = $conn->real_escape_string($_POST['type']);
    $dateFrom = $conn->real_escape_string($_POST['dateFrom']);
    $dateTo = $conn->real_escape_string($_POST['dateTo']);
    $days = $conn->real_escape_string($_POST['days']);

    // Validate required fields
    if (empty($title) || empty($description) || empty($location) || empty($type) || empty($dateFrom) || empty($dateTo) || empty($days)) {
        echo json_encode([
            "success" => false,
            "message" => "All fields are required."
        ]);
        exit;
    }

    // Prepare SQL query to insert event data into the database
    $stmt = $conn->prepare("INSERT INTO tbl_events_request (title, description, location, type, date_from, date_to, days, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssssi", $title, $description, $location, $type, $dateFrom, $dateTo, $days);

    if ($stmt->execute()) {
        // If the event is added successfully
        echo json_encode([
            "success" => true,
            "message" => "Event added successfully!"
        ]);
    } else {
        // If there is an error
        echo json_encode([
            "success" => false,
            "message" => "Error: " . $conn->error
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
}

$conn->close();
?>
