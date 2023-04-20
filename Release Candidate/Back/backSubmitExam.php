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
$studentAnswer = $response['studentAnswer'];
$n = count($studentAnswer);
$positive = true;

$examId = "";
$stmt = "select * from `examTable` where `examName` = '$examName'";
$query = mysqli_query($connection,$stmt);
while($row = mysqli_fetch_array($query)){
    $examId = $row['examId'];
}
if(!$query){
   $positive = false; 
}
$question_list_Id = array();
$stmt2 = "select * from `examContentTable` where `examId` = '$examId'";  
$query2 = mysqli_query($connection,$stmt2);
while($row = mysqli_fetch_array($query2)){
    array_push($question_list_Id, $row['questionId']);
}
for ($i = 0; $i < count($question_list_Id); $i++){
    $stmt3 = "insert into `studentAnswerTable` (`examId`, `score`, `studentAnswer`, `questionId`) VALUES ('$examId', '0', '$studentAnswer[$i]', '$question_list_Id[$i]')";
    $query3 = mysqli_query($connection,$stmt3);
    if(!$query3){
        $positive = false;
        break;
    }
}
$stmt4 = "insert into `preExamTable` (`examId`, `release`) VALUES ('$examId', 0)";
$query4 = mysqli_query($connection,$stmt4);
if($positive == false){
    echo "Failed";
}
else{
    echo "Success";
}
?>