<?php
    include("functions.php");

    if($_GET['action'] == "checkAnswer") {
        //Include input validation

        $query = "SELECT * FROM qanswers WHERE `id` = '".mysqli_real_escape_string($link, $_POST['Qid'])."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_real_escape_string($link, $_POST['answer']) == $row['answer']) {
            echo "Correct";
        } else {
            echo "Wrong";
        }
    }
?>