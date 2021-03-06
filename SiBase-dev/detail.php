<?php
require 'db.php';
require 'title.php';

$SiId		 = $_POST['SiId']; //$intLat = !empty($intLat) ? "'$intLat'" : NULL;
$Name   	 = $_POST['Name'];
$SN 		 = $_POST['SN'];
$InvNum 	 = $_POST['InvNum'];
$DevCode 	 = $_POST['DevCode'];
$nWorkPlace  = $_POST['nWorkPlace'];
$Placement 	 = $_POST['Placement'];
$Department  = $_POST['Department'];
$RespPerson  = $_POST['RespPerson'];
$ManufactDate= $_POST['ManufactDate'];
$Type 		 = $_POST['Type'];
$Status 	 = $_POST['Status'];
$MeasureCode = $_POST['MeasureCode'];
$IsMeasure   = $_POST['IsMeasure'];
$PovPeriod   = $_POST['PovPeriod'];
$Active      = $_POST['Active'];


//<!--    ***************************************************************************************  -->
//<!--                                        Main update                                           -->
//<!--    ***************************************************************************************  -->

if (($_GET['q']=='update') && (!empty($_GET['SiId']))){

$sql="UPDATE `tSI` SET
    `Name`=        ?,
	`SN`=          ?,
	`InvNum`=      ?,
	`DevCode`=     ?,
	`nWorkPlace`=  ?,
	`Placement`=   ?,
	`Department`=  ?,
	`RespPerson`=  ?,
	`ManufactDate`=?,
	`Type`=        ?,
	`Status`=      ?,
	`MeasureCode`= ?,
    `IsMeasure`=   ?,
    `PovPeriod`=   ?,
    `Active`=      ?
	WHERE SiId=    ?;";
if ($IsMeasure && !$PovPeriod){
    $PovPeriod=12;
  echo "<script>alert('Warning! Period set to 12.')</script>";
}
$stmt = mysqli_prepare($con, $sql);
$stmt->bind_param("sssssiiisiiiiiii",$Name,$SN,$InvNum,$DevCode,$nWorkPlace,$Placement,$Department,$RespPerson,$ManufactDate,$Type,$Status,$MeasureCode,$IsMeasure,$PovPeriod,$Active,$SiId);
$result = $stmt->execute();
if (!$result){
    echo $sqlю."\n";
    echo $Active;
    var_dump ($result);
    echo "<script>alert('Update error! Check input data.')</script>";
}

}//Update

$SiId=$_GET['SiId'];
$sql="SELECT *
FROM tSI AS SI
WHERE SI.SiId=$SiId
ORDER BY SI.SiId desc;";
//	echo "stop2";
$result =  $con->query($sql);
while ($row = $result->fetch_assoc()) {

	$Name   	 = $row['Name'];
	$SN 		 = $row['SN'];
	$InvNum 	 = $row['InvNum'];
	$DevCode 	 = $row['DevCode'];
	$nWorkPlace  = $row['nWorkPlace'];
	$Placement 	 = $row['Placement'];
	$Department  = $row['Department'];
	$RespPerson  = $row['RespPerson'];
	$ManufactDate= $row['ManufactDate'];
	$Type 		 = $row['Type'];
	$Status 	 = $row['Status'];
	$MeasureCode = $row['MeasureCode'];
    $IsMeasure   = $row['IsMeasure'];
    $PovPeriod   = $row['PovPeriod'];
    $Active      = $row['Active'];
}
?>


<div class="container-fluid">
	<div class="col-md-12">
		<div class="page-header">
		</div> <!-- Page Header -->

		<div class="panel-group">

			<div class="row" id="row-1">
<!--    ***************************************************************************************  -->
<!--                                        Main Prop/                                           -->
<!--    ***************************************************************************************  -->
				<div class="col-md-6">
					<div class="panel  panel-primary" id="main-panel">
						<div class="panel-heading ">
							<span class="" id="tbl_title">Общие</span>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<!-- *************************************************************** -->

							<form class="form-horizontal" role="form" method="POST" action="detail.php?SiId=<?php echo $SiId?>&q=update">

								<div class="form-group">
									<label for="SiId" class="col-lg-2 control-label">SiId</label>
									<div class="col-lg-10">
										<input type="Text" class="form-control" name="SiId" id="SiId" placeholder=<?php echo $SiId?> value="<?php echo $SiId;?>">
									</div>
								</div>
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
<!--											<option value="">---</option>-->
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
<!--											<option value="">---</option>-->
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
<!--											<option value="">---</option>-->
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
<!--											<option value="">---</option>-->
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
                                            <?php

												if ($IsMeasure<>0){

													echo "<option selected value =\"1\">СИ</option>";
                                                    echo "<option value =\"0\">Не СИ</option>";

												}else{

													echo "<option  value =\"1\">СИ</option>";
                                                    echo "<option selected value =\"0\">Не СИ</option>";
												}


											?>
										</select>

									</div>
								</div>
                                <div class="form-group">
									<label for="PovPeriod" class="col-lg-2 control-label">Межповерочн. интервал(мес.)</label>
									<div class="col-lg-10">
										<input type="Text" class="form-control" name="PovPeriod" id="PovPeriod" placeholder="12" value="<?php
                                                                                                                                 if (!empty($PovPeriod))
                                                                                                                                     {
                                                                                                                                     echo $PovPeriod;
                                                                                                                                     }else{
                                                                                                                                     echo "0";
                                                                                                                                 }
                                                                                                                                 ?>">

									</div>
								</div>
								<div class="form-group">
									<label for="Status" class="col-lg-2 control-label">Состояние</label>
									<div class="col-lg-10">
										<select name="Status" type="Status" class="form-control" id="Status">
