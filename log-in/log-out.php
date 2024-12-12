<?php
session_start(); // Start the session

// Destroy the session to log out the user
session_unset();
session_destroy();

// Redirect to the login page (or dashboard with default user info)
header("Location: ../index.php");
exit();
?>
