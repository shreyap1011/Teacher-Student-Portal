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
            Exam Menu
        </title>
    </head> 
	<body>
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
            <table>
                <tr>
                    <td><a href="createExam.php">To create an exam</a></td>
                </tr>
                <tr>
                    <td><a href="examResult.php">To grade an exam</a></td>
                </tr>
                <tr>
                    <td><a href="reviewExamResult.php">Review and Release an exam</a></td>
                </tr>
            </table>
        </div>
    </body>
</html>