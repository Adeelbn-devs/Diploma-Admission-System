<?php
session_start();
include 'connection2.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sslc_register = $_POST['SSLC_Register'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM seat_allotment WHERE SSLC_Register = ?");
    $stmt->bind_param("s", $sslc_register);

    if ($stmt->execute()) {
        // Redirect back to the seat allotment page with a success message
        $_SESSION['message'] = "Record deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: seat_allotment.php");
    exit();
}
?>