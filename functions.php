<?php 
    session_start();

    $link = mysqli_connect("localhost", "root", "", "mathq");

    if(mysqli_connect_errno()) {
        print_r(mysqli_connect_error());
        exit();
    }

    function displayQuestion() {
        global $link;
        $query = "SELECT * FROM questions WHERE `id` = 1";
        $result = mysqli_query($link, $query);

        $row = mysqli_fetch_assoc($result);

        echo "<p id='questionP' data-id='".$row['id']."'>".($row['question'])."</p>";
    }
?>