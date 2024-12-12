// signup password validation

document.getElementById('signupForm').addEventListener('submit', function(event) {
    let password = document.getElementById('password').value;
    let confirm_password = document.getElementById('confirm_password').value;

    if (password !== confirm_password) {
        alert('Passwords do not match!');
        event.preventDefault(); // Stop form from submitting
    }
});

// ---------------------------------------------------------------------------------------------------

// Handle staff request submission
function submitRequest() {
    const companyName = document.getElementById('companyName').value;
    const numEmployees = document.getElementById('numEmployees').value;
    const cleaningType = document.getElementById('cleaningType').value;
    const dateRequired = document.getElementById('dateRequired').value;

    // Simple validation
    if (companyName && numEmployees && cleaningType && dateRequired) {
        // Populate the request details for the third-party company
        const requestDetails = `
            <p><strong>Company Name:</strong> ${companyName}</p>
            <p><strong>Number of Employees Required:</strong> ${numEmployees}</p>
            <p><strong>Cleaning Type:</strong> ${cleaningType}</p>
            <p><strong>Date Required:</strong> ${dateRequired}</p>
        `;

        document.getElementById('requestDetails').innerHTML = requestDetails;

        // Show approval section
        document.getElementById('approvalSection').style.display = 'block';
    }
}

// Handle approval of request
function approveRequest() {
    updateStatusMessage("Request Approved! The cleaning staff will be provided.");
}

// Handle rejection of request
function rejectRequest() {
    updateStatusMessage("Request Rejected. Please contact the third-party company for more details.");
}

// Function to update status notification
function updateStatusMessage(message) {
    const statusMessage = document.getElementById('statusMessage');
    statusMessage.textContent = message;

    // Show notification
    document.getElementById('statusNotification').style.display = 'block';

    // Hide approval buttons
    document.getElementById('approveButton').style.display = 'none';
    document.getElementById('rejectButton').style.display = 'none';
}

// -------------------------------tasks--------------------------------------------------------------------------------------


// document.addEventListener('DOMContentLoaded', function() {
//     fetchTasks();

//     // Form submit
//     document.getElementById('taskForm').addEventListener('submit', function(e) {
//         e.preventDefault();
//         let id = document.getElementById('taskId').value;
//         let item_no = document.getElementById('item_no').value;
//         let description = document.getElementById('description').value;
//         let frequency = document.getElementById('frequency').value;
//         let weighting_percentage = document.getElementById('weighting_percentage').value;

//         if (id) {
//             updateTask(id, item_no, description, frequency, weighting_percentage);
//         } else {
//             addTask(item_no, description, frequency, weighting_percentage);
//         }
//     });
// });

// // Fetch tasks
// function fetchTasks() {
//     fetch('task-details/task_fetch.php')
//         .then(response => response.json())
//         .then(data => {
//             let tableBody = document.querySelector('#taskTable tbody');
//             let rows = '';
//             data.forEach(task => {
//                 rows += `<tr>
//                     <td>${task.item_no}</td>
//                     <td>${task.description}</td>
//                     <td>${task.frequency}</td>
//                     <td>${task.weighting_percentage}</td>
//                     <td>
//                         <button class="edit-btn" onclick="editTask(${task.id})">Edit</button>
//                         <button class="delete-btn" onclick="deleteTask(${task.id})">Delete</button>
//                     </td>
//                 </tr>`;
//             });
//             tableBody.innerHTML = rows;
//         });
// }

// // Add Task
// function addTask(item_no, description, frequency, weighting_percentage) {
//     fetch('task-details/task_add.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({
//             item_no,
//             description,
//             frequency,
//             weighting_percentage
//         })
//     }).then(() => {
//         fetchTasks();
//         document.getElementById('taskForm').reset();
//     });
// }

// // Edit Task Function
// function editTask(id) {
//     fetch(`task-details/task_fetch.php?id=${id}`)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(task => {
//             // Populate form fields with fetched data
//             document.getElementById('taskId').value = task.id;
//             document.getElementById('item_no').value = task.item_no;
//             document.getElementById('description').value = task.description;
//             document.getElementById('frequency').value = task.frequency;
//             document.getElementById('weighting_percentage').value = task.weighting_percentage;

//             // Change the form title and button text for editing
//             document.getElementById('form-title').innerText = 'Edit Task';
//             document.getElementById('save_task').innerText = 'Update Task';

//             // Make the form visible if it’s hidden (optional)
//             document.getElementById('task_form').style.display = 'block';
//         })
//         .catch(error => {
//             console.error('Error fetching task:', error);
//         });
// }



// // Save/Update Task (submit the form data to update the task)
// document.getElementById('taskForm').addEventListener('submit', function(e) {
//     e.preventDefault();

//     let id = document.getElementById('taskId').value;
//     let item_no = document.getElementById('item_no').value;
//     let description = document.getElementById('description').value;
//     let frequency = document.getElementById('frequency').value;
//     let weighting_percentage = document.getElementById('weighting_percentage').value;

//     // Log form data to check if values are being passed correctly
//     console.log("Form data being sent:", {
//         id,
//         item_no,
//         description,
//         frequency,
//         weighting_percentage
//     });

//     fetch('task-details/task_update.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({
//                 id: id,
//                 item_no: item_no,
//                 description: description,
//                 frequency: frequency,
//                 weighting_percentage: weighting_percentage
//             })
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log("Server response:", data); // Log the server's response for debugging
//             if (data.success) {
//                 alert('Task updated successfully!');
//                 fetchTasks(); // Refresh the task list
//                 resetForm(); // Reset the form for adding a new task
//             } else {
//                 alert('Failed to update task.');
//             }
//         })
//         .catch(error => {
//             console.error('Error updating task:', error);
//         });
// });

// // Function to reset the form after editing
// function resetForm() {
//     // Clear form fields
//     document.getElementById('taskId').value = '';
//     document.getElementById('item_no').value = '';
//     document.getElementById('description').value = '';
//     document.getElementById('frequency').value = '';
//     document.getElementById('weighting_percentage').value = '';

//     // Change form title and button text back to "Add Task"
//     document.getElementById('form-title').innerText = 'Add Task';
//     document.getElementById('save_task').innerText = 'Save Task';
// }



// // Delete Task
// function deleteTask(id) {
//     fetch(`task-details/task_delete.php?id=${id}`, {
//         method: 'GET'
//     }).then(() => fetchTasks());
// }

// -----------------------------------------------------------------------------------------------------------

document.getElementById('salary-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    // Fetch the calculation results using AJAX
    fetch('calculate.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        document.getElementById('result-section').innerHTML = result;
        document.getElementById('result-section').style.display = 'block';
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// ---------------------------------------------slidebar-------------------------------------------


// ------------------------footer------------------------------------------------------------------
// This script dynamically sets the current year for the copyright
document.addEventListener('DOMContentLoaded', function() {
    const currentYear = new Date().getFullYear();
    document.getElementById('currentYear').textContent = currentYear;
});

