<?php

    $con1 = $dbconn->db;
    function execq($query)
        {   global $con1;
          //  echo "executing query.. $query..<br/>";
            try{
            $res = $con1->query($query)->fetch();
            }
              catch(PDOException $e)
            {
                echo "PDO Error: ".$e->getMessage()."<br/>";
            }
           // echo "finished executing query $query...<br/>";
            return $res;
        }


?>
