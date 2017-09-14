<?php
include "db.php";
?>
<html>
<head>
  <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
  <style>
  td{
    padding: 0px;
    padding-right: 0px;
    border: 1px solid black;
    height: 4mm;
    font-size: auto;
  }
  .capt{
    font-style:normal;
    font-weight: bold;
  }
  </style>
  <head>
    <body>
      <div class="container-fluid">
      	<div class="col-md-12">

        <?php

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
              p.PovDate + INTERVAL SI.PovPeriod month AS NextPov
              FROM tSI AS SI
              LEFT OUTER JOIN
              tResposible  AS r ON SI.RespPerson = r.id
              LEFT OUTER JOIN
              tPlacement   as Pl on SI.Placement=Pl.id
              LEFT OUTER JOIN
              tDepartments as d on SI.Department=d.id
              LEFT OUTER JOIN
              tTypes       as t    ON SI.Type=t.id
              LEFT OUTER JOIN
              tStatus      as s    ON SI.Status=s.id
              LEFT OUTER JOIN tPov  as p on p.SiId=SI.SiId
              WHERE p.PovDate=(select max(tPov.PovDate) FROM tPov WHERE tPov.SiId=SI.SiId) OR p.PovDate IS NULL
              ORDER BY SI.SiId desc";
	$result = $con->query($sql);
  $col=1;
echo '<div class="row">';
      	while ($row = $result->fetch_assoc()){
if ($col>3) {
echo '<div class="row">';
}   echo '<div class="col-md-4">';
    echo $col;
    echo '<table style="font-size: 8pt;border-collapse: collapse;border: 1px solid black">';
    echo '<tr><td class="capt" style="width: 40mm;">Наименованние прибора</td>';
    echo '<td class="data" style="width: 33mm">'. $row['Name'].'</td></tr>';
    echo '<tr><td class="capt" style="width: 40mm;">Заводской №</td>';
    echo '<td class="data" style="width: 33mm">'. $row['Name'].'</td></tr>';
    echo '<tr><td class="capt" style="width: 40mm;">Дата следующей поверки</td>';
    echo '<td class="data" style="width: 33mm">'. $row['Name'].'</td></tr>';
    echo '<tr><td class="capt" style="width: 40mm;">Тип оборудования</td>';
    echo '<td class="data" style="width: 33mm">'. $row['Name'].'</td></tr>';
    echo '<tr><td class="capt" style="width: 40mm;">Текущее состояние прибора</td>';
    echo '<td class="data" style="width: 33mm">'. $row['Name'].'</td></tr>';
    echo '<tr style="height: 4mm;"><td colspan="2" class="capt"></td></tr>';
    echo " </table>";
    echo "</div>";
$col++;
if ($col>3) {
  echo "</div>";
  echo "</div>";
$col=1;
}
}
          ?>


    </body>
</html>
