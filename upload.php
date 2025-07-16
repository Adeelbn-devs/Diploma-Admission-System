<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$uploads_dir = 'uploads'; // Directory where files will be uploaded

// Create uploads directory if it doesn't exist
if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir, 0755, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve SSLC Register from the form
    $SSLC_Register = $_POST['SSLC_Register'];
    $_SESSION['SSLC_Register'] = $SSLC_Register;

    // Array to hold file paths
    $file_paths = [];

    // Handle file uploads
    $documents = [
        'sslc_marks_card',
        'tc',
        'caste_certificate',
        'income_certificate',
        'study_certificate',
        'kannada_medium_certificate',
        'rural_quota_certificate',
        'special_quota_certificate',
        'aadhar_card'
    ];

    foreach ($documents as $doc) {
        if (isset($_FILES[$doc]) && $_FILES[$doc]['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES[$doc]['tmp_name'];
            $name = basename($_FILES[$doc]['name']);
            $file_path = "$uploads_dir/$name";
            if (move_uploaded_file($tmp_name, $file_path)) {
                $file_paths[$doc] = $file_path; // Store the file path
            } else {
                echo "Failed to move uploaded file for $doc.<br>";
                $file_paths[$doc] = null; // Handle missing files as needed
            }
        } else {
            echo "Error uploading file for $doc: " . $_FILES[$doc]['error'] . "<br>";
            $file_paths[$doc] = null; // Handle missing files as needed
        }
    }

    // Store file paths in session
    $_SESSION['file_paths'] = $file_paths;

    // Redirect to marks_card.php
    header("Location: marks_card.php");
    exit();
}
?>