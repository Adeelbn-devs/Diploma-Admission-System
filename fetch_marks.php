<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "diploma_admission";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SSLC_Register = $_POST['SSLC_Register'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT names, marks_obtained, parent_mobile FROM students WHERE SSLC_Register = ?");
    $stmt->bind_param("s", $SSLC_Register);
    
    // Execute the statement
    $stmt->execute();
    
    // Bind result variables
    $stmt->bind_result($names, $marks_obtained, $parent_mobile);
    
    // Fetch the result
    if ($stmt->fetch()) {
        // Store data in session
        $_SESSION['SSLC_Register'] = $SSLC_Register;
        $_SESSION['names'] = $names;
        $_SESSION['marks_obtained'] = $marks_obtained;
        $_SESSION['parent_mobile'] = $parent_mobile; // Store parent's mobile number

        // Redirect to marks_card.php
        header("Location: marks_card.php");
        exit();
    } else {
        $error_message = "No records found for the provided SSLC Register number.";
    }
    
    // Close the statement
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fetch Marks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
        nav {
            background-color: #4CAF50;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<nav>
    <a href="branch.php">Branches</a>
    <a href="application_form.php">Application Form</a>
    <a href="fetch_marks.php">Fetch Marks</a>
    <a href="marks_card.php">Document Verification</a>
    <a href="view_marks.php">View Marks</a>
    <a href="seat_allotment.php">Seat Allotment</a>
</nav>
<h2>Fetch Marks by SSLC Register</h2>
<form method="post">
    <label for="SSLC_Register">SSLC Register No:</label>
    <input type="text" name="SSLC_Register" required>
    <input type="submit" value="Fetch">
</form>

<?php if ($error_message): ?>
    <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>
</body>
</html>