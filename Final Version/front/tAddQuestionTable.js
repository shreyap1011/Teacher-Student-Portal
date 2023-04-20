function addQuestion(){
    var table2 = document.getElementById("examT");
    let checkbox = document.getElementsByClassName("checkBox[]");
    count = 0
    for(var i = 0; checkbox.length; i++){
        if(checkbox[i].checked){
            var table = document.getElementById("ExamQ");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            cell1.innerHTML = checkbox[i].value;
            cell2.innerHTML = table2.rows[i + 1].cells[2].innerHTML;
            cell3.innerHTML = table2.rows[i + 1].cells[3].innerHTML;
            cell4.innerHTML = table2.rows[i + 1].cells[4].innerHTML;
            cell5.innerHTML = table2.rows[i + 1].cells[5].innerHTML;
            cell6.innerHTML = table2.rows[i + 1].cells[6].innerHTML;
            cell7.innerHTML = table2.rows[i + 1].cells[7].innerHTML;
            cell8.innerHTML = "<input type='text' class='point'>";
            count++;
        }
    }
    if(count == 0){
        alert("Please select a question and add to the exam.")
        return;
    }
}