function displayExamChoice(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            let result = this.responseText;
            var data = JSON.parse(result);
            let examChoiceForm = '';
            //console.log(data);
            examChoiceForm += '<select id="examName" onclick="displayExamContent();">';
            examChoiceForm += '<option class="default">'+'Choose an exam to begin.</option>';
            for(var i = 0, n = data.length; i < n; i++){
                examChoiceForm += '<option class=' + data[i]['examName']+'>'+data[i]['examName']+'</option>';
            }
            examChoiceForm += '</select>';
            document.getElementById('examchoice').innerHTML = examChoiceForm;
        }
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleDisplayExamName.php", true);
    xhttp.send(null);
}

function displayExamContent(){
    var examN = document.getElementById("examName").value;
    console.log(examN);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            let result = xhttp.responseText;
            var data = JSON.parse(result);
            console.log(data);
            var testForm = '<h1 id="examName" value="' + examN + '">' + examN +'</h1>';
            var n = data.length;
            for(var i = 0; i < n; i++){
                testForm += '<h3><label for="Question"> Question ' + (i + 1) + ': ' + data[i]['questionName'] + '</label></h3>' +
                '<p>' + data[i]['score'] + ' points<p>' +
                '<label class="questionDescription">' + data[i]['questionDescription']+ '</label><br><br>' +
                '<label for="Note">Enter your answer in the box below.</label><br><br>' +
                '<textarea rows="20" cols="50" class="studentAnswer"></textarea><br><br>';
            }
        }
        document.getElementById("exam").innerHTML = testForm;
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleDisplayExamContent.php", true);
    xhttp.send(JSON.stringify({"examName":examN}));
}