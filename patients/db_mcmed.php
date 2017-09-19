<?php
$pwd="lab";
$uid="lab";
$serverName = "192.168.220.100";
$connectionInfo = array("UID" => $uid, "PWD" => $pwd, "Database"=>"EMCiMed_FBT");
$con = odbc_connect( "mssql",$uid,$pwd);
if (!$con) {
      die('Unable to connect!');
			}

//var_dump($con);
?>
