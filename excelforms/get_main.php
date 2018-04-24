<?php
require_once 'db.php';

if ($_GET['q']=='get_main'){


	$sql="select `id`,`Name`, `Description`,`Hash`,`CrTime` FROM `tForms`";


	$result = $con->query($sql);
  $result->setFetchMode(PDO::FETCH_ASSOC);
	$arrVal = array();
	while ($row = $result->fetch()) {

    $row+=['Action'=>'<a class="btn btn-primary btn-xs"  href=get_main.php?q=get_file&id='.$row['id'].'>GetFile</a>'];
		array_push($arrVal, $row);

	}
	echo  json_encode($arrVal);

}

// *************************************************************************************
//									GET RESULTS
// *************************************************************************************
if ($_GET['q']=='get_file'){

	$id=$_GET['id'];
	$sql="SELECT `Name`, `File`,`Hash` from `tForms` where id='$id'";
   $result = $con->query($sql);
  $result->setFetchMode(PDO::FETCH_ASSOC);
  $arrVal = array();
  $row = $result->fetch();
  if (!$row['File']){
  echo  ("<H1>Error! File not found.</H1>");
  }else{
    $UID=$_SESSION['user_id'];
    $Action="GetForm";
    $Params="Code: ".$row['Name']." -> Hash: ".$row['Hash'];
    $sql="INSERT INTO tLog (`UserId`,`Action`,`Params`)
                    VALUES ('$UID','$Action','$Params')";
    $result = $con->query($sql);
  echo  ("<script type=\"text/javascript\">window.location=\"".$row['File']."\";</script>");
}
}
// *************************************************************************************
//                  ADD FORM
// *************************************************************************************
if($_GET['q']=="add_frm") {
  $Name   = $_POST['Name'];
  // $PovDate    = date("Y-m-d", strtotime($_POST['PovDate']));
  $Description    = $_POST['Description'];
    $dest       ='';
    $destdir    ='./uploads/';
//Upload file
 //echo($_FILES['filename']['name']);
if (!empty($_FILES['filename']['name'])){
$uploadfile = $_FILES['filename']['name'];

$dest ='./uploads/'.md5(date("Y-m-d H:i:s")).'.'.substr($uploadfile, strrpos($uploadfile, '.') + 1);
if(!file_exists($destdir)){
    mkdir($destdir);
}
if (!move_uploaded_file($_FILES['filename']['tmp_name'], $dest)) {
    echo "err!<br>".$_FILES['filename']['name'].'<br>';
    echo $dest.'<br>';
    echo $_FILES['filename']['error'].'<br>';
    exit;
    }else{
      $Hash=md5_file($dest);
    }

}

  $sql="INSERT INTO tForms (`Name`,`Description`,`Hash`,`File`)
                    VALUES ('$Name','$Description','$Hash','$dest')";
echo $sql;
  $result = $con->query($sql);
}




function deepIconv($from, $to, $sbj){
                if (is_array($sbj) || is_object($sbj)){
                        foreach ($sbj as &$val){
                                $val= deepIconv($from, $to, $val);
                        }
                        return $sbj;
                }else{
                        return iconv($from, $to, $sbj);
                }
        }

    ?>
