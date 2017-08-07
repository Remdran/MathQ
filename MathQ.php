<?php
    class MathQ {
        private $db_host = "localhost";
        private $db_user = "root";
        private $db_pass = "";
        private $db_name = "mathq";





        function __construct() {

        }

        function Connect() {
            $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

            if($link === false) {
                return mysqli_connect_error();
            }

            return $link;
        }
    }

?>