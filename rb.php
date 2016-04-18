<?php

		include '../init.php';
    include '../function.php';

		function ambil_item(){
			global $conn;
			$nama='';
			$sql_nama=mysqli_query($conn, "SELECT * FROM master_item");
			while($data_nama=mysqli_fetch_array($sql_nama)){
			$nama.='"'.stripslashes($data_nama['item_name']).'",';
			}
			return(strrev(substr(strrev($nama),1)));
		}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ARSINERGI PROJECT MANAGER</title>

    <script src="../js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <link href="../css/datepicker.css" rel="stylesheet">
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/jquery-1.9.1.js"></script>
  <script src="../js/jquery-ui.js"></script>
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<script src="../js/function.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../css/jquery-ui.css">
	<script>
	function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " ")); //script untuk mengulang dan memilih//
	}
	</script>

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<form id="form1" name="form1" method="post" action="../insert.php?id=<?php echo $_GET['id'] ?>">
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span></button> <a class="navbar-brand" href="../setpage.php?page=menu">ARSINERGI PROJECT MANAGER</a>
            </div>

            <div class="navbar-collapse collapse">
            </div><!--/.navbar-collapse -->
        </div>
    </div>
    <div id="content" style="position:relative; margin-top:60px; clear:both; padding:20px;width:100%;">
    	<div style="border:2px solid black;">

<div class='page-header'>
	<a class='btn-back-arrow' href="../index.php" >&nbsp;</a>
	<div class='page-header-title'>REAL BAHAN</div>
</div>
<div id='luasan' name='luasan' style="position:relative;padding:20px;">
	<script src="../js/jquery-1.9.1.js"></script>
	<script src="../js/jquery-ui.js"></script>

<div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan Data Baru</div>
<div style="width:95%; overflow:auto; float:left;">
<table id="tableRB" class='table table-stripped' style="width:95%; overflow:auto; float:left;">
	<script src="../js/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="../js/jquery-ui.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
	<link href="../css/datepicker.css" rel="stylesheet">
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="../js/function.js" type="text/javascript"></script>
<link rel="stylesheet" href="../css/jquery-ui.css">
	<thead>
		<tr>
			<th>Tahun</th>
			<th>Periode</th>
			<th>Tgl.order</th>
			<th>Gol</th>
			<th>Item</th>
			<th>Tipe</th>
			<th>Jml.order</th>
			<th>Jml.Terkirim</th>
			<th>Vol.Terbayar</th>
			<th>Vol.indent</th>
			<th>Sat</th>
			<th>Harga Satuan</th>
			<th>Jml.harga</th>
			<th>Indent</th>
			<th>Supplier</th>
			<th>No AC</th>
			<th>Status Bayar</th>
			<th>No Faktur</th>
			<th>No Bayar</th>
			<th>Tgl.Cair</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div class="form-group"  >
					<div class="input-group">
						<?php

						$now=date('Y');
						echo "<select class='form-control' name='rb_year[]' id='rb_year' class='autonumeric' input style='width:100px'>";
						for ($a=2006;$a<=$now;$a++)
						{
     						echo "<option value=' ".$a." '>".$a."</option>";
						}
								echo "</select>";
