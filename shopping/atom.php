<?php
   echo "<?xml version='1.0' encoding='utf-8'?>
<feed xmlns='http://www.w3.org/2005/Atom'>
  <id>http://www.talkpoke.com</id>
  <generator uri='http://www.talkpoke.com'>tp blog</generator>
  <title>talkpoke Blog</title>
  <link href='http://blog.talkpoke.com' />
  <link rel='self' href='http://blog.talkpoke.com/atom.php' />
  <updated>2011-04-26T06:07:51-07:00</updated>
  <icon>http://static.ak.fbcdn.net/favicon.ico</icon>
  <logo>http://static.ak.fbcdn.net/images/talkpoke.gif</logo>";

    require "dbconn.php";
    
    $con1 = $dbconn->db;
    $rs = $con1->query("select * from reports");

     $i = 0;
     $flag =0;
     while($row = $rs->fetch(PDO::FETCH_ASSOC))
       {
         
        // var_dump($row);
          if ($i > 0) {
               echo "</entry>";
           }

          $articleDateRfc3339 =  $articleDate = $row['POSTED'];

          // $articleDateRfc3339 = date3339(strtotime($articleDate));
          // echo "more inside..";
           echo "<entry> "."\n";
           echo "<title>";
           echo $row['TITLE'];
           echo "</title>"."\n";
           echo "<link type='text/html' href='http://www.fishinhole.com/reports/report.php?id=".$row['id']."'/>"."\n";
           echo "<id>";
           echo "tag:fishinhole.com,2008:http://www.fishinhole.com/reports/report.php?id=".$row['id']."\n";
           echo "</id>"."\n";
           echo "<updated>";
           echo $articleDateRfc3339;
           echo "</updated> \n";
           echo "<author>\n";
           echo "\t<name>\n";
           echo "\t".$row['AUTHOR']."\n";
           echo "\t</name>"."\n";
           echo "</author>"."\n";
           echo "<summary>"."\n";
           echo $row['SUBTITLE']."\n";
           echo "</summary>"."\n";
           echo "<content type='html'>\n";
           echo "this is some nice content\n";
           echo "</content>\n";

           $i++;
          
     }
     echo "</entry>\n";
     echo "</feed>"
?>


