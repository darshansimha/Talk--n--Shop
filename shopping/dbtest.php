<?
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
                echo "connected <br/>";

            }
            catch(PDOException $e)
            {
                echo "mysql error ".$e->getMessage();
                echo "\n";
            }

        }
    }



    $dsn = 'mysql:dbname=afroken2_smsd;host=afroken2.x10.mx';
    $user = 'root';
    $pass = '';
    $dbconn = new db_conn($dsn,$user,$pass);
    $con1 = $dbconn->db;
    $rs = $con1->query("delete from reports where AUTHOR like '%';insert into reports(AUTHOR,TITLE,SUBTITLE,CONTENT,POSTED) values('Tejesh','Talkpoke the next level','Great Changes','Hi Guys, gonna tell you that talkpoke is going to be more exciting after finish some changes','2009-05-18 8:07:33');")->fetchall();
    print_r($rs);


 ?>