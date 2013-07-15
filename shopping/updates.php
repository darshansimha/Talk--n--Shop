<?php

@session_start();

    if($_SESSION['auth'] == 1)
    {
        if($_SESSION['updates'] != 1)
        {
            header("Location: /p1/profile.php");
        }
        $ph = $_SESSION['ph'];
        $nick = $_SESSION['nick'];
    }
    else
    {
        header("Location: /p1/index.php");
    }


  require "includes/dbconn.php";
  $con1 = $dbconn->db;



?>
    <style type ="text/css">

    .top
    {
         position:absolute;
         top:0%;
         left:90%;

    }
     .mesg2
    {
        
        color: #81F781;
    }
      .mesg1
    {

        color: red;
    }
    </style>

    <html>
            <head>
                <title><?php echo $nick ?>'s updates</title>
            </head>
            <body>
                <a href="/p1/logout.php" class ="top">Logout</a>
                 <img src=<?php echo "/p1/pics/pic.php?"."id={$_SESSION['id']}"; ?> alt="no image" height="150px" width="150px" />
               <p>Your Updates</p>

               <?php
                    $sql = "select text,sent from sms_log where sender = '$ph' ";
                    $rs = $con1->query($sql);
                  //  echo "the query is ".$sql;
                    $num = count($rs);
                    
                    while($rs1 = $rs->fetch())
                    {
                        if($rs1['text'] !=NULL)
                        {
                        echo "<span class='mesg1'>{$rs1['text']}</span>   <span class='mesg2'>[{$rs1['sent']}]</span> <br/>";
                    
                        }
                        
                    }
                    echo "<p> to recieve updates... send your messages to the server's phone number </p>";

               ?>
            </body>
    </html>
