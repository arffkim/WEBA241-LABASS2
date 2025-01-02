<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirmPassword']);

    // Validate passwords
    if ($password !== $confirmPassword) {
        echo "<script>
                alert('Passwords do not match!');
                window.location.href = 'register.php';
              </script>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute SQL
    $stmt = $conn->prepare("INSERT INTO tbl_users (fullname, email, password, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $fullname, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>
                alert('Registration successful! You can now log in.');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . htmlspecialchars($conn->error) . "');
                window.location.href = 'register.php';
              </script>";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
