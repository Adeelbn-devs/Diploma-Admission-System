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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $sats_no = $_POST['sats_no'];
    $aadhar_no = $_POST['aadhar_no'];
    $names = $_POST['names'];
    $mother_name = $_POST['mother_name'];
    $father_name = $_POST['father_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $exam_type = $_POST['exam_type'];
    $native_state = $_POST['native_state'];
    $native_district = $_POST['native_district'];
    $years_studied = $_POST['years_studied'];
    $rural_study = $_POST['rural_study'];
    $kannada_medium = $_POST['kannada_medium'];
    $exemption_rule = $_POST['exemption_rule'];
    $clause_code = $_POST['clause_code'];
    $snq_quota = $_POST['snq_quota'];
    $hyd_kar_quota = $_POST['hyd_kar_quota'];
    $special_category = $_POST['special_category'];
    $reserved_category = $_POST['reserved_category'];
    $caste_name = $_POST['caste_name'];
    $annual_income = $_POST['annual_income'];
    $total_marks = $_POST['total_marks'];
    $marks_obtained = $_POST['marks_obtained'];
    $science_marks = $_POST['science_marks'];
    $maths_marks = $_POST['maths_marks'];
    $science_math_total = $_POST['science_math_total'];
    $mobile = $_POST['mobile'];
    $parent_mobile = $_POST['parent_mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $course_name = $_POST['course_name'];
    $SSLC_Register = $_POST['SSLC_Register'];
    $institution_code = $_POST['institution_code'];
    $college_name = $_POST['college_name'];
    $signature_candidate = $_POST['signature_candidate'];
    $signature_parent = $_POST['signature_parent'];
    $submission_date = $_POST['submission_date'];
    $Year_of_passing = $_POST['Year_of_passing']; // New field
    $pincode = $_POST['pincode']; // New field
    $state_appeared = $_POST['state_appeared'];

    // Handling file uploads
    $uploads_dir = 'uploads'; // Make sure this directory exists and is writable
    $documents = [
        'sslc_marks_card',
        'tc',
        'caste_certificate',
        'income_certificate',
        'study_certificate',
        'kannada_medium_certificate',
        'rural_quota_certificate',
        'special_quota_certificate',
        'aadhar_card',
        'student_photo'
    ];

    $file_paths = [];
    foreach ($documents as $doc) {
        if (isset($_FILES[$doc]) && $_FILES[$doc]['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES[$doc]['tmp_name'];
            $name = basename($_FILES[$doc]['name']);
            $file_path = "$uploads_dir/$name";
            if (move_uploaded_file($tmp_name, $file_path)) {
                $file_paths[$doc] = $file_path;
            } else {
                echo "Failed to move uploaded file for $doc.<br>";
                $file_paths[$doc] = null; // Handle missing files as needed
            }
        } else {
            echo "Error uploading file for $doc: " . $_FILES[$doc]['error'] . "<br>";
            $file_paths[$doc] = null; // Handle missing files as needed
        }
    }

    // Prepare SQL statement
    $sql = "INSERT INTO students (
        sats_no, 
        aadhar_no, 
        names, 
        mother_name, 
        father_name, 
        dob, 
        gender, 
        nationality, 
        religion, 
        exam_type, 
        native_state, 
        native_district, 
        years_studied, 
        rural_study, 
        kannada_medium, 
        exemption_rule, 
        clause_code, 
        snq_quota, 
        hyd_kar_quota, 
        special_category, 
        reserved_category, 
        caste_name, 
        annual_income, 
        total_marks,
        marks_obtained,
        science_marks, 
        maths_marks, 
        science_math_total, 
        mobile, 
        parent_mobile, 
        email, 
        address, 
        course_name, 
        SSLC_Register, 
        institution_code, 
        college_name, 
        signature_candidate, 
        signature_parent, 
        submission_date,
        Year_of_passing,  
        pincode,          
        state_appeared,    
        sslc_marks_card, 
        tc, 
        caste_certificate, 
        income_certificate, 
        study_certificate, 
        kannada_medium_certificate, 
        rural_quota_certificate, 
        special_quota_certificate, 
        aadhar_card,
        student_photo  -- Added comma here
    ) VALUES (
        '$sats_no', 
        '$aadhar_no', 
        '$names', 
        '$mother_name', 
        '$father_name', 
        '$dob', 
        '$gender', 
        '$nationality', 
        '$religion', 
        '$exam_type', 
        '$native_state', 
        '$native_district', 
        '$years_studied', 
        '$rural_study', 
        '$kannada_medium', 
        '$exemption_rule', 
        '$clause_code', 
        '$snq_quota', 
        '$hyd_kar_quota', 
        '$special_category', 
        '$reserved_category', 
        '$caste_name', 
        '$annual_income', 
        '$total_marks', 
        '$marks_obtained',
        '$science_marks', 
        '$maths_marks', 
        '$science_math_total', 
        '$mobile', 
        '$parent_mobile', 
        '$email', 
        '$address', 
        '$course_name', 
        '$SSLC_Register', 
        '$institution_code', 
        '$college_name', 
        '$signature_candidate', 
        '$signature_parent', 
        '$submission_date', 
        '$Year_of_passing',  -- New field
        '$pincode',          -- New field
        '$state_appeared',   
        '{$file_paths['sslc_marks_card']}', 
        '{$file_paths['tc']}', 
        '{$file_paths['caste_certificate']}', 
        '{$file_paths['income_certificate']}', 
        '{$file_paths['study_certificate']}', 
        '{$file_paths['kannada_medium_certificate']}', 
        '{$file_paths['rural_quota_certificate']}', 
        '{$file_paths['special_quota_certificate']}', 
        '{$file_paths['aadhar_card']}',
        '{$file_paths['student_photo']}'  -- Added comma here
    )";

    if ($conn->query($sql) === TRUE) {
        header("Location: success.php"); // Redirect to success page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Diploma Admission Form</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
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

        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        p {
            font-weight: bold;
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="email"],
        textarea,
        select {
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

        .success-message {
            text-align: center;
            color: green;
            font-weight: bold;
            margin: 20px 0;
        }

        .next-button {
            display: block;
            margin: 20px auto;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 4px;
            text-decoration: none;
            width: 100px;
        }

        .next-button:hover {
            background-color: #45a049;
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
        
    </style>

</head>
<body>
<nav>
    <a href="home.php">Home</a>
    <a href="branch.php">Branches</a>


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
        <a href="seat_details.php">seat allotted </a>
        <a href="seat_balances.php">Seat Balance</a>
        <a href="document_details.php">Documnet Details</a>
       
    </nav>
    <h2>Diploma Admission Form</h2>
    <form method="post" enctype="multipart/form-data">
        <p> The Principal, <b>DACG Govt Polytechnic Chikkmagalur</b></p>
        1. SATS No: <input type="text" name="sats_no" required><br>
        2. Aadhar No: <input type="text" name="aadhar_no" pattern="^\d{12}$" title="Please enter a valid 12-digit Aadhar number." required><br>
        3. Name: <input type="text" name="names" required><br>
        4. Mother's Name: <input type="text" name="mother_name" required><br>
        5. Father's Name: <input type="text" name="father_name" required><br>
        6. Date of Birth: <input type="date" name="dob" required><br>
        7. Gender: <select name="gender"><option value="Male">Male</option><option value="Female">Female</option></select><br>
        <label>8. Indian Nationality:</label>
        <div class="radio-group">
            <input type="radio" id="yes" name="nationality" value="Yes" required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="nationality" value="No" required>
            <label for="no">No</label>
        </div>
        9. Religion: <input type="text" name="religion" required><br>
        <label>10. Qualifying examination:</label>
        <div class="radio-group">
            <input type="radio" id="sslc" name="exam_type" value="SSLC" required>
            <label for="sslc">SSLC</label>
            <input type="radio" id="cbse" name="exam_type" value="CBSE" required>
            <label for="cbse">CBSE</label>
            <input type="radio" id="icse" name="exam_type" value="ICSE" required>
            <label for="icse">ICSE</label>
            <input type="radio" id="others" name="exam_type" value="Others" required>
            <label for="others">Others</label>
        </div>       
        11. Code of the Native State: <input type="text" name="native_state" required><br>
        12. Karnataka, code of the Native District: <input type="text" name="native_district" required><br>
        13. Code of the State appeared for SSLC: <input type="text" name="state_appeared" required><br>
        14. Total number of Years Studied in Karnataka: <input type="number" name="years_studied"><br>
        <label>15. Have you studied in Rural areas (1st to 10th):</label>
        <div class="radio-group">
            <input type="radio" id="rural_yes" name="rural_study" value="Yes" required>
            <label for="rural_yes">Yes</label>
            <input type="radio" id="rural_no" name="rural_study" value="No" required>
            <label for="rural_no">No</label>
        </div>
        <label>16. Have you studied in Kannada Medium (from 1st to 10th):</label>
        <div class="radio-group">
            <input type="radio" id="kannada_yes" name="kannada_medium" value="Yes" required>
            <label for="kannada_yes">Yes</label>
            <input type="radio" id="kannada_no" name="kannada_medium" value="No" required>
            <label for="kannada_no">No</label>
        </div>
        <label>17. Do you claim Exemption from the 5-year study rule?</label>
        <div class="radio-group">
            <input type="radio" id="exemption_yes" name="exemption_rule" value="Yes" required>
            <label for="exemption_yes">Yes</label>
            <input type="radio" id="exemption_no" name="exemption_rule" value="No" required>
            <label for="exemption_no">No</label>
        </div>
        18. If yes, mention Clause Code: <input type="text" name="clause_code"><br>
        <label>19. Do you claim SNQ Quota?</label>
        <div class="radio-group">
            <input type="radio" id="snq_yes" name="snq_quota" value="Yes" required>
            <label for="snq_yes">Yes</label>
            <input type="radio" id="snq_no" name="snq_quota" value="No" required>
            <label for="snq_no">No</label>
        </div>
        <label>20. Do you claim Hyderabad-Karnataka Quota?</label>
        <div class="radio-group">
            <input type="radio" id="hyd_kar_yes" name="hyd_kar_quota" value="Yes" required>
            <label for="hyd_kar_yes">Yes</label>
            <input type="radio" id="hyd_kar_no" name="hyd_kar_quota" value="No" required>
            <label for="hyd_kar_no">No</label>
        </div>
        <label for="special_category">21. Do you claim Special Category?</label>
        <select name="special_category" id="special_category" required>
            <option value="" disabled selected>Select an option</option>
            <option value="NCC">NCC</option>
            <option value="JTS">JTS</option>
            <option value="JOC">JOC</option>
            <option value="EDP">EDP</option>
            <option value="DP">DP</option>
            <option value="PS">PS</option>
            <option value="SP">SP</option>
            <option value="AI">AI</option>
            <option value="CI">CI</option>
            <option value="HK">HK</option>
            <option value="GK">GK</option>
            <option value="ITI">ITI</option>
            <option value="SG">SG</option>
            <option value="PH">PH</option>
        </select><br>
        22. Reserved Category code: <input type="text" name="reserved_category"><br>
        23. Caste Name: <input type="text" name="caste_name"><br>
        24. Annual Income: <input type="number" name="annual_income"><br>
        <p><b>25. Educational particulars and marks details</b></p>
        a. SSLC Register No.: <input type="text" name="SSLC_Register"><br>
        b.Year of passing:<input type="text" name="Year_of_passing"><br>
        <label for="total_marks">1. Total Marks in all subjects:</label>
        <input type="number" name="total_marks" id="total_marks" value="626" readonly>
        Marks obtained: <input type="number" name="marks_obtained"><br>
        <label for="max_science_marks">2. Max. Science Marks:</label>
        <input type="number" name="max_science_marks" id="max_science_marks" value="100" readonly>
        Science Marks: <input type="number" name="science_marks"><br>
        <label for="max_maths_marks">3. Max. Maths Marks:</label>
        <input type="number" name="max_maths_marks" id="max_maths_marks" value="100" readonly>
        Maths Marks: <input type="number" name="maths_marks"><br>
        <label for="max_science_math_marks">4. Max. Science & Maths Marks:</label>
        <input type="number" name="max_science_math_marks" id="max_science_math_marks" value="200" readonly>
        Science & Maths Total: <input type="number" name="science_math_total"><br>
        26. Student Mobile No.: <input type="text" name="mobile" pattern="^\d{10}$" title="Please enter a valid 10-digit mobile number." required><br>
        27. Address: <textarea name="address"></textarea><br>
        28. Parent Mobile No.: <input type="text" name="parent_mobile" pattern="^\d{10}$" title="Please enter a valid 10-digit mobile number."><br>
        29. Email: <input type="email" name="email"><br>
        30. PIN CODE: <textarea name="pincode"></textarea><br>
        31. Course Name: <input type="text" name="course_name"><br>
        32. Institution Code: <input type="text" name="institution_code"><br>
        33. College Name: <input type="text" name="college_name"><br>
        34. Candidate Signature: <input type="text" name="signature_candidate"><br>
        35. Parent Signature: <input type="text" name="signature_parent"><br>
        36. Submission Date: <input type="date" name="submission_date"><br>

        <h3>Documents Upload Section</h3>
        <label for="sslc_marks_card">37. SSLC Marks Card:</label>
        <input type="file" name="sslc_marks_card" required><br>

        <label for="student_photo">38. Student Photo:</label>
        <input type="file" name="student_photo" required><br>
        
        <label for="tc">39. Transfer Certificate:</label>
        <input type="file" name="tc" required><br>
        
        <label for="caste_certificate">40. Caste Certificate:</label>
        <input type="file" name="caste_certificate" required><br>
        
        <label for="income_certificate">41. Income Certificate:</label>
        <input type="file" name="income_certificate" required><br>
        
        <label for="study_certificate">42. Study Certificate:</label>
        <input type="file" name="study_certificate" required><br>
        
        <label for="kannada_medium_certificate">43. Kannada Medium Eligibility Certificate:</label>
        <input type="file" name="kannada_medium_certificate" required><br>
        
        <label for="rural_quota_certificate">44. Rural Quota Eligibility Certificate:</label>
        <input type="file" name="rural_quota_certificate" required><br>
        
        <label for="special_quota_certificate">45. Special Quota Eligibility Certificate:</label>
        <input type="file" name="special_quota_certificate" required><br>
        
        <label for="aadhar_card">46. Aadhar Card:</label>
        <input type="file" name="aadhar_card" required><br>

        

        <input type="submit" value="Submit Application">
    </form>
</body>
</html>