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

// Fetching data from the students table
$sql = "SELECT SSLC_Register, marks_obtained, science_math_total, submission_date, sslc_marks_card FROM students ORDER BY marks_obtained DESC"; // Fetch required columns
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View SSLC Marks Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
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


        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #45a049;
        }

        .red-link {
            color: red; /* Set the link color to red */
            text-decoration: none; /* Remove underline */
        }

        .red-link:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
<nav>
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
</nav>
<h2>Marks Obtained and Percentage</h2>
<table>
    <tr>
        <th>SSLC Register</th>
        <th>Science & Maths Total</th>
        <th>Marks Obtained</th>
        <th>Percentage</th>
        <th>Submission Date</th>
        <th>Marks Card</th> <!-- New column for marks card -->
        <th>Action</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $marks_obtained = htmlspecialchars($row['marks_obtained']);
            $science_math_total = htmlspecialchars($row['science_math_total']);
            $submission_date = htmlspecialchars($row['submission_date']);
            $sslc_marks_card = htmlspecialchars($row['sslc_marks_card']);
            $percentage = ($marks_obtained / 625) * 100; // Calculate percentage based on a total of 625

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['SSLC_Register']) . "</td>";
            echo "<td>" . $science_math_total . "</td>";
            echo "<td>" . $marks_obtained . "</td>";
            echo "<td>" . number_format($percentage, 2) . "%</td>"; // Format percentage to 2 decimal places
            echo "<td>" . $submission_date . "</td>";

            // Check if the marks card is uploaded
            if (empty($sslc_marks_card)) {
                echo "<td><span class='red-link'>Marks Card Not Uploaded</span></td>";
            } else {
                // Change the link to point to view_image.php
                echo "<td><a class='button' href='view_image.php?image=" . urlencode($sslc_marks_card) . "' target='_blank'>View Marks Card</a></td>";
            }
            echo "<td><a class='button' href='seat_allotment.php?marks=" . $marks_obtained . "'>Go to Seat Allotment</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
    }
    ?>
</table>
</body>
</html>

<?php 
$conn->close();
?>