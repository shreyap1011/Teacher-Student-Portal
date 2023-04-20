document.getElementById("examForm").addEventListener("submit", Submit);
function Submit(event){
    event.preventDefault();
    let examName = document.getElementById("examName").value;
    let checkbox = document.getElementsByClassName("checkBox[]");
    var point = document.getElementsByClassName("points");
    let questionIds = [];
    let points = [];
    var count = 0;
    if(examName == ""){
        alert("Please enter an exam name for the exam");
    }
    else{
        for(var i = 0; checkbox[i]; i++){
            if(checkbox[i].checked){ 
                if(point[i].value == ""){
                    alert("Please enter the score for question id " + (i+1) + "!");
                    break;
                }
                questionIds.push(checkbox[i].value);
                points.push(point[i].value);
                count++;
            }
        }
        if(count == 0){
            alert("Please add at least 1 question!!!")
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
}