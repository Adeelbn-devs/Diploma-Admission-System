<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef1f5;
            padding: 50px;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            max-width: 500px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            background-color: #2980b9;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #21618c;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Enter SSLC Register Number</h2>
    <form action="view_application.php" method="post">
        <div class="form-group">
            <label for="sslc_register_no">SSLC Register No:</label>
            <input type="text" name="sslc_register_no" required>
        </div>
        <input type="submit" value="View Details">
    </form>
</div>

</body>
</html>
