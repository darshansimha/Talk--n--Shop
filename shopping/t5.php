<?php
@session_start();

require "includes/apc.php";
echo "stuff";

//var_dump($_SESSION);
//echo $_SESSION['auth']." is the auth".$_SESSION['nick']." is the nick ".$_SESSION['id']." is the id";
//echo "unserialized stuff is ".$user_obj = unserialize(apc_fetch("john"));
//$user_obj = apc_fetch("john");
//echo $user_obj->id." ".$user_obj->name;
//echo "<br/><br/>";
//var_dump($user_obj);
/*
apc_delete('john');
apc_delete('deepak');
apc_delete('jaykay');
apc_delete('richy');
 * 
 */
//var_dump(apc_fetch('john'));
echo "<br/><br/>";
echo "<br/><br/>";
var_dump($_SESSION);



?>
