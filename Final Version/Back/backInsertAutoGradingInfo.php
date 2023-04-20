<?php
$serverName = "sql1.njit.edu";
$userName = 'ti46';
$data_password = 'MiamiHeat@3';
$database = 'ti46';
$connection = mysqli_connect($serverName,$userName,$data_password,$database);
if ( mysqli_connect_errno()){
  exit("Failed to connect". mysqli_connect_error());
}

$final_score = 0;
$json = file_get_contents('php://input');
$response = json_decode($json,true);
$examName= $response['examName'];
$fscore = $response['fscore'];
$score = $response['score'];
$cscore = $response['cscore'];
$studentOutput = $response['studentOutput'];
$positive = true;

$examName = $response['examName'];
$stmt = "select * from `examTable` where `examName` = '$examName'"; 
$query = mysqli_query($connection,$stmt);
$examId = "";
$info = [];
while($row = mysqli_fetch_array($query)){
    $examId = $row['examId'];
}

$questionIds = [];
$tc = [];
$stmt3 = "SELECT Question_Bank.questionId, Question_Bank.totalTestCase FROM Question_Bank INNER JOIN examContentTable ON Question_Bank.questionId = examContentTable.questionId WHERE examContentTable.examId = '$examId'";
$query3 = mysqli_query($connection,$stmt3);
while($row = mysqli_fetch_array($query3)){
    array_push($questionIds, $row['questionId']);
    array_push($tc, $row['totalTestCase']);
}

$counter = 0;
for($i = 0; $i < count($questionIds); $i++){
    $stmt5 = "insert into `nameCheck` (`examId`, `questionId`, `score`) VALUES ('$examId', '$questionIds[$i]', '$fscore[$i]')";
    $query5 = mysqli_query($connection,$stmt5);
    if(!$query5){
        $positive = false; 
        break;
    }
    for($j = 0; $j < $tc[$i]; $j++){
        $testcaseId = $j + 1;
        $stmt6 = "insert into `studentExamResult` (`examId`, `questionId`, `score`, `testcaseId`) VALUES ('$examId', '$questionIds[$i]', '$score[$counter]', '$testcaseId')";
        $query6 = mysqli_query($connection,$stmt6);
        if(!$query6){
            $positive = false; 
            break;
        }
        $stmt8 = "insert into `studentOutput` (`examId`, `questionId`, `studentAnswer`, `testcaseId`) VALUES ('$examId', '$questionIds[$i]', '$studentOutput[$counter]', '$testcaseId')";
        $query8 = mysqli_query($connection,$stmt8);
        if(!$query8){
            $positive = false; 
            break;
        }
        $counter++;
    }
    $stmt7 = "insert into `constraintCheck` (`examId`, `questionId`, `score`) VALUES ('$examId', '$questionIds[$i]', '$cscore[$i]')";
    $query7 = mysqli_query($connection,$stmt7);
    if(!$query7){
        $positive = false; 
        break;
    }
}

// $stmt2 = "update `preExamTable` set score = '$final_score' where `examId` = '$examId'";
// $query2 = mysqli_query($connection,$stmt2);
// if(!$query2){
//    $positive = false; 
// }
if($positive == false){
    echo "Failed";
}
else{
    echo "Success";
}
?>