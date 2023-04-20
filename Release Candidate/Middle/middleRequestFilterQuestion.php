<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
    $json = file_get_contents("php://input");
    $response = json_decode($json,true);
    $questionCat = $response['questionCateogory'];
    $questionDiff = $response['difficulty'];
    $questionKey = $response['questionKey'];

    // $questionCat = "None";
    // $questionDiff = "None";
    $data = array('questionCateogory'=>$questionCat,
    'difficulty'=>$questionDiff,
    'questionKey'=>$questionKey
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backRequestFilterQuestion.php");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$rc = curl_exec($ch);
    echo $rc;
    curl_close($ch);
?>