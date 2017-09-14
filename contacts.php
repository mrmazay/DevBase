<?php
require "title.php";
require "db.php";

?>

<div class="container">
	<div class="col-md-12">
		<div class="page-header">
			<!-- <h1>
				Add
			</h1> -->
		</div>


<div class="panel  panel-primary">
				<div class="panel-heading">
					<span class="" id="tbl_title">Контакты</span>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" id="pkg_frm"  method="POST" >
						<input type="hidden" class="form-control" name="SiId" id="SiId" value=<?php echo "'".$SiId."'"; ?>>
						<div class="form-group">
							<label for="dev" class="col-lg-2 control-label">Прибор</label>
							<div class="col-lg-7">
								<select type="Text" class="form-control" name="Dev" id="Dev" placeholder="Dev">
								<option selected value="">---</option>
								<?php
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
							<div class="col-lg-2">
							</div>
						</div>
						<div class="form-group">
							<label for="Org" class="col-lg-2 control-label">Организация</label>
							<div class="col-lg-7">
								<input type="Text" class="form-control" name="Org" id="Org" placeholder="Org">
							</div>
							<div class="col-lg-2">
							</div>
						</div>
						<div class="form-group">
							<label for="Description" class="col-lg-2 control-label">Описание</label>
							<div class="col-lg-7">
								<input type="Text" class="form-control" name="Description" id="Description" placeholder="Description">
							</div>
							
						</div>
					</form>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button id="add_contact" class="btn btn-primary">Добавить</button>
						</div>
					</div>
					
						<!-- <div class="col-lg-offset-2 col-lg-10">
						<button id="add_pkg" class="btn btn-primary">Добавить</button>
					</div> -->
					<div class="table-responsive">
						<table id="contacts_tbl" 
						class="table table-striped table-bordered table-condensed" 
						data-url="get_main.php?q=get_contacts"
						data-method="POST"  
						data-height="600" 
						data-search="true"
						data-show-refresh="true" 
						data-show-search="true" 
						 
						data-mobile-responsive="true" > 
						<thead>
							<th data-field="id" data-sortable="true"> id</th>
							<th data-field="SiId" data-sortable="true"> SiId</th>
							<th data-field="Name" data-sortable="true">Организация</th>
							<th data-field="Org" data-sortable="true">Описание</th>
							<th data-field="Action">Action</th>
						</thead>
						
					</table>
				</div>
			</div>
		</div>


		</div>
		</div>
		<script type="text/javascript">
			$("#add_contact").click(function(e){ 
		$.post( "pkg.php?q=add_contact", $( "#serv_frm" ).serialize())
		.done(function( data ) {
			
			var $table = $('#serv_tbl');
			$table.bootstrapTable('load',JSON.parse(data));
		});
	});


		</script>

		<script type="text/javascript">

			var $table = $('#contacts_tbl');
			$table.bootstrapTable({});
		</script>


	</body>
	</html>

