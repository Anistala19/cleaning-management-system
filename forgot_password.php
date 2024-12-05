<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <form action="forgot_password.php" method="POST">
            <div class="form-group">
                <label for="email">Enter your email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
