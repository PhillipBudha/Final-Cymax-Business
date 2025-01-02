<?php
// Start the session
session_start();

// Check if a session exists
if (isset($_SESSION)) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();
}

// Redirect to the login page
header("Location: login.php");
exit();
?>
