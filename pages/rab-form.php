<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pengurangan dan Penjumlahan Otomatis</title>
<script type="text/javascript" src="jquery.js"></script>
<script language='JavaScript'>
$(document).ready(function(){
    var inpA = "input[rel=Ajumlah]";
    var inpB = "input[rel=Bjumlah]";

    $(inpA).bind('keyup',function() {
        var avalA=0;
        var bVal = parseInt($('#Btotal').val(),10);
        $(inpA).each(function() {
            if(this.value !='') avalA += parseInt(this.value,10);
        });
        $('#Atotal').val(avalA);
        $('#selisih').val(avalA - bVal);
        console.log('Value avalA: ' + avalA);
    });

    $(inpB).bind('keyup',function() {
        var avalB=0;
        var aVal = parseInt($('#Atotal').val(),10);
        $(inpB).each(function() {
            if(this.value !='') avalB += parseInt(this.value,10);
        });
        $('#Btotal').val(avalB);
        $('#selisih').val(aVal - avalB);
        console.log('Value avalB: ' + avalB);
    });
});
</script>
</head>
<body>
<input type="text" name="Ajumlah1" rel="Ajumlah"/><br/>
<input type="text" name="Ajumlah2" rel="Ajumlah"/><br/>
<input type="text" name="Ajumlah3" rel="Ajumlah"/><br/>
<input type="text" name="Ajumlah4" rel="Ajumlah"/><br/>
<input type="text" name="Ajumlah5" rel="Ajumlah"/><br/>
<input type="text" name="Ajumlah6" rel="Ajumlah"/><br/><br/>
<!-- Dan seterusnya -->
Total A: <input type="text" name="Atotal" id="Atotal"/><br/><br/>
<input type="text" name="Bjumlah1" rel="Bjumlah"/><br/>
<input type="text" name="Bjumlah2" rel="Bjumlah"/><br/>
<input type="text" name="Bjumlah3" rel="Bjumlah"/><br/>
<input type="text" name="Bjumlah4" rel="Bjumlah"/><br/><br/>
<!-- Dan seterusnya -->
Total B: <input type="text" name="Btotal" id="Btotal"/><br/><br/>
Selisih: <input type="text" name="selisih" id="selisih"/><br/><br/><br/>
</body>
</html>
<!-- <?php
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
	<div class='page-header-title'>RAB</div>
</div>
<div id='luasan' style="position:relative;padding:20px;">
	<div class='project_name_title'>Project : <?=$project_name;?></div>
	<div id="table-rab"></div>
	<div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan Data Baru</div>
	<table class='table table-stripped' style='width:95%; float:left;'>
		<thead>
			<tr>
				<th>Kategori</th>
				<th>Item Pekerjaan</th>
				<th>Volume</th>
				<th>Satuan</th>
				<th>Koef Volume</th>
				<th>Vol</th>
				<th>Koef Harga</th>
				<th>Koef Profit</th>
				<th>Harga Satuan</th>
				<th>Jumlah Harga</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
				<?php
					$result=mysqli_query($conn, "SELECT catrab_id, catrab_name FROM master_rab_category WHERE catrab_status='enabled' ORDER BY catrab_name");
					echo "<select name='category' id='category' >";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['catrab_id']."'>".$data['catrab_name']."</option>";
					}
					echo "</select>";
				?>
				</td>
				<td>
					<input type="text" name="item" id="item" class="alphanumeric autocomplete"/>
					<input type="hidden" name="link_id" id="link_id" value=""/>
				</td>
				<td>
					<input type="text" name="volume" id="volume" class="autocalc" style="width:100px"/>
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
					<input type="text" name="coef_volume" id="coef_volume" class="numeric autocalc" style="width:50px" value="1"/>
				</td>
				<td>
					<div id="volume_value"></div>
				</td>
				<td>
					<input type="text" name="coef_price" id="coef_price" class="numeric autocalc" style="width:50px" value="1"/>
				</td>
				<td>
					<input  type="text" name="coef_profit" id="coef_profit" class="numeric  autocalc" style="width:50px" value="1"/>
				</td>
				<td>
					<input type="text" name="price" id="price" class="autocalc" style="width:120px"/>
				</td>
				<td>
					<div id="total_price"></div>
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
	$("#table-rab").load("tables/rab.php");
	$("#item").change(function(){
		$("#link_id").val("");
	});

	$("#item").autocomplete({
		source: function(request, response) {
	            $.ajax({
	                url: "process/autocomplete.php",
	                dataType:'json',
	                data: {
	                    id: 'newanalysisitem',
	                    item: $("#item").val(),
	                    type: 'item'
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
				$("#unit").val(unit);
				$("#price").val(price);
			},
	});


})

$('#btn-add').click(function(){

	var cat=$("#category").val();
	var item=$("#item").val();
	var link_id=$("#link_id").val();
	var volume=$("#volume").val();
	var unit=$("#unit").val();
	var coef_volume=$("#coef_volume").val().replace(/[^0-9,]/g, '');
	var price=$("#price").val();
	var coef_price=$("#coef_price").val().replace(/[^0-9,]/g, '');
	var coef_profit=$("#coef_profit").val().replace(/[^0-9,]/g, '');

	$.post('process/rab.php',{cat:cat, item:item, link_id:link_id, volume:volume, unit:unit, coef_volume:coef_volume, price:price, coef_price:coef_price, coef_profit:coef_profit},
	        function(data) {
	        	if(data.indexOf("[ERROR]"<-1))
	            	 $("#table-rab").load("tables/rab.php");
	           	else
	           		alert(data);
	         }
		);
});

 $(".autocalc").keyup(function(e) {
        if (e.which == 13) // Enter key
            $(this).blur();
    });

// prevent the Enter key from submitting the form
$('.autocalc').keypress(function(e) { return e.which != 13; });

$('.autocalc').change(function(){
	var total_price=0;

	var volume=$("#volume").val();
	var coef_volume=$("#coef_volume").val();
	var volume_value=0;
	if(volume.indexOf("=")==0){
		var formula=eval(volume.substr(1));
		volume_value=formula * coef_volume;
	}else{
		volume_value=volume * coef_volume;
	}

	var coef_price=parseFloat($("#coef_price").val());
	var coef_profit=parseFloat($("#coef_profit").val());
	var price=$("#price").val().replace(",", "");
	var price_value=0;
	if(price.indexOf("=")==0){
		var formula=eval(price.substr(1));
		price_value=formula * coef_price*coef_profit;
	}else{
		price_value=coef_price*coef_profit*price;
	}

	total_price=volume_value*price_value;

	if(!isNaN(volume_value))
		$("#volume_value").html(volume_value);
	if(!isNaN(total_price))
		$("#total_price").html(addThousandsSeparator("Rp. "+total_price));
});

</script>

<?php

} //end of project_id check

?> -->