?>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group"  >
					<div class="input-group">
						<select style="height:34px" name="rb_periode[]" id="rb_periode">
							<option value="">--periode--</option>
							<?php
							$namabulan=array("Januari","Februari","Maret","April","Mei", "Juni","July","Agustus","September","Oktober", "November","Desember");
							$bulan=count($namabulan);
							for ($c=0; $c<$bulan; $c+=1){
								echo "<option value=$namabulan[$c]> $namabulan[$c]</option>";
							}
							?>
							</select>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group"  >
					<div class="input-group">
						<input type="text" class="form-control date-order" name="rb_order_date[]" id="date" style="width:200px" date-format="yyyy-mm-dd"/>
					</div>
				</div>
			</td>
			<td>
			<?php
				$result=mysqli_query($conn, "SELECT material_category_id, material_category_name FROM master_material_category WHERE material_category_status='enabled' ORDER BY material_category_name");
				echo "<select name='rb_gol[]' id='rb_gol' class='form-group' style='height:34px'>";
				while($data=mysqli_fetch_array($result)){
					echo "<option value='".$data['material_category_id']."'>".$data['material_category_name']."</option>";
				}
				echo "</select>";
			?>
			</td>
			<td>
				<div class="form-group"  >
					<div class="ui-widget input">
						<input type="text" class="form-control" name="rb_item[]" id="rb-item" style="width:200px"/>
					</div>
				</div>
			</td>
			<td>
				<div class="ui-widget" >
					<div class="ui-widget input">
						<input type="text" class="form-control" name="rb_item_detail[]" id="rb_item_detail" style="width:100px"/>
					</div>
				</div>

			</td>
			<td>
				<div class="form-group"  >
					<div class="input-group">
						<input type="number" class="form-control" name="rb_order_total[]" id="rb_order_total" style="width:80px" onfocus="startCalculate()" onblur="stopCalc()"/>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group"  >
					<div class="input-group">
						<input type="number" class="form-control" name="rb_order_sent[]" id="rb_order_sent" style="width:80px"/>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group" >
					<div class="input-group">
						<input type="number" class="form-control" name="rb_volume_paid[]" id="rb_volume_paid" style="width:80px"/>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group" >
					<div class="input-group">
						<input type="text" readonly="readonly" class="form-control" name="rb_volume_indent[]" id="rb_volume_indent" style="width:80px"/>
					</div>
				</div>
			</td>

			<td>
			<?php
				$result=mysqli_query($conn, "SELECT unit_id, unit_name FROM master_unit WHERE unit_status='enabled' ORDER BY unit_name");
				echo "<select name='rb_unit_id[]' id='rb_unit_id' clas='input' style='height:34px'>";
				while($data=mysqli_fetch_array($result)){
					echo "<option value='".$data['unit_id']."'>".$data['unit_name']."</option>";
				}
				echo "</select>";
			?>
			</td>
			<td>
				<div class="form-group"  >
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" class="form-control" name="rb_item_price[]" id="rb_item_price" style="width:100px" onfocus="startCalculate()" onblur="stopCalc()"/>
						<div class="input-group-addon">,00</div>
					</div>
				</div>
			</td>
			<td>
					<div class="form-group"  >
						<div class="input-group">
							<div class="input-group-addon">Rp</div>
							<input type="text" readonly="readonly" class="form-control" name="rb_item_price_total[]" id="rb_item_price_total" style="width:120px" onfocus="startCalculate()" onblur="stopCalc()"/>
							<div class="input-group-addon">,00</div>
						</div>
					</div>
<!-- <input type="text" name="price_total" id="price_total" style="width:120px" onfocus="startCalculate()" onblur="stopCalc()"/> -->
			</td>
			<td>
				<div class="form-group"  >
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" readonly="readonly" class="form-control" name="rb_price_indent[]" id="rb_price_indent" style="width:120px" onfocus="startCalculate()" onblur="stopCalc()"/>
						<div class="input-group-addon">,00</div>
					</div>
				</div>
			</td>
			<td>
			<?php
				$result=mysqli_query($conn, "SELECT id_sup, supplier_name FROM master_supplier WHERE supplier_status='enabled' ORDER BY supplier_name");
				echo "<select name='rb_supplier[]' id='rb_supplier' class='input' style='height:34px'>";
				while($data=mysqli_fetch_array($result)){
					echo "<option value='".$data['id_sup']."'>".$data['supplier_name']."</option>";
				}
				echo "</select>";
			?>
			</td>
			<td>
				<div class="form-group"  >
					<div class="input-group">
						<input type="text" class="form-control" name="rb_no_ac[]" id="supplier" style="width:80px"/>
					</div>
				</div>
			</td>
			<td>
			<?php
				$result=mysqli_query($conn, "SELECT id_payment, payment_status FROM master_payment WHERE payment_status_status='enabled' ORDER BY payment_status");
				echo "<select name='rb_payment_status[]' id='rb_payment_status' class='input' style='height:34px'>";
				while($data=mysqli_fetch_array($result)){
					echo "<option value='".$data['id_payment']."'>" .$data['payment_status']. "</option>";
				}
				echo "</select>";
			?>
			</td>
			<td>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" name="rb_no_faktur[]" id="rb_no_faktur" style="width:125px"/>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" name="rb_no_paid[]" id="rb_no_paid" style="width:60px"/>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group"  >
					<div class="input-group">
						<input type="text" class="form-control" name="rb_order_date_paid[]" id="date-paid" style="width:150px" date-format="yyyy-mm-dd"/>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group" >
					<div class="input-group">
				<input type="text" class="form-control" name="rb_notes[]" id="rb_notes" style="width:250px"/>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>

