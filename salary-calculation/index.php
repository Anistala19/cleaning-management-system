<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Calculator</title>
    <link rel="stylesheet" href="../includes/css/styles.css">
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <?php include '../includes/slidebar/slidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php include '../includes/header.php'; ?>

            <div class="container salary">
                <div class="header">
                    <h1>Salary Calculation Portal</h1>
                    <p>Calculate salary for cleaners and supervisors easily and efficiently!</p>
                </div>

                <form action="salary.php" method="post" id="salary-form">
                    <!-- Cleaners Payment Section -->
                    <div class="section">
                        <h2>Cleaners' Payment</h2>

                        <div class="form-group">
                            <label for="cleaners_count">Number of Cleaners</label>
                            <input type="number" id="cleaners_count" name="cleaners_count" required>
                        </div>

                        <div class="form-group">
                            <label for="rate_per_cleaner">Rate per Cleaner (Rs.)</label>
                            <input type="number" id="rate_per_cleaner" name="rate_per_cleaner" required>
                        </div>

                        <div class="form-group">
                            <label for="attendance_percentage">Attendance Percentage (%)</label>
                            <input type="number" id="attendance_percentage" name="attendance_percentage" required>
                        </div>

                        <div class="form-group">
                            <label for="work_done_percentage">Work Done Percentage (%)</label>
                            <input type="number" id="work_done_percentage" name="work_done_percentage" required>
                        </div>

                        <div class="form-group">
                            <label for="quality_percentage">Quality Percentage (%)</label>
                            <input type="number" id="quality_percentage" name="quality_percentage" required>
                        </div>

                        <div class="form-group">
                            <label for="penalty">Penalty (%)</label>
                            <input type="number" id="penalty" name="penalty" value="0" min="0" max="100">
                        </div>
                    </div>

                    <!-- Supervisors Payment Section -->
                    <div class="section">
                        <h2>Supervisors' Payment</h2>

                        <div class="form-group">
                            <label for="supervisors_count">Number of Supervisors</label>
                            <input type="number" id="supervisors_count" name="supervisors_count" required>
                        </div>

                        <div class="form-group">
                            <label for="rate_per_supervisor">Rate per Supervisor (Rs.)</label>
                            <input type="number" id="rate_per_supervisor" name="rate_per_supervisor" required>
                        </div>

                        <div class="form-group">
                            <label for="work_done_zone_percentage">Work Done Percentage for Zone (%)</label>
                            <input type="number" id="work_done_zone_percentage" name="work_done_zone_percentage" required>
                        </div>

                        <div class="form-group">
                            <label for="quality_zone_percentage">Quality Percentage for Zone (%)</label>
                            <input type="number" id="quality_zone_percentage" name="quality_zone_percentage" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="submit-section">
                        <button type="submit" id="calculate-button">Calculate Salary</button>
                    </div>

                </form>

                <!-- Result Section -->
                <div class="result-section" id="result-section">
                    <!-- The calculation results will be shown here dynamically -->
                </div>
            </div>
        </div>
    </div>

</body>

</html>
