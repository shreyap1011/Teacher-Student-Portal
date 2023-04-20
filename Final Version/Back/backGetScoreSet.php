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
    $questionId = $response['questionId'];
    $stmt = "select * from `examTable` where `examName` = '$examName'"; 
    $query = mysqli_query($connection,$stmt);
    $examId = "";
    while($row = mysqli_fetch_array($query)){
        $examId = $row['examId'];
    }

    $stmt2 = "SELECT * From `examContentTable` WHERE `examId` = '$examId' AND `questionId` = '$questionId'"; 
    $query2 = mysqli_query($connection,$stmt2);
    $info = [];
    while($row = mysqli_fetch_array($query2)){
        $info[] = array('score' => $row['score'],
        );
    }
    echo json_encode($info);
?>