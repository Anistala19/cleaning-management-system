<?php
include 'db_connection.php';

$sql = "SELECT * FROM task_report";
$result = $conn->query($sql);

$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}
echo json_encode($tasks);
?>