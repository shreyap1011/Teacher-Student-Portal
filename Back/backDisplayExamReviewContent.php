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
    $stmt3 = "select * from `preExamTable` where `examId` = '$examId'";
    $query3 = mysqli_query($connection,$stmt3);
    while($row = mysqli_fetch_array($query3)){
        array_push($info,array('score' => $row['score']));
    }

    $stmt2 = "SELECT Question_Bank.questionName, Question_Bank.questionDescription, studentAnswerTable.studentAnswer FROM Question_Bank INNER JOIN studentAnswerTable ON Question_Bank.questionId = studentAnswerTable.questionId WHERE studentAnswerTable.examId = '$examId'";
    $query2 = mysqli_query($connection,$stmt2);
    while($row = mysqli_fetch_array($query2)){
        array_push($info,array('questionName' => $row['questionName'],
        'questionDescription' => $row['questionDescription'],
        'studentAnswer' => $row['studentAnswer'],
        ));
    }
    echo json_encode($info);
?>