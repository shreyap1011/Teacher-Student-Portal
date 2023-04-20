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
        <script src="displayToGradeExam2.js" type="text/JavaScript"></script>
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
        <div id="Exam_Menu_content" class="Exam_Menu_content">
        </div>
        <strong>Select a test to begin auto grading.</strong>
        <form id="examForm">
            <div id="examchoice"></div>
            <input type ="submit" value="Confirm">
        </form>
        <script src="autoGrade.js" type="text/JavaScript"></script>
    </body>
</html>