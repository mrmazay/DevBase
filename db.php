<?php
//session_start();
//$_SESSION['user']='qweqwe';
ini_set("always_populate_raw_post_data","1");
$user="devbase";
$pass="1465714";
$database="devbase";
$host="192.168.220.101";
$con = new PDO("mysql:dbname=$database;host=$host", $user, $pass);
$con->query("SET NAMES 'utf8'");

?>
