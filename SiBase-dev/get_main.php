<?php
require './db.php';
require './class.php';
if ($_GET['q']=='auth'){
$login= $_POST['login'];
$pass=  $_POST['password'];
}


$arrVal = array();
if ($_GET['q']=='get_main'){
	// $sql="SELECT SI.SiId,
 //        SI.Name,
 //        SI.IsMeasure,
 //        SI.SN,
 //        SI.InvNum,
 //        SI.DevCode,
 //        SI.nWorkPlace,
 //        Pl.Placement,
 //        d.Department,
 //        r.RespPerson,
 //        YEAR(SI.ManufactDate) AS ManufactDate,
 //        t.Type,
 //        s.Status,
 //        p.PovDate + INTERVAL SI.PovPeriod month AS NextPov
 //        FROM tSI AS SI
 //        LEFT OUTER JOIN
 //        tResposible  AS r ON SI.RespPerson = r.id
 //        LEFT OUTER JOIN
 //        tPlacement   as Pl on SI.Placement=Pl.id
 //        LEFT OUTER JOIN
 //        tDepartments as d on SI.Department=d.id
 //        LEFT OUTER JOIN
 //        tTypes       as t    ON SI.Type=t.id
 //        LEFT OUTER JOIN
 //        tStatus      as s    ON SI.Status=s.id
 //        LEFT OUTER JOIN tPov  as p on p.SiId=SI.SiId
 //        WHERE p.PovDate=(select max(tPov.PovDate) FROM tPov WHERE tPov.SiId=SI.SiId) OR p.PovDate IS NULL
 //        ORDER BY SI.SiId desc";

	$sql="SELECT SI.SiId,
				SI.Name,
				SI.IsMeasure,
				SI.SN,
				SI.InvNum,
				SI.DevCode,
				SI.nWorkPlace,
				Pl.Placement,
				d.Department,
				r.RespPerson,
				YEAR(SI.ManufactDate) AS ManufactDate,
				t.Type,
				s.Status,
				MAX(p.PovDate) + INTERVAL SI.PovPeriod month AS NextPov
		FROM tSI AS SI
		LEFT OUTER JOIN tResposible  AS r  ON SI.RespPerson = r.id
		LEFT OUTER JOIN tPlacement   as Pl on SI.Placement=Pl.id
		LEFT OUTER JOIN tDepartments as d  on SI.Department=d.id
		LEFT OUTER JOIN tTypes       as t  ON SI.Type=t.id
		LEFT OUTER JOIN tStatus      as s  ON SI.Status=s.id
		LEFT OUTER JOIN tPov  		 as p  on p.SiId=SI.SiId
		GROUP BY SI.SiId
		ORDER BY SI.SiId desc";


		$result = $con->query($sql);
    $result = setFetchMode(PDO::FETCH_CLASS, 'dev');
while($obj = $result->fetch()) {
    echo $obj->addr;

//	$i=1;
//	while ($row = $result->fetch_assoc()) {
//        if ($row['IsMeasure']=='0'){$row['NextPov']='-';}
//		$name = array(
//			'num' => $i,
//			'SiId'=> $row['SiId'],
//			'Name'=> $row['Name'],
//			'SN'=> $row['SN'],
//			'DevCode'=> $row['DevCode'],
//			'nWorkPlace'=> $row['nWorkPlace'],
//			'Placement'=> $row['Placement'],
//			'Department'=> $row['Department'],
//			'RespPerson'=> $row['RespPerson'],
//			'Status'=> $row['Status'],
//			'Type'=> $row['Type'],
//			'IsMeasure'=> $row['IsMeasure'],
//			'NextPov'=> $row['NextPov'],
//			'ManufactDate'=> $row['ManufactDate'],
//			'Action'=>'<a class="btn btn-primary btn-xs"  href=detail.php?SiId='.$row['SiId'].'>Detail</a><br><button class="btn btn-info btn-xs pov-btn" type="button" data-toggle="modal" data-target="#PovModal" id='.$row['SiId'].' siname="'.$row['Name'].'('.$row['SN'].')">Pov</button><button class="btn btn-info btn-xs srv-btn" type="button" data-toggle="modal" data-target="#SrvModal" id='.$row['SiId'].' siname="'.$row['Name'].'('.$row['SN'].')">Srv</button>'
//			);
// 	 		 	 			//echo ($row[1]);
//
//
//		array_push($arrVal, $name);
//		$i++;
//	}
	echo  json_encode($arrVal);
}
//*********************************************************
//                      Package
//**********************************************************

if ($_GET['q']=='get_pkg'){
	$SiId=$_GET['SiId'];
	$sql="select * from tPackage where SiId='".$SiId."'";

	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'Name'=> $row['Name'],
			'Count'=> $row['Count'],
			'Action'=>'<a class="btn btn-primary btn-xs rm-pkg" id="rm-pkg-btn" value="'.$row['id'].'">Del</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}

if($_GET['q']=="add_pkg") {
	$SiId		= $_POST['SiId'];
	$Name   	= $_POST['Name'];
	$Count 		= $_POST['Count'];
	$units 		= $_POST['units'];

	$sql="INSERT INTO tPackage (`SiId`,`Name`,`Count`)
						VALUES ($SiId,'$Name','$Count $units')";
	$result = $con->query($sql);

	$sql="select * from tPackage where SiId=$SiId";

	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'Name'=> $row['Name'],
			'Count'=> $row['Count'],
			'Action'=>'<a class="btn btn-primary btn-xs rm-pkg " id="rm-pkg-btn" value="'.$row['id'].'">Del</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}

if ($_GET['q']=='rm_pkg'){
	$id=$_POST['id'];
	$SiId=$_POST['SiId'];
	$sql="delete from tPackage where id='".$id."'";
	$result = $con->query($sql);

	$sql="select * from tPackage where SiId='".$SiId."'";
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'Name'=> $row['Name'],
			'Count'=> $row['Count'],
			'Action'=>'<a class="btn btn-primary btn-xs rm-pkg " id="rm-pkg-btn" value="'.$row['id'].'">Del</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}


//*********************************************************
//                      Character
//**********************************************************
//$arrVal = array();
if ($_GET['q']=='get_char'){
	$SiId=$_GET['SiId'];
	$sql="select * from tCharacter where SiId='".$SiId."'";

	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'Charact'=> $row['Charact'],
			'Value'=> $row['Value'],
			'Action'=>'<a class="btn btn-primary btn-xs rm-char"  id="rm-char-btn" value="'.$row['id'].'">Del</a> '
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}

if($_GET['q']=="add_char") {
	$SiId		= $_POST['SiId'];
	$Charact   	= $_POST['Charact'];
	$Value 		= $_POST['Value'];


	$sql="INSERT INTO tCharacter (`SiId`,`Charact`,`Value`)
						  VALUES ($SiId,'$Charact','$Value')";
						//  echo $sql;

	$result = $con->query($sql);
//	echo $result;
	$sql="select * from tCharacter where SiId=$SiId";
	//echo $sql;
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'Charact'=> $row['Charact'],
			'Value'=> $row['Value'],
			'Action'=>'<a class="btn btn-primary btn-xs rm-char"  id="rm-char-btn" value="'.$row['id'].'">Del</a> '
			);
 	 		 	 			echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}



if ($_GET['q']=='rm_char'){
	$id=$_POST['id'];
	$SiId=$_POST['SiId'];
	$sql="delete from tCharacter where id='".$id."'";
	$result = $con->query($sql);

	$sql="select * from tCharacter where SiId='".$SiId."'";
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'Charact'=> $row['Charact'],
			'Value'=> $row['Value'],
			'Action'=>'<a class="btn btn-primary btn-xs rm-char"  id="rm-char-btn" value="'.$row['id'].'">Del</a> '
			);
 	 		 	 			//echo ($row[1]);



		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}


//*********************************************************
//                      Calibration
//**********************************************************
//$arrVal = array();
if ($_GET['q']=='get_pov'){
	$SiId=$_GET['SiId'];
	$sql="select * from tPov where SiId='".$SiId."'";

	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'PovDate'=> $row['PovDate'],
			'Doc'=> $row['Doc'],
            'File'=>'<a href="'.$row['File'].'">'.$row['File'].'</a> ',
			'Action'=>'<a class="btn btn-primary btn-xs rm-pov"  id="rm-pov-btn" data-fname="'.$row['File'].'"  value="'.$row['id'].'">Del</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}


if($_GET['q']=="add_pov") {
	$SiId		= $_POST['SiId'];
	$PovDate   	= date("Y-m-d", strtotime($_POST['PovDate']));
	$Doc 		= $_POST['Doc'];
    $dest       ='';
    $destdir    ='./uploads/'.date("Y", strtotime($_POST['PovDate']));
//Upload file
if (!empty($_FILES['filename']['name'])){
$uploadfile = $_FILES['filename']['name'];
$dest ='./uploads/'.date("Y", strtotime($_POST['PovDate'])).'/'.md5(date("Y-m-d H:i:s")).'.'.substr($uploadfile, -3);
if(!file_exists($destdir)){
    mkdir($destdir);
}
if (!move_uploaded_file($_FILES['filename']['tmp_name'], $dest)) {
    echo "err!<br>".$_FILES['filename']['name'].'<br>';
    echo $dest.'<br>';
    echo $_FILES['filename']['error'].'<br>';
    }

}



	$sql="INSERT INTO tPov (`SiId`,`PovDate`,`Doc`,`File`)
					  VALUES ($SiId,'$PovDate','$Doc','$dest')";

	$result = $con->query($sql);

    $sql="INSERT INTO tService (`SiId`,`ServDate`,`Executor`,`Description`)
						VALUES ($SiId,'$PovDate','А.А. Леонов','Метрологическая аттестация')";

	$result = $con->query($sql);

	$sql="select * from tPov where SiId=$SiId";
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'PovDate'=> $row['PovDate'],
			'Doc'=> $row['Doc'],
            'File'=>'<a href="'.$row['File'].'">'.$row['File'].'</a> ',
			'Action'=>'<a class="btn btn-primary btn-xs rm-pov"  id="rm-pov-btn" data-fname="'.$row['File'].'"  value="'.$row['id'].'">Del</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}


if ($_GET['q']=='rm_pov'){
	$id=$_POST['id'];
	$SiId=$_POST['SiId'];
    $fname=$_POST['fname'];
    if (file_exists($fname)){
    unlink($fname);
    }
	$sql="delete from tPov where id='".$id."'";
	$result = $con->query($sql);

	$sql="select * from tPov where SiId='".$SiId."'";
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'PovDate'=> $row['PovDate'],
			'Doc'=> $row['Doc'],
            'File'=>'<a href="'.$row['File'].'">'.$row['File'].'</a> ',
			'Action'=>'<a class="btn btn-primary btn-xs rm-pov"  id="rm-pov-btn" data-fname="'.$row['File'].'" value="'.$row['id'].'">Del</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}

//*********************************************************
//                      Service
//**********************************************************
if ($_GET['q']=='get_serv'){
	$SiId=$_GET['SiId'];
	$sql="select * from tService where SiId='".$SiId."'";

	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'ServDate'=> $row['ServDate'],
			'ServType'=> $row['ServType'],
			'Executor'=> $row['Executor'],
			'Description'=> $row['Description'],
			'NextDate'=> $row['NextDate'],
			'Action'=>'<a class="btn btn-primary btn-xs rm-serv"  id="rm-serv-btn" value="'.$row['id'].'">Del</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}


if($_GET['q']=="add_serv") {
	$SiId		= $_POST['SiId'];
	$ServDate   	= date("Y-m-d", strtotime($_POST['ServDate']));
	$ServType 		= $_POST['ServType'];
	$Executor 		= $_POST['Executor'];
	$Description 	= $_POST['Description'];
	$NextDate 		= date("Y-m-d", strtotime($_POST['NextDate']));


	$sql="INSERT INTO tService (`SiId`,`ServDate`,`ServType`,`Executor`,`Description`,`NextDate`)
						VALUES ($SiId,'$ServDate','$ServType','$Executor','$Description','$NextDate')";
//echo $sql."\n";
	$result = $con->query($sql);
//echo $result;
	$sql="select * from tService where SiId=$SiId";
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'ServDate'=> $row['ServDate'],
			'ServType'=> $row['ServType'],
			'Executor'=> $row['Executor'],
			'Description'=> $row['Description'],
			'NextDate'=> $row['NextDate'],
			'Action'=>'<a class="btn btn-primary btn-xs rm-serv"  id="rm-serv-btn" value="'.$row['id'].'">Del</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}

if ($_GET['q']=='rm_serv'){
	$id=$_POST['id'];
	$SiId=$_POST['SiId'];
	$sql="delete from tService where id='".$id."'";
	$result = $con->query($sql);

	$sql="select * from tService where SiId=$SiId";
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'ServDate'=> $row['ServDate'],
			'ServType'=> $row['ServType'],
			'Executor'=> $row['Executor'],
			'Description'=> $row['Description'],
			'NextDate'=> $row['NextDate'],
			'Action'=>'<a class="btn btn-primary btn-xs rm-serv"  id="rm-serv-btn" value="'.$row['id'].'">Del</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}


//*********************************************************
//                      Contacts
//**********************************************************
if ($_GET['q']=='get_contacts'){
	$SiId=$_GET['SiId'];
	$sql="select * from tContacts";

	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(

			'id'=> $row['id'],
			'SiId'=> $row['SiId'],
			'Name'=> $row['Name'],
			'Org'=> $row['Org'],
			'Addr'=> $row['Addr'],
			'Description'=> $row['Description'],
			'Action'=>'<a class="btn btn-primary btn-xs"  href=#?SiId='.$row['SiId'].'>Delete</a>'
			);
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}
//*************************************************************************************************


//*********************************************************
//                      Add_SI
//**********************************************************
if ($_GET['q']=='add_si'){
	//$SiId=$_GET['SiId'];
    $Name   	= $_POST['Name'];
    $SN   	= $_POST['SN'];
	$sql="INSERT INTO tSI (`Name`,`SN`)
						VALUES ('$Name','$SN')";

	$result = $con->query($sql);
	if ($result===true){
        echo($Name." добавлен.");
    }else{
        echo("Ошибка добавления!");
    }

}
//*************************************************************************************************
if ($_GET['q']=='get_missed'){

//	$sql="SELECT *
//FROM (SELECT SI.SiId,
//        SI.Name,
//        SI.IsMeasure,
//        SI.SN,
//        SI.InvNum,
//        SI.DevCode,
//        SI.nWorkPlace,
//        Pl.Placement,
//        d.Department,
//        r.RespPerson,
//        YEAR(SI.ManufactDate) AS ManufactDate,
//        t.Type,
//        s.Status,
//        p.PovDate + INTERVAL SI.PovPeriod month AS NextPov
//      FROM tSI AS SI
//      LEFT OUTER JOIN tPov  as p on p.SiId=SI.SiId
//      LEFT OUTER JOIN
//        tResposible  AS r ON SI.RespPerson = r.id
//        LEFT OUTER JOIN
//        tPlacement   as Pl on SI.Placement=Pl.id
//        LEFT OUTER JOIN
//        tDepartments as d on SI.Department=d.id
//        LEFT OUTER JOIN
//        tTypes       as t    ON SI.Type=t.id
//        LEFT OUTER JOIN
//        tStatus      as s    ON SI.Status=s.id
//      WHERE SI.IsMeasure='1' AND SI.Status <> '1' AND p.PovDate=(SELECT max(tPov.PovDate) FROM tPov WHERE tPov.SiId=SI.SiId )) AS pov
//WHERE pov.NextPov <= CURDATE() + INTERVAL 2 month";
    $sql="SELECT *
FROM (SELECT SI.SiId,
				SI.Name,
				SI.IsMeasure,
				SI.SN,
				SI.InvNum,
				SI.DevCode,
				SI.nWorkPlace,
				Pl.Placement,
				d.Department,
				r.RespPerson,
				YEAR(SI.ManufactDate) AS ManufactDate,
				t.Type,
				s.Status,
				MAX(p.PovDate) + INTERVAL SI.PovPeriod month AS NextPov
		FROM tSI AS SI
		LEFT OUTER JOIN tResposible  AS r  ON SI.RespPerson = r.id
		LEFT OUTER JOIN tPlacement   as Pl on SI.Placement=Pl.id
		LEFT OUTER JOIN tDepartments as d  on SI.Department=d.id
		LEFT OUTER JOIN tTypes       as t  ON SI.Type=t.id
		LEFT OUTER JOIN tStatus      as s  ON SI.Status=s.id
		LEFT OUTER JOIN tPov  		 as p  on p.SiId=SI.SiId
        WHERE SI.IsMeasure='1'  AND SI.Status <> '1'
		GROUP BY SI.SiId
		ORDER BY SI.SiId desc) AS Pov
        WHERE Pov.NextPov <= CURDATE() + INTERVAL 2 month";
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()){

		$name = array(
			'num' => $i,
			'SiId'=> $row['SiId'],
			'Name'=> $row['Name'],
			'SN'=> $row['SN'],
			'DevCode'=> $row['DevCode'],
			'nWorkPlace'=> $row['nWorkPlace'],
			'Placement'=> $row['Placement'],
			'Department'=> $row['Department'],
			'RespPerson'=> $row['RespPerson'],
			'Status'=> $row['Status'],
			'Type'=> $row['Type'],
			'IsMeasure'=> $row['IsMeasure'],
			'NextPov'=> $row['NextPov'],
			'ManufactDate'=> $row['ManufactDate'],
			'Action'=>'<a class="btn btn-primary btn-xs"  href=detail.php?SiId='.$row['SiId'].'>Detail</a><br><button class="btn btn-info btn-xs pov-btn" type="button" data-toggle="modal" data-target="#PovModal" id='.$row['SiId'].' siname="'.$row['Name'].'('.$row['SN'].')">Pov</button><button class="btn btn-info btn-xs srv-btn" type="button" data-toggle="modal" data-target="#SrvModal" id='.$row['SiId'].' siname="'.$row['Name'].'('.$row['SN'].')">Srv</button>'
        );
 	 		 	 			//echo ($row[1]);


		array_push($arrVal, $name);

	}
	echo  json_encode($arrVal);
}
//**************************************************************************************

$con->close();
?>
