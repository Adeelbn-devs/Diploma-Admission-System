<!DOCTYPE html>
<html lang="kn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Science Department</title>
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
        .hidden {
            display: none;
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
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Light gray for even rows */
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
        <h1>ಗಣಕಯಂತ್ರ ವಿಭಾಗದ ಬಗ್ಗೆ</h1>
        <p>ಡಿಎಸಿಜಿ ಸರ್ಕಾರಿ ಪಾಲಿಟೆಕ್ನಿಕ್‌,ಚಿಕ್ಕಮಗಳೂರು</p>
        <p>ಗಣಕ ವಿಜ್ಞಾನವು ಗಣನೆ, ಮಾಹಿತಿ ಮತ್ತು ಯಾಂತ್ರೀಕೃತಗೊಂಡ ಅಧ್ಯಯನವಾಗಿದೆ. ಗಣಕ ವಿಜ್ಞಾನವು ಸೈದ್ಧಾಂತಿಕ ವಿಭಾಗಗಳನ್ನು (ಅಲ್ಗಾರಿದಮ್‌ಗಳು, ಗಣನೆಯ ಸಿದ್ಧಾಂತ ಮತ್ತು ಮಾಹಿತಿ ಸಿದ್ಧಾಂತದಂತಹ) ಅನ್ವಯಿಕ ವಿಭಾಗಗಳಿಗೆ (ಹಾರ್ಡ್‌ವೇರ್ ಮತ್ತು ಸಾಫ್ಟ್‌ವೇರ್‌ನ ವಿನ್ಯಾಸ ಮತ್ತು ಅನುಷ್ಠಾನವನ್ನು ಒಳಗೊಂಡಂತೆ) ವ್ಯಾಪಿಸಿದೆ.</p>
        <p>ಕೃತಕ ಬುದ್ಧಿಮತ್ತೆ ಮತ್ತು ಯಂತ್ರ ಕಲಿಕೆಯ ಯುಗದಲ್ಲಿ, ನಾವು ಅಂತಿಮ ವರ್ಷದಲ್ಲಿ ನಾಲ್ಕು ಮಾರ್ಗಗಳನ್ನು ನೀಡುತ್ತಿದ್ದೇವೆ:</p>
        <ol>
            <li>ಕೃತಕ ಬುದ್ಧಿಮತ್ತೆ ಮತ್ತು ಯಂತ್ರ ಕಲಿಕೆ</li>
            <li>ಪೂರ್ಣ ಸ್ಟಾಕ್ ಅಭಿವೃದ್ಧಿ</li>
            <li>ಕ್ಲೌಡ್ ಕಂಪ್ಯೂಟಿಂಗ್</li>
            <li>ಸೈಬರ್ ಭದ್ರತೆ</li>
        </ol>
        <h3>2023-24ನೇ ಸಾಲಿನಲ್ಲಿ ನಮ್ಮಲ್ಲಿ ಕಲಿಯುತ್ತಿರುವ ವಿದ್ಯಾರ್ಥಿಗಳ ಸಂಖ್ಯೆ ಹೀಗಿದೆ:</h3>
        <table>
            <tr>
                <th>ವರ್ಷ</th>
                <th>ಒಟ್ಟು ವಿದ್ಯಾರ್ಥಿಗಳು</th>
            </tr>
            <tr>
                <td>ಮೊದಲ</td>
                <td>63</td>
            </tr>
            <tr>
                <td>ಎರಡನೆಯ</td>
                <td>53</td>
            </tr>
            <tr>
                <td>ಮೂರನೆಯ</td>
                <td>60</td>
            </tr>
        </table>
    </div>

    <div id="english-content" class="hidden">
        <h1>About Computer Science Department</h1>
        <p>DSG Government Polytechnic, Chikkamagaluru</p>
        <p>Computer science is the study of computation, information, and automation. Computer science spans theoretical disciplines (such as algorithms, theory of computation, and information theory) to applied disciplines (including the design and implementation of hardware and software).</p>
        <p>In the era of artificial intelligence and machine learning, we are offering four pathways in the final year:</p>
        <ol>
            <li>Artificial Intelligence and Machine Learning</li>
            <li>Full Stack Development</li>
            <li>Cloud Computing</li>
            <li>Cyber Security</li>
        </ol>
        <h3>This is our student strength in the year 2023-24:</h3>
        <table>
            <tr>
                <th>Year</th>
                <th>Number of Students</th>
            </tr>
            <tr>
                <td>First</td>
                <td>63</td>
            </tr>
            <tr>
                <td>Second</td>
                <td>53</td>
            </tr>
            <tr>
                <td>Third</td>
                <td>60</td>
            </tr>
        </table>
    </div>

    <a href="cs_lecture_details.php" class="navigate-button">Go to Lecture Details</a>
    <a href="branch.php" class="go-back-button">Go Back to Branches</a>
</div>

</body>
</html>