</div>
<div style="float:bottom">
<button id="btn_plus" type="button" class="btn btn-default btn-lg">
<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
</button>
<button id="btn_save" type="Submit" class="btn btn-default btn-lg">
<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
</button>
</div>
</div>
<div style="width:95%; overflow:auto;">
<table id="gridBookingEquipment" class="table table-striped table-hover">
	<thead>
		<tr>
			<th style="text-align:center;"></th>
			<th style="text-align:center;">Tahun</th>
      <th style="text-align:center;">Periode</th>
      <th style="text-align:center;">Tgl.order</th>
      <th style="text-align:center;">Gol</th>
      <th style="text-align:center;">Item</th>
      <th style="text-align:center;">Tipe</th>
      <th style="text-align:center;">Jml.order</th>
      <th style="text-align:center;">Jml.Terkirim</th>
      <th style="text-align:center;">Vol.Terbayar</th>
      <th style="text-align:center;">Vol.indent</th>
      <th style="text-align:center;">Sat</th>
      <th style="text-align:center;">Harga Satuan</th>
      <th style="text-align:center;">Jml.harga</th>
			<th style="text-align:center;">indent</th>
      <th style="text-align:center;">Supplier</th>
			<th style="text-align:center;">no.ac</th>
			<th style="text-align:center;">Status Bayar</th>
			<th style="text-align:center;">No.Faktur</th>
			<th style="text-align:center;">No.Bayar</th>
			<th style="text-align:center;">Tgl.Cair</th>
      <th style="text-align:center;">Keterangan</th>
		</tr>
	</thead>
	<tbody>
	<?php

	$sql="SELECT rb_id, rb_project_id, rb_year, rb_periode, rb_order_date, mmc.material_category_name ,rb_item, rb_item_detail, rb_order_total, rb_order_sent, rb_volume_paid, rb_volume_indent,
               u.unit_name, rb_item_price, mp.payment_status, rb_item_price_total, rb_price_indent,rb_notes, ms.supplier_name, rb_order_date_paid, rb_no_ac, rb_no_faktur, rb_no_paid
			FROM realbahan,master_unit u, master_supplier ms, master_material_category mmc, master_project_list mpl, master_payment mp
			WHERE mpl.project_id=".$_GET['id']."
			AND rb_unit_id=u.unit_id
			AND mmc.material_category_id=rb_gol
			AND mp.id_payment=rb_payment_status
			AND ms.id_sup=rb_supplier
			AND mpl.project_id=rb_project_id";

	$result=mysqli_query($conn,$sql);
	while($data=mysqli_fetch_array($result)){
		echo "<tr".$data['rb_project_id'].">";
		echo "<td><a href='#' class='btn btn-default btn-s link-edit' value='edit'>
				<span class='glyphicon glyphicon-edit' id='editproject' aria-hidden='true'></span>
				</a>&nbsp;<a id='btn-del' class='btn btn-default btn-s link-del' href='../deleted.php?id=".$data['rb_id']."& rb_project_id=".$data['rb_project_id']."'>
						<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						</a>&nbsp;<button id='btn_save' name='tedit' type='Submit' class='btn btn-default btn-s link-save'>
								<span class='glyphicon glyphicon-ok' aria-hidden='true'></span></a></td>";
		echo "<td><span class='project-label1 project-label1'>".$data['rb_year']."</span><input type='text' name='rb_year1' class='project-input1 project-input' style='display:none' /></td>";
    echo "<td><span class='project-label1 project-label2'>".$data['rb_periode']."</span><input type='text' name='rb_periode1' class='project-input2 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label3'>".convertToDateID($data['rb_order_date'])."</span><input type='text' name='rb_order_date1' class='project-input3 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label4'>".$data['material_category_name']."</span><input type='text' name='material_category_name1' class='project-input4 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label5'>".$data['rb_item']."</span><input type='text' name='rb_item1' class='project-input15 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label6'>".$data['rb_item_detail']."</span><input type='text' name='rb_item detail' class='project-input6 project-input' style='display:none' /></td>";
    echo "<td><span class='project-label1 project-label7'>".number_format($data['rb_order_total'],2,".",",")."</span><input type='text' name='project_name7' class='project-input7 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label8'>".number_format($data['rb_order_sent'],2,".",",")."</span><input type='text' name='project_name8' class='project-input8 project-input' style='display:none' /></td>";
    echo "<td><span class='project-label1 project-label9'>".number_format($data['rb_volume_paid'],2,".",",")."</span><input type='text' name='project_name9' class='project-input9 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label10'>".number_format($data['rb_volume_indent'],2,".",",")."</span><input type='text' name='project_name10' class='project-input10 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label11'>".$data['unit_name']."</span><input type='text' name='project_name11' class='project-input11 project-input' style='display:none' /></td>";
    echo "<td><span class='project-label1 project-label12'>".convertToRp($data['rb_item_price'])."</span><input type='text' name='project_name12' class='project-input12 project-input' style='display:none' /></td>";
    echo "<td class='row-price-total'><span class='project-label1 project-label13'>".convertToRp($data['rb_item_price_total'])."</span><input type='text' name='project_name13' class='project-input13 project-input' style='display:none' /></td>";
		echo "<td class='row-price-indent'><span class='project-label1 project-label14'>".convertToRp1($data['rb_price_indent'])."</span><input type='text' name='project_name14' class='project-input14 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label15'>".$data['supplier_name']."</span><input type='text' name='project_name15' class='project-input15 project-input' style='display:none' /></td>";
    echo "<td><span class='project-label1 project-label16'>".$data['rb_no_ac']."</span><input type='text' name='project_name16' class='project-input16 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label17'>".$data['payment_status']."</span><input type='text' name='project_name17' class='project-input17 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label18'>".$data['rb_no_faktur']."</span><input type='text' name='project_name18' class='project-input18 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label19'>".$data['rb_no_paid']."</span><input type='text' name='project_name19' class='project-input19 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label20'>".convertToDateID($data['rb_order_date_paid'])."</span><input type='text' name='project_name20' class='project-input20 project-input' style='display:none' /></td>";
		echo "<td><span class='project-label1 project-label21'>".$data['rb_notes']."</span><input type='text' name='project_name21' class='project-input21 project-input' style='display:none' /></td>";
		echo "</tr>";
	}
	?>
	</tbody>
