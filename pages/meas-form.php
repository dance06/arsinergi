<?php
	//start of project_id check
	$sql="SELECT project_id, project_name FROM project WHERE sha1(project_id)='".$_SESSION['project_id']."'";
	$result=mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)!=1){
		echo jsAlert('Project ID Not Found');
	}
	else{
	$data=mysqli_fetch_array($result);
	$project_id=$data[0];
	$project_name=$data[1];
?>
<div class='page-header'>
	<div class='btn-back-arrow' id="goToProjectlist">&nbsp;</div>
	<div class='page-header-title'>Luasan</div>
</div>
<div id='luasan' style="position:relative;padding:20px;">
	<div class='project_name_title'>Project : <?=$project_name;?></div>
	<div id="table-measurement"></div>
	<div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan Data Baru</div>
	<table class='table table-stripped' style='width:95%; float:left;'>
		<thead>
			<tr>
				<th rowspan="2">Kategori</th>
				<th rowspan="2">Item Luasan Kerja</th>
				<th rowspan="2">Luas (A)</th>
				<th rowspan="2">Satuan</th>
				<th colspan="2" align="center">Luasan Owner</th>
				<th colspan="2" align="center">Luasan Mandor</th>
			</tr>
			<tr>
				<th>Koefisien (B)</th>
				<th>(AxB) M2</th>
				<th>Koefisien (B)</th>
				<th>(AxB) M2</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
				<?php
					$result=mysqli_query($conn, "SELECT catmeas_id, catmeas_name FROM master_measurement_category WHERE catmeas_status='enabled' ORDER BY catmeas_name");
					echo "<select name='category' id='category' >";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['catmeas_id']."'>".$data['catmeas_name']."</option>";
					}
					echo "</select>";
				?>
				</td>
				<td>
					<input type="text" name="name" id="name" class="alphanumeric" autocomplete="on"/>
				</td>
				<td>
					<input type="text" name="area" id="area" class="decimal4 autocalc" />
				</td>
				<td>
				<?php
					$result=mysqli_query($conn, "SELECT unit_id, unit_name FROM master_unit WHERE unit_status='enabled' ORDER BY unit_name");
					echo "<select name='unit' id='unit'>";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['unit_id']."'>".$data['unit_name']."</option>";
					}
					echo "</select>";
				?>
				</td>
				<td>
					<input type="text" name="coef_owner" id="coef_owner" class="decimal2 autocalc"/>
				</td>
				<td>
					<div id="measurement_owner"></div>
				</td>
				<td>
					<input  type="text" name="coef_foreman" id="coef_foreman" class="decimal2 autocalc"/>
				</td>
				<td>
					<div id="measurement_foreman"></div>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="width:20px; float:left">
		<div id="btn-add">ADD</div>
	</div>
	<div style="clear:both"></div>
</div>
<script>
$(document).ready(function(){
	$("#unit").val("2");
	$("#table-measurement").load("tables/measurement.php");
	$("#name").autocomplete({
	source:'process/autocomplete.php?id=meas', 
	minLength:2
	});
})

$('#btn-add').click(function(){
	var cat=$("#category").val();
	var name=$("#name").val();
	var area=$("#area").val();
	var unit=$("#unit").val();
	var coef_owner=$("#coef_owner").val();
	var coef_foreman=$("#coef_foreman").val();
	
	$.post('process/measurement.php',{cat:cat, name:name, area:area, unit:unit, owner:coef_owner, foreman:coef_foreman},
	        function(data) {
	        	alert(data);
	        	if(data.indexOf("[ERROR]"<-1))
	            	 $("#table-measurement").load("tables/measurement.php");	
	           	else
	           		alert(data);				
	         }
		);
});

$('.autocalc').change(function(){
	var area=$("#area").val();
	var coef_owner=$("#coef_owner").val();
	var coef_foreman=$("#coef_foreman").val();
	var measurement_owner=parseFloat(area) * parseFloat(coef_owner);
	var measurement_foreman=parseFloat(area) * parseFloat(coef_foreman);
	if(!isNaN(measurement_owner))
		$("#measurement_owner").html(measurement_owner.toFixed(4));
	else
		$("#measurement_owner").html("");
	if(!isNaN(measurement_foreman))
		$("#measurement_foreman").html(measurement_foreman.toFixed(4));
	else
		$("#measurement_foreman").html("");
});

</script>

<?php

} //end of project_id check

?>
