<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diploma Admission Portal</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh; /* Full height for the body */
    overflow-y: auto; /* Allow vertical scrolling */
    background-image: url('images/college.jpg'); /* Corrected image path */
    background-size: cover; /* Cover the entire viewport */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Prevent the image from repeating */
}
        nav {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            padding: 15px;
            position: fixed; /* Fixed position for sticky navigation */
            width: 100%;
            top: 0;
            z-index: 10; /* Higher z-index to stay above the background */
            display: flex; /* Display navigation links in a single line */
            justify-content: center; /* Center the navigation links */
            align-items: center; /* Align the links vertically */
            flex-wrap: wrap; /* Wrap links to the next line if necessary */
            gap: 20px; /* Space between the items */
        }

        nav a {
            color: white; /* Change text color to white for visibility */
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
            padding: 10px; /* Add padding to the links */
            position: relative; /* Position relative for dropdown */
        }

        nav a:hover {
            text-decoration: underline;
            color: #d1e7dd; /* Light color on hover */
        }

        .dropdown {
            position: relative; /* Position relative for dropdown */
        }

        .dropdown-content {
            display: none; /* Hidden by default */
            position: absolute; /* Position absolute for dropdown items */
            background-color: rgba(255, 255, 255, 0.9); /* White background with transparency */
            min-width: 160px; /* Minimum width for dropdown */
            z-index: 1; /* Ensure dropdown is above other content */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for dropdown */
            top: 100%; /* Position below the dropdown link */
            left: 0; /* Align to the left of the dropdown link */
        }

        .dropdown:hover .dropdown-content {
            display: block; /* Show dropdown on hover */
        }

        .dropdown-content a {
            color: black; /* Text color for dropdown items */
            padding: 12px 16px; /* Padding for dropdown items */
            text-decoration: none; /* No underline */
            display: block; /* Block display for dropdown items */
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1; /* Light background on hover */
        }

        .hero {
            height: 300px; /* Height of the hero section */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            margin-top: 60px; /* Space for fixed nav */
            background-color: rgba(0, 0, 0, 0.7); /* More opaque black background */
            border-radius: 10px; /* Optional: rounded corners */
            padding: 0; /* Set padding to 0 */
        }

        .hero h1 {
            font-size: 3em; /* Larger font size for the hero title */
            margin: 0;
        }

        .hero p {
            font-size: 1.5em; /* Font size for the hero subtitle */
            margin: 10px 0;
        }

        .hero button {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .hero button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .container {
            max-width: 900px; /* Increased width */
            margin: auto;
            background: rgba(255, 255, 255, 0.9); /* White background with transparency */
            padding: 40px; /* Increased padding */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s; /* Animation for scaling */
            margin-top: 800px; /* Increased margin to separate from navigation */
            position: relative; /* Position relative for absolute children */
            z-index: 1; /* Ensure content is above the background */
        }

        .container:hover {
            transform: scale(1.02); /* Scale effect on hover */
        }

        .admission-open {
            background-color: #ffcc00; /* Highlight color for admission open notice */
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px; /* Space below the notice */
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

        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            display: none; /* Hidden by default */
            transition: background-color 0.3s;
        }

        .scroll-to-top:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <div class="background-image"></div> <!-- Background image -->
    <nav>
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
        <a href="seat_details.php">Alloted Seat</a>
        <a href="seat_balances.php">Seat Balance</a>
        <a href="document_details.php">Documnet Details</a>
        <a href="seat_allotment_count.php"> Alloted Seat Count </a>
        
    </nav>

    <div class="hero">
        <h1>Welcome to D.A.C.G  Admission Portal</h1>
        <p>Your future starts here!</p>
        <button onclick="location.href='application_form.php'">Apply Now</button>
    </div>

    <div class="container">
        <div class="admission-open">Click Link to get branch details </div>
        <div class="branch-diagram">
            <div class="branch">
                <h3>Computer Science</h3>
                <a href="cs_details.php">View Details</a>
            </div>
            <div class="branch">
                <h3>Electronics and Communication</h3>
                <a href="ec_details.php">View Details</a>
            </div>
            <div class="branch">
                <h3>Electrical and Electronics</h3>
                <a href="ee_details.php">View Details</a>
            </div>
            <div class="branch">
                <h3>Civil Engineering</h3>
                <a href="ce_details.php">View Details</a>
            </div>
            <div class="branch">
                <h3>Mechanical Engineering</h3>
                <a href="me_details.php">View Details</a>
            </div>
            <div class="branch">
                <h3>Automobile Engineering</h3>
                <a href="at_details.php">View Details</a>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" id="scrollToTopBtn" onclick="scrollToTop()">↑</button>

    <script>
        // Show or hide the scroll-to-top button
        window.onscroll = function() {
            const button = document.getElementById("scrollToTopBtn");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                button.style.display = "block";
            } else {
                button.style.display = "none";
            }
        };

        // Scroll to the top of the page
        function scrollToTop () {
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
    </script>
</body>
</html>
