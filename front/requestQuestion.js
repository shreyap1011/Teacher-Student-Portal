function requestQuestion(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
           let result = xhttp.responseText;
            let data = JSON.parse(result);
            var examTable = '<table class="examT"><tr>' +
            "<th>CheckBox</th>" +
            "<th>Question Id</th>" +
            "<th>Question Name</th>" +
            "<th>total test case</th>" +
            "<th>Question Difficulty</th>" +
            "<th>Question Cateogory</th>" +
            "<th>Assign Points</th></tr>"
            ;
            var value ="";
            // console.log(data);
            for(var i = 0; i < data.length; i++){
                value = data[i]['questionId'];
                examTable += "<tr><td><input type='checkbox' class='checkBox[]'" + "value =" + value + " >" + 
                "</td><td>" + data[i]['questionId'] +
                "</td><td>" + data[i]['questionName'] +
                "</td><td>" + data[i]['totalTestCase'] +
                "</td><td>" + data[i]['difficulty'] +
                "</td><td>" + data[i]['questionCateogory'] +
                "</td><td><input type='text' class='points'>" +
                "</td></tr>";
                console.log(value);
                value = value.replace(value, "");
            }
        }
        document.getElementById("questionArea").innerHTML = examTable;
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleRequestQuestion.php", true);
    xhttp.send(null);
}