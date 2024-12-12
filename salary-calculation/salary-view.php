<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Report</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../includes/css/styles.css">
</head>

<body>

    <div class="wrapper">

        <!-- Sidebar -->
        <?php include '../includes/slidebar/slidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php include '../includes/header.php'; ?>

            <?php

// Check if salary report data exists in the session
if (!isset($_SESSION['salary_report'])) {
    die('No salary data found.');
}

// Retrieve the salary report data from the session
$salary_report = $_SESSION['salary_report'];
?>

            <div class="container salary-view">
                <h1>Salary Information</h1>

                <h2>Cleaners' Payment</h2>
                <p><strong>Attendance Payment:</strong> Rs.
                    <?php echo number_format($salary_report['cleaners_attendance_payment'], 2); ?></p>
                <p><strong>Work Done Payment:</strong> Rs.
                    <?php echo number_format($salary_report['cleaners_work_done_payment'], 2); ?></p>
                <p><strong>Quality Payment:</strong> Rs.
                    <?php echo number_format($salary_report['cleaners_quality_payment'], 2); ?></p>
                <h3><strong>Total Cleaners' Payment:</strong> Rs.
                    <?php echo number_format($salary_report['cleaners_total_payment'], 2); ?></h3>

                <h2>Supervisors' Payment</h2>
                <p><strong>Attendance Payment:</strong> Rs.
                    <?php echo number_format($salary_report['supervisors_attendance_payment'], 2); ?></p>
                <p><strong>Work Done Payment:</strong> Rs.
                    <?php echo number_format($salary_report['supervisors_work_done_payment'], 2); ?></p>
                <p><strong>Quality Payment:</strong> Rs.
                    <?php echo number_format($salary_report['supervisors_quality_payment'], 2); ?></p>
                <h3><strong>Total Supervisors' Payment:</strong> Rs.
                    <?php echo number_format($salary_report['supervisors_total_payment'], 2); ?></h3>

                <h2><strong>Total Monthly Payment:</strong> Rs.
                    <?php echo number_format($salary_report['total_payment'], 2); ?></h2>

                <!-- Button to download PDF -->
                <form action="download-pdf.php" method="post">
                    <button type="submit">Download PDF</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>