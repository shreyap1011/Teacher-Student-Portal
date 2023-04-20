function displayExamChoice(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            let result = this.responseText;
            var data = JSON.parse(result);
            let examChoiceForm = '';
            //console.log(data);
            examChoiceForm += '<select id="examName" onclick="displayExamResultContent();">';
            examChoiceForm += '<option class="default">' + '---</option>';
            for(var i = 0, n = data.length; i < n; i++){
                examChoiceForm += '<option class=' + data[i]['examName']+'>'+data[i]['examName']+'</option>';
            }
            examChoiceForm += '</select><br><br>';
            document.getElementById('examchoice').innerHTML = examChoiceForm;
        }
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleDisplayToReleaseExamName.php", true);
    xhttp.send(null);
}

function displayExamResultContent(){
    var examN = document.getElementById("examName").value;
    console.log(examN);
    if(examN == "---"){
        //do nothing
    }
    else{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            let result = xhttp.responseText;
            var data = JSON.parse(result);
            console.log(data);
            var testForm = '<h1 id="examName" value="' + examN + '">' + examN +'</h1>';
            var n = data.length;
            let final_score = 0;
            let p_score = 0;
            for(var i = 0; i < data[0]['Pscore'].length; i++){
                p_score += parseInt(data[0]['Pscore'][i]);
            }

            for(var i = 0; i < data[1]['fscore'].length; i++){
                final_score += parseInt(data[1]['fscore'][i]);
            }

            for(var i = 0; i < data[2]['cscore'].length; i++){
                final_score += parseInt(data[2]['cscore'][i]);
            }

            for(var i = 0; i < data[3]['score'].length; i++){
                final_score += parseInt(data[3]['score'][i]);
            }
            console.log(final_score);
            console.log(n);
            testForm += '<strong>Possible score for this exam: ' + p_score +  '</strong><br><br>';
            testForm += '<strong>Score for this exam</strong><br>';
            testForm += '<input type="text" id="score" value="'+ final_score + '" disabled></label><br><br>';
            var counter = 0;
            var k = 0;
            for(var i = 4; i < n-3; i++){
                var student_score = 0;
                var a = data[0]['Pscore'][counter] * 0.1; 
                var t = 0;
                student_score = student_score + parseInt(data[1]['fscore'][counter]);
                testForm += '<table id= "toGrade"><tr>';
                testForm += '<td><h3><label for="Question"> Question ' + (i - 3)+ ': ' + data[i]['questionName'] + '</label></h3></td></tr>' +
                '<tr><td><label class="questionDescription">' + data[i]['questionDescription']+ '</label></td></tr>' +
                '<tr><td><textarea disabled rows="5" class="studentAnswer">' + data[i]['studentAnswer'] + '</textarea></td>' +
                '<td><table class="testCResult"><tr><td>Function Name</td><td>Possible Score: '+ a + '</td><td>Score<input type="text" class="fscore" value="'+ data[1]['fscore'][counter] + '"></td></tr>' +
                '<tr><th>TestCase</th><th>Expected Output</th><th>Student Output</th><th>Possible Score</th><th>Score</th></tr>';
                for(var j = 0; j < parseInt(data[i]['totalTestCase']); j++){
                    var b = data[3]['score'][k];
                    student_score = student_score + parseInt(b);
                    testForm += '<tr><td>' + data[n - 2]['testcase'][k] + '</td><td>' + 
                    data[n - 1]['Expected'][k] + '</td><td>'+
                    data[n - 3]['studentOutput'][k] + '</td><td>' + 
                    '9</td><td>'+
                    '<input type="text" class="score" value="'+ b + '"></td></tr>';
                    t = j;
                    k++;
                }
                k = k + parseInt(data[i]['totalTestCase']) - t - 1;
                var f = 0;
                if(data[i]['constraint'] != "None"){
                    f = -5;
                }
                student_score = student_score + parseInt(data[2]['cscore'][counter]);
                testForm += '<tr><td>Constraint: ' + data[i]['constraint'] + '</td><td>Possible Penalty: '+ f +'</td><td>Score<input type="text" class="cscore" value="'+ data[2]['cscore'][counter] + '"></td></tr>';
                testForm += '<tr><td>Total Possible Score: ' + data[0]['Pscore'][counter] + '</td><td>Student Score: '+ student_score + '</td></tr>';
                testForm += '</table>'+
                '<tr><td><strong>Enter Comment here</strong></td></tr>' +
                '<tr><td><textarea rows="5" class="comment"></textarea></td></tr></table>';
                counter++;
            }
        }
        document.getElementById("examResultToView").innerHTML = testForm;
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleDisplayExamReviewContent.php", true);
    xhttp.send(JSON.stringify({"examName":examN}));
    }
}