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

// Function to get seat balances
function getSeatBalances() {
    global $conn;
    $sql = "SELECT id, name, government_seats, donor_seats, snq_seats FROM branch";
    $result = $conn->query($sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    $balances = [];
    while ($row = $result->fetch_assoc()) {
        $balances[] = $row;
    }
    return $balances;
}

$seat_balances = getSeatBalances(); // Fetch seat balances
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Balances</title>
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
            margin-bottom: 20px;
        }

        nav {
            background-color: #4CAF50;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav a:hover {
            text-decoration: underline;
            color: #d1e7dd;
        }

        .seat-balances {
            margin-top: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .seat-balances table {
            width: 100%;
            border-collapse: collapse;
        }

        .seat-balances th, .seat-balances td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .seat-balances th {
            background-color: #4CAF50;
            color: white;
        }

        .seat-balances tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .seat-balances tr:hover {
            background-color: #e2e2e2;
        }

        .dropdown {
            display: inline-block;
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
<nav>
    <a href="home.php">Home</a>
    <a href="branch.php">Branches</a>
    <div class="dropdown">
        <a href="#">Details</a>
        <div class="dropdown-content">
            <a href="admission_details.php">Admission Details</a>
            <a href="fees_details.php">Fees Details</a>
        </div>
    </div>
    <a href="application_form.php">Application Form</a>
    <a href="fetch_marks.php">Fetch Marks</a>
    <a href="marks_card.php">Document Verification</a>
    <a href="view_marks.php">View Marks</a>
 <a href="seat_allotment.php">Seat Allotment</a>
    <a href="seat_balances.php">Seat Balance</a>
</nav>
<h1>Current Seat Balances</h1>
<div class="seat-balances">
    <table>
        <tr>
            <th>Branch Name</th>
            <th>Government Seats</th>
            <th>Donor Seats</th>
            <th>SNQ Seats</th>
        </tr>
        <?php foreach ($seat_balances as $branch): ?>
        <tr>
            <td><?php echo htmlspecialchars($branch['name']); ?></td>
            <td><?php echo htmlspecialchars($branch['government_seats']); ?></td>
            <td><?php echo htmlspecialchars($branch['donor_seats']); ?></td>
            <td><?php echo htmlspecialchars($branch['snq_seats']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>