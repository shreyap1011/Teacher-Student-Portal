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
            Exam Form
        </title>
        <script src="requestQuestion.js" type="text/JavaScript"></script>
    </head> 
	<body>
        <nav>
            <li>
                <a href= "admin.php">Admin Home Page</a>
            </li>
            <li>
                <a href= "creatingquestion.php">Create Question</a>
            </li>
            <li>
                <a href= "examMenu.php">Show Exam Menu</a>
            </li>
            <li>
                <a href= "logout.php">Logout</a>
            </li>
        </nav>
        <div id= "examFormBody" class="examformBody">
            <h1>Exam Form</h1>
            <form id="examForm" class="examFrom">
                <label for="Exam Name"></label>
                    <input type = "button" value="showQuestion" onclick="requestQuestion()"><br><br>
                    <input type="text" id="examName" name="examName" placeholder="Exam Name"><br><br>
                    <div id="questionArea"></div> 
                    <input type ="submit" value="Submit">
                </form>
            <script src ="createExam2.js" type="text/JavaScript"></script>
        </div>
    </body>
</html>