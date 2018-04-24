<?php
session_start();
if(!$_SESSION['isAdm']){
echo  ("<script type=\"text/javascript\">window.location=\"./index.php\";</script>");
exit;
}else{
require 'db.php';
require 'title.php';
}
?>
