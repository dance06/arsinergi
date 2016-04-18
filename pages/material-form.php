<div class='page-header'>
	<div class='btn-back-arrow' id="goToMenu">&nbsp;</div>
	<div class='page-header-title'>Bahan</div>
</div>
<div id='luasan' style="position:relative;padding:20px;">
	<div id="table-material"></div>
	<div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan Data Baru</div>
	<table class='table table-stripped' style='width:95%; float:left;'>
		<thead>
			<tr>
				<th>Nama Bahan</th>
				<th>Satuan</th>
				<th>Harga Dasar</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="width:70%;">
					<div>&nbsp;</div>
					<div>
					<?php
					$result=mysqli_query($conn, "SELECT material_category_id, material_category_name 
						FROM master_material_category 
						WHERE  material_category_status='enabled'
						ORDER BY material_category_name");
					echo "<select name='name_1' id='name_1'>";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['material_category_id']."'>".$data['material_category_name']."</option>";
					}
					echo "</select>";
				?>
					<input type="text" name="name_2" id="name_2" class="alphanumeric" autocomplete="on"  style="width:20%;"/>
					<input type="text" name="name_3" id="name_3" class="alphanumeric" autocomplete="on"  style="width:20%;"/>
					<input type="text" name="name_4" id="name_4" class="alphanumeric" autocomplete="on"  style="width:20%;"/>
					<input type="text" name="name_5" id="name_5" class="alphanumeric" autocomplete="on"  style="width:20%;"/>
					</div>
				<td>
				<?php
					$result=mysqli_query($conn, "SELECT unit_id, unit_name FROM master_unit WHERE unit_status='enabled' ORDER BY unit_name");
					echo "<div>&nbsp;</div>";
					echo "<div><select name='unit' id='unit'>";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['unit_id']."'>".$data['unit_name']."</option>";
					}
					echo "</select></div>";
				?>
				</td>
				<td>
					<div id="formula_result">&nbsp;</div>
					<div><input type="text" name="price" id="price" class="formula autocalc"/></div>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="width:20px; float:left">
		<div id="btn-add"></div>
	</div>
	<div style="clear:both"></div>
</div>
<script>

$(document).ready(function(){
	$("#table-material").load("tables/material.php");
	$("#name_2").autocomplete({
	source: function(request, response) {
            $.ajax({
                url: "process/autocomplete.php",
                dataType:'json',
                data: {
                    id: 'mat_2',
                    mat_1: $("#name_1").val(),
                    mat_2: $("#name_2").val()
                },
                success: function(data) {
                    response(data);
                }
            });
        },
	minLength:2,
	});
	$("#name_3").autocomplete({
	source: function(request, response) {
            $.ajax({
                url: "process/autocomplete.php",
                dataType:'json',
                data: {
                    id: 'mat_3',
                    mat_1: $("#name_1").val(),
                    mat_2: $("#name_2").val(),
                    mat_3: $("#name_3").val(),
                },
                success: function(data) {
                    response(data);
                }
            });
        },
	minLength:2,
	});
	$("#name_4").autocomplete({
	source: function(request, response) {
            $.ajax({
                url: "process/autocomplete.php",
                dataType:'json',
                data: {
                    id: 'mat_4',
                    mat_1: $("#name_1").val(),
                    mat_2: $("#name_2").val(),
                    mat_3: $("#name_3").val(),
                    mat_4: $("#name_4").val(),
                },
                success: function(data) {
                    response(data);
                }
            });
        },
	minLength:2,
	});

	
})

$('#btn-add').click(function(){
	var name_1=$("#name_1").val();
	var name_2=$("#name_2").val();
	var name_3=$("#name_3").val();
	var name_4=$("#name_4").val();
	var name_5=$("#name_5").val();
	var unit_id=$("#unit").val();
	var price=$("#price").val();
	
	$.post('process/material.php',{name_1:name_1, name_2:name_2, name_3:name_3, name_4:name_4, name_5:name_5, unit_id:unit_id, price:price},
	        function(data) {
	        	if(data.indexOf("[ERROR]"<-1))
	            	 $("#table-material").load("tables/material.php");	
	           	else
	           		alert(data);				
	         }
		);
});
$('.formula').change(function(){
	var price=$(this).val();
	if(price.indexOf("=")==0){
		var formula=eval(price.substr(1));
		$("#formula_result").html(formula);
	}
});
</script>