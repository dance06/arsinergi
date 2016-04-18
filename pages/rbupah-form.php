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
	<div class='page-header-title'>Real Bahan Upah</div>
</div>
<div id='luasan' style="position:relative;padding:20px;">
	<div class='project_name_title'>Project : <?=$project_name;?></div>
	<div id="table-rbupah"></div>
	<div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan Data Baru</div>
	<div style="width:95%; overflow:scroll; float:left;">
	<table class='table table-stripped' style='width:1000px;'>
		<thead>
			<tr>
				<th>Tgl Bon</th>
				<th>Golongan</th>
				<th>Item</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Harga Satuan</th>
				<th>Total Harga</th>
				<th class='colType'>Jenis</th>
				<th>Ket</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<input type="text" name="order_date" id="order_date" class="datepicker2" style="width:80px"/>
				</td>
				<td>
					<?php
					$arrGroup=array(
								"alat" => "Alat",
								"bbm" => "BBM",
								"tenaga" => "Tenaga"
							);
					echo "<select name='group' id='group' class=' input'>";
					foreach($arrGroup as $val => $group){
						echo "<option value='".$val."'>".$group."</option>";
					}
					echo "</select>";
					?>
				</td>
				<td>
					<input type="text" name="item" id="item" class="alphanumeric autocomplete input"/>
				</td>
				<td>
					<input type="text" name="order_total" id="order_total" class="numeric calPriceTotal input" style="width:50px"/>
				</td>
				<td>
				<?php
					$result=mysqli_query($conn, "SELECT unit_id, unit_name FROM master_unit WHERE unit_status='enabled' ORDER BY unit_name");
					echo "<select name='unit' id='unit' class='input'>";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['unit_id']."'>".$data['unit_name']."</option>";
					}
					echo "</select>";
				?>
				</td>
				<td>
					<input type="text" name="price" id="price" class="numeric calPriceTotal input" style="width:120px"/>
				</td>
				<td>
					<div id="price_total" style="width:100px"></div>
				</td>
				<td class='colType'>
					<?php
					$arrType=array(
								"mandor" => "Mandor",
								"borongan" => "Borongan",
							);
					echo "<select name='type' id='type' class='input'>";
					foreach($arrType as $val => $type){
						echo "<option value='".$val."'>".$type."</option>";
					}
					echo "</select>";
					?>
				</td>
				<!--
				<td>
					<div id="foreman" style="width:100px"></div>
				</td>
				<td>
					<div id="tools" style="width:100px"></div>
				</td>
				<td>
					<div id="wholesale" style="width:100px"></div>
				</td>
				-->
				<td>
					<input type="text" name="notes" id="notes" class="input" style="width:200px"/>
				</td>
				
			</tr>
		</tbody>
	</table>
	</div>
	<div style="width:20px; float:left">
		<div id="btn-add">ADD</div>
	</div>
	<div style="clear:both"></div>
</div>
<script>
$(document).ready(function(){
	$(".colType").hide();
	$("#table-rbupah").load("tables/rbupah.php");
	$("#item").autocomplete({
		source: function(request, response) {
	            $.ajax({
	                url: "process/autocomplete.php",
	                dataType:'json',
	                data: {
	                    id: 'upah',
	                    item: $("#item").val(),
	                },
	                success: function(data) {
	                    response(data);
	                }
	            });
	        },
		minLength:2,
	});
	$("#group").change(function(){
		if($(this).val()=='tenaga'){
			$(".colType").show();
		}else{
			$(".colType").hide();
		}
	});
})

$('#btn-add').click(function(){
	$.post('process/rbupah.php',{
		order_date:$("#order_date").val(), 
		group:$("#group").val(), 
		item:$("#item").val(), 
		item_detail:$("#item_detail").val(), 
		order_total:$("#order_total").val().replace(/[^0-9.]/g, ''), 
		unit:$("#unit").val(), 
		price:$("#price").val().replace(/[^0-9.]/g, ''), 
		type:$("#type").val(),
		notes:$("#notes").val()
	}, function(data) {
			if(data.indexOf("[ERROR]"<-1))
            	 $("#table-rbupah").load("tables/rbupah.php");	
           	else
           		alert(data);				
         }
	);
});

$('.calPriceTotal').change(function(){
	var price_total=0;
	var order_total=$("#order_total").val().replace(/[^0-9.]/g, '');
	var price=$("#price").val().replace(/[^0-9.]/g, '');

	price_total=order_total*price;
	
	if(!isNaN(price_total))
		$("#price_total").html(price_total);
});
</script>

<?php

} //end of project_id check

?>
