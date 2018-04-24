<?php
require 'db_mcmed.php';

if ($_GET['q']=='get_main'){


	$sql="select
  Persons.PersonID,
  Persons.MCNum,
  PN.LastName,
  PN.FirstName,
  PN.MiddleName,
  Persons.Sex,
  Exam.CrTime,
  FORMAT(Persons.BirthDate, 'dd/MM/yyyy', 'ru-RU') as BirthDate,
  Persons.Email,
  Phone.PhoneNumber,
  Addr.Address,
  Persons.AddCode2,
  Race.PropertyValue,
  Persons.Memo,
  Pass.Series,
  Pass.Number,
  Pass.IssuePlace,
  FORMAT(Pass.IssueDate, 'dd/MM/yyyy', 'ru-RU') as IssueDate,
  P2G.PatGroupID,
  PatGroup.Name
from Persons

LEFT OUTER JOIN (SELECT *
					  FROM PersonNames
  					  WHERE PersonNames.Status='L') AS PN ON Persons.PersonID = PN.PersonID

INNER JOIN P2G 	  ON Persons.PersonID=P2G.PersonID
INNER JOIN PatGroup ON P2G.PatGroupID=PatGroup.PatGroupID


LEFT OUTER JOIN (SELECT *
  						FROM Phones
  						WHERE Phones.Status='L' AND Phones.PhoneType='3087') AS Phone ON Persons.PersonID  = Phone.PersonID

LEFT OUTER JOIN (SELECT *
  						FROM Addresses
  						WHERE Addresses.Status='L') AS Addr ON Persons.PersonID  = Addr.PersonID

LEFT OUTER JOIN (SELECT *
  						FROM Passport
  						WHERE Passport.Status='L' and Passport.PassportTypeID = '566') AS Pass ON Persons.PersonID  = Pass.PersonID

LEFT OUTER JOIN (SELECT *
  					  FROM PersonProperties
  					  WHERE PersonProperties.PropertyID = '5567') AS Race ON Persons.PersonID = Race.PersonID

LEFT OUTER JOIN ExamRequest AS Exam ON Exam.PatientID = Persons.PersonID



WHERE     (Exam.CrTime=( SELECT    MAX(ExamRequest.CrTime)
 													 FROM     ExamRequest
 													WHERE    Persons.PersonID=ExamRequest.PatientID))

OR Exam.CrTime IS NULL
AND PatGroup.Name LIKE '%ÊÈ%'

ORDER BY Persons.MCNum DESC";


	$result = odbc_exec($con, $sql);
	$arrVal = array();
	while ($row = odbc_fetch_array($result)) {
		$row+=['Action'=>'<a class="btn btn-primary btn-xs"  href=detail.php?MCNum='.$row['MCNum'].'>Detail</a>'];
		//echo($row['Action']);
		if ($row['Sex']=='5233'){$row['Sex']='Ì';}
		if ($row['Sex']=='5234'){$row['Sex']='Æ';}
		$row=deepIconv('cp1251','UTF-8',$row);
		array_push($arrVal, $row);

	}
	echo  json_encode($arrVal);

}

// *************************************************************************************
//									GET RESULTS
// *************************************************************************************
if ($_GET['q']=='get_results'){

	$McNum=$_GET['MCNum'];

	$sql="SELECT
       P.MCNum,
       S.SampleNum,
       R.RequestDate,
       RI.ActualDate,
       RI.Status,
       ET.ExamName,
       P.FullName ,
       P.Age,
       E.Name ,
       V.Value,
       M.UnitCode,
       M.Formula,
       M.UFormula,
       Qualifier = ISNULL(V.Qualifier, E.Limit)
FROM ExamRequest R
  INNER JOIN ExamRequestItems RI ON R.ExamReqID=RI.ExamReqID
  INNER JOIN ExamTypes ET ON ET.ExamTypeID=RI.ExamType
  INNER JOIN vPatientsBrief P ON P.PersonID=R.PatientID
  INNER JOIN ExamParams E ON ET.ExamTypeID = E.ExamType AND E.Printable=1
  inner join ExamSamples AS S ON RI.ExamSampleID=S.ExamSampleID
  LEFT JOIN ExamResultValues V ON V.ExamReqItemID=RI.ExamReqItemID AND V.ExamParamID=E.ExamParamID
  LEFT JOIN MeasureUnits M ON M.UnitID=V.MeasureUnit
  LEFT JOIN vEmpPosBrief EP ON EP.EmpPosID=R.EmpPosID
  LEFT JOIN Agency A ON A.AgencyID=R.AgencyID
WHERE  P.MCNum=$McNum";


	$result = odbc_exec($con, $sql);
	$arrVal = array();
	while ($row = odbc_fetch_array($result)) {

		$row=deepIconv('cp1251','UTF-8',$row);

		array_push($arrVal, $row);

	}
	echo  json_encode($arrVal);

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
