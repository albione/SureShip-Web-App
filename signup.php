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

    $stmt = $db->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >= 1) {
        echo "signup;error;Username already exists. Please choose a different username.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");

        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        if ($stmt->execute()) {
            echo "signup;success;Account creation successful! You can now log in.";
        } else {
            echo "signup;error;" . $stmt->error;
        }
    }

    $stmt->close();
    $db->close();
}
?>