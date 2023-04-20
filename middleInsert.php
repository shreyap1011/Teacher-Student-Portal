<?php
    $str_json = file_get_contents('php://input');
    $response = json_decode($str_json,true);
    $questionName = $response['questionName'];
    $questionDescription = $response['questionDescription'];
    $difficulty = $response['difficulty'];
    $questionFunction = $response['difficulty'];
    $testcase = $response['testcase'];
    $testcaseoutput = $response['testcaseoutput'];
    $questionCateogory = $response['questionCateogory'];


    $data = array('id'=>$id,'name'=>$name,'description'=>$description,'level' => $level);
    $url = $GLOBALS['BACK_PATH']."backAddQuestion.php";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$response = curl_exec($ch);
	curl_close ($ch);


?>

