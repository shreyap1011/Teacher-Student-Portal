<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
    $json = file_get_contents("php://input");
    $response = json_decode($json,true);
    $examName = $response['examName'];
    $cscore = $response['cscore'];
    $score = $response['score'];
    $fscore = $response['fscore'];
    $comment = $response['comment'];

    $data = array('examName'=>$examName,
    'cscore' => $cscore,
    'score' => $score,
    'fscore' => $fscore,
    'comment' => $comment
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backReleaseExam.php");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$rc = curl_exec($ch);
    echo $rc;
    curl_close($ch);
?>
