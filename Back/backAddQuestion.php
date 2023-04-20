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
$questionName = $response['questionName'];
$questionDescription = $response['questionDescription'];
$difficulty = $response['difficulty'];
$questionFunction = $response['questionFunction'];
$testcase = $response['testcase'];
$testcaseoutput = $response['testcaseoutput'];
$questionCateogory = $response['questionCateogory'];
$positive = true;
$testcasefragment = explode(';', $testcase);
$testcaseoutputfragment = explode(';', $testcaseoutput);
$n = count($testcasefragment);

$stmt = "insert into `Question_Bank` (`questionName`, `questionDescription`, `questionFunction`, `questionCateogory`, `difficulty`, `totalTestCase`) VALUES ('$questionName', '$questionDescription', '$questionFunction', '$questionCateogory', '$difficulty', '$n')";
$query = mysqli_query($connection,$stmt);
if(!$query){
   $positive = false; 
}

$stmt2 = "select * from `Question_Bank` where `questionName` = '$questionName'";  //where questionName = $questionName
$query2 = mysqli_query($connection,$stmt2);
while($row = mysqli_fetch_array($query2)){
    $questionId = $row['questionId'];
}

for ($i = 0; $i < count($testcasefragment); $i++){
    $testcaseId = $i + 1;
    $stmt3 = "insert into `testcasetable` (`testcaseId`, `testcase`, `testcaseoutput`, `questionId`) VALUES ('$testcaseId', '$testcasefragment[$i]', '$testcaseoutputfragment[$i]', '$questionId')";
    $query3 = mysqli_query($connection,$stmt3);
    if(!$query3){
        $positive = false;
        break;
    }
}
if($positive == false){
    echo "Question failed to add.";
}
else{
    echo "Question Added!";
}

?>