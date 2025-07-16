<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "diploma_admission";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to allot seats
function allotSeat($branch_id) {
    global $conn;

    // Check available seats
    $sql = "SELECT government_seats, donor_seats, snq_seats FROM branches WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $branch_id);
    $stmt->execute();
    $stmt->bind_result($gov_seats, $donor_seats, $snq_seats);
    $stmt->fetch();
    $stmt->close();

    // Allot seat based on availability
    if ($gov_seats > 0) {
        $new_gov_seats = $gov_seats - 1;
        $sql = "UPDATE branches SET government_seats = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_gov_seats, $branch_id);
        $stmt->execute();
        $stmt->close();
        return "Allotted a Government seat.";
    } elseif ($donor_seats > 0) {
        $new_donor_seats = $donor_seats - 1;
        $sql = "UPDATE branches SET donor_seats = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_donor_seats, $branch_id);
        $stmt->execute();
        $stmt->close();
        return "Allotted a Donor seat.";
    } elseif ($snq_seats > 0) {
        $new_snq_seats = $snq_seats - 1;
        $sql = "UPDATE branches SET snq_seats = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_snq_seats, $branch_id);
        $stmt->execute();
        $stmt->close();
        return "Allotted a SNQ seat.";
    } else {
        return "No seats available.";
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applicant_name = $_POST['applicant_name'];
    $branch_id = $_POST['branch_id'];

    // Insert application
    $sql = "INSERT INTO applications (applicant_name, branch_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $applicant_name, $branch_id);
    $stmt->execute();
    $stmt->close();

    // Allot seat
    $seat_status = allotSeat($branch_id);

    // Update application status
    $sql = "UPDATE applications SET status = ? WHERE applicant_name = ? AND branch_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $seat_status, $applicant_name, $branch_id);
    $stmt->execute();
    $stmt->close();

    echo "Application submitted successfully. " . $seat_status;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px  0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .success-message {
            text-align: center;
            color: green;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Application Form</h1>
    <form action="" method="POST">
        <label for="applicant_name">Applicant Name:</label>
        <input type="text" id="applicant_name" name="applicant_name" required>
        
        <label for="branch_id">Select Branch:</label>
        <select id="branch_id" name="branch_id" required>
            <option value="1">Automobile Engineering</option>
            <option value="2">Civil Engineering</option>
            <option value="3">Computer Science and Engineering</option>
            <option value="4">Electrical and Electronics Engineering</option>
            <option value="5">Electronics and Communications Engineering</option>
            <option value="6">Mechanical Engineering</option>
        </select>
        
        <button type="submit">Submit Application</button>
    </form>
</body>
</html>