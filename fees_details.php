<!DOCTYPE html>
<html lang="kn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ಪ್ರವೇಶ ಶುಲ್ಕ | Fee Structure</title>
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
        
        <a href="application_form.php">Application Form</a>
        <a href="fetch_marks.php">Fetch Marks</a>
        <a href="marks_card.php">Document Verification</a>
        <a href="view_marks.php">View Marks</a>
        <a href="seat_allotment.php">Seat Allotment</a>
       
    </nav>
    <div class="container">
        <h1>ಪ್ರವೇಶ ಶುಲ್ಕ</h1>
        <div class="language-toggle">
            <button onclick="toggleLanguage()">See Translation</button>
        </div>

        <div id="kannada-content">
            <h2>ಶುಲ್ಕದ ವಿವರ</h2>
            <p>ಸರ್ಕಾರದ ಆದೇಶ ಸಂಖ್ಯೆ. ಇಡಿ 119 ಟಿಪಿಇ 2005, ದಿನಾಂಕ: 18-10-2005 ಮತ್ತು ಸರ್ಕಾರದ ಆದೇಶ ಸಂಖ್ಯೆ . ಇಡಿ 10 ಟಿಪಿಇ 2012, ದಿನಾಂಕ: 29-05-2012 ಹಾಗೂ ಸರ್ಕಾರದ ಆದೇಶ ಸಂಖ್ಯೆ. ಇಡಿ 64 ಟಿಪಿಇ 2016, ದಿ:21-06-2016ರನ್ವಯ ಸರ್ಕಾರಿ, ಅನುದಾನಿತ ಮತ್ತು ಖಾಸಗಿ ಅನುದಾನರಹಿತ ಪಾಲಿಟೆಕ್ನಿಕ್ ಗಳಿಗೆ ಅನ್ವಯವಾಗುವಂತೆ ಕೆಳಕಂಡ ಶುಲ್ಕವನ್ನು ನಿಗದಿಪಡಿಸಲಾಗಿದೆ.</p>
            <table>
                <tr>
                    <th>ಕ್ರ.ಸಂ.</th>
                    <th>ಸಂಸ್ಥೆ</th>
                    <th>ಬೋಧನಾ ಶುಲ್ಕ</th>
                    <th>ಅಭಿವೃದ್ಧಿ ಶುಲ್ಕ</th>
                    <th>ಇತರೆ ಶುಲ್ಕ</th>
                    <th>ಒಟ್ಟು</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>ಸರ್ಕಾರಿ ಪಾಲಿಟೆಕ್ನಿಕ್</td>
                    <td>2940/-</td>
                    <td>500/-</td>
                    <td>830/-</td>
                    <td>4,270/-</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>ಅನುದಾನಿತ ಪಾಲಿಟೆಕ್ನಿಕ್</td>
                    <td>5,618/-</td>
                    <td>500/-</td>
                    <td>830/-</td>
                    <td>6,948/-</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>ಖಾಸಗಿ ಪಾಲಿಟೆಕ್ನಿಕ್</td>
                    <td>ಕರ್ನಾಟಕ ವಿದ್ಯಾರ್ಥಿಗಳಿಗೆ</td>
                    <td>12,075/-</td>
                    <td>500/-</td>
                    <td>830/-</td>
                    <td>13,405/-</td>
                </tr>
                <tr>
                    <td></td>
                    <td>ಕರ್ನಾಟಕೇತರ ವಿದ್ಯಾರ್ಥಿಗಳಿಗೆ</td>
                    <td>19,425/-</td>
                    <td>500/-</td>
                    <td>830/-</td>
                    <td>20,755/-</td>
                </tr>
            </table>

            <h2>ಶುಲ್ಕದ ವಿವರ </h2>
            <table>
                <tr>
                    <th>ಕ್ರ.ಸಂ</th>
                    <th>ಅಭ್ಯರ್ಥಿಯು ಕ್ಲೇಮ್ ಮಾಡಿದ ವರ್ಗ</th>
                    <th>ಪೋಷಕರ ವಾರ್ಷಿಕ ಆದಾಯ ಮಿತಿ</th>
                    <th>ಶುಲ್ಕದ ವಿವರ</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>ಸಾಮಾನ್ಯ</td>
                    <td>------</td>
                    <td>4,270/-</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>ಪರಿಶಿಷ್ಟ ಜಾತಿ ಮತ್ತು ಪರಿಶಿಷ್ಟ ಪಂಗಡ</td>
                    <td>2.50 ಲಕ್ಷ</td>
                    <td>430/-</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>2.50 ದಿಂದ 10.00 ಲಕ್ಷ</td>
                    <td>2,535/-</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>ಪ್ರವರ್ಗ -1</td>
                    <td>2.50 ಲಕ್ಷ</td>
                    <td>960/-</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>2A/3A/3B</td>
                    <td>2.50 ಲಕ್ಷ</td>
                    <td>960/-</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>ಪ್ರವರ್ಗ -2A ,ಪ್ರವರ್ಗ -2B ,ಪ್ರವರ್ಗ -3B</td>
                    <td>-----</td>
                    <td>4,270/-</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>ಎಸ್.ಎನ್.ಕ್ಯೂ (SNQ)</td>
                    <td>6.00 ಲಕ್ಷ</td>
                    <td>1,330/-</td>
                </tr>
            </table>
            <p>* ಎನ್.ಎಸ್.ಎಸ್ ಘಟಕ ಇರುವ ಸಂಸ್ಥೆಗಳು ಹೆಚ್ಚುವರಿಯಾಗಿ ಸ್ವ-ಆರ್ಥಿಕ ಘಟಕ ಸ್ಥಾಪಿಸುವವರಿದ್ದರೆ ಮಾತ್ರ ಮೇಲ್ಕಂಡ ಶುಲ್ಕದ ಜೊತೆಗೆ ರೂ.40/- ನ್ನು ವಿದ್ಯಾರ್ಥಿಗಳಿಂದ ಪ್ರವೇಶ ಸಮಯದಲ್ಲಿ ಪಾವತಿಸಿಕೊಳ್ಳತಕ್ಕದ್ದು.</p>
            <p>** ಎನ್.ಎಸ್.ಎಸ್ ಘಟಕ ಇಲ್ಲದ ಸಂಸ್ಥೆಗಳು ಸ್ವ-ಆರ್ಥಿಕ ಘಟಕ ಸ್ಥಾಪಿಸಲು ಮೇಲ್ಕಂಡ ಶುಲ್ಕದ ಜೊತೆಗೆ ರೂ.50/- ನ್ನು ವಿದ್ಯಾರ್ಥಿಗಳಿಂದ ಪ್ರವೇಶ ಸಮಯದಲ್ಲಿ ಪಾವತಿಸಿಕೊಳ್ಳತಕ್ಕದ್ದು.</p>
            <p>***ಪ್ರತಿ ಪಾಲಿಟೆಕ್ನಿಕ್ ನಲ್ಲಿ ಕನಿಷ್ಠ ಒಂದಾದರೂ ಎನ್.ಎಸ್.ಎಸ್ ಘಟಕ ಸ್ಥಾಪಿತವಾಗಿರಬೇಕು.</p>
        </div>

        <div id="english-content" class="hidden">
            <h2>Fee Structure</h2>
            <p>The fee structure for the diploma programmes in Government & Aided polytechnics in the state is mentioned below as per the Government order No. ED 119 TPE 05, dt: 18/10/2005, G.O. No. ED 10 TPE 2012, Dated: 29-05-2012, and G.O. No. ED 64 TPE 2016, Dated: 21-06-2016.</p>
            <table>
                <tr>
                    <th>Sl.No</th>
                    <th>Polytechnic</th>
                    <th>Tution Fee</th>
                    <th>Development Fee</th>
                    <th>Other Fee</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Government Polytechnic</td>
                    <td>2940/-</td>
                    <td>500/-</td>
                    <td>830/-</td>
                    <td>4,270/-</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Aided Polytechnic</td>
                    <td>5,618/-</td>
                    <td>500/-</td>
                    <td>830/-</td>
                    <td>6,948/-</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Private Polytechnic</td>
                    <td>Karnataka students</td>
                    <td>12,075/-</td>
                    <td>500/-</td>
                    <td>830/-</td>
                    <td>13,405/-</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Non-Karnataka students</td>
                    <td>19,425/-</td>
                    <td>500/-</td>
                    <td>830/-</td>
                    <td>20,755/-</td>
                </tr>
            </table>

            <h2>Fee Structure in Government Polytechnic </h2>
            <table>
                <tr>
                    <th>Sl. No.</th>
                    <th>Category Claimed by the Candidate</th>
                    <th>Income Limit</th>
                    <th>Fee to be paid</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>General</td>
                    <td>------</td>
                    <td>4,270/-</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>SC/ST</td>
                    <td>2.50 Lakhs</td>
                    <td>430/-</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>2.50 to 10.00 Lakhs</td>
                    <td>2,535/-</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Cat-1</td>
                    <td>2.50 Lakhs</td>
                    <td>960/-</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>2A/3A/3B</td>
                    <td>2.50 Lakhs</td>
                    <td>960/-</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Cat-2A, Cat-2B, Cat-3B</td>
                    <td>-----</td>
                    <td>4,270/-</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>SNQ</td>
                    <td>6.00 Lakhs</td>
                    <td>1,330/-</td>
                </tr>
            </table>
            <p>* The Candidates have to pay 40/- towards NSS in institutes only where Additional Self-financed NSS unit is willing to establish when NSS unit exists.</p>
            <p>** The Candidates have to pay 50/- towards NSS in institutes where Self-financed NSS unit is willing to establish when NSS unit does not exist.</p>
            <p>*** At least one NSS unit must be existing in every Polytechnic.</p>
        </div>
    </div>
</body>
</html>