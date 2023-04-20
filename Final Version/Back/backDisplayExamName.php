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
    $stmt = "select * from `examTable`"; 
    $query = mysqli_query($connection,$stmt);
    $info = [];
    while($row = mysqli_fetch_array($query)){
        $info[] = array('examName' => $row['examName']
        );
    }
    echo json_encode($info);
?>