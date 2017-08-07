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
        private $prevSeen = [];

        function __construct() {

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
            $qId = $this->GetRandomQ();
        
            $query = "SELECT * FROM questions WHERE `id` = '".$qId."'";
            $result = mysqli_query($this->link, $query);

            $row = mysqli_fetch_assoc($result);

            if($qId !== "-1"){
                echo "<p class='questionP' data-id='".$row['id']."'>".($row['question'])."</p>";
            } else {
                echo "<p class='questionP'>No More Questions</p>";
            }
            var_dump($this->prevSeen);
        }

        function GetRandomQ() {
            var_dump($this->prevSeen);
            $quesId = rand($this->idMin, $this->idMax);
            if(!$this->prevSeen) {
                echo "First Time";
                $this->prevSeen[] = $quesId;
                return $quesId;
            } else {
                if(count($this->prevSeen) == $idMax){
                    return "-1";
                }

                echo "Second time";
                foreach ($this->prevSeen as $id) {
                    if ($id == $quesId) {
                        $this->GetRandomQ();
                    } 
                }
                echo "here";
                $this->prevSeen[] = $quesId;  
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