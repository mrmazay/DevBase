<?php
session_start();
$_SESSION['user']='qweqwe';
$user="mysql";
$pass="mysql";
$database="DevBase";
try{
//$con = new mysqli('192.168.220.119', $user, $pass,'DevBase');
$con = new PDO("mysql:host=192.168.220.119;dbname=$database", $user, $pass);
}
catch(PDOException $e) {
    echo $e->getMessage();
    echo "qweqweqwe";
}
//mysql_select_db($database) or die('Не удалось выбрать базу данных');
//Git_test

?>
