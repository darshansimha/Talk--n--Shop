<?php

class user
{
	public $nick,$id,$age,$sex,$location,$workplace,$passions,$goals,$accomplish;
	public $food,$movies,$tv,$ph;
	public $pic,$mime;
}

class user_pic
{
	public $id,$nick,$pic,$mime;

}

?>
<?php
    @session_start();

    require "includes/protect.php";
    require "includes/dbconn.php";
    require "includes/store.php";
    require "includes/funcs.php";



   if(isset($_GET['ramble']) && isset($_GET['to_nick']))
   {
        if(isset($_GET['location']))
        {
            $location = htmlentities($_GET['location']);
        }
        else
            $location = "";

        $to_nick = $_GET['to_nick'];
      // $time = date('y-m-d G:i:s ');
       if(apc_exists($to_nick))
       {
          // echo "inside apc...<br/>";
           $user_obj = apc_fetch($to_nick);
           $to_id = $user_obj->id;
           $to_name = $user_obj->name;
       }
       else
       {  $to_nick = addslashes($to_nick);
          $query = " select id,name from details where nick = '$to_nick'";
          $rs = execq($query);
          $to_name = $rs['name'];
          $to_id = $rs['id'];
       }
       $time = time();
       $content = $_GET['ramble'];
       $content = htmlentities($content);
   //    echo "creating sql query<br/>";
       $query = "insert into rambles(user_nick,user_name,user_id,from_nick,from_name,from_id,time,location,content) values('$to_nick','$to_name',$to_id,'{$_SESSION['nick']}','{$_SESSION['name']}',{$_SESSION['id']},'$time','$location','$content')";
   //    echo $query;
       $time = date("m-d-Y G:i:s", $time);
       $ok = 1;
       try{
       execq($query);
       $lastinsertid = $con1->lastInsertId();

       }
       catch(Exception $e)
       {
           $ok = 0;
     //      echo "not ok...";
       }
       
       if($ok == 1)
       {
     //      echo "ok";
        $result = array();

        $result['nick'] = $_SESSION['nick'];
        $result['content'] = $content;
        $result['time'] = $time;
        $result['location'] = $location;
        $result['id'] = $lastinsertid;
        $result = json_encode($result);
        echo $result;

       }

   }



?>
