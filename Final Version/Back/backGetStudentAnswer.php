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
    $stmt = "select * from `examTable` where `examName` = '$examName'"; 
    $query = mysqli_query($connection,$stmt);
    $examId = "";
    $info = [];
    while($row = mysqli_fetch_array($query)){
        $examId = $row['examId'];
    }
    $stmt2 = "SELECT Question_Bank.questionName, studentAnswerTable.studentAnswer, studentAnswerTable.questionId FROM Question_Bank INNER JOIN studentAnswerTable ON Question_Bank.questionId = studentAnswerTable.questionId WHERE studentAnswerTable.examId = '$examId'";
    $query2 = mysqli_query($connection,$stmt2);
    while($row = mysqli_fetch_array($query2)){
        $info[]= array('questionName' => $row['questionName'],
        'studentAnswer' => $row['studentAnswer'],'questionId' => $row['questionId']
        );
    }
    echo json_encode($info);
?>