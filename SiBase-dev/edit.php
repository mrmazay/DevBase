<?php
require 'title.php';
require 'db.php';


$SiId=$_GET['SiId'];
if (empty($SiId)){
	$SiId		= $_POST['SiId'];
	$Name   	= $_POST['Name'];
	$SN 		= $_POST['SN'];
	$InvNum 	= $_POST['InvNum'];
	$DevCode 	= $_POST['DevCode'];
	$nWorkPlace = $_POST['nWorkPlace'];
	$Placement 	= $_POST['Placement'];
	$Department = $_POST['Department'];
	$RespPerson = $_POST['RespPerson'];
	$ManufactDate= $_POST['ManufactDate'];
	$Type 		= $_POST['Type'];
	$Status 	= $_POST['Status'];
	$MeasureCode= $_POST['MeasureCode'];

	echo "<br><br>";

	if(!empty($Name) && !empty($SN)&& !empty($SiId)) {
		$str="UPDATE 'tSI' SET Name='".$Name.
		"',SN='".$SN.
		"',InvNum='".$InvNum.
		"',DevCode='".$DevCode.
		"',nWorkPlace='".$nWorkPlace.
		"',Placement='".$Placement.
		"',Department='".$Department.
		"',RespPerson='".$RespPerson.
		"',ManufactDate='".$ManufactDate.
		"',Type='".$Type.
		"',Status='".$Status.
		"',MeasureCode='".$MeasureCode.
		"' WHERE SiId=".$SiId;

		$query = $con->query($str);
	} else {
		echo "Insert Name and SerialNumber!";
	}

} else {
	$sql="SELECT *
	FROM tSI AS SI
	WHERE SI.SiId=".$SiId."
	ORDER BY SI.SiId desc;";
 // *************************************************************************************
	//echo "<br><br>";
	$query = $con->query($sql);
	while ($rowList = $query->fetchArray()) {

		$Name   	 = $rowList['Name'];
		$SN 		 = $rowList['SN'];
		$InvNum 	 = $rowList['InvNum'];
		$DevCode 	 = $rowList['DevCode'];
		$nWorkPlace  = $rowList['nWorkPlace'];
		$Placement 	 = $rowList['Placement'];
		$Department  = $rowList['Department'];
		$RespPerson  = $rowList['RespPerson'];
		$ManufactDate= $rowList['ManufactDate'];
		$Type 		 = $rowList['Type'];
		$Status 	 = $rowList['Status'];
		$MeasureCode = $rowList['MeasureCode'];

	}

	//echo $Status;
}


?>

<div class="container">
	<div class="col-md-12">
		<div class="page-header">
