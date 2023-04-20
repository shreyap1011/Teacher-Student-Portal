<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <link href ="style.css" rel="stylesheet" type="text/css"/>
        <title>
            Student exam Result Page
        </title>
        <script src="displayExamResult3.js" type="text/JavaScript"></script>
    </head> 
    <body onload="displayExamResultChoice()">
        <nav>
            <li>
                <a href= "user.php">Student Home Page</a>
            </li>
            <li>
                <a href="STakeExam.php">Take Exam</a>
            </li>
            <li>
                <a href= "SExamResult.php">Review Result</a>
            </li>
            <li>
                <a href= "logout.php">Logout</a>
            </li>
        </nav>
        <div id="examchoice"></div>
        <div id="examResult"></div>
    </body>
</html>
