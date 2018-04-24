<?php
//require_once('./tcpdf tcpdf_include.php');
require "./tcpdf/tcpdf.php";
require_once "db.php";
// create new PDF document
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 005');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);



$pdf->SetFont('times', '', 8,'','false');

// add a page
$pdf->AddPage();

// set cell padding
 $pdf->setCellPaddings(1, 1, 1, 1);

// // set cell margins
// $pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 255);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example
$txt = 'qwe';
$arrVal = array();
$arrName = array('Наименование прибора' , 'Заводской №','Дата следующей поверки',
					'Тип оборудования','Текущее состояние прибора','Ответственный за прибор');
$sql="SELECT `Name`,`SN`,`NextPov`,`Type`,`Status`, `RespPerson` FROM `vMain` LIMIT 20 ";

	$result = $con->query($sql);
	while ($row = $result->fetch_array()){

		array_push($arrVal, $row);

	}
$k=0;
while ($k<count($arrVal)) {
for ($i=0;$i<6; $i++){
	$flag=0;
	for ($j=$k;$j<=$k+3;$j++){
		$flag=$j-$k-2;
		$pdf->SetFont('timesbd', '', 7,'','false');
		$pdf->Cell(37, 4, $arrName[$i], 1, 0,'L');
		$pdf->SetFont('times', '', 5,'','false');
		$pdf->MultiCell(32, 4,  $arrVal[$j][$i], 1,'L', 'false',$flag,'','','true',0,'true','true',4);
	}

}
$pdf->Cell(69, 4, "SOP-GEN-EQUIP-001.02_Приложение Г", 1, 0,'L');
$pdf->Cell(69, 4, "SOP-GEN-EQUIP-001.02_Приложение Г", 1, 0,'L');
$pdf->Cell(69, 4, "SOP-GEN-EQUIP-001.02_Приложение Г", 1, 0,'L');
$pdf->Cell(69, 4, "SOP-GEN-EQUIP-001.02_Приложение Г", 1, 1,'L');
$k+=4;
if ($k>=16){
$pdf->AddPage();
	}
}
// $pdf->SetFont('timesbd', '', 7,'','false');
$pdf->Cell(37, 4, "Наименование прибора", 1, 0,'L');
// $pdf->SetFont('times', '', 5,'','false');
$pdf->Cell(32, 4, $txt, 1, 1,'L');
// $pdf->SetFont('timesbd', '', 7,'','false');
$pdf->Cell(37, 4, "Заводской №", 1, 0,'L');
// $pdf->SetFont('times', '', 5,'','false');
$pdf->Cell(32, 4, $txt, 1, 1,'L');
// //$pdf->SetFont('timesbd', '', 7,'','false');
$pdf->Cell(37, 4, "Дата следующей поверки", 1, 0,'L');
//$pdf->SetFont('times', '', 5,'','false');
$pdf->Cell(32, 4, $txt, 1, 1,'L');
//$pdf->SetFont('timesbd', '', 7,'','false');
$pdf->Cell(37, 4, "Тип оборудования", 1, 0,'L');
//$pdf->SetFont('times', '', 5,'','false');
$pdf->Cell(32, 4, $txt, 1, 1,'L');
//$pdf->SetFont('timesbd', '', 7,'','false');
$pdf->Cell(37, 4, "Текущее состояние прибора", 1, 0,'L');
//$pdf->SetFont('times', '', 5,'','false');
$pdf->Cell(32, 4, $txt, 1, 1,'L');
//$pdf->SetFont('timesbd', '', 7,'','false');
$pdf->Cell(37, 4, "Ответственный за прибор", 1, 0,'L');
//$pdf->SetFont('times', '', 5,'','false');
$pdf->Cell(32, 4, $txt, 1, 1,'L');
//$pdf->SetFont('timesbd', '', 7,'','false');
$pdf->Cell(69, 4, "SOP-GEN-EQUIP-001.02_Приложение Г", 1, 0,'L');


//move pointer to last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('example_005.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
