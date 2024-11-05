<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    @ $db = new mysqli('localhost', 'root', '', 'sureship');

    if (mysqli_connect_errno()) {
        error_log("Database connection error: " . mysqli_connect_error());
        return ['price' => 'Error: Could not connect to database.'];
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");

    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        echo "alert(\"New user created successfully.\");";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
}
?>