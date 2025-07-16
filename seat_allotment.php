<?php
session_start();
include 'connection2.php'; 

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

$student = null;
$error_message = null;

// Hardcoded branch details
$branches = [
    ['id' => 1, 'name' => 'CS'],
    ['id' => 2, 'name' => 'E&E'],
    ['id' => 3, 'name' => 'ME'],
    ['id' => 4, 'name' => 'EC'],
    ['id' => 5, 'name' => 'CE'],
    ['id' => 6, 'name' => 'AT'],
];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $register_number = trim($_POST['register_number']);

    $sql = "SELECT * FROM students WHERE SSLC_Register = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $register_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
        } else {
            $error_message = "No student found with this SSLC Register number.";
        }
    } else {
        $error_message = "Error preparing SQL statement: " . $conn->error;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['allot'])) {
    if (!empty($_POST['register_number']) && !empty($_POST['branch_allocated']) && !empty($_POST['allocated_category']) && !empty($_POST['fees_paid']) && !empty($_POST['receipt_number'])) {
        $register_number = trim($_POST['register_number']);
        $branch_allocated = trim($_POST['branch_allocated']);
        $allocated_category = trim($_POST['allocated_category']);
        $fees_paid = trim($_POST['fees_paid']);
        $receipt_number = trim($_POST['receipt_number']); 

       
        error_log("Branch Allocated ID: " . $branch_allocated); // Log the branch ID

       
        $seat_status = allotSeat($branch_allocated);

        if ($seat_status === true) {
            
            $insert_sql = "INSERT INTO seat_allotment (SSLC_Register, branch_allocated, allocated_category, fees_paid, receipt_number) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            if ($insert_stmt) {
                
                $insert_stmt->bind_param("sssss", $register_number, $branch_allocated, $allocated_category, $fees_paid, $receipt_number);
                if ($insert_stmt->execute()) {
                  
                    $subject = "Seat Allotment Confirmation";
                    $message = "Dear " . htmlspecialchars($student['names']) . ",<br><br>" .
                               "Congratulations! Your seat has been successfully allotted to the branch: " . htmlspecialchars($branch_allocated) . ".<br>" .
                               "Allocated Category: " . htmlspecialchars($allocated_category) . "<br>" .
                               "Fees Paid Receipt: " . htmlspecialchars($fees_paid) . "<br><br>" .
                               "Thank you for your application.";

                    $recipient = htmlspecialchars($student['email']); 
                    $mobileNumber = htmlspecialchars($student['mobile_number']); 

                    
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.example.com'; 
                        $mail->SMTPAuth = true;
                        $mail->Username = 'your_email@example.com'; 
                        $mail->Password = 'your_password'; 
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        $mail->setFrom('from@example.com', 'Mailer');
                        $mail->addAddress($recipient); 

                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body    = $message;

                        $mail->send();
                        error_log('Email has been sent to ' . $recipient);
                    } catch (Exception $e) {
                        $error_message = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                    
                    header("Location: success3.php?register_number=" . urlencode($register_number) . "&branch_allocated=" . urlencode($branch_allocated) . "&allocated_category=" . urlencode($allocated_category) . "&fees_paid=" . urlencode($fees_paid));
                    exit();
                } else {
                    $error_message = "Error inserting data: " . $insert_stmt->error;
                }
            } else {
                $error_message = "Error preparing insert statement: " . $conn->error; 
            }
        } else {
            $error_message = $seat_status; 
        }
    } else {
        $error_message = "All fields are required for seat allotment.";
    }
}


