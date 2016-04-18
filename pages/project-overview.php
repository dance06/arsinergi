<div class='page-header'>
	<div class='btn-back-arrow' id="goToProjectlist">&nbsp;</div>
	<div class='page-header-title'>Project Overview</div>
</div>
<div id='project-overview' style="position:relative;">
	<div style='width:33%; float:left;'>
		<div class='row'>
			<div>Judul Proyek</div>
			<div><input type="text" name='name' id='name'/></div>
		</div>
		<div class='row'>
			<div>Tipe Proyek</div>
			<div>
			<?php
					$result=mysqli_query($conn, "SELECT catpro_id, catpro_name FROM master_project_category");
					echo "<select name='category' id='category'>";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['catpro_id']."'>".$data['catpro_name']."</option>";
					}
					echo "</select>";
				?>
			</div>
		</div>
		<div class='row'>
			<div>Alamat</div>
			<div><input type="text" name='address' id='address' class='alphanumeric'/></div>
		</div>
		<div class='row'>
			<div>&nbsp;</div>
			<div>
			<?php
					$result=mysqli_query($conn, "SELECT city_id, city_name FROM master_city");
					echo "<select name='city' id='city'>";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['city_id']."'>".$data['city_name']."</option>";
					}
					echo "</select>";
				?>
			</div>
		</div>
		
	</div>
	<div style='width:33%; float:left;'>
		<div class='row'>
			<div>PIC</div>
			<div><input type="text" name='pic' id='pic'/></div>
		</div>
		<div class='row'>
			<div>Klien</div>
			<div><input type="text" name='client' id='client'/></div>
		</div>
		<div class='row'>
			<div>No Telp</div>
			<div><input type="text" name='phone' id='phone'/></div>
		</div>
		<div class='row'>
			<div>E-Mail</div>
			<div><input type="text" name='email' id='email'/></div>
		</div>
	</div>
	<div style='width:33%; float:left;'>
		<div class='row'>
			<div>Catatan Khusus</div>
		</div>
		<div class='row'>
			<textarea style='margin-left:40px; width:80%; height: 120px; resize:none;' id='notes' placeholder="Catatan Khusus"></textarea>
		</div>
		<div style='width:100%; height:50px; position:relative; '>
			<div id="btn-save" class='button btn-blue' style="width:120px; margin:20px 0px; position:absolute; right:32px">SAVE</div>
		</div>
	</div>
	<div style='clear:both'></div>
</div>

<!--div style="margin-top:30px; border-top: 2px solid #cdcdcd; height:80px">
<div class='button btn-blue' id='goToMeasurement' style="width:120px; margin-top:20px; margin-left:40px;">Manage Luasan</div>
<div class='button btn-blue' id='goToRab' style="width:120px; margin-top:20px; margin-left:20px;">Manage RAB</div>
<div class='button btn-blue' id='goToRab' style="width:120px; margin-top:20px; margin-left:20px;">Manage RB</div>
</div-->
<script type=text/javascript>
$('#btn-save').click(function(){
	var name=$('#name').val();
	var category=$('#category').val();
	var address=$('#address').val();
	var city=$('#city').val();
	var pic=$('#pic').val();
	var client=$('#client').val();
	var phone=$('#phone').val();
	var email=$('#email').val();
	var notes=$('#notes').val();
	
	$.post('process/overview.php',{name:name, category:category, address:address, city:city, pic:pic, client:client, phone:phone, email:email, notes:notes},
	        function(data) {
	        	alert(data);
	            if(data.indexOf("[ERROR]"<-1))
	            	 window.location='setpage.php?page=projectlist';					
	         }
		);
});
</script>