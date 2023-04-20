<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <link href ="style2.css" rel="stylesheet" type="text/css"/>
        <title>
            Exam Form
        </title>
        <script src="requestQuestion4.js" type="text/JavaScript"></script>
        <script src="tAddQuestionTable.js" type="text/JavaScript"></script>
    </head> 
	<body>
        <nav>
            <ul>
                <li>
                    <a href= "admin.php">Admin Home Page</a>
                </li>
                <li>
                    <a href= "creatingquestion.php">Create Question</a>
                </li>
                <li>
                    <a class="active" href= "examMenu.php">Show Exam Menu</a>
                </li>
                <li style="float:right">
                    <a href= "logout.php">Logout</a>
                </li>
            </ul>
        </nav>
        <div id="examF" class="split left">
            <h1>Create Exam Form</h1>
            <form id="submitExamForm" class="submitExamForm">
                    <label for="ExamName">Exam Name:</label>
                    <input type='text' id='ExamName'><br><br>
                    <table class="examQ" id ="ExamQ">
                        <tr>
                            <th>Question ID</th>
                            <th>Question Name</th>
                            <th>Question Description</th>
                            <th>total test Case</th>
                            <th>Question Difficulty</th>
                            <th>Question Cateogory</th>
                            <th>Constraint</th>
                            <th>Point</th>
                        </tr>
                    </table>
            <!-- <input type='text' class='points'> -->
            <br><br>
            <input type ="submit" value="Create">
            </form>
            <script src ="createExam3.js" type="text/JavaScript"></script>
        </div>
        <div id= "examFormBody" class="split right">
            <h1>Question Table</h1>
            <form id="examForm" class="examFrom">
            <label for="QuestionCateogory">Question Cateogory:</label>
            <select name="QuestionCateogory" id="QuestionCateogory">
                <option value="None">None</option>
                <option value="Loop">Loop</option>
                <option value="Conditional">Conditional</option>
                <option value="recursion">recursion</option>
                <option value="Lists">Lists</option>
                <option value="Strings">Strings</option>
                <option value="Arithmetic">Arithmetic</option>
                <option value="Others">Others</option>
            </select>
            <br><br>
            <label for="Question Difficulty">Question Difficulty:</label>
            <select name="Qdifficulty" id="Qdifficulty">
                <option value="None">None</option>
                <option value="Easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
            <br><br>
            <label for="Question keyword">Question Keyword:</label>
            <input type="text" id="QuestionKey" name="QuestionKey">
            <br><br>
                    <input type ="button" value="showQuestion" id="filter" onclick=requestQuestion()><br><br>
                    <div id="questionArea"></div><br><br>
            <input type ="button" value="Add" onclick=addQuestion() id="Create">
        </div>
    </body>
</html>