<?php

   
    class db_conn
    {
        public $db;

        public function __construct($dsn,$user,$pass)
        {
            try
            {
                $this->db = new PDO($dsn,$user,$pass);
                
              //  echo "server connected \n";
              //  $sql1 = "insert into users(id,nick,passkey) values(2,'tejesh','password')";
              
                //   $rs = $this->db->query($sql1);
              //  echo "inside try.. done.. \n";
            }
            catch(PDOException $e)
            {
                echo "mysql error ".$e->getMessage();
                echo "\n";
            }

        }
    }

    $dsn = 'mysql:dbname=smsd;host=localhost';
    $user = 'root';
    $pass = '';
    $dbconn = new db_conn($dsn,$user,$pass);
    $con1 = $dbconn->db;

       


 ?>
