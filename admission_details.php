<!DOCTYPE html>
<html lang="kn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ಡಿಪ್ಲೋಮಾ ಪ್ರವೇಶದ ಬಗ್ಗೆ | About Admission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .section {
            margin-bottom: 20px;
        }
        .hidden {
            display: none;
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
<nav>
    <div class="dropdown">
            <a href="#">Details</a>
            <div class="dropdown-content">
                <a href="admission_details.php">Admission Details</a>
                <a href="fees_details.php">Fees Details</a>
                
            </div>
        </div>
        <a href="branch.php">Branch</a>
        <a href="application_form.php">Application Form</a>
        <a href="fetch_marks.php">Fetch Marks</a>
        <a href="marks_card.php">Document Verification</a>
        <a href="view_marks.php">View Marks</a>
        <a href="seat_allotment.php">Seat Allotment</a>
       
    </nav>
    <div class="container">
        <h1>ಡಿಪ್ಲೋಮಾ ಪ್ರವೇಶದ ಬಗ್ಗೆ</h1>
        <div class="language-toggle">
            <button onclick="toggleLanguage()">See Translation</button>
        </div>

        <div id="kannada-content">
            <h2>ವಿಭಾಗಗಳು ಮತ್ತು ಲಭ್ಯವಿರುವ ಸೀಟುಗಳು</h2>
            <table>
                <tr>
                    <th>ಕ್ರ. ಸಂ</th>
                    <th>ವಿಭಾಗಗಳು</th>
                    <th>ಲಭ್ಯವಿರುವ ಸೀಟುಗಳು (ಕೋಟಾವಾರು)</th>
                </tr>
                <tr>
                    <td>01</td>
                    <td>ಆಟೋಮೊಬೈಲ್‌ ವಿಭಾಗ</td>
                    <td>48+02+5% (ಸಂಖ್ಯಾಧಿಕ ಸೀಟುಗಳು)</td>
                </tr>
                <tr>
                    <td>02</td>
                    <td>ಕಾಮಗಾರಿ ವಿಭಾಗ</td>
                    <td>58+02+5% (ಸಂಖ್ಯಾಧಿಕ ಸೀಟುಗಳು)</td>
                </tr>
                <tr>
                    <td>03</td>
                    <td>ಗಣಕಯಂತ್ರ ವಿಭಾಗ</td>
                    <td>58+02+5% (ಸಂಖ್ಯಾಧಿಕ ಸೀಟುಗಳು)</td>
                </tr>
                <tr>
                    <td>04</td>
                    <td>ಎಲೆಕ್ಟ್ರಿಕಲ್‌ ಮತ್ತು ಎಲೆಕ್ಟ್ರಾನಿಕ್ಸ್‌ ವಿಭಾಗ</td>
                    <td>58+02+5% (ಸಂಖ್ಯಾಧಿಕ ಸೀಟುಗಳು)</td>
                </tr>
                <tr>
                    <td>05</td>
                    <td>ವಿದ್ಯುನ್ಮಾನ ಮತ್ತು ಸಂವಹನ ವಿಭಾಗ</td>
                    <td>58+02+5% (ಸಂಖ್ಯಾಧಿಕ ಸೀಟುಗಳು)</td>
                </tr>
                <tr>
                    <td>06</td>
                    <td>ಯಾಂತ್ರಿಕ ವಿಭಾಗ</td>
                    <td>58+02+5% (ಸಂಖ್ಯಾಧಿಕ ಸೀಟುಗಳು)</td>
                </tr>
            </table>

            <h2>ವಿದ್ಯಾರ್ಹತೆ:</h2>
            <p>ಎಸ್ಎಸ್ಎಲ್ಸಿ/ 10 ನೇ ತರಗತಿ, ಗಣಿತ ಮತ್ತು ವಿಜ್ಞಾನದಲ್ಲಿ ಕನಿಷ್ಠ 35% ಅಂಕಗಳೊಂದಿಗೆ ಉತ್ತೀರ್ಣರಾಗಿರಬೇಕು.</p>
            <p>ಲ್ಯಾಟರಲ್ ಎಂಟ್ರಿ ಸ್ಕೀಮ್ ಅಡಿಯಲ್ಲಿ ಮೂರನೇ ಸೆಮಿಸ್ಟರ್ ಡಿಪ್ಲೊಮಾಗೆ ಪ್ರವೇಶ ಬಯಸುವ ಅಭ್ಯರ್ಥಿಗಳು ಸೂಕ್ತ ಟ್ರೇಡ್ನಲ್ಲಿ ಐಟಿಐ ಉತ್ತೀರ್ಣರಾಗಿರಬೇಕು ಅಥವಾ ದ್ವಿತೀಯ ಪಿಯುಸಿ(ವಿಜ್ಞಾನ) ಉತ್ತೀರಣರಾದ ವಿದ್ಯಾರ್ಥಿಗಳು ಯಾವುದೇ ವಿಭಾಗದಾಲ್ಲಿ ಲಭ್ಯವಿರುವ ಸೀಟುಗಳನ್ನು ಪಡೆಯಬಹುದು.</p>

            <h2>ಪ್ರವೇಶ ವಿಧಾನ:</h2>
            <p>ತಾಂತ್ರಿಕ ಶಿಕ್ಷಣ ಇಲಾಖೆ ಪ್ರವೇಶಕ್ಕಾಗಿ ಅಧಿಸೂಚನೆ ಹೊರಡಿಸುವ ಮೂಲಕ ಎಸ್.ಎಸ್.ಎಲ್.ಸಿ/ 10 ನೇ ತರಗತಿಯ ಫಲಿತಾಂಶಗಳನ್ನು ಪ್ರಕಟಿಸಿದ ನಂತರ ಪ್ರವೇಶ ಪ್ರಕ್ರಿಯೆಯು ಸಾಮಾನ್ಯವಾಗಿ ಪ್ರಾರಂಭವಾಗುತ್ತದೆ. ಡಿಪ್ಲೊಮಾಗೆ ಪ್ರವೇಶ ಬಯಸುವ ಅಭ್ಯರ್ಥಿಗಳು ಯಾವುದೇ ಸರ್ಕಾರಿ ಪಾಲಿಟೆಕ್ನಿಕ್ ಗಳಲ್ಲಿ ಅರ್ಜಿ ನಮೂನೆಗಳನ್ನು ಪಡೆಯಬಹುದು ಮತ್ತು ಯಾವುದೇ ಸರ್ಕಾರಿ ಪಾಲಿಟೆಕ್ನಿಕ್ ಗಳಲ್ಲಿ ಅರ್ಜಿ ಸಲ್ಲಿಸಬಹುದು.</p>

            <h2>ಅಗತ್ಯವಿರುವ ಪ್ರಮಾಣಪತ್ರಗಳು:</h2>
            <ul>
                <li>ಎಸ್.ಎಸ್.ಎಲ್.ಸಿ. ಅಂಕಪಟ್ಟಿ.</li>
                <li>ವರ್ಣಾವಣೆ ಪ್ರಮಾಣಪತ್ರ/ಟಿಸಿ/ಎಲ್.ಸಿ</li>
                <li>10ನೇ ತರಗತಿ ಸೇರಿದಂತೆ ಕನಿಷ್ಠ 6 ವರ್ಷಗಳು ಕರ್ನಾಟಕದಲ್ಲಿ ಶಿಕ್ಷಣ ಪಡೆದ ಬಗ್ಗೆ ಪ್ರಮಾಣಪತ್ರ.</li>
                <li>4 ಪಾಸ್ಪೋರ್ಟ್ ಗಾತ್ರದ ಫೋಟೋಗಳು.</li>
                <li>ಜಾತಿ ಮತ್ತು ಆದಾಯ ಪ್ರಮಾಣಪತ್ರ / ಗ್ರಾಮೀಣ ಪ್ರಮಾಣಪತ್ರ/ ಕನ್ನಡ ಮಾಧ್ಯಮ ಅನ್ವಯವಾದರೆ.</li>
            </ul>
        </div>

        <div id="english-content" class="hidden">
            <h2>Branches and Available Seats</h2>
            <table>
                <tr>
                    <th>Sl. No.</th>
                    <th>Branch</th>
                    <th>Seats Available (Quota wise)</th>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Automobile Engineering</td>
                    <td>48+02+5% (SNQ)</td>
                </tr>
                <tr>
                    <td>02</td>
                    <td>Civil Engineering</td>
                    <td>58+02+5% (SNQ)</td>
                </tr>
                <tr>
                    <td>03</td>
                    <td>Computer Science and Engineering</td>
                    <td>58+02+5% (SNQ)</td>
                </tr>
                <tr>
                    <td>04</td>
                    <td>Electrical and Electronics Engineering</td>
                    <td>58+02+5% (SNQ)</td>
                </tr>
                <tr>
                    <td>05</td>
                    <td>Electronics and Communications Engineering</td>
                    <td>58+02+5% (SNQ)</td>
                </tr>
                <tr>
                    <td>06</td>
                    <td>Mechanical Engineering</td>
                    <td>58+02+5% (SNQ)</td>
                </tr>
            </table>

            <h2>Admission Eligibility:</h2>
            <p>Should pass in SSLC/ 10th Standard with minimum 35 % in Maths & Science.</p>
            <p>Candidates seeking admission for third semester diploma under lateral entry scheme should have passed ITI in appropriate trade. OR Candidates passed in II PUC (Science) can select any available seats.</p>

            <h2>Admission Procedure:</h2>
            <p>Admission procedure starts normally after the SSLC results through a notification by the Department of Technical Education. Candidates seeking admission can get application forms from any of the government polytechnics and apply in the institute they want to join.</p>

            <h2>Certificates Required:</h2>
            <ul>
                <li>SSLC marks card</li>
                <li>Transfer certificate/Leaving Certificate</li>
                <li>Study certificate with a minimum of 6 years studied in Karnataka including SSLC.</li>
                <li>4 Passport size Photos</li>
                <li>Caste and Income Certificate/Rural Certificate if applicable.</li>
            </ul>
        </div>
    </div>
</body>
</html>