<?php
    class MathQ {
        private $db_host = "localhost";
        private $db_user = "root";
        private $db_pass = "";
        private $db_name = "mathq";
        private $link;

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
            echo "<p class='questionP' data-id='".$row['id']."'>".($row['question'])."</p>";
        }

        function GetRandomQ() {
            var_dump($this->prevSeen);
            if(!$this->prevSeen) {
                echo "First Time";
                $quesId = rand($this->idMin, $this->idMax);
                $this->prevSeen[] = $quesId;
                return $quesId;
            } else {
                echo "Second time";
                for ($i = 0; $i < count($this->prevSeen); $i++) {
                    if ($this->prevSeen[$i] == $quesId) {
                        $this->GetRandomQ();
                    } else {
                        $this->prevSeen[] = $quesId;  
                        return $quesId;
                    }
                }
            }
        }      
    }

?>