<!--											<option value="">---</option>-->
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
										<input type="date/month/week/time" class="form-control" name="ManufactDate" id="ManufactDate" pattern="\d{4}-\d{2}-\d{2}" placeholder="2014-01-01" value="<?php echo $ManufactDate;?>">
									</div>
								</div>
								<div class="form-group">
									<label for="InvNum" class="col-lg-2 control-label">Инв.№</label>
									<div class="col-lg-10">
										<input type="Text" class="form-control" name="InvNum" id="InvNum" placeholder="#" value="<?php
                                                                                                                                 if (!empty($InvNum))
                                                                                                                                     {
                                                                                                                                     echo $InvNum;
                                                                                                                                     }else{
                                                                                                                                     echo "-";
                                                                                                                                 }
                                                                                                                                 ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="DevCode" class="col-lg-2 control-label">Код оборудования</label>
									<div class="col-lg-10">
										<input type="Text" class="form-control" name="DevCode" id="DevCode" placeholder="#" value="<?php
                                                                                                                                 if (!empty($DevCode))
                                                                                                                                     {
                                                                                                                                     echo $DevCode;
                                                                                                                                     }else{
                                                                                                                                     echo "-";
                                                                                                                                 }
                                                                                                                                 ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="MeasureCode" class="col-lg-2 control-label">Код вида измерений</label>
									<div class="col-lg-10">
										<select name="MeasureCode" type="MeasureCode" class="form-control" id="MeasureCode">
