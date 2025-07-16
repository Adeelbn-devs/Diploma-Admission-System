<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: home.php"); // Redirect to home page if already logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Set a fixed width for the login container */
        }

        h2 {
            margin-bottom: 20px;
            text-align: center; /* Center the heading */
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px; /* Increased padding for better touch targets */
            box-sizing: border-box;
            border: 1px solid #ccc; /* Add a border */
            border-radius: 4px; /* Rounded corners */
        }

        input:focus {
            border-color: #5cb85c; /* Change border color on focus */
            outline: none; /* Remove default outline */
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px; /* Increase font size */
        }

        button:hover {
            background-color: #4cae4c; /* Darker green on hover */
        }

        .message {
            margin-top: 15px;
            text-align: center; /* Center the message */
        }

        .success {
            color: green; /* Success message color */
        }

        .error {
            color: red; /* Error message color */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p id="message" class="message">
                <?php
                if (isset($_SESSION['message'])) {
                    // Display success or error message based on the session variable
                    $messageClass = $_SESSION['message_type'] === 'success' ? 'success' : 'error';
                    echo "<span class='$messageClass'>" . $_SESSION['message'] . "</span>";
                    unset($_SESSION['message']); // Clear the message after displaying
                    unset($_SESSION['message_type']); // Clear the message type after displaying
                }
                ?>
            </p>
        </form>
    </div>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Define the correct credentials
        $correct_email = 'dacgadmission@gmail.com';
        $correct_password = 'dacg@123';

        // Validate the credentials
        if ($email === $correct_email && $password === $correct_password) {
            // Set session variable to indicate the user is logged in
            $_SESSION['loggedin'] = true;
            // Set a success message and redirect to home page after 3 seconds
            $_SESSION['message'] = 'Login successful! Redirecting to home page...';
            $_SESSION['message_type'] = 'success'; // Set message type to success
            header("refresh:3;url=home.php"); // Redirect to home.php after 3 seconds
            exit();
        } else {
            // Set an error message
            $_SESSION['message'] = 'Username and password error.';
            $_SESSION['message_type'] = 'error'; // Set message type to error
        }
    }
    ?>
</body>
</html>