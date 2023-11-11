<?php
// Start the session
session_start();

// Check if the "logout" button is clicked
if (isset($_POST['logout'])) {
    // Destroy the session, effectively logging the user out
    session_destroy();

    // Redirect the user to the login page or any other desired location
    header("Location: index.php");
    exit;
}
?>