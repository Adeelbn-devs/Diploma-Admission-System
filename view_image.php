<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['image'])) {
    die("No image specified.");
}

$image_path = $_GET['image'];

// Check if the image file exists
if (!file_exists($image_path)) {
    die("Image not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Marks Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }

        img {
            max-width: 71%; /* Responsive image */
            height: auto; /* Maintain aspect ratio */
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        .back-to-top {
            display: inline-block;
            margin-top: 20px;
            padding: 10px;
            background-color: #007BFF; /* Blue color */
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .back-to-top:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <h2>Marks Card</h2>
    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Marks Card">
    <br>
    <a class="back-button" href="view_marks.php">Back to Marks</a>
    <a class="back-to-top" href="#top">↑ Back to Top</a> <!-- Back to top button -->
</body>
</html>