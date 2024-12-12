<?php
// Start the session
session_start();

// Include TCPDF library
require_once('../tcpdf/tcpdf.php');

// Check if salary report data exists in the session
if (!isset($_SESSION['salary_report'])) {
    die('No salary data found.');
}

// Retrieve the salary report data from the session
$salary_report = $_SESSION['salary_report'];

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Salary Report');

// Add a page
$pdf->AddPage();

// Set content for Cleaners' Payment
$html = "<h1>Salary Report</h1>";
$html .= "<h2>Cleaners' Payment</h2>";
$html .= "<p><strong>Attendance Payment:</strong> Rs. " . number_format($salary_report['cleaners_attendance_payment'], 2) . "</p>";
$html .= "<p><strong>Work Done Payment:</strong> Rs. " . number_format($salary_report['cleaners_work_done_payment'], 2) . "</p>";
$html .= "<p><strong>Quality Payment:</strong> Rs. " . number_format($salary_report['cleaners_quality_payment'], 2) . "</p>";
$html .= "<h3><strong>Total Cleaners' Payment:</strong> Rs. " . number_format($salary_report['cleaners_total_payment'], 2) . "</h3>";

// Set content for Supervisors' Payment
$html .= "<h2>Supervisors' Payment</h2>";
$html .= "<p><strong>Attendance Payment:</strong> Rs. " . number_format($salary_report['supervisors_attendance_payment'], 2) . "</p>";
$html .= "<p><strong>Work Done Payment:</strong> Rs. " . number_format($salary_report['supervisors_work_done_payment'], 2) . "</p>";
$html .= "<p><strong>Quality Payment:</strong> Rs. " . number_format($salary_report['supervisors_quality_payment'], 2) . "</p>";
$html .= "<h3><strong>Total Supervisors' Payment:</strong> Rs. " . number_format($salary_report['supervisors_total_payment'], 2) . "</h3>";

// Set total monthly payment
$html .= "<h2><strong>Total Monthly Payment:</strong> Rs. " . number_format($salary_report['total_payment'], 2) . "</h2>";

// Output the HTML content into the PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF (download)
$pdf->Output('Salary Report.pdf', 'D');

// Clear session data (optional)
unset($_SESSION['salary_report']);