<!-- 			<h1>
				Add
			</h1> -->
		</div>


		<div class="panel panel-success">
			<div class="panel-heading ">
				<span class="" id="tbl_title">
					Edit
				</span>


			</div>


			<!-- ********************************************************************************************* -->
			<div class="col-lg-offset-8 col-lg-1">
				<form action="package.php">
					<input type="hidden" name="SiId"  value=<? echo $SiId;?>>
					<button class="btn btn-default" type="submit">Package</button>
				</form>
			</div>
			<div class="col-lg-1">
				<form action="character.php">
					<input type="hidden" name="SiId"  value=<? echo $SiId;?>>
					<button class="btn btn-default" type="submit">Character</button>
				</form>
			</div>
			<div class="col-lg-1">
				<form action="calibration.php">
					<input type="hidden" name="SiId"  value=<? echo $SiId;?>>
					<button class="btn btn-default" type="submit">Calibration</button>
				</form>
			</div>
			<div class="col-lg-1">
				<form action="service.php">
					<input type="hidden" name="SiId"  value=<? echo $SiId;?>>
					<button class="btn btn-default" type="submit">Service</button>
				</form>
			</div>
			<!--*********************************************************************************************  -->
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal" role="form" method="POST" action="edit.php">

							<div class="form-group">
								<label for="SiId" class="col-lg-2 control-label">SiId</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="SiId" id="SiId" placeholder=<?echo $SiId?> value=<? echo $SiId;?>>
								</div>
							</div>

							<div class="form-group">
								<label for="Name" class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="Name" id="Name" placeholder="Name" value='<? echo $Name;?>'>
								</div>
							</div>

							<div class="form-group">
								<label for="SN" class="col-lg-2 control-label">SN</label>
								<div class="col-lg-10">
									<input type="SN" class="form-control" name="SN" id="SN" placeholder="SN" value=<? echo $SN;?>>
								</div>
							</div>

							<div class="form-group">
								<label for="RespPerson" class="col-lg-2 control-label">Responsible</label>
								<div class="col-lg-10">
									<select name="RespPerson" type="RespPerson" class="form-control" id="RespPerson">
										<option value="">---</option>
										<?
										$sql="select * from tResposible order by id asc";
										$query = $con->query($sql);
										while ($rowList = $query->fetchArray()) {
											if ($RespPerson!=$rowList['id']){
												echo "<option value =".$rowList['id'].">".$rowList['RespPerson']."</option>";
											}else{

												echo "<option selected value =".$rowList['id'].">".$rowList['RespPerson']."</option>";
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="Placement" class="col-lg-2 control-label">Placement</label>
								<div class="col-lg-10">
									<select name="Placement" type="Placement" class="form-control" id="Placement">
										<option value="">---</option>
										<?
										$sql="select * from tPlacement order by id asc";
										$query = $con->query($sql);
										while ($rowList = $query->fetchArray()) {
											if ($Placement!=$rowList['id']){
												echo "<option value =".$rowList['id'].">".$rowList['Placement']."</option>";
											}else{

												echo "<option selected value =".$rowList['id'].">".$rowList['Placement']."</option>";
											}

										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="Department" class="col-lg-2 control-label">Department</label>
								<div class="col-lg-10">
									<select name="Department" type="Department" class="form-control" id="Department">
										<option value="">---</option>
										<?
										$sql="select * from tDepartments order by id asc";
										$query = $con->query($sql);

										while ($rowList = $query->fetchArray()) {
											if ($Department!=$rowList['id']){
												echo "<option value =".$rowList['id'].">".$rowList['department']."</option>";
											}else{

												echo "<option selected value =".$rowList['id'].">".$rowList['department']."</option>";
											}

										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="Type" class="col-lg-2 control-label">Type</label>
								<div class="col-lg-10">
									<select name="Type" type="Type" class="form-control" id="Type">
										<option value="">---</option>
										<?

										$sql="select * from tTypes order by id asc";
										$query = $con->query($sql);
										while ($rowList = $query->fetchArray()) {
											if ($Type!=$rowList['id']){

												echo "<option value =".$rowList['id'].">".$rowList['Type']."</option>";
											}else{

												echo "<option selected value =".$rowList['id'].">".$rowList['Type']."</option>";
											}

										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="Status" class="col-lg-2 control-label">Status</label>
								<div class="col-lg-10">
									<select name="Status" type="Status" class="form-control" id="Status">
										<option value="">---</option>
										<?
										$sql="select * from tStatus order by id asc";
										$query = $con->query($sql);
										while ($rowList = $query->fetchArray()) {
											if ($Status!=$rowList['id']){
												echo "<option value =".$rowList['id'].">".$rowList['status']."</option>";

											}else{

												echo "<option selected value =".$rowList['id'].">".$rowList['status']."</option>";
											}
										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="ManufactDate" class="col-lg-2 control-label">ManufactDate</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="ManufactDate" id="ManufactDate" placeholder="01.01.2014" value=<? echo $ManufactDate;?>>
								</div>
							</div>

							<div class="form-group">
								<label for="InvNum" class="col-lg-2 control-label">InvNum</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="InvNum" id="InvNum" placeholder="#" value=<? echo $InvNum;?>>
								</div>
							</div>

							<div class="form-group">
								<label for="DevCode" class="col-lg-2 control-label">DevCode</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="DevCode" id="DevCode" placeholder="#" value=<? echo $DevCode; ?>>
								</div>
							</div>

							<div class="form-group">
								<label for="MeasureCode" class="col-lg-2 control-label">MeasureCode</label>
								<div class="col-lg-10">
									<select name="MeasureCode" type="MeasureCode" class="form-control" id="MeasureCode">
										<option value="">---</option>
										<?
										$sql="select * from tMeasureCodes order by id asc";
										$query = $con->query($sql);
										while ($rowList = $query->fetchArray()) {
											if ($MeasureCode!=$rowList['id']){
												echo "<option value =".$rowList['id'].">".$rowList['Name']."</option>";
											}else{

												echo "<option selected value =".$rowList['id'].">".$rowList['Name']."</option>";
											}
										}
										?>
									</select>
								</div>
							</div>


							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button type="submit" class="btn btn-default">Submit</button>
								</div>
							</div>
						</form>
						<!-- ************************************************************* -->
						<br>


					</div>
				</div>
			</div>
		</div>

	</div>
</div>



<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--=====================================================-->

<script type="text/javascript">

	$(document).on("click", "#SiId", function(e) {
		alert(this.id);
		$(document).$("#p1").innerHTML="qweqweqwe";
	});

</script>

</body>
</html>