<tfoot>
	<tr>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th style="text-align:right; width:auto;">Grand Total</th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<td>Rp<div style="align:right;"><span id="grandTotal" style="text-align:right;">".convertToRp."0</span></div></td>
		<td>Rp<span id="grandTotalindent">0</span></td>
	</tr>
</tfoot>
</table>

</div>
</div>
</div>

</body>
</html>


<script type="text/javascript">

function calcPriceTotal()
{
	var grandTotal = 0;
	$('.row-price-total').each(function(){
		var price = $(this).find('.price-field').html();
		var rpl= price.replace(/\./g,'');
		grandTotal += parseInt(rpl);
	});
	// alert(grandTotal);
	$("#grandTotal").html(grandTotal);
}
calcPriceTotal();

function calcPriceTotalindent()
{
	var grandTotalindent = 0;
	$('.row-price-indent').each(function(){
		var pricei = $(this).find('.price-field-indent').html();
		var rpli= pricei.replace(/\./g,'');
		grandTotalindent += parseInt(rpli);

		console.log(rpli);
	});
	// alert(grandTotal);
	$("#grandTotalindent").html(grandTotalindent);
}
calcPriceTotalindent();


$(function(){
				$('.date-order').datepicker({
			dateFormat:"yy/mm/dd"});
			});

			$('#btn_plus').click(function(){
				var table = $('#tableRB').find('tbody');
				var clone = table.find('tr:first').clone();
				clone.find('input').val('');
				table.append(clone);
				var DaftarItem = [<?php echo ambil_item();?>];
				$( "#rb-item" ).autocomplete({
		      source: DaftarIte
					});
			});
$(function(){
				$("#date-paid").datepicker({
					dateFormat:"yy/mm/dd"});
						});

