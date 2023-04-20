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
            Creating Question
        </title>
    </head> 
    <body>
        <div class="naver">
            <nav>
                <ul>
                    <li>
                        <a href= "admin.php">Admin Home Page</a>
                    </li>
                    <li>
                        <a class="active" href= "creatingquestion.php">Create Question</a>
                    </li>
                    <li>
                        <a href= "examMenu.php">Show Exam Menu</a>
                    </li>
                    <li style="float:right">
                        <a href= "logout.php">Logout</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div id = "Question_Main" class="split left">
            <h1>Create Question</h1>
            <form id = "questionForm">
            <label for="Question Name">Question Name</label>
            <input type="text" id="QuestionName" name="QuestionName" placeholder="Question Name"><br><br>
            <label for="Question Difficulty">Choose the Question Difficulty</label>
            <select name="difficulty" id="difficulty">
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
            <br><br>
            <label for="Question Des">Question Description</label>
            <textarea id="questionDescription" name="questionDescription" rows="8" cols="50" placeholder="Enter your question here"></textarea><br><br>
            <label for="question function">Enter Define function</label>
            <input type="text" id="questionFunction" name="question function" size="30"><br><br>
            <div id="testCase" class="testCase">
                <label for="test case">Enter Test Case here (Seperate each one with ;)</label>
                <input type="text" id="testcase" name="testcase" placeholder="Test case" size="50"><br>
                <label for="test case output">Enter Test Case expected output here (Seperate each one with ;)</label>
                <input type="text" id="testcaseoutput" name="testcaseoutput" size="50">
                <br><br>
            </div>
            <label for="QuestionCateogory">Choose the type of question cateogory</label>
            <select name="QuestionCateogory" id="questionCateogory">
                <option value="Loop">Loop</option>
                <option value="Conditional">Conditional</option>
                <option value="recursion">recursion</option>
                <option value="Lists">Lists</option>
                <option value="Strings">Strings</option>
                <option value="Arithmetic">Arithmetic</option>
                <option value="Others">Others</option>
            </select>
            <br><br>
            <label for="Constraint">Choose the Constraint for this question</label>
            <select name="constraint" id="constraint">
                <option value="None">None</option>
                <option value="For Loop">For Loop</option>
                <option value="While Loop">While Loop</option>
                <option value="Recursion">Recursion</option>
            </select>
                <br><br>  
            <input type ="submit" value="Submit">
            </form>
            <script src ="addQuestion.js" type="text/JavaScript"></script>
        </div>

        <div id="Question_List" class="split right">
            <form id="FilterForm">
            <h1>Question Table</h1>
            <br><br>
            <label for="QuestionCateogory">Question Cateogory</label>
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
            <label for="Question Difficulty">Question Difficulty</label>
            <select name="Qdifficulty" id="Qdifficulty">
                <option value="None">None</option>
                <option value="Easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
            <br><br>
            <label for="Question keyword">Question Keyword</label>
            <input type="text" id="QuestionKey" name="QuestionKey">
            <br><br>
        <input type ="submit" value="Filter">
        <br><br>
    </form>   
    <script src ="QuestionTable2.js" type="text/JavaScript"></script>  
        <div id="questionArea">
        </div>
        </div>
    </body>
</html>
