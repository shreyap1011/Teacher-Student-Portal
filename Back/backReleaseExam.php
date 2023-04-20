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
$examName= $response['examName'];
$score = $response['score'];
$comment = $response['comment'];
$positive = true;

$examName = $response['examName'];
$stmt = "select * from `examTable` where `examName` = '$examName'"; 
$query = mysqli_query($connection,$stmt);
$examId = "";
$info = [];
while($row = mysqli_fetch_array($query)){
    $examId = $row['examId'];
}


$stmt4 = "select * from `examContentTable` where `examId` = '$examId'"; 
$query4 = mysqli_query($connection,$stmt4);
$questionId = [];
while($row = mysqli_fetch_array($query4)){
    array_push($questionId, $row['questionId']);
}

$stmt2 = "insert into `studentExamResult` (`examId`, `score`) VALUES ('$examId', '$score')";
$query2 = mysqli_query($connection,$stmt2);
if(!$query2){
   $positive = false; 
}

for($i = 0; $i < count($questionId); $i++){
    $stmt3 = "insert into `commentTable` (`questionId`, `examId`, `comment`) VALUES ('$questionId[$i]', '$examId', '$comment[$i]')";
    $query3 = mysqli_query($connection,$stmt3);
    if(!$query3){
        $positive = false;
        break;
    }
}

$stmt4 = "delete from `preExamTable` where `examId` = '$examId'";
$query4 = mysqli_query($connection,$stmt4);

if($positive == false){
    echo "Failed";
}
else{
    echo "Success";
}
?>