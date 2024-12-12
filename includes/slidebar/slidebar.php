<?php
session_start();  // Start the session

// Check if the session variable for admin username exists
$admin_username = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Guest';

// Check if the session variable for profile image exists
$profile_image = isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image']) 
                 ? $_SESSION['profile_image'] 
                 : '../log-in/uploads/User-Profile-PNG-High-Quality-Image.png';  // Default profile image
?>

<!-- Sidebar -->
<nav class="sidebar">
    <div class="user-profile">
        <!-- Profile Image -->
        <img id="profileAvatar" src="<?php echo $profile_image; ?>" alt="profile Image" style="cursor: pointer;">

        <!-- Admin Username -->
        <span><?php echo htmlspecialchars($admin_username); ?></span>
    </div>

    <ul class="menu">
        <li><a href="index.php" class="active">Dashboard</a></li>
        <li><a href="calendar/calendar.php">Calendar</a></li>
        <li><a href="staff-request.php">Employee Requirement</a></li>
        <li><a href="salary-calculation/salary.php">Salary Calculation</a></li>
        <li><a href="">Reports</a></li>
    </ul>
</nav>

