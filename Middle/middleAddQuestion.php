<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
    $json = file_get_contents("php://input");
    $response = json_decode($json,true);
    $questionName = $response['questionName'];
    $questionDescription = $response['questionDescription'];
    $difficulty = $response['difficulty'];
    $questionFunction = $response['questionFunction'];
    $testcase = $response['testcase'];
    $testcaseoutput = $response['testcaseoutput'];
    $questionCateogory = $response['questionCateogory'];

    $data = array('questionName'=>$questionName,
    'questionDescription'=>$questionDescription,
    'difficulty'=>$difficulty,
    'questionFunction' => $questionFunction,
    'testcase' => $testcase,
    'testcaseoutput' => $testcaseoutput,
    'questionCateogory' => $questionCateogory
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backAddQuestion.php");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$rc = curl_exec($ch);
    echo $rc;
    curl_close($ch);
?>

