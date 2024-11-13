<?php

function login($username, $password) {
    @ $db = new mysqli('localhost', 'root', '', 'sureship');

    if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }
        
    $stmt = $db->prepare("SELECT userID, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            //$username = $user['username'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['userID'] = $user['userID'];
            //$_SESSION['token'] = $token;

            // Not allowed JSON :(
            //echo json_encode(["status" => "success", "token" => $token]);

            // Return plain text instead
            return true;
        } else {
            //echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
            return false;
        }
    } else {
        //echo json_encode(["status" => "error", "message" => "User not found"]);
        return false;
    }
    
    $stmt->close();
    $db->close();
}
?>
