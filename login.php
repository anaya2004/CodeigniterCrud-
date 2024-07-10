<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        /* Reset box model and set default font */
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        /* Body styling */
        body {
            background-color: #f3f4f7; /* Light background color */
            padding-top: 50px; /* Space for navbar */
        }
        /* Login container */
        .login {
            width: 400px;
            background-color: #ffffff; /* White background */
            box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
            margin: 0 auto; /* Center horizontally */
            padding: 20px;
            border-radius: 5px;
        }
        /* Login header styling */
        .login h1 {
            text-align: center;
            color: #333; /* Dark text color */
            font-size: 24px;
            margin-bottom: 20px;
        }
        /* Input field styling */
        .login input[type="email"],
        .login input[type="password"] {
            width: 100%;
            height: 50px;
            border: 1px solid #ccc; /* Light border */
            margin-bottom: 20px;
            padding: 0 15px;
            border-radius: 3px;
        }
        /* Submit button styling */
        .login input[type="submit"] {
            width: 100%;
            height: 50px;
            background-color: #3274d6; /* Blue button */
            border: 0;
            cursor: pointer;
            font-weight: bold;
            color: #ffffff; /* White text color */
            border-radius: 3px;
            transition: background-color 0.2s;
        }
        /* Button hover effect */
        .login input[type="submit"]:hover {
            background-color: #2868c7; /* Darker blue on hover */
        }
        /* Error message styling */
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <!-- Display error message if any -->
        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <!-- Form for user login -->
        <?php echo form_open('TempController/login',['method'=>'post']); ?>
            <label for="email">
                <i class="fas fa-user"></i> <!-- User icon -->
            </label>
            <input type="email" name="email" placeholder="Email" id="email" required>
            <?php echo form_error('email'); ?> <!-- Display email validation error if any -->
            <label for="password">
                <i class="fas fa-lock"></i> <!-- Lock icon -->
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <?php echo form_error('password'); ?> <!-- Display password validation error if any -->
            <input type="submit" value="Login">
        <?php echo form_close(); ?>
    </div>
</body>
</html>
