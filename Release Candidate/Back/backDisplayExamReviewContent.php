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
    // $stmt3 = "select * from `preExamTable` where `examId` = '$examId'";
    // $query3 = mysqli_query($connection,$stmt3);
    // while($row = mysqli_fetch_array($query3)){
    //     array_push($info,array('score' => $row['score']));
    // }

    $stmt4 = "select * from `nameCheck` where `examId` = '$examId'";
    $query4 = mysqli_query($connection,$stmt4);
    $nscore = [];
    while($row = mysqli_fetch_array($query4)){
        array_push($nscore, $row['score']);
    }
    array_push($info, array('fscore' => $nscore));

    $cscore = [];
    $stmt5 = "select * from `constraintCheck` where `examId` = '$examId'";
    $query5 = mysqli_query($connection,$stmt5);
    while($row = mysqli_fetch_array($query5)){
        array_push($cscore, $row['score']);
    }
    array_push($info, array('cscore' => $cscore));

    $score = [];
    $stmt6 = "select * from `studentExamResult` where `examId` = '$examId'";
    $query6 = mysqli_query($connection,$stmt6);
    while($row = mysqli_fetch_array($query6)){
        array_push($score, $row['score']);
    }
    array_push($info, array('score' => $score));

    $questionIds = [];
    $stmt2 = "SELECT Question_Bank.questionId, Question_Bank.questionName, Question_Bank.questionDescription, Question_Bank.totalTestCase, Question_Bank.constraint, studentAnswerTable.studentAnswer FROM Question_Bank INNER JOIN studentAnswerTable ON Question_Bank.questionId = studentAnswerTable.questionId WHERE studentAnswerTable.examId = '$examId'";
    $query2 = mysqli_query($connection,$stmt2);
    while($row = mysqli_fetch_array($query2)){
        array_push($questionIds, $row['questionId']);
        array_push($info,array('questionName' => $row['questionName'],
        'questionDescription' => $row['questionDescription'],
        'totalTestCase' => $row['totalTestCase'],
        'constraint' => $row['constraint'],
        'studentAnswer' => $row['studentAnswer'],
        ));
    }

    $stmt3 = "select * from `studentOutput` where `examId` = '$examId'";
    $query3 = mysqli_query($connection,$stmt3);
    $studentOut = [];
    while($row = mysqli_fetch_array($query3)){
        array_push($studentOut, $row['studentAnswer']);
    }
    array_push($info, array('studentOutput' => $studentOut));

    $testcase = [];
    $expected = [];
    for($i = 0; $i < count($questionIds); $i++){
        $stmt7 = "select * from `testcasetable` where `questionId` = '$questionIds[$i]'";
        $query7 = mysqli_query($connection,$stmt7);
        while($row = mysqli_fetch_array($query7)){
            array_push($testcase, $row['testcase']);
            array_push($expected, $row['testcaseoutput']);
        }
    }
    array_push($info, array('testcase' => $testcase));
    array_push($info, array('Expected' => $expected));

    echo json_encode($info);
?>