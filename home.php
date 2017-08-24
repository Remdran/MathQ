<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Prof Lavelles Math Quiz</title>
</head>
<body>
    <div class="container">
        <h1>Math Class 101</h1>
        <div class="question">
            <?php
                $mathq->DisplayQuestion(); 
            ?> 
        </div>
      
        <input type="text" id="userAnswer"></input>
        <button id="submitBtn">Submit</button>
        <div class="score">Score: 0</div>
        <div class="nextQ">Next Question...</div>
        <button id="reset">Reset Questions</button>

        <div class="qWrong">That answer was incorrect</div>
        <div class="qRight">Correct!</div>       
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html> 