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

// -------------------------------------------------------------------------------

// script.js
function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Fetch values from the form
    const taskDescription = document.getElementById('taskDescription').value;
    const frequency = document.getElementById('frequency').value;
    const weightPercentage = document.getElementById('weightPercentage').value;
    const dateCompleted = document.getElementById('dateCompleted').value;

    // Add text to the PDF
    doc.text("Task Report", 20, 20);
    doc.text(`Task Description: ${taskDescription}`, 20, 40);
    doc.text(`Frequency: ${frequency}`, 20, 50);
    doc.text(`Weighting Percentage: ${weightPercentage}%`, 20, 60);
    doc.text(`Date Completed: ${dateCompleted}`, 20, 70);

    // Save the PDF
    doc.save("task_report.pdf");
}
