<?php
session_start();
$_SESSION['user']='qweqwe';
$user="excelforms";
$pass="lr2npAGawLy1BHyJ";
$database="excelforms";
$host="192.168.220.101";
// $user="mysql";
// $pass="mysql";
// $database="DevBase";
// $host="192.168.220.119";
try {
  $con = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
  $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    echo "DB Error!!!!";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}
?>
