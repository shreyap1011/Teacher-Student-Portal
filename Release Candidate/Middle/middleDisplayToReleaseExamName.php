<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
    $json = file_get_contents("php://input");
    $response = json_decode($json,true);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backDisplayExamToReleaseName.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $rc = curl_exec($ch);
    echo $rc;
    curl_close($ch);
?>