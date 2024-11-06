<?php
function getUserData($username) {
    @ $db = new mysqli('localhost', 'root', '', 'sureship');

    if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }
    $stmt = $db->prepare("SELECT username, email, address FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $userData = $result->fetch_assoc(); // Fetch user data as an associative array
    } else {
        echo "<script>
            alert('User not found.');
            window.location.href = 'login.html';
        </script>";
        exit();
    }
    
    $stmt->close();
    $db->close();

    return $userData;
}
?>