<?php
    class MathQ {
        private $db_host = "localhost";
        private $db_user = "root";
        private $db_pass = "";
        private $db_name = "mathq";
        public $link;
        private $idCount;
        private $idMin;
        private $idMax;

        function __construct() {
            session_start();
        }

        function Connect() {
            $this->link = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            if($this->link === false) {
                return mysqli_connect_error();
            }
        }

        function GetIdArray() {
            $query = "SELECT `id` FROM questions";
            $result = mysqli_query($this->link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $idsArray[] = $row['id'];
            }
            $this->idCount = count($idsArray);
            sort($idsArray);
            $this->idMin = $idsArray[0];
            $this->idMax = $idsArray[$this->idCount - 1];
        }

        function DisplayQuestion() {
            if(($qId = $this->GetRandomQ()) == "-2"){
                $this->DisplayQuestion();
            } else {                    
                if($qId == "-1"){
                    echo "<p class='questionP'>No More Questions</p>";
                } else {
                    $query = "SELECT * FROM questions WHERE `id` = '".mysqli_real_escape_string($this->link, $qId)."'";
                    $result = mysqli_query($this->link, $query);
                    $row = mysqli_fetch_assoc($result);
                    echo "<p class='questionP' data-id='".$row['id']."'>".($row['question'])."</p>";
                }
            }
        }
        
        function GetRandomQ() {
            $quesId = rand($this->idMin, $this->idMax);
            if(array_key_exists("idArray", $_SESSION)) {
                if(!$_SESSION['idArray']) {
                    $_SESSION['idArray'][] = $quesId;
                    return $quesId;                
                } else {
                    if(count($_SESSION['idArray']) == $this->idCount){
                        return "-1";
                    }
                    foreach ($_SESSION['idArray'] as $id) {
                        if ($id == $quesId) {
                            return "-2";
                        } 
                    }
                    $_SESSION['idArray'][] = $quesId;  
                    return $quesId;                    
                }
            } else {
                $_SESSION['idArray'][] = $quesId;
                return $quesId;                
            }
        }
                
        function CheckAnswer() {
            $query = "SELECT * FROM qanswers WHERE `id` = '".mysqli_real_escape_string($this->link, $_POST['Qid'])."'";
            $result = mysqli_query($this->link, $query);
            $row = mysqli_fetch_assoc($result);
            if(mysqli_real_escape_string($this->link, $_POST['answer']) == $row['answer']) {
                return "1";
            } else {
                return "0";
            }
        }
    }
?>