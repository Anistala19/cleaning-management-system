<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="wrapper">
        <?php include 'slidebar.php'; ?>

        <!-- Main Dashboard -->
        <div class="main-content">
            <?php include 'header.php'; ?>

            <section class="dashboard">
                <div class="cards">
                    <a href="#">
                        <div class="card">
                            <img src="img/background.avif" alt="">
                            <hr>
                            <h3>Task Details</h3>
                        </div>
                    </a>
                    <a href="staff-request.php">
                        <div class="card">
                            <img src="img/background.avif" alt="">
                            <hr>
                            <h3>Employee Requirement</h3>
                        </div>
                    </a>
                    <a href="#">
                        <div class="card">
                            <img src="img/background.avif" alt="">
                            <hr>
                            <h3>Salary Requirement</h3>
                        </div>
                    </a>
                </div>
                <div class="cards">
                    <a href="#">
                        <div class="card">
                            <img src="img/background.avif" alt="">
                            <hr>
                            <h3>Salary Calculation</h3>
                        </div>
                    </a>
                    <a href="reports.php">
                        <div class="card">
                            <img src="img/background.avif" alt="">
                            <hr>
                            <h3>Reports</h3>
                        </div>
                    </a>
                    <a href="/calendar/calendar.php">
                        <div class="card">
                            <img src="img/background.avif" alt="">
                            <hr>
                            <h3>Calender</h3>
                        </div>
                    </a>
                </div>

            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="scripts.js"></script>
</body>

</html>