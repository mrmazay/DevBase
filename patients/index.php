<?php
header("Content-Type: text/html; charset=windows-1251");
require 'db_mcmed.php';
require 'title.php';
?>

  <!--//**************************************************************************************-->
  <?php


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
AND PatGroup.Name LIKE '%КИ%'

ORDER BY Persons.MCNum DESC";
//OR Persons.MCNum=7711003
// AND Persons.MCNum=7711003
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
                  <th data-field="MCNum" data-sortable="true" >№ЭМК</th>
                  <th data-field="LastName" data-sortable="true">Фамилия</th>
                  <th data-field="FirstName" data-sortable="true">Имя</th>
                  <th data-field="MiddleName" data-sortable="true">Отчество</th>
                  <th data-field="Sex" data-sortable="true">Пол</th>
                  <th data-field="CrTime" data-sortable="true">Последний визит</th>
                  <th data-field="BirthDate" data-sortable="true">Дата рождения</th>
                  <th data-field="PhoneNumber" data-sortable="true">Тел.</th>
                  <th data-field="Address" data-sortable="true">Адрес</th>
                  <th data-field="AddCode2" data-sortable="true">Гражданство</th>
                  <th data-field="Email" data-sortable="true">Email</th>
                  <th data-field="PropertyValue" data-sortable="true">Раса</th>
                  <th data-field="Memo" data-sortable="true">Примечание</th>
                  <th data-field="Series" data-sortable="true">Паспорт:серия</th>
                  <th data-field="Number" data-sortable="true">Паспорт:№</th>
                  <th data-field="IssuePlace" data-sortable="true">Паспорт:выдан</th>
                  <th data-field="IssueDate" data-sortable="true">Паспорт:дата выдачи</th>
                  <th data-field="Action">Action</th>
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
