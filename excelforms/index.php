<?php
//session_start();
//header("Content-Type: text/html; charset=UTF-8");
require_once 'db.php';
require_once 'title.php';
include_once 'auth.php';

?>
<!--//**************************************************************************************-->
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="page-header">
  <!--     <h1>
        Main
      </h1> -->

    </div>


    <div class="panel panel-primary">
      <div class="panel-heading ">
        <span id="count" class="">
        Main
      </span>


    </div>

    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">


 <div id="toolbar" class="btn-group">

    <button type="button" id="export_btn" class="btn btn-default">
        <i class="glyphicon glyphicon-export"></i>
    </button>

    <?php

    if (isset($_SESSION['isAdm'])&& $_SESSION['isAdm'] == '1'){
    echo "<button type=\"button\" id=\"export_btn\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#add_frm_modal\">
        <i class=\"glyphicon glyphicon-plus\"></i>
    </button>";
}
    ?>
</div>
            <table id="table" class="table table-striped table-bordered table-condensed"
                   data-height="460"
                   data-search="true"
                   data-show-print="true"
                   data-show-refresh="true"
                   data-show-columns="true"
                   data-show-export="true"
                   data-mobile-responsive="true"
                   data-toolbar="#toolbar"
                   data-url="get_main.php?q=get_main">
              <thead>
                <tr >

                  <!-- <th data-sortable="true">#</th> -->
                  <th data-field="id" data-sortable="true" style="width: 10%" >id</th>
                  <th data-field="Name" data-sortable="true" >Code</th>
                  <th data-field="Description" data-sortable="true">Description</th>
                  <th data-field="Hash" data-sortable="true">MD5 Hash</th>
                  <th data-field="CrTime" data-sortable="true">CrTime</th>
                  <th data-field="Action" data-sortable="true">Action</th>
                </tr>
              </thead>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!--
//********************************
//   Modal Add Device
//********************************
 -->
<div id="add_frm_modal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
<h4 class="modal-title">Добавить форму</h4>
</div>
<div class="modal-body">

<div class="panel  panel-primary" id="add_si-panel">
						<div class="panel-heading ">
							<span class="" id="si_tbl_title">Добавить форму</span>
						</div><!-- panel-heading -->
						<div class="panel-body">
						<form class="form-horizontal" role="form" id="add_form_frm"  method="POST" >
<!--			<input type="hidden" class="form-control" name="SiId" id="SrvSiId" value="">-->
			<div class="form-group">
				<label for="Name" class="col-lg-2 control-label">Код</label>
				<div class="col-lg-10">
					<input type="Text" class="form-control" name="Name" id="Name">
				</div>
				<div class="col-lg-2">
				</div>
			</div>
			<div class="form-group">
				<label for="Description" class="col-lg-2 control-label">Описание</label>
				<div class="col-lg-10">
					<input type="Text" class="form-control" name="Description" id="Description" >
				</div>
				<div class="col-lg-2">

				</div>
			</div>

			<div class="form-group">
					<label for="file" class="col-lg-2 control-label">Скан</label>
			<div class="col-lg-3">
            <input id="File" name="filename" type="file">
            </div>
				</div>
			<div class="col-lg-offset-2 col-lg-10">
			<button type="submit"  id="add_frm_btn" class="btn btn-primary">Добавить</button>
			</div>
		</form>
<!--		<div class="form-group">-->

<!--		</div>-->


						</div><!-- panel body -->
					</div><!-- panel -->


    </div><!-- modal-body -->
<div class="modal-footer">
<button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>
</div><!-- modal-footer -->
</div><!-- modal-contenet -->
</div><!-- modal-dialog -->
</div><!-- class-modal-fade -->
<!-- ***********************************************************-->

</div>
</div>





<!-- <script src="js/jquery-1.11.1.min.js"></script> -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<!--<script src="js/bootstrap-table.js"></script>-->
<!--<script src="https://rawgit.com/yaronyam/bootstrap-table/feature/print/src/extensions/print/bootstrap-table-print.js"></script>-->
<script type="text/javascript">
$(document).ready(function(){
 var $table = $('#table');
 $table.bootstrapTable({
  search: true,
  pagination: false,
  buttonsClass: 'primary',
  showFooter: false,
  minimumCountColumns: 2,
  select: true,
  height: 700,
  width: 500,
  clickToSelect: true,
  singleSelect: true,
  striped: true,
  detailView: false,
onLoadSuccess: function (e,data) {
        var $rowCount=$('#table').bootstrapTable('getData').length;

        $('#count').text($rowCount+' записей.');
       // $('#table').tableExport({type:'excel'});
    },
    onPostBody: function () {
        var $rowCount=$('#table').bootstrapTable('getData').length;
         $('#count').text($rowCount+' записей.');
    }
});

   $("#add_form_frm").submit(function(e){
    e.preventDefault();
   var formData = new FormData($(this).get(0));
     $.ajax({
	                url: 'get_main.php?q=add_frm',
	                dataType: 'text',
	                cache: false,
	                contentType: false,
                    processData: false,
	                data: formData,
	                type: 'post',
	                success: function( data ) {
			alert(data);
		}
     });
    return false;
});

$('#export_btn').click(function(){
  $('#table').tableExport({type:'excel'});
})
  });

</script>
</body>
</html>
