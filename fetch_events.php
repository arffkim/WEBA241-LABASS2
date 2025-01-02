<?php
session_start();
include('db.php'); // Include your database connection file

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "You are not logged in."]);
    exit;
}

// Fetch events from the database
$sql = "SELECT id, title, description, location, type, date_from, date_to, days FROM tbl_events_request ORDER BY created_at DESC";
$result = $conn->query($sql);

$events = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

// Return events as JSON
header('Content-Type: application/json');
echo json_encode($events);

$conn->close();
?>
