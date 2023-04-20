document.getElementById("examContent").addEventListener("submit", Submit);
function Submit(event){
    event.preventDefault();
    let examName = document.getElementById("examName").value;
    let studentAnswer = document.getElementsByClassName('studentAnswer');
    var answer = [];
    console.log(studentAnswer[0].value);
    for(var i = 0; studentAnswer[i]; i++){
        answer.push(studentAnswer[i].value);
    }
    var sendInfo = {"examName": examName,
        "studentAnswer": answer 
    };
    console.log(sendInfo);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            if(xhttp.responseText == "Success"){
                alert("Exam Submit Sucessfully, Well done");
                window.location.replace("https://web.njit.edu/~pl255/CS490/user.php");
            }
            else{
                console.log(xhttp.responseText);
                alert("Exam Fail to Submit.");
            }
        }
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleSubmitExam.php", true); 
    xhttp.send(JSON.stringify(sendInfo));
}