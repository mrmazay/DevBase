	<?php
	require 'title.php';
	require 'db.php';

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
	//$NextPov 	= $_POST['NextPov'];

	//echo "<br><br>";
	$sql="select max(SiId) as SiId from tSi";
	$query = $con->query($sql);
	while ($rowList = $query->fetchArray()) {  
	$SiId=$rowList['SiId'];
	}
	$SiId++;
	if(!empty($Name) && !empty($SN)&& !empty($SiId)) {
	$str="INSERT INTO 'tSi' ('SiId','Name','SN','InvNum','DevCode','nWorkPlace','Placement','Department','RespPerson','ManufactDate','Type','Status') 
	VALUES ('".$SiId."','".$Name."','".$SN."','".$InvNum."','".$DevCode."','".$nWorkPlace."','".$Placement."','".$Department."','".$RespPerson."','".$ManufactDate."','".$Type."','".$Status."')";
	$query = $con->query($str);

	} else {
	echo "<style type='text/css'>
	.control-label{
		color: red;
	}
	</style>";
	}

	?>

	<div class="container">
	<div class="col-md-12">
		<div class="page-header">
	<!-- 			<h1>
				Add
			</h1> -->
		</div>


		<div class="panel panel-primary">
			<div class="panel-heading "> 
				<span class="" id="tbl_title"> 
					Добавление
				</span>  


			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<!--*********************************************************************************************  -->
						<form class="form-horizontal" role="form" method="POST">


							<div class="form-group">
								<label for="SiId" class="col-lg-2 control-label">SiId</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="SiId" id="SiId" disabled="true" placeholder=<?echo $SiId?> value=<? echo $SiId?>>
								</div>
							</div>

							<div class="form-group">
								<label for="Name" class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="Name" id="Name" placeholder="Name">
								</div>
							</div>

							<div class="form-group">
								<label for="SN" class="col-lg-2 control-label">SN</label>
								<div class="col-lg-10">
									<input type="SN" class="form-control" name="SN" id="SN" placeholder="SN">
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
											echo "<option value =".$rowList['id'].">".$rowList['RespPerson']."</option>";
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
											echo "<option value =".$rowList['id'].">".$rowList['Placement']."</option>";
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
											echo "<option value =".$rowList['id'].">".$rowList['department']."</option>";
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
											echo "<option value =".$rowList['id'].">".$rowList['Type']."</option>";
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
											echo "<option value =".$rowList['id'].">".$rowList['Status']."</option>";
										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="ManufactDate" class="col-lg-2 control-label">ManufactDate</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="ManufactDate" id="ManufactDate" placeholder="01.01.2014">
								</div>
							</div>

							<div class="form-group">
								<label for="InvNum" class="col-lg-2 control-label">InvNum</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="InvNum" id="InvNum" placeholder="#">
								</div>
							</div>

							<div class="form-group">
								<label for="DevCode" class="col-lg-2 control-label">DevCode</label>
								<div class="col-lg-10">
									<input type="Text" class="form-control" name="DevCode" id="DevCode" placeholder="#">
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
											echo "<option value =".$rowList['id'].">".$rowList['Name']."</option>";
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