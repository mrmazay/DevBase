<?php
require 'db.php';



if ($_GET['q']=='add'){

	$SiId		  = $_POST['SiId'];
	$Name   	  = $_POST['Name'];
	$SN 		  = $_POST['SN'];
	$InvNum 	  = $_POST['InvNum'];
	$DevCode 	  = $_POST['DevCode'];
	$nWorkPlace   = $_POST['nWorkPlace'];
	$Placement 	  = $_POST['Placement'];
	$Department   = $_POST['Department'];
	$RespPerson   = $_POST['RespPerson'];
	$ManufactDate = $_POST['ManufactDate'];
	$Type 		  = $_POST['Type'];
	$Status 	  = $_POST['Status'];
    $IsMeasure    = $_POST['IsMeasure'];

    $sql="INSERT INTO tSi (`Name`,`SN`,`InvNum`,`DevCode`,`nWorkPlace`,`Placement`,`Department`,`RespPerson`,`ManufactDate`,`Type`,`Status`,`IsMeasure`,CrTime)
	VALUES ('$Name','$SN','$InvNum','$DevCode','$nWorkPlace','$Placement','$Department','$RespPerson','$ManufactDate','$Type','$Status','$IsMeasure',NOW())";
    $result = $con->query($sql);
   header('HTTP/1.1 200 OK');
header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
exit();

}

require 'title.php';

	?>


<div class="container">
	<div class="col-md-12">
		<div class="page-header">
		</div> <!-- Page Header -->

		<div class="panel-group">

			<div class="row" id="row-1">
<!--    ***************************************************************************************  -->
<!--                                        Main Prop                                            -->
<!--    ***************************************************************************************  -->
				<div class="col-md-12">
					<div class="panel  panel-primary" id="main-panel">
						<div class="panel-heading ">
							<span class="" id="tbl_title">Общие</span>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<form class="form-horizontal" role="form" method="POST" action="add_si.php?q=add">

<!--
								<div class="form-group">
									<label for="SiId" class="col-lg-2 control-label">SiId</label>
									<div class="col-lg-10">
										<input type="Text" class="form-control" name="SiId" id="SiId">
									</div>
								</div>