function allotSeat($branch_id) {
    global $conn;

    
    $sql = "SELECT government_seats, donor_seats, snq_seats FROM branch WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $branch_id);
    $stmt->execute();
    $stmt->bind_result($gov_seats, $donor_seats, $snq_seats);
    $stmt->fetch();
    $stmt->close();

    
    error_log("Available Seats - Government: $gov_seats, Donor: $donor_seats, SNQ: $snq_seats"); 

    
    if ($gov_seats > 0) {
        $new_gov_seats = $gov_seats - 1;
        $sql = "UPDATE branch SET government_seats = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_gov_seats, $branch_id);
        $stmt->execute();
        $stmt->close();
        return true; // Seat allotted successfully
    } elseif ($donor_seats > 0) {
        $new_donor_seats = $donor_seats - 1;
        $sql = "UPDATE branch SET donor_seats = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_donor_seats, $branch_id);
        $stmt->execute();
        $stmt->close();
        return true; // Seat allotted successfully
    } elseif ($snq_seats > 0) {
        $new_snq_seats = $snq_seats - 1;
        $sql = "UPDATE branch SET snq_seats = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_snq_seats, $branch_id);
        $stmt->execute();
        $stmt->close();
        return true; // Seat allotted successfully
    } else {
        return "No seats available."; // No seats to allot
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Allotment</title>
    <style>
        /* Your existing styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4; 
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        label {
            width: 200px;
            font-weight: bold;
            color: #333; 
        }
        input[type="text"],
        input[type="date"],
        select {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px; 
            transition: border-color 0.3s; 
        }
        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #28a745;
            outline: none; 
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            border: none; 
            border-radius: 4px; 
            font-size: 16px; 
            transition: background-color 0.3s; 
        }
        input[type="submit"]:hover {
            background-color: #218838; 
        }
        nav {
            background-color: #4CAF50;
            padding: 10px;
            text-align: center;
            border-radius: 8px; 
            margin-bottom: 20px; 
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
<h2>Seat Allotment</h2>

<?php if ($error_message): ?>
    <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
<?php endif; ?>

<form method="POST">
    <div class="form-container">
        <div class="form-group">
            <label for="register_number">SSLC Register Number:</label>
            <input type="text" id="register_number" name="register_number" required>
        </div>
        <input type="submit" name="search" value="Fetch Details">
    </div>
</form>

<?php if ($student): ?>
    <form method="POST">
        <div class="form-container">
            <div class="form-group">
                <label>SSLC Register Number:</label>
                <input type="text" value="<?php echo htmlspecialchars($student['SSLC_Register']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" value="<?php echo htmlspecialchars($student['names']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" name="dob" value ="<?php echo htmlspecialchars($student['dob']); ?>" required> 
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <input type="text" value="<?php echo htmlspecialchars($student['gender']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Father Name:</label>
                <input type="text" value="<?php echo htmlspecialchars($student['father_name']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Student Preferred Branch:</label>
                <input type="text" name="course_name" value="<?php echo htmlspecialchars($student['course_name']); ?>" readonly> 
            </div>
            <div class="form-group">
                <label>Uploaded photo:</label>
                <input type="text" value="<?php echo htmlspecialchars($student['tc']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="branch_allocated">Branch Allocated:</label>
                <select id="branch_allocated" name="branch_allocated" required>
                    <option value="" disabled selected>Select a branch</option>
                    <?php foreach ($branches as $branch): ?>
                        <option value="<?php echo htmlspecialchars($branch['id']); ?>">
                            <?php echo htmlspecialchars($branch['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Allocated Category:</label>
                <input type="text" name="allocated_category" required>
            </div>
            <div class="form-group">
                <label>Fees Paid Receipt:</label>
                <select id="fees_paid" name="fees_paid" required>
                    <option value="" disabled selected>Select your Fees</option>
                    <option value="4160">4160</option>
                    <option value="1260">1260</option>
                </select>
            </div>
            <div class="form-group">
                <label>Receipt Number:</label>
                <input type="text" name="receipt_number" required> 
            </div>

            <input type="hidden" name="register_number" value="<?php echo htmlspecialchars($student['SSLC_Register']); ?>">
            <input type="submit" name="allot" value="Allot Seat">
        </div>
    </form>
<?php endif; ?>
</body>
</html>