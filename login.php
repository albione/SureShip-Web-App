<?php
session_start();

@ $db = new mysqli('localhost', 'root', '', 'sureship');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $db->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password == $user['password']) {
            //$token = $user['username'];
            $_SESSION['username'] = $user['username'];
            //$_SESSION['token'] = $token;

            // Not allowed JSON :(
            //echo json_encode(["status" => "success", "token" => $token]);

            // Return plain text instead
            echo "success;$token";
        } else {
            //echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
            echo "error;Invalid credentials";
        }
    } else {
        echo json_encode(["status" => "error", "message" => "User not found"]);
    }
}
?>