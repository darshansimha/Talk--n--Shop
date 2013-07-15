<?php

  require "../includes/dbconn.php";
  require "../includes/funcs.php";
  require "../includes/protect.php";

if($_FILES["file"]["error"]>0)
{
  header("Location:/p1/profiledit.php");
}
else
{
    $img = file_get_contents($_FILES['file']['tmp_name']);
    $img = addslashes($img);
   
    $query = "update details set pic='$img',mime='{$_FILES['file']['type']}' where id='{$_SESSION['id']}' ";

    $con1->query($query);

}

   header("Location:/p1/profiledit.php");

?>


