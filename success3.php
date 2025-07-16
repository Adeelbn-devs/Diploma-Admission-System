<?php
session_start();
include 'connection2.php';

// Check if the required parameters are set
if (!isset($_GET['register_number']) || !isset($_GET['branch_allocated']) || !isset($_GET['allocated_category']) || !isset($_GET['fees_paid'])) {
    echo "Invalid access!";
    exit();
}

// Retrieve parameters from the URL
$register_number = $_GET['register_number'];
$branch_allocated = $_GET['branch_allocated'];
$allocated_category = $_GET['allocated_category'];
$fees_paid = $_GET['fees_paid'];

// Fetch student details
$sql = "SELECT * FROM students WHERE SSLC_Register = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $register_number);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        header("Location: error.php?message=" . urlencode("Student not found!"));
        exit();
    }
} else {
    echo "Database query failed!";
    exit();
}

// Fetch TC image path
$student_photo_filename = isset($student['student_photo']) ? trim($student['student_photo']) : null; // Ensure this is the correct field
$student_photo_path = $student_photo_filename ? "uploads/" . basename($student_photo_filename) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Allotment Success</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }
        strong {
            color: #555;
        }
        img {
            max-width: 50%;
            height: auto; /* Changed to auto for better aspect ratio */
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .debug {
            font-size: 12px;
            color: #888;
        }
        @media (max-width: 600px) {
            .container {
                width: 95%;
            }
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
        <a href="application_form.php">Application Form</a>
        <a href="fetch_marks.php">Fetch Marks</a>
        <a href="marks_card.php">Document Verification</a>
        <a href="view_marks.php">View Marks</a>
        <a href="seat_allotment.php">Seat Allotment</a>
</nav>
<div class="container">
    <h2>Seat Successfully Allotted</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($student['names']); ?></p>
    <p><strong>Branch Allocated:</strong> <?php echo htmlspecialchars($branch_allocated); ?></p>
    <p><strong>Allocated Category:</strong> <?php echo htmlspecialchars($allocated_category); ?></p>
    <p><strong>Fees Paid Receipt:</strong> <?php echo htmlspecialchars($fees_paid); ?></p>

    <p><strong>Uploaded photo:</strong></p>

    <?php if ($student_photo_path && file_exists($student_photo_path)): ?>
        <img src="<?php echo htmlspecialchars($student_photo_path); ?>" alt="Student Photo" />
    <?php else: ?>
        <p class="error"> Student image not found.</p>
        <p class="debug">Debug: Expected Path - <strong><?php echo htmlspecialchars($student_photo_path); ?></strong></p>
    <?php endif; ?>

    <p><a href="seat_allotment.php">Back to Seat Allotment</a></p>
</div>
</body>
</html>