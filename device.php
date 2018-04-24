<?php
/**
*
*/
class Device
{
	public $SiId;
	public $Name;
	public $SN;
	public $DevCode;
	public $nWorkPlace;
	public $Placement;
	public $Department;
	public $RespPerson;
	public $Status;
	public $Type;
	public $IsMeasure;
	public $PovPeriod;
	function __construct(){

	}
public function get(){

}
public function add(){

}

public function delete($SiId){

}
public function update(){

}
}

?>

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
