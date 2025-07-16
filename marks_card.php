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

// Fetch document verification responses
$sql_verification = "SELECT * FROM document_verification WHERE SSLC_Register = ?";
$stmt_verification = $conn->prepare($sql_verification);
if (!$stmt_verification) {
    die("❌ SQL Error: " . $conn->error);
}
$stmt_verification->bind_param("s", $SSLC_Register);
$stmt_verification->execute();
$result_verification = $stmt_verification->get_result();
$verification = $result_verification->fetch_assoc();

// Set the correct path for uploaded documents
$upload_dir = ''; // update if your path is different

// File paths
$file_paths = [
    'sslc_marks_card' => !empty($student['sslc_marks_card']) ? $upload_dir . $student['sslc_marks_card'] : null,
    'student_photo' => !empty($student['student_photo']) ? $upload_dir . $student['student_photo'] : null,
    'tc' => !empty($student['tc']) ? $upload_dir . $student['tc'] : null,
    'caste_certificate' => !empty($student['caste_certificate']) ? $upload_dir . $student['caste_certificate'] : null,
    'income_certificate' => !empty($student['income_certificate']) ? $upload_dir . $student['income_certificate'] : null,
    'study_certificate' => !empty($student['study_certificate']) ? $upload_dir . $student['study_certificate'] : null,
    'kannada_medium_certificate' => !empty($student['kannada_medium_certificate']) ? $upload_dir . $student['kannada_medium_certificate'] : null,
    'rural_quota_certificate' => !empty($student['rural_quota_certificate']) ? $upload_dir . $student['rural_quota_certificate'] : null,
    'special_quota_certificate' => !empty($student['special_quota_certificate']) ? $upload_dir . $student['special_quota_certificate'] : null,
    'aadhar_card' => !empty($student['aadhar_card']) ? $upload_dir . $student['aadhar_card'] : null
];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted_data = [
        'names' => $student['names'],
        'SSLC_Register' => $student['SSLC_Register'],
        'marks_obtained' => $student['marks_obtained'],
        'phone_number' => $student['parent_mobile'],
        'sslc_marks_card' => $_POST['sslc_marks_card'],
        'student_photo' => $_POST['student_photo'],
        'tc' => $_POST['tc'],
        'caste_certificate' => $_POST['caste_certificate'],
        'income_certificate' => $_POST['income_certificate'],
        'study_certificate' => $_POST['study_certificate'],
        'kannada_medium_certificate' => $_POST['kannada_medium_certificate'],
        'rural_quota_certificate' => $_POST['rural_quota_certificate'],
        'special_quota_certificate' => $_POST['special_quota_certificate'],
        'aadhar_card' => $_POST['aadhar_card']
    ];

    $_SESSION['submitted_data'] = $submitted_data;

    if ($verification) {
        $update_sql = "UPDATE document_verification SET 
            sslc_marks_card = ?, 
            tc = ?, 
            caste_certificate = ?, 
            income_certificate = ?, 
            study_certificate = ?, 
            kannada_medium_certificate = ?, 
            rural_quota_certificate = ?, 
            special_quota_certificate = ?, 
            aadhar_card = ?, 
            student_photo = ?, 
            phone_number = ?, 
            names = ?,
            marks_obtained = ?
            WHERE SSLC_Register = ?";
        
        $stmt_update = $conn->prepare($update_sql);
        if (!$stmt_update) {
            die("❌ SQL Error: " . $conn->error);
        }

        $stmt_update->bind_param("ssssssssssssss", 
            $_POST['sslc_marks_card'], 
            $_POST['tc'], 
            $_POST['caste_certificate'], 
            $_POST['income_certificate'], 
            $_POST['study_certificate'], 
            $_POST['kannada_medium_certificate'], 
            $_POST['rural_quota_certificate'], 
            $_POST['special_quota_certificate'], 
            $_POST['aadhar_card'], 
            $_POST['student_photo'], 
            $student['parent_mobile'], 
            $student['names'],
            $student['marks_obtained'],
            $SSLC_Register
        );
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        $insert_sql = "INSERT INTO document_verification (SSLC_Register, sslc_marks_card, tc, caste_certificate, income_certificate, study_certificate, kannada_medium_certificate, rural_quota_certificate, special_quota_certificate, aadhar_card, student_photo, phone_number, names, marks_obtained) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_insert = $conn->prepare($insert_sql);
        if (!$stmt_insert) {
            die("❌ SQL Error: " . $conn->error);
        }

        $stmt_insert->bind_param("ssssssssssssss", 
            $SSLC_Register, 
            $_POST['sslc_marks_card'], 
            $_POST['tc'], 
            $_POST['caste_certificate'], 
            $_POST['income_certificate'], 
            $_POST['study_certificate'], 
            $_POST['kannada_medium_certificate'], 
            $_POST['rural_quota_certificate'], 
            $_POST['special_quota_certificate'], 
            $_POST['aadhar_card'], 
            $_POST['student_photo'],  
            $student['parent_mobile'], 
            $student['names'],
            $student['marks_obtained']
        );
        $stmt_insert->execute();
        $stmt_insert->close();
    }

    header("Location: success2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document Verification</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; }
        .info { margin-bottom: 10px; font-size: 16px; }
        .document-links a { display: block; margin-bottom: 5px; color: blue; text-decoration: underline; }
        input[type="submit"] { background-color: #4CAF50; color: white; border: none; cursor: pointer; padding: 10px; width: 100%; border-radius: 5px; }
        input[type="submit"]:hover { background-color: #45a049; }
        nav { background-color: #4CAF50; padding: 10px; text-align: center; }
        nav a { color: white; margin: 0 15px; text-decoration: none; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
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
    <h2>Verify Documents</h2>
    <p class="info"><strong>SSLC Register:</strong> <?= htmlspecialchars($SSLC_Register) ?></p>
    <p class="info"><strong>Name:</strong> <?= htmlspecialchars($student['names']) ?></p>
    <p class="info"><strong>Phone Number:</strong> <?= htmlspecialchars($student['parent_mobile']) ?></p>
    <p class="info"><strong>Marks Obtained:</strong> <?= htmlspecialchars($student['marks_obtained']) ?></p>

    <form method="post" action="marks_card.php">
        <?php
        $documents = [
            "sslc_marks_card" => "SSLC Marks Card",
            "tc" => "Transfer Certificate",
            "caste_certificate" => "Caste Certificate",
            "income_certificate" => "Income Certificate",
            "study_certificate" => "Study Certificate",
            "kannada_medium_certificate" => "Kannada Medium Eligibility Certificate",
            "rural_quota_certificate" => "Rural Quota Eligibility Certificate",
            "special_quota_certificate" => "Special Quota Eligibility Certificate",
            "aadhar_card" => "Aadhar Card",
            "student_photo" => "Student Photo"
        ];

        foreach ($documents as $key => $label) {
            echo "<p><strong>$label:</strong></p>";

            if ($verification) {
                echo "<p>Saved Response: " . htmlspecialchars($verification[$key]) . "</p>";
                echo "<label><input type='radio' name='$key' value='Yes' " . ($verification[$key] == 'Yes' ? 'checked' : '') . " required> Yes</label>";
                echo "<label><input type='radio' name='$key' value='No' " . ($verification[$key] == 'No' ? 'checked' : '') . " required> No</label>";
            } else {
                echo "<label><input type='radio' name='$key' value='Yes' required> Yes</label>";
                echo "<label><input type='radio' name='$key' value='No' required> No</label>";
            }

            if (!empty($file_paths[$key])) {
                echo "<div class='document-links'><a href='" . htmlspecialchars($file_paths[$key]) . "' target='_blank'>View $label</a></div>";
            } else {
                echo "<span style='color: red;'>❌ No document uploaded or file not found.</span>";
            }
        }
        ?>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>
