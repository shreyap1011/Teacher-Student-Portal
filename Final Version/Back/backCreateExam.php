<?php
$serverName = "sql1.njit.edu";
$userName = 'ti46';
$data_password = 'MiamiHeat@3';
$database = 'ti46';
$connection = mysqli_connect($serverName,$userName,$data_password,$database);
if ( mysqli_connect_errno()){
  exit("Failed to connect". mysqli_connect_error());
}

$json = file_get_contents('php://input');
$response = json_decode($json,true);
$examName = $response['examName'];
$questionIds = $response['questionIds'];
$points = $response['points'];
$n = count($questionIds);
$positive = true;

$stmt = "insert into `examTable` (`examName`) VALUES ('$examName')";
$query = mysqli_query($connection,$stmt);
if(!$query){
   $positive = false; 
}

$stmt2 = "select * from `examTable` where `examName` = '$examName'";  
$query2 = mysqli_query($connection,$stmt2);
while($row = mysqli_fetch_array($query2)){
    $examId = $row['examId'];
}

for ($i = 0; $i < count($questionIds); $i++){
    $stmt3 = "insert into `examContentTable` (`examId`, `questionId`, `score`) VALUES ('$examId', '$questionIds[$i]', '$points[$i]')";
    $query3 = mysqli_query($connection,$stmt3);
    if(!$query3){
        $positive = false;
        break;
    }
}
if($positive == false){
    echo "Failed";
}
else{
    echo "Success";
}
?>