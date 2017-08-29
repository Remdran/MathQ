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
        <div class="page">
            <h1>Math Class 101</h1>
            <div class="question">
                <?php
                    $mathq->DisplayQuestion(); 
                ?> 
            </div>
            <div class="score">Score: 0</div>
        
            <div class="qWrong">That answer was incorrect</div>      
            <input type="text" id="userAnswer" placeholder="Enter Answer"></input>
            <button id="submitBtn">Submit</button>
            <br>
            <button class="nextQ">Next Question</button>
            <button id="reset">Reset Questions</button>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html> 