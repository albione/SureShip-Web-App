<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = [];

// If it's desired to kill the session, also delete the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Remove the sessionToken cookie if set
if (isset($_COOKIE['sessionToken'])) {
    setcookie('sessionToken', '', time() - 3600, '/'); // Expire the cookie
}

// Redirect to the login page or index page
header("Location: login.html");
exit();
?>