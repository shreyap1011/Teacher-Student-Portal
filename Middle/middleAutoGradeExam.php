<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
    $json = file_get_contents("php://input");
    $response = json_decode($json,true);
    $examName = $response['examName'];
    $data = array('examName'=>$examName,
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backGetStudentAnswer.php");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$rc = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($rc,true);
    $score = 0;
    $comment = [];
    $testfile = '/afs/cad.njit.edu/u/p/l/pl255/public_html/CS490/test.py';

    for($i = 0; $i < count($response); $i++){
        if($response[$i]['studentAnswer'] == ""){   //automatically mark question wrong if nothing input and skip to next one
            continue;
        }
        else{
            file_put_contents($testfile, $response[$i]['studentAnswer']);
            $data2 = array('questionId' => $response[$i]['questionId']);
            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backGetTestCase.php");
            curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($data2));
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            $rc2 = curl_exec($ch2);
            curl_close($ch2);
            $response2 = json_decode($rc2,true);
            // $testcase = $response2[0]['testcase'];
            // $testcaseoutput = $response2[0]['testcaseoutput'];
            // file_put_contents($testfile, $response[$i]['testcase']);

            $data3 = array('examName'=>$examName,
            'questionId' => $response[$i]['questionId']);
            $ch3 = curl_init();
            curl_setopt($ch3, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backGetScoreSet.php");
            curl_setopt($ch3, CURLOPT_POSTFIELDS, json_encode($data3));
            curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
            $rc3 = curl_exec($ch3);
            curl_close($ch3);
            $response3 = json_decode($rc3,true);
            $TScore = $response3[0]['score'];
            $factor = $TScore / count($response2);  //get the factor to get 1 testcase right

            for($j = 0; $j < count($response2); $j++){
                $test = $response2[$j]['testcase'];
                file_put_contents($testfile, "\nprint($test)", FILE_APPEND);
            }
            exec("python test.py", $output, $return_code);  //based on php exec function
            // echo $output[0];
            // echo $output[1];
            // echo $output[2];
            if($return_code == 1){   //fail to compile, auto 0 for that question
                continue;
            }
            else{
                for($k=0; $k < count($response2); $k++){    //compare testcaseoutput
                    if($output[$k] == $response2[$k]['testcaseoutput']){    //correct testcase
                        $score = $score + (1 * $factor);
                        $c = "Correct TestCase " . strval($k + 1);
                        array_push($comment, $c);
                    }
                    //incorrect dont get point for that testcase
                    else{
                        $c = "Incorrect TestCase " . strval($k + 1);
                        array_push($comment, $c);
                    }
                }
            }
            $output = "";   //reset output stream for next question
        }
    }

    $data4 = array('examName'=>$examName,
    'score' => $score);
    
    $ch4 = curl_init();
    curl_setopt($ch4, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backInsertAutoGradingInfo.php");
    curl_setopt($ch4, CURLOPT_POSTFIELDS, json_encode($data4));
	curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1);
	$rc4 = curl_exec($ch4);
    curl_close($ch4);
    echo $rc4;
?>