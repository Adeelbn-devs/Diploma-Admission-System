<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure database connection file exists
if (!file_exists('db_connection.php')) {
    die("❌ Error: Missing database connection file.");
}

require 'db_connection.php';

// Check if the connection is successful
if (!$conn) {
    die("❌ Error: Database connection failed.");
}

// Check if session contains SSLC_Register
if (!isset($_SESSION['SSLC_Register'])) {
    die("❌ Error: SSLC_Register session not set. Please login again.");
}

$SSLC_Register = $_SESSION['SSLC_Register'];

// Fetch student details securely
$sql = "SELECT * FROM students WHERE SSLC_Register = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("❌ SQL Error: " . $conn->error);
}

$stmt->bind_param("s", $SSLC_Register);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    die("❌ No student found with SSLC Register: " . htmlspecialchars($SSLC_Register));
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare an array to hold the responses
    $responses = [
        'sslc_marks_card' => isset($_POST['sslc_marks_card']) ? $_POST['sslc_marks_card'] : 'No',
        'tc' => isset($_POST['tc']) ? $_POST['tc'] : 'No',
        'caste_certificate' => isset($_POST['caste_certificate']) ? $_POST['caste_certificate'] : 'No',
        'income_certificate' => isset($_POST['income_certificate']) ? $_POST['income_certificate'] : 'No',
        'study_certificate' => isset($_POST['study_certificate']) ? $_POST['study_certificate'] : 'No',
        'kannada_medium_certificate' => isset($_POST['kannada_medium_certificate']) ? $_POST['kannada_medium_certificate'] : 'No',
        'rural_quota_certificate' => isset($_POST['rural_quota_certificate']) ? $_POST['rural_quota_certificate'] : 'No',
        'special_quota_certificate' => isset($_POST['special_quota_certificate']) ? $_POST['special_quota_certificate'] : 'No',
        'aadhar_card' => isset($_POST['aadhar_card']) ? $_POST['aadhar_card'] : 'No',
        'student_photo' => isset($_POST['student_photo']) ? $_POST['student_photo'] : 'No'
    ];

    // Prepare the SQL statement to insert or update the responses
    $sql = "INSERT INTO certificates (SSLC_Register, sslc_marks_card, tc, caste_certificate, income_certificate, study_certificate, kannada_medium_certificate, rural_quota_certificate, special_quota_certificate, aadhar_card,student_photo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?) 
            ON DUPLICATE KEY UPDATE 
            sslc_marks_card = VALUES(sslc_marks_card), 
            tc = VALUES(tc), 
            caste_certificate = VALUES(caste_certificate), 
            income_certificate = VALUES(income_certificate), 
            study_certificate = VALUES(study_certificate), 
            kannada_medium_certificate = VALUES(kannada_medium_certificate), 
            rural_quota_certificate = VALUES(rural_quota_certificate), 
            special_quota_certificate = VALUES(special_quota_certificate), 
            aadhar_card = VALUES(aadhar_card),
            student_photo=VALUES(student_photo)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }

    $stmt->bind_param("sssssssssss", 
        $SSLC_Register, 
        $responses['sslc_marks_card'], 
        $responses['tc'], 
        $responses['caste_certificate'], 
        $responses['income_certificate'], 
        $responses['study_certificate'], 
        $responses['kannada_medium_certificate'], 
        $responses['rural_quota_certificate'], 
        $responses['special_quota_certificate'], 
        $responses['aadhar_card'],
        $responses['student_photo']
    );

    // Execute the statement
    if ($stmt->execute()) {
        // Store submitted data in session to pass to success2.php
        $_SESSION['submitted_data'] = $responses;

        // Redirect to success2.php
        header("Location: success2.php");
        exit();
    } else {
        die("❌ Error saving data: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>