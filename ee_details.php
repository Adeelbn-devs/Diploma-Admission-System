<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electrical and Electronics Engineering Department</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .language-toggle {
            text-align: center;
            margin-bottom: 20px;
        }
        .language-toggle button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .language-toggle button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .hidden {
            display: none;
        }
        .navigate-button, .go-back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .navigate-button {
            background-color: #4CAF50;
        }
        .navigate-button:hover {
            background-color: #45a049;
        }
        .go-back-button {
            background-color: #f44336;
        }
        .go-back-button:hover {
            background-color: #d32f2f;
        }
    </style>
    <script>
        function toggleLanguage() {
            const kannadaContent = document.getElementById('kannada-content');
            const englishContent = document.getElementById('english-content');
            if (kannadaContent.classList.contains('hidden')) {
                kannadaContent.classList.remove('hidden');
                englishContent.classList.add('hidden');
            } else {
                kannadaContent.classList.add('hidden');
                englishContent.classList.remove('hidden');
            }
        }
    </script>
</head>
<body>

<div class="container">
    <div class="language-toggle">
        <button onclick="toggleLanguage()">See Translation</button>
    </div>

    <div id="kannada-content">
        <h1>ಇಲೆಕ್ಟ್ರಿಕಲ್ ಮತ್ತು ಇಲೆಕ್ಟ್ರಾನಿಕ್ಸ್ ಇಂಜಿನಿಯರಿಂಗ್ ವಿಭಾಗ</h1>
        <p>ಡಿಎಸಿಜಿ ಸರ್ಕಾರಿ ಪಾಲಿಟೆಕ್ನಿಕ್‌ನಲ್ಲಿ ಇಲೆಕ್ಟ್ರಿಕಲ್ ಮತ್ತು ಇಲೆಕ್ಟ್ರಾನಿಕ್ಸ್ ಇಂಜಿನಿಯರಿಂಗ್ ವಿಭಾಗವು 1958 ರಲ್ಲಿ ಪ್ರಾರಂಭವಾಯಿತು.</p>
        <h3>2024-25ನೇ ಸಾಲಿನಲ್ಲಿ ನಮ್ಮಲ್ಲಿ ಕಲಿಯುತ್ತಿರುವ ವಿದ್ಯಾರ್ಥಿಗಳ ಸಂಖ್ಯೆ ಹೀಗಿದೆ:</h3>
        <table>
            <tr>
                <th>ವರ್ಷ</th>
                <th>ಒಟ್ಟು ವಿದ್ಯಾರ್ಥಿಗಳು</th>
            </tr>
            <tr>
                <td>ಮೊದಲ</td>
                <td>68</td>
            </tr>
            <tr>
                <td>ಎರಡನೆಯ</td>
                <td>46</td>
            </tr>
            <tr>
                <td>ಮೂರನೆಯ</td>
                <td>39</td>
            </tr>
        </table>
    </div>

    <div id="english-content" class="hidden">
        <h1>About Electrical and Electronics Engineering Department</h1>
        <p>The Department of Electrical and Electronics Engineering at DACG Government Polytechnic started in the year 1958.</p>
        <h3>This is our student strength in the year 2024-25:</h3>
        <table>
            <tr>
                <th>Year</th>
                <th>Number of Students</th>
            </tr>
            <tr>
                <td>First</td>
                <td>68</td>
            </tr>
            <tr>
                <td>Second</td>
                <td>46</td>
            </tr>
            <tr>
                <td>Third</td>
                <td>39</td>
            </tr>
        </table>
    </div>

    <a href="ee_lecture_details.php" class="navigate-button">Go to Lecture Details</a>
    <a href="branch.php" class="go-back-button">Go Back to Branches</a>
</div>

</body>
</html>