<!--											<option value="">---</option>-->
											<?php
											$sql="select * from tMeasureCodes order by id asc";
											$result = $con->query($sql);
											while ($row = $result->fetch_assoc()) {
												if ($MeasureCode!=$row['id']){
													echo "<option value =".$row['id'].">".htmlspecialchars($row['Name'])."</option>";
												}else{

													echo "<option selected value = ".$row['id'].">".htmlspecialchars($row['Name'])."</option>";
												}
											}
											?>
										</select>
									</div>
								</div>

                                <div class="form-group">
									<label for="Active" class="col-lg-2 control-label">Активен:</label>
									<div class="col-lg-10">
										<select name="Active" type="Active" class="form-control" id="Active">
                                            <?php

												if ($Active<>0){

													echo "<option selected value =\"1\">Активен</option>";
                                                    echo "<option value =\"0\">Не активен</option>";

												}else{

													echo "<option  value =\"1\">Активен</option>";
                                                    echo "<option selected value =\"0\">Не активен</option>";
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

<!--    ***************************************************************************************  -->
<!--                                        Package                                              -->
<!--    ***************************************************************************************  -->

				<div class="col-md-6">
					<div class="panel  panel-primary" id="package-panel">
						<div class="panel-heading ">
							<span class="" id="tbl_title">Комплект</span>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<form class="form-horizontal" role="form" id="pkg_frm"  method="POST" >
						<input type="hidden" class="form-control" name="SiId" id="SiId" value="<?php echo "'".$SiId."'"; ?>">
						<div class="form-group">
							<label for="Name" class="col-lg-2 control-label">Название</label>
							<div class="col-lg-7">
								<input type="Text" class="form-control" name="Name" id="Name" placeholder="Name">
							</div>
							<div class="col-lg-2">
							</div>
						</div>
						<div class="form-group">
							<label for="Count" class="col-lg-2 control-label">Количество</label>
							<div class="col-lg-2">
								<input type="Text" class="form-control" name="Count" id="Count" placeholder="Count">
							</div>
							<div class="col-lg-2">
								<select name="units" type="units" class="form-control" id="units">
									<option>шт.</option>
									<option>экз.</option>
                                    <option>пар</option>
								</select>
							</div>
						</div>
					</form>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button id="add_pkg" class="btn btn-primary">Добавить</button>
						</div>
					</div>

						<!-- <div class="col-lg-offset-2 col-lg-10">
						<button id="add_pkg" class="btn btn-primary">Добавить</button>
					</div> -->
					<div class="table-responsive">
						<table id="pkg_tbl"
						class="table table-striped table-bordered table-condensed"
						data-url="get_main.php?q=get_pkg&SiId=<?php echo $SiId?>"
						data-method="POST"
						data-height="200"

						data-show-refresh="true"

						data-mobile-responsive="true" >
						<thead>
							<th data-field="id" data-sortable="true"> id</th>
							<th data-field="Name" data-sortable="true">Название</th>
							<th data-field="Count" data-sortable="true">Количество</th>
							<th data-field="Action">Action</th>
						</thead>

					</table>
				</div>
						</div><!-- panel body -->
					</div><!-- panel -->
				</div><!-- col-md-6 -->

<!--    ***************************************************************************************  -->
<!--                                        Character                                            -->
<!--    ***************************************************************************************  -->

				<div class="col-md-6">
					<div class="panel  panel-primary" id="char-panel">
						<div class="panel-heading ">
							<span class="" id="tbl_title">Характеристики</span>
						</div><!-- panel-heading -->
						<div class="panel-body">
							<form class="form-horizontal" role="form" id="char_frm"  method="POST" >
					<input type="hidden" class="form-control" name="SiId" id="SiId" value="<?php echo "'".$SiId."'"; ?>">
					<div class="form-group">
						<label for="Character" class="col-lg-2 control-label">Название</label>
						<div class="col-lg-7">
							<input type="Text" class="form-control" name="Charact" id="Charact" placeholder="Character">
						</div>
						<div class="col-lg-2">
						</div>
					</div>
					<div class="form-group">
						<label for="Value" class="col-lg-2 control-label">Значение</label>
						<div class="col-lg-7">
							<input type="Text" class="form-control" name="Value" id="Value" placeholder="Value">
						</div>
						<div class="col-lg-2">

						</div>
					</div>
				</form>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button  id="add_char" class="btn btn-primary">Добавить</button>
					</div>
				</div>


				<div class="table-responsive">
					<table id="char_tbl"
					class="table table-striped table-bordered table-condensed"
					data-url="get_main.php?q=get_char&SiId=<?php echo $SiId?>"
					data-method="POST"
					data-height="200"
					data-show-refresh="true"
					data-mobile-responsive="true" >

					<thead>
						<th data-field="id" data-sortable="true"> id</th>
						<th data-field="Charact" data-sortable="true">Имя</th>
						<th data-field="Value" data-sortable="true">Значение</th>
						<th data-field="Action" >Action</th>
					</thead>

				</table>
			</div>
						</div><!-- panel body -->
					</div><!-- panel -->
				</div><!-- col-md-6 -->
			</div><!-- row -->
<!--    *************************************************************************************    -->
<!--                                     ROW-2
                                      Calibration                                                -->
<!--    *************************************************************************************    -->
			<div class="row" id="row-2">
				<div class="col-md-6">
					<div class="panel  panel-primary" id="pov-panel">
						<div class="panel-heading ">
							<span class="" id="tbl_title">Поверка/калибровка</span>
						</div><!-- panel-heading -->
						<div class="panel-body">
					<form enctype="multipart/form-data" class="form-horizontal" role="form" id="pov_frm"  method="POST" action="get_main.php?q=add_pov" >
				<input type="hidden" class="form-control" name="SiId" id="SiId" value="<?php echo "'".$SiId."'"; ?>">
				<div class="form-group">
					<label for="PovDate" class="col-lg-2 control-label">Дата</label>
					<div class="col-lg-2">
						<input type="Text" class="form-control" name="PovDate" id="PovDate" pattern="\d{4}-\d{2}-\d{2}" placeholder="2014-01-01">
					</div>
					<div class="col-lg-2">
					</div>
				</div>
				<div class="form-group">
					<label for="Doc" class="col-lg-2 control-label">Документ</label>
					<div class="col-lg-7">
						<input type="Text" class="form-control" name="Doc" id="Doc" placeholder="Документ">
					</div>
					<div class="col-lg-2">

					</div>
				</div>

				<div class="form-group">
					<label for="file" class="col-lg-2 control-label">Скан</label>
			<div class="col-lg-3">
            <input id="file" name="filename" type="file">
            </div>
				</div>

                <div class="col-lg-2">
            <button id="add_pov" class="btn btn-primary">Добавить</button>
				</div>
			</form>


			<div class="table-responsive">
				<table
				id="pov_tbl"
				class="table table-striped table-bordered table-condensed"
				data-url="get_main.php?q=get_pov&SiId=<?php echo $SiId?>"
				data-method="POST"
				data-height="200"
				data-show-refresh="true"
				data-mobile-responsive="true" >
				<thead>
					<th data-field="id" data-sortable="true"> id</th>
					<th data-field="PovDate" data-sortable="true">Дата</th>
					<th data-field="Doc" data-sortable="true">Документ</th>
                    <th data-field="File" data-sortable="true">Скан</th>
					<th data-field="Action">Action</th>
				</thead>

			</table>
		</div>
						</div><!-- panel body -->
					</div><!-- panel -->
				</div><!-- col-md-6 -->
<!--    ***************************************************************************************  -->
<!--                                        Service                                              -->
<!--    ***************************************************************************************  -->
				<div class="col-md-6">
					<div class="panel  panel-primary" id="serv-panel">
						<div class="panel-heading ">
							<span class="" id="tbl_title">Обслуживание</span>
						</div><!-- panel-heading -->
						<div class="panel-body">
						<form class="form-horizontal" role="form" id="serv_frm"  method="POST" >
			<input type="hidden" class="form-control" name="SiId" id="SiId" value="<?php echo "'".$SiId."'"; ?>">
			<div class="form-group">
				<label for="SiId" class="col-lg-2 control-label">Дата</label>
				<div class="col-lg-10">
					<input type="Text" class="form-control" name="ServDate" id="ServDate" pattern="\d{4}-\d{2}-\d{2}" placeholder="2014-01-01">
				</div>
				<div class="col-lg-2">
				</div>
			</div>
			<div class="form-group">
				<label for="ServType" class="col-lg-2 control-label">Вид</label>
				<div class="col-lg-10">
					<input type="Text" class="form-control" name="ServType" id="ServType" placeholder="ServType">
				</div>
				<div class="col-lg-2">

				</div>
			</div>
            <div class="form-group">
				<label for="Description" class="col-lg-2 control-label">Описание</label>
				<div class="col-lg-10">
<!--
				<div class="select-editable">
            <select onchange="this.nextElementSibling.value=this.value">
--><input list="Descriptions" name="Description">
                    <datalist id="Desccriptions">
                <option value="Чистка. Проверка тех. сост.">
                <option value="Метрологическая аттестация">
                <option value="Чистка. Калибровка.">
                <option value="Квалификация">
                    </datalist>
<!--
            </select>
            <input type="Text" class="form-control" name="Description" id="Description" placeholder="Description" value="Чистка. Проверка тех. сост.">
-->
<!--                </div>-->
				</div>
				<div class="col-lg-2">

				</div>
			</div>
			<div class="form-group">
				<label for="Executor" class="col-lg-2 control-label">Выполнил</label>
				<div class="col-lg-10">
					<input type="Text" class="form-control" name="Executor" id="Executor" placeholder="А.А. Леонов" value="А.А. Леонов">
				</div>

			</div>
			<div class="form-group">
				<label for="NextDate" class="col-lg-2 control-label">Дата следующего</label>
				<div class="col-lg-10">
					<input type="Text" class="form-control" name="NextDate" id="NextDate" pattern="\d{4}-\d{2}-\d{2}" placeholder="2014-01-01">
				</div>

			</div>
		</form>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
				<button  id="add_serv" class="btn btn-primary">Добавить</button>
			</div>
		</div>

		<div class="table-responsive">
			<table
			id="serv_tbl"
			class="table table-striped table-bordered table-condensed"
			data-url="get_main.php?q=get_serv&SiId=<?php echo $SiId?>"
			data-method="POST"
			data-height="200"
			data-show-refresh="true"
			data-mobile-responsive="true" >
			<thead>
				<th data-field="id" data-sortable="true"> id</th>
				<th data-field="ServDate" data-sortable="true">Дата</th>
				<th data-field="ServType" data-sortable="true">Вид</th>
				<th data-field="Description" data-sortable="true">Описание</th>
				<th data-field="Executor" data-sortable="true">Выполнил</th>
				<th data-field="NextDate" data-sortable="true">Дата след.</th>
				<th data-field="Action">Action</th>
			</thead>

		</table>
	</div>


						</div><!-- panel body -->
					</div><!-- panel -->
				</div><!-- col-md-6 -->
			</div><!-- row -->
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
      $("#serv_tbl").on('click','.rm-serv',function(e){
		var $id = $(this).attr('value');
        var $SiId=$( '#SiId' ).attr('value');
		$.post( "get_main.php?q=rm_serv", {id:$id , SiId: $SiId})
		.done(function( data ) {

			var $table = $('#serv_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
	});



});
</script>

</body>
</html>
