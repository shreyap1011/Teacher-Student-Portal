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
    <link href ="style2.css" rel="stylesheet" type="text/css"/>
        <title>
            User Home Page
        </title>
    </head> 
    <body>
        <nav>
            <ul>
                <li>
                    <a class="active" href= "user.php">Student Home Page</a>
                </li>
                <li>
                    <a href="STakeExam.php">Take Exam</a>
                </li>
                <li>
                    <a href= "SExamResult.php">Review Result</a>
                </li>
                <li style="float:right">
                    <a href= "logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </body>
</html>
