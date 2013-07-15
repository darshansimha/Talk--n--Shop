<?php
@session_start();

if($_SESSION['auth']!=1)
{

    header("Location: /p1/index.php");
}
 else
 {
    $nick = $_SESSION['nick'];

 }


?>