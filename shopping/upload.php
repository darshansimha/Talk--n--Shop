#!/usr/bin/php -q

<?php
$host = 'localhost';
$user = 'root';
$pass = 'gatorade';

$conn = mysql_connect($host,$user,$pass) or die('could not connect to database..');

mysql_select_db("smsd",$conn);
$query = "insert into sms_log(sent,sender,text) values('$argv[1]','$argv[2]','$argv[3]')";
mysql_query($query,$conn);
mysql_close($conn);

?>