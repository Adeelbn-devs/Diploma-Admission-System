<!DOCTYPE html>
<html lang="kn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diploma Admission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        nav {
            background-color: #4CAF50;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
        nav a:hover {
            text-decoration: underline;
            color: #d1e7dd; /* Light color on hover */
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
        .container {
            max-width: 900px; /* Increased width */
            margin: auto;
            background: white;
            padding: 60px; /* Increased padding */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s; /* Animation for scaling */
            margin-top: 80px; /* Increased margin to separate from navigation */
        }
        .container:hover {
            transform: scale(1.02); /* Scale effect on hover */
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 2.5em; /* Increased font size */
        }
        p {
            font-size: 1.2em; /* Increased font size for paragraph */
            text-align: center; /* Center text */
        }
        .branch-diagram {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Responsive grid */
            gap: 20px;
            margin-top: 40px; /* Increased margin to separate from the container */
        }
        .branch {
            background: #e7f3fe;
            border: 1px solid #b3d7ff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s; /* Animation for scaling and shadow */
        }
        .branch:hover {
            transform: translateY(-5px); /* Lift effect on hover */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Shadow effect on hover */
            cursor: pointer;
        }
        .branch h3 {
            margin: 10px 0;
            font-size: 1.5em; /* Increased font size for branch titles */
        }
        .branch a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .branch a:hover {
            background-color: #45a049; /* Darker green on hover */
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

<div class="container">
    <h1>Welcome to Diploma Admission Portal</h1>
    <p>Click branch to get Details.</p>

    <div class="branch-diagram">
        <div class="branch">
            <h3>Automobile Engineering</h3>
            <a href="at_details.php">View Details</a>
        </div>
        <div class="branch">
            <h3>Civil Engineering</h3>
            <a href="ce_details.php">View Details</a>
        </div>
        <div class="branch">
            <h3>Computer Science Engineering </h3>
            <a href="cs_details.php">View Details</a>
        </div>
        <div class="branch">
            <h3>Electrical and Electronics</h3>
            <a href="ee_details.php">View Details</a>
        </div>
        <div class="branch">
            <h3>Electronics and Communication</h3>
            <a href="ec_details.php">View Details</a>
        </div>
        <div class="branch">
            <h3>Mechanical Engineering</h3>
            <a href="me_details.php">View Details</a>
        </div>
    </div>
</div>

</body>
</html>