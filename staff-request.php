<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Staff Request</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="wrapper">
        <?php include 'slidebar.php'; ?>

        <!-- Main Dashboard -->
        <div class="main-content">
            <?php include 'header.php'; ?>

            <div class="staff-request container">
                <h1>Request for Additional Employees</h1>

                <!-- Request Form -->
                <form id="requestForm">
                    <div class="form-group">
                        <label for="companyName">Company Name</label>
                        <input type="text" id="companyName" name="companyName" required>
                    </div>

                    <div class="form-group">
                        <label for="numEmployees">Number of Employees Required</label>
                        <input type="number" id="numEmployees" name="numEmployees" required>
                    </div>

                    <div class="form-group">
                        <label for="cleaningType">Cleaning Type</label>
                        <select id="cleaningType" name="cleaningType" required>
                            <option value="" disabled selected>Select Cleaning Type</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dateRequired">Date Required</label>
                        <input type="date" id="dateRequired" name="dateRequired" required>
                    </div>

                    <button type="button" onclick="submitRequest()">Submit Request</button>
                </form>

                <!-- Approval Section -->
                <div id="approvalSection" class="approval-section">
                    <h2>Third-Party Company Approval</h2>
                    <div id="requestDetails"></div>
                    <button id="approveButton" class="approve" onclick="approveRequest()">Approve</button>
                    <button id="rejectButton" class="reject" onclick="rejectRequest()">Reject</button>
                </div>

                <!-- Status Notification -->
                <div id="statusNotification">
                    <p id="statusMessage"></p>
                </div>
            </div>

        </div>
    </div>

    <script src="scripts.js"></script>
</body>

</html>