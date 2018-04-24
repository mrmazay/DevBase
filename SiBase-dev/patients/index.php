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
            <table id="table" class="table table-striped table-bordered table-condensed"
                    data-height="460" data-search="true" data-show-print="true" data-show-columns="true" data-mobile-responsive="true" >
              <thead>
                <tr >
                  <th data-sortable="true">#</th>
                  <th data-field="MCNum" data-sortable="true" >№ЭМК</th>
                  <th data-sortable="true">Фамилия</th>
                  <th data-sortable="true">Имя</th>
                  <th data-sortable="true">Отчество</th>
                  <th data-sortable="true">Пол</th>
                  <th data-sortable="true">Последний визит</th>
                  <th data-sortable="true">Дата рождения</th>
                  <th data-sortable="true">Тел.</th>
                  <th data-sortable="true">Адрес</th>
                  <th data-sortable="true">Гражданство</th>
                  <th data-sortable="true">Email</th>
                  <th data-sortable="true">Раса</th>
                  <th data-sortable="true">Примечание</th>
                  <th data-sortable="true">Паспорт:серия</th>
                  <th data-sortable="true">Паспорт:№</th>
                  <th data-sortable="true">Паспорт:выдан</th>
                  <th data-sortable="true">Паспорт:дата выдачи</th>
                  <th >Action</th>
                </tr>
              </thead>
              <tbody>
                <?php    $i=1; while ($rowList = odbc_fetch_array($res)) {

				$sex=$rowList['Sex'];
				if ($sex=='5233'){
					$sex='М';
				}
				if ($sex=='5234'){
					$sex='Ж';
				}
				?>
                <tr>
                  <td><?php echo $i                         ?></td>
                  <td><?php echo $rowList['MCNum'];         ?></td>
                  <td><?php echo $rowList['LastName'];      ?></td>
                  <td><?php echo $rowList['FirstName'];     ?></td>
                  <td><?php echo $rowList['MiddleName'];    ?></td>
                  <td><?php echo $sex 					    ?></td>
                  <td><?php echo $rowList['CrTime'];        ?></td>
                  <td><?php echo $rowList['BirthDate'];     ?></td>
                  <td><?php echo $rowList['PhoneNumber'];   ?></td>
                  <td><?php echo $rowList['Address'];       ?></td>
                  <td><?php echo $rowList['AddCode2'];      ?></td>
                  <td><?php echo $rowList['Email'];         ?></td>
                  <td><?php echo $rowList['PropertyValue']; ?></td>
                  <td><?php echo $rowList['Memo'];          ?></td>
                  <td><?php echo $rowList['Series'];        ?></td>
                  <td><?php echo $rowList['Number'];        ?></td>
                  <td><?php echo $rowList['IssuePlace'];    ?></td>
                  <td><?php echo $rowList['IssueDate'];     ?></td>
                  <td><?php echo ('<a class="btn btn-primary btn-xs"  href=detail.php?MCNum='.$rowList['MCNum'].'>Detail</a>'); ?></td>
                </tr>
                <?php
                $i++;
              }   ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>





<!-- <script src="js/jquery-1.11.1.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
<script src="https://rawgit.com/yaronyam/bootstrap-table/feature/print/src/extensions/print/bootstrap-table-print.js"></script>
<script type="text/javascript">

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

});
</script>
<script type="text/javascript">
  $(document).ready(function () {
var $rowCount = $('#table tr').length;
$('#count').text($rowCount+' записей.');
$('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
  });
</script>
</body>
</html>
