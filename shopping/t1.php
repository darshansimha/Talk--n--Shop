<?php

    require "dbconn.php";


        $rs == (1==2);
        if(!$rs)
        {
            echo "it is false..<br/>";
        }
       
        $con1 = $dbconn->db;

        try{
        $rs = $con1->query(" select id from users where nick='john'; ")->fetch();
        var_dump($rs);
        echo "id is ".$rs['id']."...<br/>";

        echo "query completed succesfully..\n";
        }
        catch(PDOException $e)
        {
            echo "PDO Error: ".$e->getMessage()."\n";
        }



?>
