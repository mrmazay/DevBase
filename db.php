<?php
//~ Старт сессии, файл должен быть сохранен без DOM информации
session_start();
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