<?php
session_start();
$serverName = "sql1.njit.edu";
$userName = 'ti46';
$data_password = 'MiamiHeat@3';
$database = 'ti46';

// $ID = $_POST["ID"];
 $UserName = $_POST['UserName'];
 $Password1 = $_POST['password'];
// $UserType = $_POST['UserType'];
$connection = mysqli_connect($serverName,$userName,$data_password,$database);
if ( mysqli_connect_errno()){
  exit("Failed to connect". mysqli_connect_error());
}
if( !isset($_POST['UserName'],$_POST['password'])){
  exit('Please fill both the username and password');
}
//Help with the sql statement
if ($stmt = $connection->prepare('SELECT ID, Password, UserType FROM Login WHERE UserName= ?')){  //line fixed
  $stmt->bind_param('s',$_POST['UserName']);
  $stmt->execute();
  $stmt->store_result();
  if($stmt->num_rows > 0){
    $stmt->bind_result($ID,$Password,$UserType);
    $stmt->fetch();
    if(password_verify($Password1,$Password)){
      session_regenerate_id();
      $_SESSION['loggedin'] = TRUE;
		  $_SESSION['name'] = $_POST['Username'];
		  $_SESSION['ID'] = $ID;
      echo 'UserName';
      if($UserType == "admin"){
        header('Location: admin.php');
      }
      elseif($UserType == "user"){
        header('Location: user.php');
      }
	  } else {
		// Incorrect password
		echo "Incorrect password!";
    echo "Redirecting";
    header('refresh:3; url =login.html');
	  }
  } 
  else {
	// Incorrect username
	echo 'Incorrect username and/or password!';
  echo "Redirecting";
  header('refresh:3; url =login.html');
  }
  $stmt->close();
}

  // $stmt->close();



?>
