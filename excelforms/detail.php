<?php
header("Content-Type: text/html; charset=windows-1251");
require 'db_mcmed.php';
require 'title.php';
?>

  <!--//**************************************************************************************-->
  <?php

$McNum=$_GET['MCNum'];

  $sql="SELECT
       P.MCNum,
       S.SampleNum,
       R.RequestDate,
       RI.ActualDate,
       RI.Status,
       ET.ExamName,
       P.FullName AS PatientName,
       P.Age,
       E.Name AS ExamParamName,
       V.Value,
       M.UnitCode AS Units,
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

  $res = odbc_exec($con, $sql);


  ?>
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
        Results
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
                   data-url="get_main.php?q=get_results&MCNum=<?php echo $McNum;?>">
              <thead>
                <tr >
                 <!--  <th data-field="#" data-sortable="true">#</th> -->
                  <th data-field="MCNum" data-sortable="true" >№ЭМК</th>
                  <th data-field="SampleNum" data-sortable="true">SampleNum</th>
                  <th data-field="RequestDate" data-sortable="true">RequestDate</th>
                  <!-- <th data-field="ActualDate" data-sortable="true">ActualDate</th> -->
                  <th data-field="Status" data-sortable="true">Status</th>
                  <th data-field="ExamName" data-sortable="true">ExamName</th>
                  <th data-field="FullName" data-sortable="true">PatientName</th>
                  <!-- <th data-field="Age" data-sortable="true">Age</th> -->
                  <th data-field="Name" data-sortable="true">ExamParamName</th>
                  <th data-field="Value" data-sortable="true">Value</th>
                  <th data-field="UnitCode" data-sortable="true">Units</th>
                  <th data-field="Formula" data-sortable="true">Formula</th>
                  <th data-field="UFormula" data-sortable="true">UFormula</th>
                  <th data-field="Qualifier" data-sortable="true">Qualifier</th>
                </tr>
              </thead>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
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

// var $rowCount = $('#table tr').length;
// $('#count').text($rowCount+' записей.');
//$('#table').DataTable( {
//        dom: 'Bfrtip',
//        buttons: [
//            'print'
//        ]
//    } );
$('#export_btn').click(function(){
  $('#table').tableExport({type:'excel'});
})
  });

</script>
</body>
</html>
