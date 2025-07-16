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

// Filters
$branch = $_POST['branch'] ?? 'all';
$category = $_POST['category'] ?? 'all';
$gender = $_POST['gender'] ?? 'all';
$sortOrder = $_POST['sort_order'] ?? 'desc'; // New: Sort order

$query = "SELECT * FROM students WHERE 1=1";

if ($branch !== 'all') {
    $query .= " AND course_name = '$branch'";
}
if ($category !== 'all') {
    $query .= " AND reserved_category = '$category'";
}
if ($gender !== 'all') {
    $query .= " AND gender = '$gender'";
}

// Sort logic
$sortOrder = strtolower($sortOrder) === 'asc' ? 'ASC' : 'DESC';
$query .= " ORDER BY marks_obtained $sortOrder";

$result = $conn->query($query);
$students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

$totalApplicationsQuery = "SELECT COUNT(*) as total FROM students";
$totalApplicationsResult = $conn->query($totalApplicationsQuery);
$totalApplications = $totalApplicationsResult->fetch_assoc()['total'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Merit List</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #4CAF50; color: white; }
        select, input[type="submit"] {
            margin: 10px;
            padding: 6px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<h1>Merit List Before Seat Allotment</h1>

<form method="POST" action="merit_list.php">
    <label for="branch">Select Branch:</label>
    <select name="branch" id="branch">
        <option value="all" <?= $branch == 'all' ? 'selected' : '' ?>>All</option>
        <option value="CE" <?= $branch == 'CE' ? 'selected' : '' ?>>CE</option>
        <option value="CS" <?= $branch == 'CS' ? 'selected' : '' ?>>CS</option>
        <option value="ECE" <?= $branch == 'ECE' ? 'selected' : '' ?>>ECE</option>
        <option value="EE" <?= $branch == 'EE' ? 'selected' : '' ?>>EE</option>
        <option value="ME" <?= $branch == 'ME' ? 'selected' : '' ?>>ME</option>
    </select>

    <label for="category">Select Category:</label>
    <select name="category" id="category">
        <option value="all" <?= $category == 'all' ? 'selected' : '' ?>>All</option>
        <option value="2A" <?= $category == '2A' ? 'selected' : '' ?>>2A</option>
        <option value="2B" <?= $category == '2B' ? 'selected' : '' ?>>2B</option>
        <option value="3A" <?= $category == '3A' ? 'selected' : '' ?>>3A</option>
        <option value="3B" <?= $category == '3B' ? 'selected' : '' ?>>3B</option>
        <option value="SC" <?= $category == 'SC' ? 'selected' : '' ?>>SC</option>
        <option value="ST" <?= $category == 'ST' ? 'selected' : '' ?>>ST</option>
    </select>

    <label for="gender">Select Gender:</label>
    <select name="gender" id="gender">
        <option value="all" <?= $gender == 'all' ? 'selected' : '' ?>>All</option>
        <option value="Male" <?= $gender == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $gender == 'Female' ? 'selected' : '' ?>>Female</option>
    </select>

    <label for="sort_order">Sort by Merit:</label>
    <select name="sort_order" id="sort_order">
        <option value="desc" <?= $sortOrder === 'DESC' ? 'selected' : '' ?>>Highest to Lowest</option>
        <option value="asc" <?= $sortOrder === 'ASC' ? 'selected' : '' ?>>Lowest to Highest</option>
    </select>

    <input type="submit" value="Filter">
</form>

<h2>Total Applications: <?= $totalApplications ?></h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Register Number</th>
            <th>Caste</th>
            <th>Gender</th>
            <th>Mobile Number</th>
            <th>Marks Obtained</th>
            <th>Branch</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($students)): ?>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['names']) ?></td>
                    <td><?= htmlspecialchars($student['SSLC_Register']) ?></td>
                    <td><?= htmlspecialchars($student['reserved_category']) ?></td>
                    <td><?= htmlspecialchars($student['gender']) ?></td>
                    <td><?= htmlspecialchars($student['mobile']) ?></td>
                    <td><?= htmlspecialchars($student['marks_obtained']) ?></td>
                    <td><?= htmlspecialchars($student['course_name']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No students found for selected filters.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
