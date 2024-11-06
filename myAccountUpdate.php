<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "<script>
            alert('You must be logged in to access this page.');
            window.location.href = 'login.html';
          </script>";
    exit();
}
@ $db = new mysqli('localhost', 'root', '', 'sureship');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}
$username = $_SESSION['username'];
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$address = trim($_POST['address']);

$stmt = $db->prepare("UPDATE users SET email = ?, password = ?, address = ? WHERE username = ?");
if ($stmt) {
    // Hash the password (if you plan to store it hashed)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("ssss", $email, $hashedPassword, $address, $username);
    
    if ($stmt->execute()) {
        echo "success;Your account information has been updated successfully!";
    } else {
        echo "error;Error updating your account information. Please try again.";
    }
    $stmt->close();
    } else {
        echo "error;Database error, please try again later.";
    }

$db->close();
?>