-->
								<div class="form-group">
									<label for="Name" class="col-lg-2 control-label">Название</label>
									<div class="col-lg-10">
										<input type="Text" class="form-control" name="Name" id="Name" placeholder="Name" value="<?php echo $Name;?>">
									</div>
								</div>
								<div class="form-group">
									<label for="SN" class="col-lg-2 control-label">Зав.№</label>
									<div class="col-lg-10">
										<input type="SN" class="form-control" name="SN" id="SN" placeholder="SN" value="<?php echo $SN;?>">
									</div>
								</div>
								<div class="form-group">
									<label for="RespPerson" class="col-lg-2 control-label">Ответственное лицо</label>
									<div class="col-lg-10">
										<select name="RespPerson" type="RespPerson" class="form-control" id="RespPerson">
											<option value="">---</option>
											<?php
											$sql="select * from tResposible order by id asc";
											$result = $con->query($sql);
											while ($row = $result->fetch_assoc()) {
												if ($RespPerson!=$row['id']){
													echo "<option value =".$row['id'].">".$row['RespPerson']."</option>";
												}else{

													echo "<option selected value =".$row['id'].">".$row['RespPerson']."</option>";
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="Placement" class="col-lg-2 control-label">Расположение</label>
									<div class="col-lg-10">
										<select name="Placement" type="Placement" class="form-control" id="Placement">
											<option value="">---</option>
											<?php
											$sql="select * from tPlacement order by id asc";
											$result = $con->query($sql);
											while ($row = $result->fetch_assoc()) {
												if ($Placement!=$row['id']){
													echo "<option value =".$row['id'].">".$row['Placement']."</option>";
												}else{

													echo "<option selected value =".$row['id'].">".$row['Placement']."</option>";
												}

											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="Department" class="col-lg-2 control-label">Подразделение</label>
									<div class="col-lg-10">
										<select name="Department" type="Department" class="form-control" id="Department">
											<option value="">---</option>
											<?php
											$sql="select * from tDepartments order by id asc";
											$result = $con->query($sql);

											while ($row = $result->fetch_assoc()) {
												if ($Department!=$row['id']){
													echo "<option value =".$row['id'].">".$row['department']."</option>";
												}else{

													echo "<option selected value =".$row['id'].">".$row['department']."</option>";
												}

											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="Type" class="col-lg-2 control-label">Тип</label>
									<div class="col-lg-10">
										<select name="Type" type="Type" class="form-control" id="Type">
											<option value="">---</option>
											<?php

											$sql="select * from tTypes order by id asc";
											$result = $con->query($sql);
											while ($row = $result->fetch_assoc()) {
												if ($Type!=$row['id']){

													echo "<option value =".$row['id'].">".$row['Type']."</option>";
												}else{

													echo "<option selected value =".$row['id'].">".$row['Type']."</option>";
												}

											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="IsMeasure" class="col-lg-2 control-label">СИ/Не СИ</label>
									<div class="col-lg-10">
										<select name="IsMeasure" type="IsMeasure" class="form-control" id="IsMeasure">
											<option value="1">СИ</option>
											<option value="0">Не СИ</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="Status" class="col-lg-2 control-label">Состояние</label>
									<div class="col-lg-10">
										<select name="Status" type="Status" class="form-control" id="Status">
											<option value="">---</option>
											<?php
											$sql="select * from tStatus order by id asc";
											$result = $con->query($sql);
											while ($row = $result->fetch_assoc()) {
												if ($Status!=$row['id']){
													echo "<option value =".$row['id'].">".$row['Status']."</option>";

												}else{

													echo "<option selected value =".$row['id'].">".$row['Status']."</option>";
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="ManufactDate" class="col-lg-2 control-label">Дата изготовления</label>
									<div class="col-lg-10">
										<input type="date/month/week/time" class="form-control" name="ManufactDate" id="ManufactDate" placeholder="01.01.2014" value="<?php echo $ManufactDate;?>">
									</div>
								</div>
								<div class="form-group">
									<label for="InvNum" class="col-lg-2 control-label">Инв.№</label>
									<div class="col-lg-10">
										<input type="Text" class="form-control" name="InvNum" id="InvNum" placeholder="#" value="<?php echo $InvNum;?>">
									</div>
								</div>
								<div class="form-group">
									<label for="DevCode" class="col-lg-2 control-label">Код оборудования</label>
									<div class="col-lg-10">
										<input type="Text" class="form-control" name="DevCode" id="DevCode" placeholder="#" value="<?php echo $DevCode; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="MeasureCode" class="col-lg-2 control-label">Код вида измерений</label>
									<div class="col-lg-10">
										<select name="MeasureCode" type="MeasureCode" class="form-control" id="MeasureCode">
											<option value="">---</option>
											<?php
											$sql="select * from tMeasureCodes order by id asc";
											$result = $con->query($sql);
											while ($row = $result->fetch_assoc()) {
												if ($MeasureCode!=$row['id']){
													echo "<option value =".$row['id'].">".$row['Name']."</option>";
												}else{

													echo "<option selected value = ".$row['id'].">".$row['Name']."</option>";
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-offset-2 col-lg-4">
										<button type="submit" class="btn btn-primary">Сохранить</button>
									</div>
								</div>
							</form>

						</div><!-- panel body -->
                    </div><!-- panel -->
				</div><!-- col-md-6 -->
		</div><!-- panel-group -->
	</div><!-- col-md-12 -->
</div><!-- container -->




<script type="text/javascript">

$(document).ready(function(){

	var $table = $('#detail_tbl');
	$table.bootstrapTable({});
	var $table = $('#pkg_tbl');
	$table.bootstrapTable({});
	var $table = $('#char_tbl');
	$table.bootstrapTable({});
	var $table = $('#pov_tbl');
	$table.bootstrapTable({});
	var $table = $('#serv_tbl');
	$table.bootstrapTable({})

//********************************
//      Add & Remove Calibration
//********************************
$("#pov_frm").submit(function(e){
    e.preventDefault();
   var formData = new FormData($(this).get(0));
     $.ajax({
	                url: 'get_main.php?q=add_pov',
	                dataType: 'text',
	                cache: false,
	                contentType: false,
                    processData: false,
	                data: formData,
	                type: 'post',
	                success: function( data ) {
			var $table = $('#pov_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		}
     });
    return false;
});

    $("#pov_tbl").on('click','.rm-pov',function(e){
		var $id = $(this).attr('value');
        var $SiId=$( '#SiId' ).attr('value');
        var $fname=$(this).attr('data-fname');
		$.post( "get_main.php?q=rm_pov", {id: $id , SiId: $SiId , fname: $fname })
		.done(function( data ) {

			var $table = $('#pov_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
	});


//********************************
//          Add & Remove Package
//********************************
	$("#add_pkg").click(function(e){
		$.post( "get_main.php?q=add_pkg", $( "#pkg_frm" ).serialize())
		.done(function( data ) {

			var $table = $('#pkg_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
	});

	$("#pkg_tbl").on('click','.rm-pkg',function(e){
		var $id = $(this).attr('value');
        var $SiId=$( '#SiId' ).attr('value');

		$.post( "get_main.php?q=rm_pkg", {id:$id , SiId: $SiId})
		.done(function( data ) {

			var $table = $('#pkg_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
	});

//********************************
//          Add & Remove Character
//********************************
	$("#add_char").click(function(e){
		$.post( "get_main.php?q=add_char", $( "#char_frm" ).serialize())
		.done(function( data ) {

			var $table = $('#char_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
        });
    $("#char_tbl").on('click','.rm-char',function(e){
		var $id = $(this).attr('value');
        var $SiId=$( '#SiId' ).attr('value');
		$.post( "get_main.php?q=rm_char", {id:$id , SiId: $SiId})
		.done(function( data ) {

			var $table = $('#char_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
	});

//********************************
//          Add & Remove Service
//********************************
	$("#add_serv").click(function(e){
		$.post( "get_main.php?q=add_serv", $( "#serv_frm" ).serialize())
		.done(function( data ) {

			var $table = $('#serv_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
	});

});
</script>

</body>
</html>
