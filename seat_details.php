<?php
session_start();
include 'connection2.php'; // Include the database connection

// Get the selected allocated category from the dropdown
$allocated_category = isset($_GET['allocated_category']) ? $_GET['allocated_category'] : '';

// Fetch seat allotment details with branch names
$sql = "SELECT sa.SSLC_Register, sa.branch_allocated, sa.allocated_category, sa.fees_paid, sa.receipt_number, sa.created_at, s.names, s.email, b.name AS branch_name 
        FROM seat_allotment sa 
        JOIN students s ON sa.SSLC_Register = s.SSLC_Register 
        JOIN branch b ON sa.branch_allocated = b.id";

if ($allocated_category) {
    $sql .= " WHERE sa.allocated_category = '" . $conn->real_escape_string($allocated_category) . "'";
}

$sql .= " ORDER BY sa.branch_allocated ASC, sa.created_at ASC";

$result = $conn->query($sql);

// Initialize an array to hold seat allotment details by branch
$branches_data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $branch_id = $row['branch_allocated'];
        $branches_data[$branch_id]['branch_name'] = $row['branch_name'];
        $row['day_of_week'] = date('l', strtotime($row['created_at'])); // Get the day of the week
        $branches_data[$branch_id]['students'][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seat Allotment Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
        nav { background-color: #4CAF50; padding: 15px; text-align: center; }
        nav a { color: white; margin: 0 20px; text-decoration: none; font-weight: bold; text-transform: uppercase; }
        nav a:hover { text-decoration: underline; }

        .container {
            width: 80%; margin: 20px auto; background-color: white;
            padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; color: #4CAF50; font-size: 2em; }
        .branch-container {
            margin-bottom: 30px; background-color: #ffffff;
            padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h3 { color: #333; font-size: 1.5em; }
        table {
            width: 100%; border-collapse: collapse; margin-top: 10px;
        }
        th, td {
            padding: 12px; border: 1px solid #ddd; text-align: left;
        }
        th { background-color: #4CAF50; color: white; }
        td { background-color: #fafafa; }
        tr:nth-child(even) td { background-color: #f1f1f1; }
        tr:hover td { background-color: #ddd; }
        .no-student {
            text-align: center; color: #ff0000; font-weight: bold;
        } .dropdown {
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
    <a href="seat_details.php"> Seat Allotted</a>
    <a href="seat_balances.php">Seat Balance</a>
</nav>

<div class="container">
    <h2>Seat Allotment Details</h2>

    <form method="GET" action="">
        <label for="allocated_category">Select Allocated Category:</label>
        <select name="allocated_category" id="allocated_category">
            <option value="">All Categories</option>
            <option value="2A" <?= ($allocated_category == '2A') ? 'selected' : ''; ?>>2A</option>
            <option value="2B" <?= ($allocated_category == '2B') ? 'selected' : ''; ?>>2B</option>
            <option value="3A" <?= ($allocated_category == '3A') ? 'selected' : ''; ?>>3A</option>
            <option value="3B" <?= ($allocated_category == '3B') ? 'selected' : ''; ?>>3B</option>
            <option value="GM" <?= ($allocated_category == 'GM') ? 'selected' : ''; ?>>GM</option>
        </select>
        <input type="submit" value="Filter">
    </form>

    <?php
    $branches = [
        1 => 'CS',
        2 => 'E&E',
        3 => 'ME',
        4 => 'EC',
        5 => 'CE',
        6 => 'AT',
    ];

    $any_data_found = false;

    foreach ($branches as $branch_id => $branch_name):
        if (isset($branches_data[$branch_id])) {
            $student_count = count($branches_data[$branch_id]['students']);
            $any_data_found = true;
    ?>
    <div class="branch-container">
        <h3>Branch: <?= htmlspecialchars($branch_name); ?> (Total Students: <?= $student_count; ?>)</h3>
        <table>
            <thead>
                <tr>
                    <th>Day</th>
                    <th>SSLC Register Number</th>
                    <th>Name</th>
                    <th>Allocated Category</th>
                    <th>Fees Paid</th>
                    <th>Receipt Number</th>
                    <th>Email</th>
                    <th>Allotment Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($branches_data[$branch_id]['students'] as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['day_of_week']); ?></td>
                    <td><?= htmlspecialchars($student['SSLC_Register']); ?></td>
                    <td><?= htmlspecialchars($student['names']); ?></td>
                    <td><?= htmlspecialchars($student['allocated_category']); ?></td>
                    <td><?= htmlspecialchars($student['fees_paid']); ?></td>
                    <td><?= htmlspecialchars($student['receipt_number']); ?></td>
                    <td><?= htmlspecialchars($student['email']); ?></td>
                    <td><?= htmlspecialchars($student['created_at']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
        }
    endforeach;

    if (!$any_data_found):
    ?>
    <p class="no-student">No seat allotments found for the selected category.</p>
    <?php endif; ?>
</div>

</body>
</html>