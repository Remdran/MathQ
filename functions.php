<?php 
    session_start();

    $link = mysqli_connect("localhost", "root", "", "mathq");

    if(mysqli_connect_errno()) {
        print_r(mysqli_connect_error());
        exit();
    }

    $idMin = "";
    $idMax ="";
    $prevSeen = [];

    /* 
     *  STORE THE IDS FROM THE DATABASE INTO AN ARRAY SO WE CAN USE THEM TO GET A RANDOM QUESTION LATER
     */ 
    function initialise() {
        global $link;
        global $idMin;
        global $idMax;

        $query = "SELECT `id` FROM questions";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $idsArray[] = $row['id'];
        }

        $idCount = count($idsArray);
        sort($idsArray);
        $idMin = $idsArray[0];
        $idMax = $idsArray[$idCount - 1];
    }

    /*
    *  USING THE ID FROM RANDOMQUESTION(), QUERY THE DATABASE AND DISPLAY THE QUESTION
     */
    function displayQuestion() {
        global $link;
        global $idMin;
        global $idMax;
        global $prevSeen;
        
        $qId = randomQuestion($idMin, $idMax, $prevSeen);
        
        $query = "SELECT * FROM questions WHERE `id` = '".$qId."'";
        $result = mysqli_query($link, $query);

        $row = mysqli_fetch_assoc($result);
        echo "<p class='questionP' data-id='".$row['id']."'>".($row['question'])."</p>";
    }

    /*
     *  GET A RANDOM ID, IF IT HASNT BEEN PREVIOUSLY SEEN RETURN IT AND ADD TO THE ARRAY, ELSE GET A NEW QUESTION
     */
    function randomQuestion($idMin, $idMax, $prevSeen) {
        // $quesId = rand($idMin, $idMax);
        $quesId = rand(1, 6);
        if (empty($prevSeen)) {
            $prevSeen[] = $quesId;
            return $quesId;
        } else {
            for ($i = 0; $i < count($prevSeen); $i++) {
                if ($prevSeen[$i] == $quesId) {
                    randomQuestion();
                } else {
                    $prevSeen[] = $quesId;
                    return $quesId;
                }
            }
        }
    }
?>