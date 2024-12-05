<?php
include 'db_connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$item_no = $data['item_no'];
$description = $data['description'];
$frequency = $data['frequency'];
$weighting_percentage = $data['weighting_percentage'];

$sql = "INSERT INTO task_report (item_no, description, frequency, weighting_percentage) 
        VALUES ('$item_no', '$description', '$frequency', '$weighting_percentage')";
$conn->query($sql);
?>
