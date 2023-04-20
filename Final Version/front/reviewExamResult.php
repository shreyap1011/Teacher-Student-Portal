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
            Exam Grading Review Menu 
        </title>
        <script src="displayToReleaseExam2.js" type="text/JavaScript"></script>
    </head> 
	<body onload="displayExamChoice()">
        <nav>
            <ul>
                <li>
                    <a href= "admin.php">Admin Home Page</a>
                </li>
                <li>
                    <a href= "creatingquestion.php">Create Question</a>
                </li>
                <li>
                    <a class="active" href= "examMenu.php">Show Exam Menu</a>
                </li>
                <li style="float:right">
                    <a href= "logout.php">Logout</a>
                </li>
            </ul>
        </nav>
        <strong>Selected a test to review and release it.</strong>
        <div id="examchoice"></div>
        <form id="examChangeForm">
            <div id="examResultToView">
            </div>
            <input type ="submit" value="Release">
        </form>
        <script src="submitChanges2.js" type="text/JavaScript"></script>
    </body>
</html>