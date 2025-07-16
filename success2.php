<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if submitted data exists in session
if (!isset($_SESSION['submitted_data'])) {
    die("❌ Error: No data submitted. Please go back and submit the form.");
}

// Retrieve submitted data
$submitted_data = $_SESSION['submitted_data'];

// Clear the submitted data from session
unset($_SESSION['submitted_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Success</title>
    <style>
    body {
        font-family: 'Roboto', sans-serif; /* Google Font */
        background-color: #f0f2f5; /* Light background */
        padding: 20px;
        margin: 0;
    }
    nav {
        background-color: #3a9a2d; /* Dark green */
        padding: 15px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }
    nav a {
        color: #ffffff;
        margin: 0 20px;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
    }
    nav a:hover {
        text-decoration: underline;
        color: #d1e7dd;
    }
    .container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
        border-left: 5px solid #4CAF50; /* Accent border */
    }
    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }
    p {
        font-size: 18px;
        color: #555;
    }
    h3 {
        color: #3a9a2d; /* Accent color */
        margin-top: 20px;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        background: #e9ecef;
        margin: 10px 0;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .back-button {
        margin-top: 30px;
        text-align: center;
    }
    .back-button a {
        text-decoration: none;
        color: white;
        background-color: #3a9a2d;
        padding: 12px 25px;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.3s;
    }
    .back-button a:hover {
        background-color: #2e7d27; /* Darker green */
        transform: translateY(-2px);
    }
    .print-button {
        margin-top: 20px;
        text-align: center;
    }
    .print-button button {
        text-decoration: none;
        color: white;
        background-color: #007bff; /* Blue */
        padding: 12px 25px;
        border-radius: 5px;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }
    .print-button button:hover {
        background-color: #0056b3; /* Darker blue */
        transform: translateY(-2px);
    }
    </style>
</head>
<body>
    <nav>
        <a href="application_form.php">Application Form</a>
        <a href="fetch_marks.php">Fetch Marks</a>
        <a href="marks_card.php">Document Verification</a>
        <a href="view_marks.php">View Marks</a>
        <a href="success2.php">Document Success</a>
    </nav>
    <div class="container">
        <h2>Submission Successful</h2>
        <p>Your responses have been recorded successfully.</p>

        <h3>Document Submission Status:</h3>
        <ul>
            <?php foreach ($submitted_data as $key => $value): ?>
                <li><?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $key))) . ": " . $value; ?></li>
            <?php endforeach; ?>
        </ul>

        
    </div>
    <div class="back-button">
            <a href="view_marks.php">Go to View Marks</a>
        </div>
        <div class="print-button">
            <button onclick="window.print()">Print this page</button>
        </div>
</body>
</html>