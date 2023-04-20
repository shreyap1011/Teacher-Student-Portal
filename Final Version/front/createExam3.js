document.getElementById("submitExamForm").addEventListener("submit", Submit);
function Submit(event){
    event.preventDefault();
    let examName = document.getElementById("ExamName").value;
    let table = document.getElementById("ExamQ");
    let tableLen = table.rows.length;
    let questionIds = [];
    let points = [];
    var point = document.getElementsByClassName('point');
    console.log(point[1].value);
    if(examName == ""){
        alert("Please enter an exam name for the exam");
        return;
    }
    if(tableLen < 2){
        alert("Please add a question to the exam.")
        return;
    }
    for(var i = 1; i < tableLen; i++){
        var cells = table.rows.item(i).cells;
        questionIds.push(cells.item(0).innerHTML);
        var id = "point" + String(i);
        console.log(id);
        points.push(point[i-1].value);
    }
    let sendInfo = {"examName": examName,
    "questionIds": questionIds,
    "points": points
    };
    console.log(sendInfo);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            if(xhttp.responseText == "Success"){
                alert("Exam succesfully created.")
                window.location.replace("https://web.njit.edu/~pl255/CS490/examMenu.php");
            }
            else{
                alert("Exam fail to create.")
            }
        }
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleCreateExam.php", true); //refer to w3w ajax_xmlrequestsend info
    xhttp.send(JSON.stringify(sendInfo));
}