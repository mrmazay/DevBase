<?php
session_start();
$_SESSION['user']='qweqwe';
$user="mysql";
$pass="mysql";
$database="DevBase";
$con = new mysqli('192.168.220.119', $user, $pass,'DevBase');
if (mysqli_connect_errno()) {
   printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
   exit;
} 
//mysql_select_db($database) or die('Не удалось выбрать базу данных');

?>
