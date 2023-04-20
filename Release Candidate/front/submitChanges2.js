document.getElementById("examChangeForm").addEventListener("submit", Submit);
function Submit(event){
    event.preventDefault();
    let examName = document.getElementById("examName").value;
    let fscore = document.getElementsByClassName("fscore");
    let score = document.getElementsByClassName("score");
    let cscore = document.getElementsByClassName("cscore");
    let comment = document.getElementsByClassName('comment');
    var fscores = [];
    var comments = [];
    var cscores = [];
    var scores = [];

    for(var i = 0; comment[i]; i++){
        comments.push(comment[i].value);
    }
    for(var i = 0; fscore[i]; i++){
        fscores.push(fscore[i].value);
    }
    for(var i = 0; cscore[i]; i++){
        cscores.push(cscore[i].value);
    }
    for(var i = 0; score[i]; i++){
        scores.push(score[i].value);
    }
    var sendInfo = {"examName": examName,
        "fscore": fscores,
        "score": scores,
        "cscore": cscores,
        "comment": comments
    };
    console.log(sendInfo);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            if(xhttp.responseText == "Success"){
                console.log(xhttp.responseText);
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