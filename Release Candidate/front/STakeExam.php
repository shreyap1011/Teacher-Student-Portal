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
            Student Exam Menu
        </title>
        <script src="displayExam3.js" type="text/JavaScript"></script>
    </head> 
    <body onload="displayExamChoice()">
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
        <form id="examContent">
            <div id="exam"></div>
            <input type="submit" value="submit"></input></form>
        </form>
        <script src="submitExam4.js" type="text/JavaScript"></script>
    </body>
</html>
