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
    $stmt3 = "select * from `studentExamResult` where `examId` = '$examId'";
    $query3 = mysqli_query($connection,$stmt3);
    while($row = mysqli_fetch_array($query3)){
        array_push($info,array('score' => $row['score']));
    }
    $stmt4 = "select * from `examContentTable` where `examId` = '$examId'"; 
    $query4 = mysqli_query($connection,$stmt4);
    $questionId = [];
    while($row = mysqli_fetch_array($query4)){
        array_push($questionId, $row['questionId']);
    }
    for($i = 0; $i < count($questionId); $i++){
        $stmt2 = "SELECT Question_Bank.questionName, Question_Bank.questionDescription, studentAnswerTable.studentAnswer, commentTable.comment FROM commentTable INNER JOIN studentAnswerTable ON commentTable.questionId = studentAnswerTable.questionId INNER JOIN Question_Bank ON commentTable.questionId = Question_Bank.questionId WHERE commentTable.questionId = '$questionId[$i]' AND commentTable.examId = '$examId'";
        $query2 = mysqli_query($connection,$stmt2);
        while($row = mysqli_fetch_array($query2)){
            array_push($info,array('questionName' => $row['questionName'],
            'questionDescription' => $row['questionDescription'],
            'studentAnswer' => $row['studentAnswer'],
            'comment' => $row['comment']
        ));
        }
    }
    echo json_encode($info);
?>