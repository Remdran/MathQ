<?php
    include("functions.php");
    if($_GET['action'] == "checkAnswer") {
        $result = $mathq->CheckAnswer();
        echo $result;
    }
    if($_GET['action'] == "newQ") {
        $mathq->DisplayQuestion();
    }

    if($_GET['action'] == "logout") {
        session_unset();
        $_SESSION['idArray'] = [];
    }
?> 