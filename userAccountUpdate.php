<?php

function getUserData($username) {
    @ $db = new mysqli('localhost', 'root', '', 'sureship');

    if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }
    $stmt = $db->prepare("SELECT userID, username, email, address FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $userData = $result->fetch_assoc();
    } else {
        echo "<script>
            alert('User not found.');
            window.location.href = 'login.php';
        </script>";
        exit();
    }
    
    $stmt->close();
    $db->close();

    return $userData;
}

function updateUserData($username, $usernameToChange, $email, $password, $address) {
    @ $db = new mysqli('localhost', 'root', '', 'sureship');

    if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }

    $stmt = $db->prepare("UPDATE users SET username = ?, email = ?, password = ?, address = ? WHERE username = ?");
    if ($stmt) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssss", $usernameToChange, $email, $hashedPassword, $address, $username);
        
        if ($stmt->execute()) {
            $_SESSION['username'] = $usernameToChange;
            echo "<script> alert('Account information successfully updated!'); </script>";
            echo "<script> window.location.href = 'myAccount.php'; </script>";
        } else {
            echo "<script> alert('Error updating your account information. Please try again.'); </script>";
        }
        $stmt->close();
    } else {
        echo "<script> alert('Database error, please try again later.'); </script>";
    }

    $db->close();
}
?>
