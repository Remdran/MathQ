<?php 
    include("MathQ.php");
    $_SESSION['idArray'] = array();
    $mathq = new MathQ();
    $mathq->Connect();
    $mathq->GetIdArray();
?>