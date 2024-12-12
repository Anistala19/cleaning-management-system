<?php
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
    // Retrieve session data for the salary report
    session_start();
    $salary_report = $_SESSION['salary_report'];

    // Create a new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Salary Report');

    // Add a page
    $pdf->AddPage();

    // Set content for the salary report
    $html = "<h1>Salary Report</h1>";
    $html .= "<h2>Cleaners' Payment</h2>";
    $html .= "<p><strong>Attendance Payment:</strong> Rs. " . number_format($salary_report['cleaners_attendance_payment'], 2) . "</p>";
    $html .= "<p><strong>Work Done Payment:</strong> Rs. " . number_format($salary_report['cleaners_work_done_payment'], 2) . "</p>";
    $html .= "<p><strong>Quality Payment:</strong> Rs. " . number_format($salary_report['cleaners_quality_payment'], 2) . "</p>";
    $html .= "<h3><strong>Total Cleaners' Payment:</strong> Rs. " . number_format($salary_report['cleaners_total_payment'], 2) . "</h3>";
    $html .= "<h2>Supervisors' Payment</h2>";
    $html .= "<p><strong>Attendance Payment:</strong> Rs. " . number_format($salary_report['supervisors_attendance_payment'], 2) . "</p>";
    $html .= "<p><strong>Work Done Payment:</strong> Rs. " . number_format($salary_report['supervisors_work_done_payment'], 2) . "</p>";
    $html .= "<p><strong>Quality Payment:</strong> Rs. " . number_format($salary_report['supervisors_quality_payment'], 2) . "</p>";
    $html .= "<h3><strong>Total Supervisors' Payment:</strong> Rs. " . number_format($salary_report['supervisors_total_payment'], 2) . "</h3>";
    $html .= "<h2><strong>Total Monthly Payment:</strong> Rs. " . number_format($salary_report['total_payment'], 2) . "</h2>";

    // Write the HTML content to the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Save the PDF to a directory on the server
    $file_path = '../salary_reports/salary_report_' . time() . '.pdf';
    $pdf->Output($file_path, 'F'); // 'F' saves the file to a local path

    // Insert the PDF file path into the database
    $stmt = $conn->prepare("INSERT INTO salary_reports (file_path, report_date) VALUES (?, NOW())");
    $stmt->bind_param("s", $file_path);

    if ($stmt->execute()) {
        echo "Salary report saved to database.";
    } else {
        echo "Error saving report to database: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
