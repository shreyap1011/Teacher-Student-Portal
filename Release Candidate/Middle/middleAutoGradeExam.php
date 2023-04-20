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
    $fscore = [];   //function name score
    $score = [];    //testcase score
    $cscore = [];   //constraint score if necessary
    $studentOutput = [];
    $testfile = '/afs/cad.njit.edu/u/p/l/pl255/public_html/CS490/test.py';
    // $outfile = '/afs/cad.njit.edu/u/p/l/pl255/public_html/CS490/out.txt';

    for($i = 0; $i < count($response); $i++){
        if($response[$i]['studentAnswer'] == ""){   //automatically mark question wrong if nothing input and skip to next one
            continue;
        }
        else{
            $tCount = 0;
            $data2 = array('questionId' => $response[$i]['questionId']);
            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backGetTestCase.php");
            curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($data2));
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            $rc2 = curl_exec($ch2);
            curl_close($ch2);
            $response2 = json_decode($rc2,true);

            $data3 = array('examName'=>$examName,
            'questionId' => $response[$i]['questionId']);
            $ch3 = curl_init();
            curl_setopt($ch3, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backGetScoreSet.php");
            curl_setopt($ch3, CURLOPT_POSTFIELDS, json_encode($data3));
            curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
            $rc3 = curl_exec($ch3);
            curl_close($ch3);
            $response3 = json_decode($rc3,true);
            $Score = $response3[0]['score'];   //Question score
            $Fscore = $Score * 0.1; //10% worth
            $Tscore = $Score - $Fscore;
            // $factor = $TScore / count($response2);  //get the factor to get 1 testcase right
            
            //String Check for fucntion name
            $data5 = array('questionId' => $response[$i]['questionId']);
            $ch5 = curl_init();
            curl_setopt($ch5, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backGetFunctionName.php");
            curl_setopt($ch5, CURLOPT_POSTFIELDS, json_encode($data5));
            curl_setopt($ch5, CURLOPT_RETURNTRANSFER, 1);
            $rc5 = curl_exec($ch5);
            curl_close($ch5);
            $response5 = json_decode($rc5,true);

            //$testcase = $response2[0]['testcase'];
            $ex = explode("\n", $response[$i]['studentAnswer']);
            $student_func = $ex[0];
            $student_func_name = substr($student_func, 0, strpos($student_func, "("));
            $funct_name = $response5[0]['questionFunction'];
            // file_put_contents($outfile, "Testing");
            // file_put_contents($outfile, $student_funct);
            // file_put_contents($outfile, $student_funct_name);
            // file_put_contents($outfile, $funct_name);
            $fname = substr($funct_name, 0, strpos($funct_name, "("));
            if(strcmp($student_func_name, $fname) != 0){
                // echo "Incorrect Name";
                file_put_contents($testfile, $funct_name);
                file_put_contents($testfile, "\n", FILE_APPEND);
                for($j = 1; $j < count($ex); $j++){
                    file_put_contents($testfile, $ex[$j], FILE_APPEND);
                }
                array_push($fscore, 0);
            }
            else{
                // echo "Correct Name";
                file_put_contents($testfile, $response[$i]['studentAnswer']);
                array_push($fscore, $Fscore);
            }
            //file_put_contents($testfile, $response[$i]['studentAnswer']);
            for($j = 0; $j < count($response2); $j++){
                $test = $response2[$j]['testcase'];
                file_put_contents($testfile, "\nprint($test)", FILE_APPEND);
            }
            exec("python test.py", $output, $return_code);  //based on php exec function
            // echo $output[0];
            // echo $output[1];
            // echo $output[2];
            if($return_code == 1){   //fail to compile, auto 0 for that question
                for($k = 0; $k < count($response2); $k++){
                    array_push($studentOutput, "Failed To Compile");
                    array_push($score, 0);
                    $tCount++;
                }
            }
            else{
                for($k=0; $k < count($response2); $k++){    //compare testcaseoutput
                    if($output[$k] == $response2[$k]['testcaseoutput']){    //correct testcase
                        $tscore = $Tscore / count($response2);
                        array_push($studentOutput, $output[$k]);
                        array_push($score, $tscore);
                        
                    }
                    //incorrect dont get point for that testcase
                    else{
                        array_push($studentOutput, $output[$k]);
                        array_push($score, 0);
                        $tCount++;
                    }
                }
            }
            $output = "";   //reset output stream for next question

            //Check Constraint
            $data6 = array('questionId' => $response[$i]['questionId']);
            $ch6 = curl_init();
            curl_setopt($ch6, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backGetConstraint.php");
            curl_setopt($ch6, CURLOPT_POSTFIELDS, json_encode($data6));
            curl_setopt($ch6, CURLOPT_RETURNTRANSFER, 1);
            $rc6 = curl_exec($ch6);
            curl_close($ch6);
            $response6 = json_decode($rc6,true);

            $constraint = $response6[0]['constraint'];
            if($constraint == "None"){
                array_push($cscore, 0);
            }
            else{
                if($constraint == "For Loop"){
                    if(substr_count($response[$i]['studentAnswer'], "for") < 1){
                        if($tCount == count($response2)){
                            array_push($cscore, 0); //dont get penalty
                        }
                        else{
                            array_push($cscore, -5);
                        }
                    }
                }
                else if($constraint == "While Loop"){
                    if(substr_count($response[$i]['studentAnswer'], "while") < 1){
                        if($tCount == count($response2)){
                            array_push($cscore, 0); //dont get penalty
                        }
                        else{
                            array_push($cscore, -5);
                        }
                    }
                }
                else{
                    if(substr_count($response[$i]['studentAnswer'], $fname) < 2){
                        if($tCount == count($response2)){
                            array_push($cscore, 0); //dont get penalty
                        }
                        else{
                            array_push($cscore, -5);
                        }
                    }
                }
            }
        }
    }

    $data4 = array('examName'=>$examName,
    'fscore' => $fscore,
    'score' => $score,
    'cscore' => $cscore,
    'studentOutput' => $studentOutput
    );
    
    $ch4 = curl_init();
    curl_setopt($ch4, CURLOPT_URL, "https://web.njit.edu/~pl255/CS490/backInsertAutoGradingInfo.php");
    curl_setopt($ch4, CURLOPT_POSTFIELDS, json_encode($data4));
	curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1);
	$rc4 = curl_exec($ch4);
    curl_close($ch4);
    echo $rc4;
?>