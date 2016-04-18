<?php
include 'init.php'
 ?>
 <head>
   <script type="text/javascript" language="javascript" src="../js/datatables_script/media/js/jquery.dataTables.js"></script>
 <script type="text/javascript" language="javascript" src="../js/datatables_script/media/js/dataTables.responsive.js"></script>
 <script type="text/javascript" language="javascript" src="../js/datatables_script/media/js/dataTables.bootstrap.js"></script>
 <script type="text/javascript" language="javascript" src="../js/datatables_script/media/js/common.js"></script>
 <script type="text/javascript" language="javascript" ></script>
 </head>
<form id="form1" name="form1" method="post" action="../arsinergi/insertmp.php">
<div class='page-header'>
	<div class='btn-back-arrow' id="btn-menu">&nbsp;</div>
	<div class='page-header-title'>Master Project</div>
</div>
<div id="luasan" name="luasan" style="position:relative;padding:20px;">
	<div style='font-weight:bold; font-size:1.2em; margin-top:10px;'>Tambahkan Project Baru</div>
  <div style="width:95%; overflow-x:auto;overflow-y:visible; float:left;">
	<table class="table table-stripped' style='width:95%; overflow:auto; float:left;">
    <div id="linkscontainer">
          <div id="newlink">
		<thead>
			<tr>
				<th>Judul Proyek</th>
				<th>Tipe</th>
				<th>PIC</th>
				<th>Klien</th>
				<th>Luasan</th>
				<th>RAB</th>
				<th>Real Bahan</th>
				<th>Real Bahan Rupiah</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<input type="text" class="form-control" name="project_name" id="project-name" input style="width:200px" />
							</div>
						</div>
					</td>
					<td>
						<?php
							$result=mysqli_query($conn, "SELECT catpro_id, catpro_name FROM master_project_category WHERE catpro_status='enabled' ORDER BY catpro_name");
							echo "<select name='project_type' id='project-type' class='input' style='height:34px; width:100px'>";
							while($data=mysqli_fetch_array($result)){
								echo "<option value='".$data['catpro_id']."'>" .$data['catpro_name']. "</option>";
							}
							echo "</select>";
						?>
					</td>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<input type="text" class="form-control" name="project_pic" id="pic" style="width:100px"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<input type="text" class="form-control" name="project_client_name" id="client" style="width:100px"/>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group"  >
							<div class="input-group">
						    <input type="text" class="form-control" name="project_measurement_total" id="project-luasan" style="width:120px" onfocus="startCalculate()" onblur="stopCalc()"/>
						    <div class="input-group-addon">M2</div>
						  </div>
						</div>
					</td>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<div class="input-group-addon">Rp</div>
								<input type="text" class="form-control" name="project_rab_total" id="rab-total" style="width:100px"/>
								<div class="input-group-addon">,00</div>
							</div>
						</div>
					</td>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<div class="input-group-addon">Rp</div>
								<input type="text" class="form-control" name="project_rb_total" id="rb-total" style="width:100px"/>
								<div class="input-group-addon">,00</div>
							</div>
						</div>
					</td>
          <td>
            <div class="form-group"  >
              <div class="input-group">
                <div class="input-group-addon">Rp</div>
                <input type="text" class="form-control" name="project_rbupah_total" id="rb-upah" style="width:100px"/>
                <div class="input-group-addon">,00</div>
              </div>
            </div>
          </td>
			</tr>
		</tbody>
  </div>
  </div>
	</table>


	<button id="btn_save" name="tsave" type="Submit" class="btn btn-default btn-lg">
  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
</button>
	<div style="clear:both"></div>
	</div>

<?php include 'tables/project.php' ?>
	<!-- <div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan Data Baru</div>
	<div style="width:95%; overflow:auto; float:left;">
	<table id="tableRB" class='table table-stripped' style='width:1050px;'> -->

 <script>

 $(document).ready(function(){
 	$("#table-project").load("tables/project.php");
});
	$('#btn-menu').click(function(){
		window.location='setpage.php?page=menu';
	});
 </script>
</form>
