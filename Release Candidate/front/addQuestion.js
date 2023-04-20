document.getElementById("questionForm").addEventListener("submit", Submit);
function Submit(event){
    event.preventDefault();
    let questionName = document.getElementById("QuestionName").value;
    let questionDescription = document.getElementById("questionDescription").value;
    let difficulty = document.getElementById("difficulty").value;
    let questionFunction = document.getElementById("questionFunction").value;
    let testcase = document.getElementById("testcase").value;
    let testcaseoutput = document.getElementById("testcaseoutput").value;
    let questionCateogory = document.getElementById("questionCateogory").value;
    let constraint = document.getElementById("constraint").value;
    if(questionName == ""){
        alert("Please enter question name");
    }
    else if(questionDescription == ""){
        alert("Please enter question description!");
    }
    else if(questionFunction == ""){
        alert("Please enter function call");
    }
    else if(testcase == ""){
        alert("Please enter test case");
    }
    else if(testcaseoutput == ""){
        alert("Please enter test case output");
    }
    else{
        var sendInfo = {"questionName": questionName,
        "questionDescription": questionDescription,
        "difficulty": difficulty,
        "questionFunction": questionFunction,
        "testcase": testcase,
        "testcaseoutput": testcaseoutput,
        "questionCateogory": questionCateogory,
        "constraint": constraint
        };
        console.log(sendInfo);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(xhttp.readyState == 4 && xhttp.status == 200){
                if(xhttp.responseText == "Success"){
                    alert("Question Added");
                    location.reload();
                }
                else{
                    alert(xhttp.responseText);
                }
            }
        }
        xhttp.open("POST", "https://afsaccess4.njit.edu/~pl255/CS490/middleAddQuestion.php", true); //refer to w3w ajax_xmlrequestsend info
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(JSON.stringify(sendInfo));
        //"https://web.njit.edu/~pl255/CS490/middleAddQuestion.php"
        //https://afsaccess4.njit.edu/~pl255/CS490/middleAddQuestion.php
    }
}