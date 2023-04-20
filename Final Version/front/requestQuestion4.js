function requestQuestion(){
    // alert(document.getElementById(filter).value);
    // if(document.getElementById(filter).value != "showQuestion"){
    //     return;
    // }
    let questionCat = document.getElementById("QuestionCateogory").value;
    let questionDiff = document.getElementById("Qdifficulty").value;
    let questionKey = document.getElementById("QuestionKey").value;
    let sendInfo = {"questionCateogory": questionCat,
    "difficulty": questionDiff,
    'questionKey': questionKey
    };
    console.log(sendInfo)
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
           let result = xhttp.responseText;
            let data = JSON.parse(result);
            var examTable = '<table id="examT"><tr>' +
            "<th>CheckBox</th>" +
            "<th>Question Id</th>" +
            "<th>Question Name</th>" +
            "<th>Question Description</th>" +
            "<th>total test case</th>" +
            "<th>Question Difficulty</th>" +
            "<th>Question Cateogory</th>" +
            "<th>Constraint</th>"
            ;
            var value ="";
            // console.log(data);
            for(var i = 0; i < data.length; i++){
                value = data[i]['questionId'];
                examTable += "<tr><td><input type='checkbox' class='checkBox[]'" + "value =" + value + " >" + 
                "</td><td>" + data[i]['questionId'] +
                "</td><td>" + data[i]['questionName'] +
                "</td><td>" + data[i]['questionDescription'] +
                "</td><td>" + data[i]['totalTestCase'] +
                "</td><td>" + data[i]['difficulty'] +
                "</td><td>" + data[i]['questionCateogory'] +
                "</td><td>" + data[i]['constraint'] +
                "</td></tr>";
                console.log(value);
                value = value.replace(value, "");
            }
        }
        document.getElementById("questionArea").innerHTML = examTable;
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleRequestFilterQuestion.php", true);
    xhttp.send(JSON.stringify(sendInfo));
}