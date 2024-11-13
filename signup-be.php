<?php

function signUp($username, $email, $password) {
    @ $db = new mysqli('localhost', 'root', '', 'sureship');

    if (mysqli_connect_errno()) {
        error_log("Database connection error: " . mysqli_connect_error());
        return ['price' => 'Error: Could not connect to database.'];
    }

    $stmt = $db->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >= 1) {
        echo "<script> alert('Username already exists. Please choose a different username.'); </script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");

        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        if ($stmt->execute()) {
            echo "<script> alert('Account creation successful! You can now log in.'); </script>";
            echo "<script> window.location.href = 'login.php'; </script>";
        } else {
            echo "<script> alert($stmt->error); </script>";
        }
    }

    $stmt->close();
    $db->close();
}

?>
