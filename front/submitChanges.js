document.getElementById("examChangeForm").addEventListener("submit", Submit);
function Submit(event){
    event.preventDefault();
    let examName = document.getElementById("examName").value;
    let score = document.getElementById("score").value;
    let comment = document.getElementsByClassName('comment');
    var comments = [];
    for(var i = 0; comment[i]; i++){
        comments.push(comment[i].value);
    }
    var sendInfo = {"examName": examName,
        "score": score,
        "comment": comments
    };
    console.log(sendInfo);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            if(xhttp.responseText == "Success"){
                alert("Exam Released");
                window.location.replace("https://web.njit.edu/~pl255/CS490/examMenu.php");
            }
            else{
                console.log(xhttp.responseText);
                alert("Exam Fail to Release.");
            }
        }
    }
    xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleReleaseExam.php", true); 
    xhttp.send(JSON.stringify(sendInfo));
}