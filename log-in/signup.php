<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #4c6ef5, #d6336c);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        /* Container */
        .container {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
            transition: all 0.3s ease-in-out;
        }

        /* Heading */
        h2 {
            margin-bottom: 20px;
            font-size: 2rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #fff;
        }

        /* Form Elements */
        label {
            display: block;
            margin: 10px 0 5px;
            color: #fff;
            font-size: 1rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
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

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="file"]:focus {
            background-color: rgba(255, 255, 255, 0.5);
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #5cb85c;
            color: white;
            font-size: 1.2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        /* Success Message */
        .success-message {
            background-color: #28a745;
            color: white;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Login Button */
        .login-link {
            margin-top: 15px;
            display: block;
            color: #fff;
            font-size: 1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .login-link:hover {
            color: #d6336c;
        }

        /* Mobile Responsive */
        @media (max-width: 600px) {
            body {
                padding: 20px;
            }

            .container {
                width: 100%;
                padding: 25px;
            }

            h2 {
                font-size: 1.8rem;
            }
        }

        /* Fade-In Animation */
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Sign Up</h2>
        <form action="signup.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <label for="profile_image">Profile Image</label>
            <input type="file" name="profile_image" accept="image/*">

            <input type="submit" name="signup" value="Sign Up">
        </form>

        <?php
        // signup.php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
            require '../includes/db-connection/db_connection.php';

            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            // Default profile image if none is uploaded
            $profile_image = 'default.jpg'; 

            // Handle profile image upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
                $img_name = $_FILES['profile_image']['name'];
                $img_temp = $_FILES['profile_image']['tmp_name'];
                $img_new_name = uniqid() . '-' . $img_name;
                $upload_dir = 'uploads/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);  // Make sure the uploads directory exists
                move_uploaded_file($img_temp, $upload_dir . $img_new_name);
                $profile_image = $img_new_name;
            }

            // SQL query to insert user into the database
            $sql = "INSERT INTO admins (username, email, password, profile_image) VALUES ('$username', '$email', '$password', '$profile_image')";
            if (mysqli_query($conn, $sql)) {
                // Success message after sign-up
                echo "<div class='success-message'>Sign Up successful! <a href='login.php' class='login-link'>Login here</a></div>";
            } else {
                // Display error message if there was an issue
                echo "<div class='error-message'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>

        <a href="login.php" class="login-link">Already have an account? Log in</a>
    </div>
</body>
</html>
