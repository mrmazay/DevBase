<?php
$pwd="lab";
$uid="lab";
$serverName = "192.168.220.100";
$connectionInfo = array("UID" => $uid, "PWD" => $pwd, "Database"=>"EMCiMed_FBT");
$con = odbc_connect( "mssql",$uid,$pwd);
//var_dump($con);
if (!$con) {
      die('Unable to connect!');
			}

// $sql="SELECT TOP 100 *
// FROM dbo.ExamRequestItems ";


// 	$result = odbc_exec($con, $sql);
// 	if (odbc_error()) {
//     echo "I've found a problem: " . odbc_errormsg($con);
// }
// $prev="";

// // echo "<html>
// // 		<head><title>Miura</title>
// // 	   <meta charset=\"UTF-8\">
// // 		</head>
// //    <body>
// //    <table>";
// //while (
// 	$row = odbc_fetch_array($result);
// 		if (odbc_error()) {
//     echo "I've found a problem: " . odbc_errormsg($con);
// }
// //) {
// echo $row[0];
// if ($row['SampleNum']!=$prev){

// echo "<tr><td>".$row['SampleNum']."----</td><td>".$row['ExamCode']."</td>";
// 		}else{
// echo "<td>".$row['ExamCode']."</td>";
// 		}
// 			$prev=$row['SampleNum'];
// //		}

// echo("</table></body");
			$sql="SELECT TOP 100 *
FROM ExamRequest R
  INNER JOIN ExamRequestItems RI ON R.ExamReqID=RI.ExamReqID
  INNER JOIN ExamTypes ET ON ET.ExamTypeID=RI.ExamType
  INNER JOIN vPatientsBrief P ON P.PersonID=R.PatientID
  INNER JOIN ExamParams E ON ET.ExamTypeID = E.ExamType AND E.Printable=1
  inner join ExamSamples AS S ON RI.ExamSampleID=S.ExamSampleID
  LEFT JOIN ExamResultValues V ON V.ExamReqItemID=RI.ExamReqItemID AND V.ExamParamID=E.ExamParamID
  LEFT JOIN MeasureUnits M ON M.UnitID=V.MeasureUnit
  LEFT JOIN vEmpPosBrief EP ON EP.EmpPosID=R.EmpPosID
  LEFT JOIN Agency A ON A.AgencyID=R.AgencyID";


	$result = odbc_exec($con, $sql);
	$arrVal = array();
	while ($row = odbc_fetch_array($result)) {

		array_push($arrVal, $row);

	}
	echo  json_encode($arrVal);


?>
