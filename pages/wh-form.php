<?php
if(1==1){	
?>
<div class='page-header'>
	<div class='btn-back-arrow' id="goToMenu">&nbsp;</div>
	<div class='page-header-title'>Master Gudang</div>
</div>
<div id='luasan' style="position:relative;padding:20px;">
	<div id="table-wh"></div>
	<div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan Data Baru</div>
	<div style="width:95%; overflow:auto; float:left;">
	<table class='table table-stripped' style='width:1000px;' id='input-form'>
		<thead>
			<tr>
				<th style="text-align:center;">Lokasi</th>
				<th style="text-align:center;">Tanggal Masuk</th>
				<th style="text-align:center;">Item</th>
				<th style="text-align:center;">Ukuran</th>
				<th style="text-align:center;">Tipe</th>
				<th style="text-align:center;">Jumlah Masuk</th>
				<th style="text-align:center;">Satuan</th>
				<th style="text-align:center;">Harga</th>
				<th style="text-align:center;">AC asal</th>
				<th style="text-align:center;">Proyek Asal</th>
				<th style="text-align:center;">Keterangan</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<?php
					$sql="SELECT warehouse_id, warehouse_name
							FROM master_warehouse
							WHERE warehouse_status='enabled'";
					$result=mysqli_query($conn, $sql);
					echo "<select name='warehouse' id='warehouse'>";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['warehouse_id']."'>".$data['warehouse_name']."</option>";
					}
					echo "</select>";
					?>
				</td>
				<td>
					<input type="text" name="date_in" id="date_in" class="datepicker2" style="width:80px" value="<?=date("d-m-Y")?>"/>
				</td>
				<td>
					<input type="text" name="item" id="item" class="alphanumeric autocomplete"  style="width:150px"/>
					<input type="hidden" name="link_id" id="link_id" value=""/>
				</td>
				<td>
					<input type="text" name="size" id="size" class="alphanumeric autocomplete"  style="width:100px"/>
				</td>
				<td>
					<input type="text" name="type" id="type" class="alphanumeric autocomplete" style="width:100px"/>
				</td>
				<td>
					<input type="text" name="total_in" id="total_in" class="numeric" style="width:50px"/>
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
					<input type="text" name="price" id="price" class="numeric" style="width:120px"/>
				</td>
				<td>
					<input type="text" name="ac_origin" id="ac_origin" class="alphanumeric" style="width:120px"/>
				</td>
				<td>
					<input type="text" name="project_origin" id="project_origin" class="alphanumeric" style="width:120px"/>
					<input type="hidden" name="origin_id" id="origin_id" value=""/>
				</td>
				<td>
					<input type="text" name="notes" id="notes" class="" style="width:220px"/>
				</td>
				
			</tr>
		</tbody>
	</table>
	</div>
	<div style="width:20px; float:left">
		<div id="btn-add"></div>
	</div>
	<div style="clear:both"></div>
</div>
<script>
$(document).ready(function(){
	$("#table-wh").load("tables/wh.php");
	$("#item").autocomplete({
		source: function(request, response) {
	            $.ajax({
	                url: "process/autocomplete.php",
	                dataType:'json',
	                data: {
	                    id: 'newanalysisitem',
	                    item: $("#item").val(),
	                    type: 'material'
	                },
	                success: function(data) {
	                    response(data);
	                }
	            });
	        },
		minLength:2,
		select: function(event,ui){
				var id = ui.item.id;
				var unit = ui.item.unit;
				var price = ui.item.price;
				$("#link_id").val(id);
			},
		change: function( event, ui ) {
			if ( !ui.item ) {
				$(this).val("");
				select.val("");
				input.data("autocomplete").term = "";
				return false;
			}
		}
	});
	
	$("#project_origin").autocomplete({
		source: function(request, response) {
	            $.ajax({
	                url: "process/autocomplete.php",
	                dataType:'json',
	                data: {
	                    id: 'project',
	                    item: $("#project_origin").val(),
	                },
	                success: function(data) {
	                    response(data);
	                }
	            });
	        },
		minLength:2,
		select: function(event,ui){
				var id = ui.item.id;
				$("#origin_id").val(id);
			},
		change: function( event, ui ) {
			if ( !ui.item ) {
				$("#origin_id").val("NULL");
				return false;
			}
		}
	});

})

$('#btn-add').click(function(){
	$.post('process/wh.php',{
		warehouse:$("#warehouse").val(), 
		date_in:$("#date_in").val(), 
		link_id:$("#link_id").val(), 
		item:$("#item").val(), 
		size:$("#size").val(), 
		type:$("#type").val(), 
		total_in:$("#total_in").val(), 
		unit:$("#unit").val(), 
		price:$("#price").val().replace(/[^0-9.]/g, ''), 
		ac_origin:$("#ac_origin").val(), 
		project_origin:$("#project_origin").val(), 
		origin_id:$("#origin_id").val(), 
		notes:$("#notes").val()
	}, function(data) {
			alert(data);
        	if(data.indexOf("[ERROR]"<-1))
            	$("#table-wh").load("tables/wh.php");
           	else
           		alert(data);				
         }
	);
});
</script>
<?php
} //end of project_id check

?>
