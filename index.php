<?php
require 'db.php';
require 'title.php';
?>

<div class="container-fluid">
	<div class="col-md-12">
		<div class="page-header">
			<!-- <h1>
				Main
			</h1> -->
		</div>


		<div class="panel panel-primary">
			<div class="panel-heading ">
				<span class="">
					Main
				</span>


			</div>

			<div class="panel-body">


				<div class="row">
					<div class="col-md-12">
					<input type="checkbox" name="missed" id="missed">На поверку

						<table id="table"
						class="table table-striped table-bordered table-condensed"
						data-url="get_main.php?q=get_main"
						data-method="POST"
						data-height="700"
						data-search="true"
						data-show-refresh="true"
                        data-show-export="true"
						data-show-toggle="true"
						data-show-columns="true"
						data-mobile-responsive="true" >
						<thead>
							<th data-sortable="true" data-field="SiId"> SiId</th>
							<th data-sortable="true" data-field="Name">Name</th>
							<th data-sortable="true" data-field="SN">SN</th>
							<th data-sortable="true" data-field="IsMeasure">Is<br>Measure</th>
							<th data-sortable="true" data-field="NextPov">NextPov</th>
							<th data-sortable="true" data-field="DevCode">DevCode</th>
							<th data-sortable="true" data-field="nWorkPlace">nWorkPlace</th>
							<th data-sortable="true" data-field="Placement">Placement</th>
							<th data-sortable="true" data-field="Department">Department</th>
							<th data-sortable="true" data-field="RespPerson">RespPerson</th>
							<th data-sortable="true" data-field="Type">Type</th>
							<th data-sortable="true" data-field="Status">Status</th>
							<th data-sortable="true" data-field="ManufactDate">Manufact<br>Date</th>
							<th data-field="Action">Action</th>
						</thead>

					</table>
				<p id="count" name="count">Записей:</p>
				</div>
			</div>
		</div>
		</div>


<!--*********************************************************************************-->

<div id="PovModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
<h4 class="modal-title">Поверка</h4>
</div>
<div class="modal-body">

<div class="panel  panel-primary" id="pov-panel">
						<div class="panel-heading ">
							<span class="" id="tbl_title">Поверка/калибровка</span>
						</div><!-- panel-heading -->
						<div class="panel-body">
					<form enctype="multipart/form-data" class="form-horizontal" role="form" id="pov_frm"  method="POST" >
				<input type="hidden" class="form-control" name="SiId" id="SiId" value="" >
				<div class="form-group">
					<label for="PovDate" class="col-lg-2 control-label">Дата</label>
					<div class="col-lg-7">
						<input type="Text" class="form-control" name="PovDate" id="PovDate" placeholder="2014-01-01">
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

				<div id="target-div1"></div>
			
			</form>
			<!-- <div class="form-group"> -->
				<div class="col-lg-offset-2 col-lg-10">
					<button id="add_pov" class="btn btn-primary">Добавить</button>
				</div>
			<!-- </div> -->

			<div class="table-responsive">
				<table
				id="pov_tbl"
				class="table table-striped table-bordered table-condensed"
				data-method="POST"
				data-height="200"
				data-show-refresh="true"
				data-mobile-responsive="true" >
				<thead>
					<th data-field="id" data-sortable="true"> id</th>
					<th data-field="PovDate" data-sortable="true">Дата</th>
					<th data-field="Doc" data-sortable="true">Документ</th>
					<th data-field="Action">Action</th>
				</thead>

			</table>
		</div>
						</div><!-- panel body -->
					</div><!-- panel -->
    </div><!-- modal-body -->
<div class="modal-footer">
<button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>
</div><!-- modal-footer -->
</div><!-- modal-contenet -->
</div><!-- modal-dialog -->
</div><!-- class-modal-fade -->

<!--***********************************************************************************-->
</div><!-- Col-md-12 -->
		</div><!-- Container-fluid -->

<!--
		<script type="text/javascript">
		  $(document).ready(function () {

		$('#count').text($rowCount+' записей.');
		$('#table').DataTable( {
		        dom: 'Bfrtip',
		        buttons: [
		            'print'
		        ]
		    } );
		  });
		</script>
-->



<script type="text/javascript">
$(document).ready(function(){
    $('#target-div1').JSAjaxFileUploader({
        uploadUrl:'upload.php'
    });

    $('#table').bootstrapTable({
    onLoadSuccess: function (e,data) {
        var $rowCount=$('#table').bootstrapTable('getData').length;

        $('#count').text($rowCount+' записей.');
    },
    onSearch: function () {
        var $rowCount=$('#table').bootstrapTable('getData').length;
         $('#count').text($rowCount+' записей.');
    }
});

$("#pov_tbl").bootstrapTable({});


$("#table").on('click','.pov-btn',function(e){
//		var $id = $(this).attr('value');
        var $SiId=$(this ).attr('id');
    $("#SiId").val($SiId);
    $("#tbl_title").text($(this).attr('siname'));
		$.post( "get_main.php?q=get_pov&SiId="+$SiId, {SiId: $SiId})
		.done(function( data ) {

			var $table = $('#pov_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
	});

    $("#add_pov").click(function(e){
		$.post( "get_main.php?q=add_pov", $( "#pov_frm" ).serialize())
		.done(function( data ) {

			var $table = $('#pov_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
	});


    $("#missed").change(function(){
		if ($('#missed').prop('checked')) {
		$.post( "get_main.php?q=get_missed")
		.done(function( data ) {
			var $table = $('#table');
			$table.bootstrapTable('load',JSON.parse(data));

	//	return true;
		});
		}
		$.post( "get_main.php?q=get_main")
		.done(function( data ) {
			var $table = $('#table');
			$table.bootstrapTable('load',JSON.parse(data));

	//	return false;
	});
	});




  //  $('#table').on('load-success.bs.table',function(){
//  	     var $rowCount=$('#table').bootstrapTable('getOptions').totalRows;
//         $('#count').text($rowCount+' записей.');
//        });



});

</script>


	</body>
	</html>
