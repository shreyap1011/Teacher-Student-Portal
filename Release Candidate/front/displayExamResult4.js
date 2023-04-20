function displayExamResultChoice(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            let result = this.responseText;
            var data = JSON.parse(result);
            let examChoiceForm = '';
            //console.log(data);
            examChoiceForm += '<select id="examName" onclick="displayExamResultContent();">';
            examChoiceForm += '<option class="default">'+'Choose an exam to Review your Result.</option>';
            for(var i = 0, n = data.length; i < n; i++){
                examChoiceForm += '<option class=' + data[i]['examName']+'>'+data[i]['examName']+'</option>';
            }
            examChoiceForm += '</select>';
            document.getElementById('examchoice').innerHTML = examChoiceForm;
        }
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleRequestExamResultName.php", true);
    xhttp.send(null);
}

function displayExamResultContent(){
    var examN = document.getElementById("examName").value;
    if(examN == "Choose an exam to Review your Result."){
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
            for(var i = 0; i < data[0]['fscore'].length; i++){
                final_score += parseInt(data[0]['fscore'][i]);
            }

            for(var i = 0; i < data[1]['cscore'].length; i++){
                final_score += parseInt(data[1]['cscore'][i]);
            }

            for(var i = 0; i < data[2]['score'].length; i++){
                final_score += parseInt(data[2]['score'][i]);
            }
            console.log(final_score);
            console.log(n);
            testForm += '<strong>Score for this exam</strong><br>';
            testForm += '<input type="text" id="score" value="'+ final_score + '" disabled></label><br><br>';
            var counter = 0;
            var k = 0;
            for(var i = 3; i < n-4; i++){
                testForm += '<table id= "toGrade"><tr>';
                var t = 0;
                testForm += '<td><h3><label for="Question"> Question ' + i + ': ' + data[i]['questionName'] + '</label></h3></td></tr>' +
                '<tr><td><label class="questionDescription">' + data[i]['questionDescription']+ '</label></td></tr>' +
                '<tr><td><textarea disabled rows="8" cols="30" class="studentAnswer">' + data[i]['studentAnswer'] + '</textarea></td>' +
                '<td><table class="testCResult"><tr><td>Function Name</td><td>Score<input type="text" class="fscore" value="'+ data[0]['fscore'][counter] + '"disabled></td></tr>' +
                '<tr><th>TestCase</th><th>Expected</th><th>Result</th><th>Score</th></tr>';
                for(var j = 0; j < parseInt(data[i]['totalTestCase']); j++){
                    testForm += '<tr><td>' + data[n - 3]['testcase'][k] + '</td><td>' + 
                    data[n - 2]['Expected'][k] + '</td><td>'+
                    data[n - 4]['studentOutput'][k] + '</td><td>' + 
                    '<input type="text" class="score" value="'+ data[2]['score'][k] + '"disabled></td></tr>';
                    t = j;
                    k++;
                }
                k = k + parseInt(data[i]['totalTestCase']) - t - 1;
                testForm += '<tr><td>Constraint: ' + data[i]['constraint'] + '</td><td>Score<input type="text" class="cscore" value="'+ data[1]['cscore'][counter] + '"disabled></td></tr>';
                testForm += '</table>'+
                '<tr><td><textarea disabled rows="5" class="comment">' + data[n-1]['comment'][counter] + '</textarea></td></tr></table>';
                counter++;
            }
        }
        document.getElementById("examResult").innerHTML = testForm;
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleDisplayExamResultContent.php", true);
    xhttp.send(JSON.stringify({"examName":examN}));
    }
}