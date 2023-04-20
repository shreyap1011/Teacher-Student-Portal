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
    $questionId = $response['questionId'];
    $stmt = "select * from `testcasetable` where `questionId` = '$questionId'"; 
    $query = mysqli_query($connection,$stmt);
    $info = [];
    while($row = mysqli_fetch_array($query)){
        $info[] = array('testcase' => $row['testcase'],
        'testcaseoutput' => $row['testcaseoutput']
        );
    }
    echo json_encode($info);
?>