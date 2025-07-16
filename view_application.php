<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli("localhost", "root", "", "diploma_admission");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_details = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sslc_register_no = $_POST['sslc_register_no'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE SSLC_Register = ?");
    $stmt->bind_param("s", $sslc_register_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student_details = $result->fetch_assoc();
    } else {
        echo "<script>alert('No student found with SSLC Register No: $sslc_register_no');</script>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Application</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef1f5;
            margin: 0;
            padding: 30px;
        }

        h1, h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            max-width: 1100px;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .details {
            margin-top: 20px;
        }

        .top-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .box, .student-photo-box {
            flex: 1 1 calc(50% - 20px);
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        .label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .value {
            color: #34495e;
            word-wrap: break-word;
        }

        .student-photo-inline {
            width: 130px;
            height: 160px;
            border: 1px solid #ccc;
            object-fit: cover;
            background-color: #eee;
            margin-top: 8px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .button-container {
            text-align: center;
            margin-top: 40px;
        }

        .button-container button {
            padding: 10px 25px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
        }

        .next-button {
            background-color: #3498db;
            color: white;
        }

        .next-button:hover {
            background-color: #2e86c1;
        }

        .print-button {
            background-color: #2ecc71;
            color: white;
        }

        .print-button:hover {
            background-color: #27ae60;
        }

        @media (max-width: 768px) {
            .box, .student-photo-box {
                flex: 1 1 100%;
            }

            .student-photo-inline {
                align-self: center;
            }
        }

        @media print {
            .button-container {
                display: none;
            }
        }

        h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>GOVERNMENT OF KARNATAKA<br>DEPARTMENT OF TECHNICAL EDUCATION</h1>
    <h2>View Application Details</h2>

    <div class="form-container">
        <?php if ($student_details): ?>
            <div class="details">
                <h3>Student Details</h3>
                <div class="top-section">
                    <?php if (!empty($student_details['sats_no'])): ?>
                        <div class="box">
                            <div class="label">SATS No:</div>
                            <div class="value"><?php echo htmlspecialchars($student_details['sats_no']); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($student_details['student_photo'])): ?>
                        <div class="student-photo-box">
                            <div class="label">Student Photo:</div>
                            <img src="<?php echo htmlspecialchars($student_details['student_photo']); ?>" alt="Student Photo" class="student-photo-inline">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <?php
                        $exclude_keys = [
                            'id',
                            'sats_no',
                            'student_photo',
                            'marks_card', 'tc', 'caste_certificate',
                            'income_certificate', 'study_certificate',
                            'kannada_medium_certificate', 'rural_quota_certificate',
                            'special_quota_certificate', 'aadhar_card'
                        ];

                        foreach ($student_details as $key => $value):
                            if (in_array($key, $exclude_keys)) continue;
                    ?>
                        <div class="box">
                            <div class="label"><?php echo ucwords(str_replace("_", " ", $key)); ?>:</div>
                            <div class="value"><?php echo htmlspecialchars($value); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Buttons -->
            <div class="button-container">
                <button class="next-button" onclick="location.href='fetch_marks.php'">Next</button>
                <button class="print-button" onclick="window.print()">Print</button>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
