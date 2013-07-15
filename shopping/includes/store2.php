<?php

$user_obj = unserialize($_SESSION['user_obj']);

$id = $user_obj->id;
$nick = $user_obj->nick;
$age = $user_obj->age;
$sex = $user_obj->sex;
$location = $user_obj->location;
$ph = $user_obj->ph;


?>