$(document).on('click', '.link-save', function(){
	var row = $(this).closest('tr');
	var id = row.data('id');
	var rb_year1 = row.find('[name="rb_year1"]').val();
	var rb_periode1 = row.find('[name="rb_periode1"]').val();
	var rb_order_date1 = row.find('[name="rb_order_date1"]').val();
	var material_category_name1 = row.find('[name="material_category_name1"]').val();
	var rb_item1 = row.find('[name="rb_item1"]').val();
	var project_rab_total1 = row.find('[name="project_rab_total1"]').val();
	var project_rb_total1 = row.find('[name="project_rb_total1"]').val();
	//alert(id);
	$.post('insertmp2.php', {
		project_id : id,
		rb_year1: rb_year1,
		rb_periode1: rb_periode1,
		rb_order_date1: rb_order_date1,
		material_category_name1: material_category_name1,
		rb_item1: rb_item1,
		project_rb_total1: project_rb_total1,
		project_rab_total1: project_rab_total1
	}, function(val){
		//alert(val);
		row.find('.project-input').each(function(){
			var label = $(this).parent().find('.project-label');
			var input = $(this);
			label.html(input.val());
			label.show();
			input.hide();
		});
	});
	return false;
});

$(function() {
    var DaftarItem = [<?php echo ambil_item();?>];
    $( "#rb-item" ).autocomplete({
      source: DaftarItem
    });
  });

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label1');
		var input = row.find('.project-input1');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label2');
		var input = row.find('.project-input2');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label3');
		var input = row.find('.project-input3');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label4');
		var input = row.find('.project-input4');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label5');
		var input = row.find('.project-input5');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label6');
		var input = row.find('.project-input6');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label7');
		var input = row.find('.project-input7');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label8');
		var input = row.find('.project-input8');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label9');
		var input = row.find('.project-input9');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label10');
		var input = row.find('.project-input10');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label11');
		var input = row.find('.project-input11');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label12');
		var input = row.find('.project-input12');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label13');
		var input = row.find('.project-input13');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label14');
		var input = row.find('.project-input14');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label15');
		var input = row.find('.project-input15');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label16');
		var input = row.find('.project-input16');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label17');
		var input = row.find('.project-input17');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label18');
		var input = row.find('.project-input18');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label19');
		var input = row.find('.project-input19');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label20');
		var input = row.find('.project-input20');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label21');
		var input = row.find('.project-input21');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

$('#btn_plus').click(function(){
	var table = $('#tableRB').find('tbody');
	var clone = table.find('tr:first').clone();
	clone.find('input').val('');
	table.append(clone);
	table.find('.date-order').datepicker({
			dateFormat:"yy/mm/dd"
		});

});

$(function () {
            $('#konfirm-box').dialog({
                modal: true,
                autoOpen: false,
                show: "bounce",
                hide: "explode",
                title: "Konfirmasi",
                buttons: {

                    "Ya": function () {
											window.location = '../deleted.php?id=<?= $_GET['id'] ?>';
										},
                    "Batal": function () {

                    $(this).dialog("close");

            }
					}
				});


            $('.link-del').click(function () {
								if(confirm("Apakah anda yakin ingin menghapus data ini?"))
								{
									return true;
								}
								return false;

            });
        });

function startCalculate(){
interval=setInterval("Calculate()",10)	;

}
function Calculate(){

//var a=parseFloat(document.form1.price.value);
	$('[name="rb_order_total[]"]').each(function(){
		var parent = $(this).closest('tr');
		var b = parent.find('[name="rb_item_price[]"]').val();
		var c = $(this).val();
		parent.find('[name="rb_item_price_total[]"]').val(b*c);
	});

	$('[name="rb_volume_indent[]"]').each(function(){
		var parent = $(this).closest('tr');
		var d = parent.find('[name="rb_volume_paid[]"]').val();
		var e = parent.find('[name="rb_order_sent[]"]').val();
		var f = parseInt(e)-parseInt(d);
		parent.find('[name="rb_volume_indent[]"]').val(f);
	});

	$('[name="rb_volume_indent[]"]').each(function(){
		var parent = $(this).closest('tr');
		var g = parent.find('[name="rb_item_price[]"]').val();
		var h = $(this).val();
		var i = parseInt(g)*parseInt(h);
		parent.find('[name="rb_price_indent[]"]').val(i);
	});
//var b=parseFloat(document.form1.volume_indent.value);
//var c=parseFloat(document.form1.order_total.value)
//document.form1.price_total.value= a*c;
//document.form1.indent.value= a*b;
// var b=document.form1.volume_indent.value;
// var d=document.form1.indent
}

function stopCalc(){
clearInterval(interval);
}

</script>
</form>
