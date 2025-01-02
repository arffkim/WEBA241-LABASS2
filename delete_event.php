<?php
header('Content-Type: application/json'); // Ensure the response is JSON

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteParams); // Parse DELETE input
    $eventId = isset($_GET['id']) ? intval($_GET['id']) : null;

    if (!$eventId) {
        http_response_code(400); // Bad Request
        echo json_encode(["success" => false, "message" => "Invalid event ID."]);
        exit;
    }

    include 'db.php'; // Include database connection

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM tbl_events_request WHERE id = ?");
    $stmt->bind_param("i", $eventId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Event deleted successfully."]);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["success" => false, "message" => "Event not found."]);
        }
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(["success" => false, "message" => "Failed to delete event."]);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
