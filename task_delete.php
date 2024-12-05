<?php
include 'db_connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM task_report WHERE id=$id";
$conn->query($sql);
?>
