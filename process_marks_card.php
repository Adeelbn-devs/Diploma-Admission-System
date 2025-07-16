<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "diploma_admission";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_data = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $register_number = $_POST['register_number'];
    $allotted_category = $_POST['allotted_category'];
    $branch_allotted = $_POST['branch_allotted'];
    $fees_paid_receipt_number = $_POST['fees_paid_receipt_number'];

    // Prepare SQL statement to insert seat allotment details
    $stmt = $conn->prepare("INSERT INTO seat_allotment (register_number, allotted_category, branch_allotted, fees_paid_receipt_number) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $register_number, $allotted_category, $branch_allotted, $fees_paid_receipt_number);

    if ($stmt->execute()) {
        echo "<script>alert('Seat allotment details submitted successfully.');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch student data based on register number
if (isset($_GET['register_number'])) {
    $register_number = $_GET['register_number'];
    $sql = "SELECT * FROM students WHERE SSLC_Register = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $register_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student_data = $result->fetch_assoc();
    } else {
        echo "No student found with the given register number.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seat Allotment</title>
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
            max-width: 600px;
            margin: auto;
        }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Seat Allotment</h2>
    <form method="post" action="">
        <?php if ($student_data): ?>
            <p><strong>Register Number:</strong> <?php echo htmlspecialchars($student_data['SSLC_Register']); ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($student_data['names']); ?></p>
            <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($student_data['father_name']); ?></p>
            <p><strong>Mother's Name:</strong> <?php echo htmlspecialchars($student_data['mother_name']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($student_data['dob']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($student_data['gender']); ?></p>
            <p><strong>Qualifying Examination:</strong> <?php echo htmlspecialchars($student_data['exam_type']); ?></p>
            <p><strong>Caste:</strong> <?php echo htmlspecialchars($student_data['caste_name']); ?></p>
            <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($student_data['mobile']); ?></p>

            <input type="hidden" name="register_number" value="<?php echo htmlspecialchars($student_data['SSLC_Register']); ?>">
        <?php else: ?>
            <p>No student data available.</p>
        <?php endif; ?>

        <label for="allotted_category">Allotted Category:</label>
        <input type="text" name="allotted_category" required>

        <label for="branch_allotted">Branch Allotted:</label>
        <input type="text" name="branch_allotted" required>

        <label for="fees_paid_receipt_number">Fees Paid Receipt Number:</label>
        <input type="text" name="fees_paid_receipt_number" required>

        <input type="submit" value="Submit Seat Allotment">
    </form>
</body>
</html>