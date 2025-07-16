<?php
session_start();
include 'connection2.php'; // Include the database connection

if (isset($_GET['SSLC_Register'])) {
    $sslc_register = $_GET['SSLC_Register'];

    // Fetch the student details
    $stmt = $conn->prepare("SELECT * FROM seat_allotment WHERE SSLC_Register = ?");
    $stmt->bind_param("s", $sslc_register);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) {
        echo "No record found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Handle form submission for updating
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated values from the form
    $branch_allocated = $_POST['branch_allocated'];
    $allocated_category = $_POST['allocated_category'];
    $fees_paid = $_POST['fees_paid'];
    $receipt_number = $_POST['receipt_number'];
    $email = $_POST['email'];

    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE seat_allotment SET branch_allocated = ?, allocated_category = ?, fees_paid = ?, receipt_number = ?, email = ? WHERE SSLC_Register = ?");
    $stmt->bind_param("ssssss", $branch_allocated, $allocated_category, $fees_paid, $receipt_number, $email, $sslc_register);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Record updated successfully.";
    } else {
        $_SESSION['message'] = "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location = seat_allotment.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Seat Allotment</title>
</head>
<body>
    <h2>Update Seat Allotment</h2>
    <form action="" method="post">
        <label for="branch_allocated">Branch Allocated:</label>
        <input type="text" name="branch_allocated" value="<?php echo htmlspecialchars($student['branch_allocated']); ?>" required><br>

        <label for="allocated_category">Allocated Category:</label>
        <input type="text" name="allocated_category" value="<?php echo htmlspecialchars($student['allocated_category']); ?>" required><br>

        <label for="fees_paid">Fees Paid:</label>
        <input type="text" name="fees_paid" value="<?php echo htmlspecialchars($student['fees_paid']); ?>" required><br>

        <label for="receipt_number">Receipt Number:</label>
        <input type="text" name="receipt_number" value="<?php echo htmlspecialchars($student['receipt_number']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>