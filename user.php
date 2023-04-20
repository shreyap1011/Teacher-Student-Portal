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
        <title>
            User Page
        </title>
    </head> 
    <body>
        <p>
            This is for User Access Page.
        </p>
    </body>
</html>
