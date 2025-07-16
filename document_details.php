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

// Initialize variables
$register_number = '';
$filter_sql = '';

// Check if a register number is submitted for filtering
if (isset($_POST['register_number']) && !empty($_POST['register_number'])) {
    $register_number = $conn->real_escape_string($_POST['register_number']);
    $filter_sql = " WHERE SSLC_Register = '$register_number'";
}

// Fetch all student details and their associated certificate responses
$sql = "SELECT SSLC_Register, phone_number, names, sslc_marks_card, tc, caste_certificate, income_certificate, study_certificate, kannada_medium_certificate, rural_quota_certificate, special_quota_certificate, aadhar_card FROM document_verification" . $filter_sql;
$result = $conn->query($sql);
if (!$result) {
    die("❌ Error fetching document_verification: " . $conn->error);
}

// Column headers for the documents
$document_types = [
    "sslc_marks_card" => "SSLC Marks Card",
    "tc" => "Transfer Certificate",
    "caste_certificate" => "Caste Certificate",
    "income_certificate" => "Income Certificate",
    "study_certificate" => "Study Certificate",
    "kannada_medium_certificate" => "Kannada Medium Eligibility Certificate",
    "rural_quota_certificate" => "Rural Quota Eligibility Certificate",
    "special_quota_certificate" => "Special Quota Eligibility Certificate",
    "aadhar_card" => "Aadhar Card"
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students' Certificates</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
        .container { max-width: 1200px; margin: auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
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
    <h2>All Students' Certificates</h2>

    <form method="POST" action="">
        <label for="register_number">Enter SSLC Register Number:</label>
        <input type="text" id="register_number" name="register_number" value="<?php echo htmlspecialchars($register_number); ?>">
        <button type="submit">Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>SSLC Register</th>
                <th>Name</th>
                <th>Phone Number</th>
                <?php foreach ($document_types as $key => $label): ?>
                    <th><?php echo htmlspecialchars($label); ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($document_verification = $result->fetch_assoc()): ?>
 <tr>
                    <td><?php echo htmlspecialchars($document_verification['SSLC_Register']); ?></td>
                    <td><?php echo htmlspecialchars($document_verification['names']); ?></td>
                    <td><?php echo htmlspecialchars($document_verification['phone_number']); ?></td>
                    
                    <?php foreach ($document_types as $key => $label): ?>
                        <td>
                            <?php
                            // Display 'Yes' if the document is submitted, 'No' otherwise
                            if (isset($document_verification[$key]) && $document_verification[$key] == 'Yes') {
                                echo "Yes";
                            } else {
                                echo "No";
                            }
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>