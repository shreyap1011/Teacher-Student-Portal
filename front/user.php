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
            User Home Page
        </title>
    </head> 
    <body>
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
    </body>
</html>
