<?php
session_start();  // Start the session

// Redirect to dashboard if already logged in
if (isset($_SESSION['admin_username'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../includes/db-connection/db_connection.php';  // Ensure DB connection is included

    // Sanitize and get the form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Query the database for user with the given email
    $sql = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        
        // Check if the password matches
        if (password_verify($password, $admin['password'])) {
            // Store the session data
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['profile_image'] = $admin['profile_image'];  // Store profile image from DB if available
            header('Location: ../index.php');  // Redirect to dashboard
            exit();
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "No user found with this email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Log In</title>
    <style>
        /* Basic reset for better cross-browser compatibility */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #4c6ef5, #d6336c);
            color: #fff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            transition: all 0.3s ease-in-out;
        }

        h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #fff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 1rem;
            margin-bottom: 5px;
            color: #fff;
        }

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: background-color 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            background-color: rgba(255, 255, 255, 0.5);
        }

        input[type="submit"] {
            background-color: #4c6ef5;
            border: none;
            color: #fff;
            padding: 12px;
            font-size: 1.2rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #3b5bdb;
        }

        a {
            color: #fff;
            text-decoration: underline;
            font-size: 0.9rem;
            margin-top: 10px;
            text-align: center;
            display: block;
        }

        a:hover {
            color: #d6336c;
        }

        /* Mobile-friendly adjustments */
        @media (max-width: 600px) {
            body {
                padding: 20px;
            }

            .container {
                width: 100%;
            }

            h2 {
                font-size: 1.8rem;
            }

            input[type="email"],
            input[type="password"] {
                font-size: 0.9rem;
            }
        }

        /* Optional animation on form load */
        .container {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-message {
            color: #ff3333;
            margin-top: 10px;
            text-align: center;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Log In</h2>
        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <input type="submit" name="login" value="Log In">
        </form>
        <p><a href="forgot_password.php">Forgot Password?</a></p>

        <?php
        if (isset($error_message)) {
            echo "<div class='error-message'>$error_message</div>";
        }
        ?>
    </div>
</body>
</html>
