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

// Set the default date to today
$selected_date = date('Y-m-d');

// Initialize results
$results = [];

// Define branch mapping
$branches = [
    1 => 'CS',
    2 => 'E&E',
    3 => 'ME',
    4 => 'EC',
    5 => 'CE',
    6 => 'AT'
];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected date from the form
    $selected_date = $_POST['date'];

    // Prepare the SQL query
    $start_date = $selected_date . ' 00:00:00';
    $end_date = $selected_date . ' 23:59:59';
    $sql = "SELECT COUNT(SSLC_Register) AS count, branch_allocated 
            FROM seat_allotment 
            WHERE created_at BETWEEN ? AND ? 
            GROUP BY branch_allocated";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch results
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Allotment Count</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
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
    <h2>Seat Allotment Count</h2>

    <form method="post" action="">
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $selected_date; ?>" required>
        <input type="submit" value="Show Count">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h3>Seat Allotment on <?php echo htmlspecialchars($selected_date); ?></h3>
        <table>
            <thead>
                <tr>
                    <th>Branch Allocated</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($results)): ?>
                    <tr>
                        <td colspan="2">No records found for this date.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($branches[$row['branch_allocated']]); ?></td>
                            <td><?php echo htmlspecialchars($row['count']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>