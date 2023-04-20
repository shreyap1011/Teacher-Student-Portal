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
    $questionCat = $response['questionCateogory'];
    $questionDiff = $response['difficulty'];
    $questionKey = $response['questionKey'];
    $key = "%" . $questionKey . "%";
    $info = [];
    if($questionCat == "None" && $questionDiff == "None" && $questionKey == ""){
        $stmt = "select * from `Question_Bank`"; 
        $query = mysqli_query($connection,$stmt);
        while($row = mysqli_fetch_array($query)){
            $info[] = array('questionId' => $row['questionId'],
            'questionName' => $row['questionName'],
            'questionDescription' => $row['questionDescription'],
            'totalTestCase' => $row['totalTestCase'],
            'difficulty' => $row['difficulty'],
            'questionCateogory' => $row['questionCateogory'],
            'constraint' => $row['constraint']
            );
        }
    }
    else{
        if($questionKey != ""){
            $stmt = "select * from `Question_Bank` where `questionDescription` like '$key'"; 
            $query = mysqli_query($connection,$stmt);
        }
        else if($questionDiff == "None" && $questionCat != "None" && $questionKey == ""){
            $stmt = "select * from `Question_Bank` where `questionCateogory` = '$questionCat'"; 
            $query = mysqli_query($connection,$stmt);
        }
        else if($questionDiff != "None" && $questionCat == "None" && $questionKey == ""){
            $stmt = "select * from `Question_Bank` where `difficulty` = '$questionDiff'"; 
            $query = mysqli_query($connection,$stmt);
        }
        else{
            $stmt = "SELECT * FROM Question_Bank WHERE questionCateogory = '$questionCat' AND difficulty = '$questionDiff'"; 
            $query = mysqli_query($connection,$stmt);
        }
        while($row = mysqli_fetch_array($query)){
            $info[] = array('questionId' => $row['questionId'],
            'questionName' => $row['questionName'],
            'questionDescription' => $row['questionDescription'],
            'totalTestCase' => $row['totalTestCase'],
            'difficulty' => $row['difficulty'],
            'questionCateogory' => $row['questionCateogory'],
            'constraint' => $row['constraint']
            );
        }
    }
    echo json_encode($info);
?>