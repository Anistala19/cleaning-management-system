<?php
$servername = "localhost";
$username = "root"; // Adjust this to your database username
$password = ""; // Adjust this to your database password
$dbname = "cleaning_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

