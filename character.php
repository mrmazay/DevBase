<?php
require 'title.php';
require 'db.php';


$SiId=$_GET['SiId'];
$Charact=$_POST['Charact'];
$Value=$_POST['Value'];



if(!empty($Charact) && !empty($Value)&& !empty($SiId)) {

  $sql="INSERT INTO 'tCharacter' ('SiId','Charact','Value') 
  VALUES ('$SiId','$Charact','$Value')";

  $query = $con->query($sql);

}

?>



<br>
<div class="container">
  <div class="col-md-12">
    <form class="form-horizontal" role="form"  method="POST" >
      <input type="hidden" class="form-control" name="SiId" id="SiId" value=<?echo "'".$SiId."'"; ?>>
      <div class="form-group">
       <label for="SiId" class="col-lg-2 control-label">Character</label>
       <div class="col-lg-7">
         <input type="Text" class="form-control" name="Charact" id="Charact" placeholder="Character">
       </div>
       <div class="col-lg-2">
       </div>
     </div>
     <div class="form-group">
       <label for="SiId" class="col-lg-2 control-label">Value</label>
       <div class="col-lg-2">
         <input type="Text" class="form-control" name="Value" id="Value" placeholder="Value">
       </div>
       <div class="col-lg-2">

       </div>
     </div>

     <div class="form-group">
       <div class="col-lg-offset-2 col-lg-10">
         <button type="submit" id="add_btn" class="btn btn-default">Add</button>
       </div>
     </div>
   </form>
 </div>

 <!-- ******************************************************************************* -->

 

 <div class="table-responsive">
  <table id="table" class="table table-striped table-bordered table-condensed" data-height="460" data-search="true" data-show-toggle="true" data-show-columns="true" data-mobile-responsive="true" > 
   <thead>
    <th data-sortable="true"> id</th>
    <th data-sortable="true">Character</th>
    <th data-sortable="true">Value</th>
    <th>Action</th>	
  </thead>
  <tbody>
   <?	$sql="select * from tCharacter where SiId='".$SiId."'";
 //echo $sql;
 //echo $SiId;
   $query = $con->query($sql);

   while ($rowList = $query->fetchArray()){   ?>
   <tr> 				        
    <td class="td_7"><?php echo $rowList['id']; ?></td>
    <td class="td_7"><?php echo $rowList['Charact']; ?></td>
    <td class="td_7"><?php echo $rowList['Value']; ?></td>
    <td class="act_td"><a href="edit.php?SiId=<?echo $rowList['SiId']; ?>">edit</a></td>
  </tr>	
  <?php 
}   ?>
</tbody>
</table>
</div>
</div>



<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- <script type="text/javascript">		

$('#add_btn').click(function(){
var SiId = $('#SiId').val();
var Name = $('#Name').val();
var Count = $('#Count').val();
var units = $('#units').val();
   if(SiId.length == '' || Name.length == ''||Count.length == '' ) {
       alert('Заполните все поля!');
   } else {
       // speckyboy.init.addTodo(todo_item_text,todo_due_date);
       $('#Name').val('');
       $('#Count').val('');
   }
});
</script> -->
</body>
</html>