document.getElementById("examForm").addEventListener("submit", Submit);
function Submit(event){
    event.preventDefault();
    let examName = document.getElementById("examName").value;
    if(examName == "---"){
        alert("Please select an exam to auto Grade");
    }
    else{
        var sendInfo = {"examName": examName,
        };
        console.log(sendInfo);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(xhttp.readyState == 4 && xhttp.status == 200){
                if(xhttp.responseText == "Success"){
                    alert("Exam Graded, now please review before release the final grade");
                    window.location.replace("https://web.njit.edu/~pl255/CS490/examMenu.php");
                }
                else{
                    console.log(xhttp.responseText);
                    alert("Exam Fail to Auto Grade.");
                }
            }
        }
        xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleAutoGradeExam.php", true); 
        xhttp.send(JSON.stringify(sendInfo));
    }
}