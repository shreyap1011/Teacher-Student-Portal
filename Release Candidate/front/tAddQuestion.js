function addQuestion(){
    let checkbox = document.getElementsByClassName("checkBox[]");
    count = 0
    for(var i = 0; checkbox[i]; i++){
        if(checkbox[i].checked){
            var table = document.getElementById("ExamQ");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = checkbox[i].value;
            cell2.innerHTML = "<input type='text' id='point"+ (count+1) + "'>";
            count++;
        }
    }
    if(count == 0){
        alert("Please select a question and add to the exam.")
        return;
    }
}