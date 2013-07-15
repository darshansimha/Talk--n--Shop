<?php
$host = 'afroken.x10.mx';
$user = 'afroken_1';
$pass = '';

$conn = mysql_connect($host,$user,$pass) or die('could not connect to database..');
echo "connected..<br/>";

mysql_select_db("afroken_smsd",$conn);

mysql_query("CREATE TABLE subscr(ID varchar(30),check varchar(5))");
mysql_query("INSERT INTO subscr(ID,check) VALUES ('Daniel','Yes')");

 
//mysql_query($query,$conn);
echo "query executed...<br/>";
$query = "select * from subscr";
$rs = mysql_query($query,$conn);
$row = mysql_fetch_array($rs);
var_dump($row);
mysql_close($conn);

?>