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

  //  require "../includes/protect.php";
    require "../includes/dbconn.php";
    require "../includes/funcs.php";
  //  require "../includes/apc.php";
   
    if(isset($_GET['nick']))
    {
        $rnickpic = $_GET['nick'];
        if(apc_exists($rnickpic."pic"))
        {
            $user_pic = apc_fetch($rnickpic."pic");
            $rs = array();
            $rs['pic'] = $user_pic->pic;
            $rs['mime'] = $user_pic->mime;
            $flag = 1;
            goto pic;

        }
        
    }
     
    
    if(isset($_GET['id']))
    {
        $fid = $_GET['id'];
        $fid = addslashes($fid);
      //  $fid = htmlspecialchars(addslashes($fid));
    }

    $query = "select pic from product_details where id=$fid";
    $rs = execq($query);

    pic:
   
    header("Content-type: {$rs['mime']}");
    echo $rs['pic'];

?>


