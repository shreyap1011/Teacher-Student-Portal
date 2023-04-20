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
            Teacher Home Page
        </title>
    </head> 
    <body>
        <nav>
            <ul>
                <li>
                    <a class="active" href= "admin.php">Admin Home Page</a>
                </li>
                <li>
                    <a href= "creatingquestion.php">Create Question</a>
                </li>
                <li>
                    <a href= "examMenu.php">Show Exam Menu</a>
                </li>
                <li style="float:right">
                    <a href= "logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </body>
</html>