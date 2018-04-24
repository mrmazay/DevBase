<?php
require "db.php";
$arrVal = array();

//*********************************************************************
if($_GET['q']=="add_pkg") {
	$SiId		= $_POST['SiId'];
	$Name   	= $_POST['Name'];
	$Count 		= $_POST['Count'];
	$units 		= $_POST['units'];

	$sql="INSERT INTO tPackage (`SiId`,`Name`,`Count`)
						VALUES ($SiId,'$Name','$Count $units')";
	$query = mysql_query($sql);

	$sql="select * from tPackage where SiId=$SiId";
	$query = mysql_query($sql);
	while ($rowList = mysql_fetch_array($query)){

		$name = array(

			'id'=> $rowList['id'],
			'Name'=> $rowList['Name'],
			'Count'=> $rowList['Count'],
			'Action'=>'<a class="btn btn-primary btn-xs"  href=#?SiId='.$rowList['SiId'].'>Delete</a>'
			);
 	 		 	 			//echo ($rowList[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}
//****************************************************************************
if($_GET['q']=="add_char") {
	$SiId		= $_POST['SiId'];
	$Charact   	= $_POST['Charact'];
	$Value 		= $_POST['Value'];


	$sql="INSERT INTO tCharacter (`SiId`,`Charact`,`Value`)
						  VALUES ($SiId,'$Charact','$Value')";
						//  echo $sql;

	$query = mysql_query($sql);
//	echo $query;
	$sql="select * from tCharacter where SiId=$SiId";
	//echo $sql;
	$query = mysql_query($sql);
	while ($rowList = mysql_fetch_array($query)){

		$name = array(

			'id'=> $rowList['id'],
			'Charact'=> $rowList['Charact'],
			'Value'=> $rowList['Value'],
			'Action'=>'<a class="btn btn-primary btn-xs"  href=#?SiId='.$rowList['SiId'].'>Delete</a>'
			);
 	 		 	 			//echo ($rowList[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}

//**************************************************************************************************
if($_GET['q']=="add_pov") {
	$SiId		= $_POST['SiId'];
	$PovDate   	= $_POST['PovDate'];
	$Doc 		= $_POST['Doc'];


	$sql="INSERT INTO tPov (`SiId`,`PovDate`,`Doc`)
					  VALUES ($SiId,'$PovDate','$Doc')";

	$query = mysql_query($sql);

	$sql="select * from tPov where SiId=$SiId";
	$query = mysql_query($sql);
	while ($rowList = mysql_fetch_array($query)){

		$name = array(

			'id'=> $rowList['id'],
			'PovDate'=> $rowList['PovDate'],
			'Doc'=> $rowList['Doc'],
			'Action'=>'<a class="btn btn-primary btn-xs"  href=#?SiId='.$rowList['SiId'].'>Delete</a>'
			);
 	 		 	 			//echo ($rowList[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}

//**************************************************************************************************
if($_GET['q']=="add_serv") {
	$SiId		= $_POST['SiId'];
	$ServDate   	= $_POST['ServDate'];
	$ServType 		= $_POST['ServType'];
	$Executor 		= $_POST['Executor'];
	$Description 	= $_POST['Description'];
	$NextDate 		= $_POST['NextDate'];


	$sql="INSERT INTO tService (`SiId`,`ServDate`,`ServType`,`Executor`,`Description`,`NextDate`)
						VALUES ($SiId,'$ServDate','$ServType','$Executor','$Description','$NextDate')";
//echo $sql;
	$query = mysql_query($sql);

	$sql="select * from tService where SiId=$SiId";
	$query = mysql_query($sql);
	while ($rowList = mysql_fetch_array($query)){

		$name = array(

			'id'=> $rowList['id'],
			'ServDate'=> $rowList['ServDate'],
			'ServType'=> $rowList['ServType'],
			'Executor'=> $rowList['Executor'],
			'Description'=> $rowList['Description'],
			'NextDate'=> $rowList['NextDate'],
			'Action'=>'<a class="btn btn-primary btn-xs"  href=#?SiId='.$rowList['SiId'].'>Delete</a>'
			);
 	 		 	 			//echo ($rowList[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}

//**************************************************************************************************
?>
