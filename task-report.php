<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Report</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="wrapper">
        <?php include 'slidebar.php'; ?>

        <!-- Main Dashboard -->
        <div class="main-content">
            <?php include 'header.php'; ?>

            <h2>Task Report</h2>
            <table id="taskTable">
                <thead>
                    <tr>
                        <th>Item No.</th>
                        <th>Description</th>
                        <th>Frequency</th>
                        <th>Weighting Percentage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be fetched from PHP -->
                </tbody>
            </table>

            <!-- Add/Edit Form -->
            <h3 id="form-title">Add New Task</h3>
            <form id="taskForm">
                <input type="hidden" id="taskId">
                <label>Item No: </label><input type="text" id="item_no"><br><br>
                <label>Description: </label><input type="text" id="description"><br><br>
                <label>Frequency: </label><input type="text" id="frequency"><br><br>
                <label>Weighting Percentage: </label><input type="text" id="weighting_percentage"><br><br>
                <button type="submit">Save Task</button>
            </form>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetchTasks();

                // Form submit
                document.getElementById('taskForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    let id = document.getElementById('taskId').value;
                    let item_no = document.getElementById('item_no').value;
                    let description = document.getElementById('description').value;
                    let frequency = document.getElementById('frequency').value;
                    let weighting_percentage = document.getElementById('weighting_percentage').value;

                    // Add or Edit
                    if (id) {
                        updateTask(id, item_no, description, frequency, weighting_percentage);
                    } else {
                        addTask(item_no, description, frequency, weighting_percentage);
                    }
                });
            });

            // Fetch tasks
            function fetchTasks() {
                fetch('task_fetch.php')
                    .then(response => response.json())
                    .then(data => {
                        let tableBody = document.querySelector('#taskTable tbody');
                        tableBody.innerHTML = '';
                        data.forEach(task => {
                            let row = `<tr>
                    <td>${task.item_no}</td>
                    <td>${task.description}</td>
                    <td>${task.frequency}</td>
                    <td>${task.weighting_percentage}</td>
                    <td>
                        <button class="edit-btn" onclick="editTask(${task.id})">Edit</button>
                        <button class="delete-btn" onclick="deleteTask(${task.id})">Delete</button>
                    </td>
                </tr>`;
                            tableBody.innerHTML += row;
                        });
                    });
            }

            // Add Task
            function addTask(item_no, description, frequency, weighting_percentage) {
                fetch('task_add.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        item_no,
                        description,
                        frequency,
                        weighting_percentage
                    })
                }).then(() => fetchTasks());
            }

            // Edit Task
            function editTask(id) {
                fetch(`task_fetch_single.php?id=${id}`)
                    .then(response => response.json())
                    .then(task => {
                        document.getElementById('taskId').value = task.id;
                        document.getElementById('item_no').value = task.item_no;
                        document.getElementById('description').value = task.description;
                        document.getElementById('frequency').value = task.frequency;
                        document.getElementById('weighting_percentage').value = task.weighting_percentage;
                        document.getElementById('form-title').innerText = 'Edit Task';
                    });
            }

            // Update Task
            function updateTask(id, item_no, description, frequency, weighting_percentage) {
                fetch('task_update.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id,
                        item_no,
                        description,
                        frequency,
                        weighting_percentage
                    })
                }).then(() => {
                    fetchTasks();
                    document.getElementById('form-title').innerText = 'Add New Task';
                    document.getElementById('taskForm').reset();
                });
            }

            // Delete Task
            function deleteTask(id) {
                fetch(`task_delete.php?id=${id}`, {
                    method: 'GET'
                }).then(() => fetchTasks());
            }
            </script>

        </div>
    </div>

</body>

</html>

<?php
require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

$html = '<h2>Task Report</h2>';
$html .= '<table border="1" cellpadding="5">
            <tr>
                <th>Item No.</th>
                <th>Description</th>
                <th>Frequency</th>
                <th>Weighting Percentage</th>
            </tr>';

// Fetch the task data
$sql = "SELECT * FROM task_db";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $row['item_no'] . '</td>
                <td>' . $row['description'] . '</td>
                <td>' . $row['frequency'] . '</td>
                <td>' . $row['weighting_percentage'] . '</td>
              </tr>';
}

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('task_report.pdf', 'D');
?>

