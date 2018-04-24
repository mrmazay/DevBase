<?php
require 'db.php';
$arrVal=array();
$sql="SELECT SI.MeasureCode,
			 p.PovDate
		FROM tSI AS SI
		LEFT OUTER JOIN tResposible  AS r  ON SI.RespPerson = r.id
		LEFT OUTER JOIN tPlacement   as Pl on SI.Placement=Pl.id
		LEFT OUTER JOIN tDepartments as d  on SI.Department=d.id
		LEFT OUTER JOIN tTypes       as t  ON SI.Type=t.id
		LEFT OUTER JOIN tStatus      as s  ON SI.Status=s.id
		LEFT OUTER JOIN tPov  		 as p  on p.SiId=SI.SiId
		WHERE  not isnull(SI.MeasureCode) AND not isnull(p.PovDate)
		ORDER BY SI.MeasureCode asc";

	$result = $con->query($sql);
$prev="";
echo "<html>
  <head>
    <title>DevBase</title>
   <meta charset=\"UTF-8\">
	</head>
   <body>
   <table>";
	while ($row = $result->fetch()) {
//	echo "<tr>";
		if ($row['MeasureCode']!=$prev){

echo "<tr><td>".$row['MeasureCode']."----</td><td>".$row['PovDate']."</td>";
		}else{
echo "<td>".$row['PovDate']."</td>";
		}
			$prev=$row['MeasureCode'];

			//$row['MeasureCode'] => $row['PovDate'],

	//	array_push($arrVal, $name);
		}

echo("</body")

?>
