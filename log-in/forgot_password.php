<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* same style as sign up page */
    </style>
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="forgot_password.php" method="POST">
            <label for="email">Enter your Email</label>
            <input type="email" name="email" required>
            <input type="submit" name="forgot_password" value="Submit">
        </form>
    </div>
</body>
</html>
<?php
// forgot_password.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['forgot_password'])) {
    require '../includes/db-connection/db_connection.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sql = "SELECT * FROM admins WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $update = "UPDATE admins SET reset_token='$token', reset_expiry='$expiry' WHERE email='$email'";
        if (mysqli_query($conn, $update)) {
            echo "Password reset link sent!";
            // Email reset link logic here (e.g., mail())
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Email not found!";
    }
}
?>
