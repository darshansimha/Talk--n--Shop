<?php
   echo "<?xml version='1.0' encoding='utf-8'?>
         <rss>";

    require "dbconn.php";

    $con1 = $dbconn->db;
    $rs = $con1->query("select * from reports");

     $i = 0;
     $flag =0;
     while($row = $rs->fetch(PDO::FETCH_ASSOC))
       {

        // var_dump($row);
          if ($i > 0) {
               echo "</channel>";
           }

          $articleDateRfc3339 =  $articleDate = $row['POSTED'];

          // $articleDateRfc3339 = date3339(strtotime($articleDate));
          // echo "more inside..";
           echo "<channel> "."\n";
           echo "<title>";
           echo $row['TITLE'];
           echo "</title>"."\n";
           echo "<link type='text/html' href='www.talkpoke.com".$row['id']."'/>"."\n";
           echo "<description>"."\n";
           echo $row['SUBTITLE']."\n";
           echo "</description>"."\n";
           echo "<content type='html'>\n";
           echo "this is some nice content\n";
           echo "</content>\n";

           $i++;

     }
     echo "</entry>\n";
     echo "</rss>"
?>


