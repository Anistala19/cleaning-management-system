<?php
include 'db_connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$item_no = $data['item_no'];
$description = $data['description'];
$frequency = $data['frequency'];
$weighting_percentage = $data['weighting_percentage'];

$sql = "UPDATE task_report SET 
        item_no='$item_no', 
        description='$description', 
        frequency='$frequency', 
        weighting_percentage='$weighting_percentage'
        WHERE id=$id";
$conn->query($sql);
?>
