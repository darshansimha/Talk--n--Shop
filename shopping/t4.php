<?php

echo date('y-m-d G:i:s ')."<br/>";

echo "time value is ".strtotime(date('y-m-d G:i:s '));

$str = " ' or 1=1--  <a href='www.google.com'>www.yahoo.com</a> <script type='text/javascript'> window.onlocation='www.google.com' </script>";
echo htmlspecialchars($str);
?>

