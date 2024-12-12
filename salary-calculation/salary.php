<?php
// Start the session
session_start();

// Include TCPDF library
require_once('../tcpdf/tcpdf.php');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_db";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input values
    $cleaners_count = htmlspecialchars($_POST['cleaners_count']);
    $rate_per_cleaner = htmlspecialchars($_POST['rate_per_cleaner']);
    $attendance_percentage = htmlspecialchars($_POST['attendance_percentage']);
    $work_done_percentage = htmlspecialchars($_POST['work_done_percentage']);
    $quality_percentage = htmlspecialchars($_POST['quality_percentage']);
    $penalty = htmlspecialchars($_POST['penalty']);

    $supervisors_count = htmlspecialchars($_POST['supervisors_count']);
    $rate_per_supervisor = htmlspecialchars($_POST['rate_per_supervisor']);
    $work_done_zone_percentage = htmlspecialchars($_POST['work_done_zone_percentage']);
    $quality_zone_percentage = htmlspecialchars($_POST['quality_zone_percentage']);

    // Cleaners' Payment Calculations
    $cleaners_attendance_payment = $cleaners_count * $rate_per_cleaner * (40 / 100);
    $cleaners_work_done_payment = $cleaners_count * $rate_per_cleaner * (50 / 100) * ($work_done_percentage / 100);
    $cleaners_quality_payment = $cleaners_count * $rate_per_cleaner * (10 / 100) * ($quality_percentage / 100) - ($penalty / 100);

    // Ensure the quality payment does not go negative due to penalty
    $cleaners_quality_payment = max($cleaners_quality_payment, 0);
    $cleaners_total_payment = $cleaners_attendance_payment + $cleaners_work_done_payment + $cleaners_quality_payment;

    // Supervisors' Payment Calculations
    $supervisors_attendance_payment = $supervisors_count * $rate_per_supervisor * (40 / 100);
    $supervisors_work_done_payment = $supervisors_count * $rate_per_supervisor * (50 / 100) * ($work_done_zone_percentage / 100);
    $supervisors_quality_payment = $supervisors_count * $rate_per_supervisor * (10 / 100) * ($quality_zone_percentage / 100);
    $supervisors_total_payment = $supervisors_attendance_payment + $supervisors_work_done_payment + $supervisors_quality_payment;

    // Total Monthly Payment
    $total_payment = $cleaners_total_payment + $supervisors_total_payment;

    // ... existing code for database connection and calculations ...

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // ... calculations code ...

  // Store calculated data in session
  $_SESSION['salary_report'] = [
      'cleaners_attendance_payment' => $cleaners_attendance_payment,
      'cleaners_work_done_payment' => $cleaners_work_done_payment,
      'cleaners_quality_payment' => $cleaners_quality_payment,
      'cleaners_total_payment' => $cleaners_total_payment,
      'supervisors_attendance_payment' => $supervisors_attendance_payment,
      'supervisors_work_done_payment' => $supervisors_work_done_payment,
      'supervisors_quality_payment' => $supervisors_quality_payment,
      'supervisors_total_payment' => $supervisors_total_payment,
      'total_payment' => $total_payment
  ];

  // Redirect to the salary-view page
  header('Location: salary-view.php');
  exit();
}

}

?>