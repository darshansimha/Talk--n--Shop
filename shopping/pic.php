<?php

    @session_start();

    require "protect.php";
    require "dbconn.php";
    require "funcs.php";





    $query = "select pic from details where id={$_SESSION['id']}";
    header("Content-type: image/jpeg");
    
    $rs = execq($query);
    echo $rs['pic'];

?>


