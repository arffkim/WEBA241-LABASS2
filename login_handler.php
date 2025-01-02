<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Check if the user exists
    $stmt = $conn->prepare("SELECT id, fullname, email, password FROM tbl_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $fullname, $userEmail, $hashedPassword);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Store user details in the session
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_name'] = $fullname;
            $_SESSION['user_email'] = $userEmail;

            echo "<script>
                    alert('Login successful!');
                    window.location.href = 'mainpage.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Incorrect password.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Email not registered.');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
