<html>
</body>
<?php

require "includes/dbconn.php";
require "includes/funcs.php";
require "includes/apc.php";

$con1 = $dbconn->db;
$query = " select id,nick from users";


$q_obj = $con1->query($query);

while($arr = $q_obj->fetch())
{
echo $arr['nick']."<br/>";
$id = $arr['id'];
$pass = md5($arr['nick']);

$query2 = "update users set password='$pass' where id=$id";
echo $query2."<br/>";
execq($query2);
}

//echo $arr['nick']."<br/>";

?>
</body>
</html>
