document.getElementById("FilterForm").addEventListener("submit", filter);
function filter(event){
    event.preventDefault();
    let questionCat = document.getElementById("QuestionCateogory").value;
    let questionDiff = document.getElementById("Qdifficulty").value;
    let questionKey = document.getElementById("QuestionKey").value;
    let sendInfo = {"questionCateogory": questionCat,
    "difficulty": questionDiff,
    "questionKey": questionKey
    };
    console.log(sendInfo)
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            let result = xhttp.responseText;
            let data = JSON.parse(result);
            var qTable = '<table class="questionT"><tr>'+
            "<th>Question Id</th>" +
            "<th>Question Name</th>" +
            "<th>Question Description</th>" +
            "<th>Total test case</th>" +
            "<th>Question Difficulty</th>" +
            "<th>Question Cateogory</th>" +
            "<th>Constraint</th>"+
            "</tr>";
            var value ="";
            console.log(data);
            for(var i = 0; i < data.length; i++){
                value = data[i]['questionId'];
                qTable += "</td><td>" + data[i]['questionId'] +
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
            qTable += "</table>";
        }
        document.getElementById("questionArea").innerHTML = qTable;
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleRequestFilterQuestion.php", true);
    xhttp.send(JSON.stringify(sendInfo));
}
