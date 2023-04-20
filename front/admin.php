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
            Teacher Home Page
        </title>
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
    </body>
</html>