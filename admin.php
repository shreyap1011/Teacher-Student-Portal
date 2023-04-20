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
            Admin Page
        </title>
    </head> 
    <body>
        <p>
            This is for Admin Access Page.
        </p>
    </body>
</html>