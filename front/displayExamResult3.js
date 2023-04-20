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
            testForm += '<strong><label class="score"> Your score for this exam is ' + data[0]['score']+ '.</label></strong><br>';
            for(var i = 1; i < n; i++){
                testForm += '<h3><label for="Question"> Question ' + i + ': ' + data[i]['questionName'] + '</label></h3>' +
                '<label class="questionDescription">' + data[i]['questionDescription']+ '</label><br><br>' +
                '<textarea disabled rows="20" cols="50" class="studentAnswer">' + data[i]['studentAnswer'] + '</textarea><br><br>'+
                '<p>Comment</p><br>' +
                '<textarea disabled rows="5" class="comment">' + data[i]['comment'] + '</textarea><br><br>';
            }
        }
        document.getElementById("examResult").innerHTML = testForm;
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleDisplayExamResultContent.php", true);
    xhttp.send(JSON.stringify({"examName":examN}));
    }
}