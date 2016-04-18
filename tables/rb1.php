<?php 
	include '../init.php';
	include '../function.php';
?>
<div style="width:100%; height:200px; display:block; font-size:0.9em;float:left; overflow:auto;" id='div1'>
<table class='table table-stripped'>
	<thead>
		<tr>
			<td>FILTER:</div></td>
			<td colspan="16">
			<input type="text" name="fOrderDate" id="fOrderDate" placeholder="Tgl Order" class="datepicker3" style="width:120px" value="<?=$_SESSION['fOrderDate']?>"/>
				<?php
					$sql="SELECT DISTINCT(m.material_category_id) as material_category_id, mc.material_category_name
						FROM realbahan rb, master_material m, master_material_category mc 
						WHERE sha1(rb_project_id) = '".$_SESSION['project_id']."'
							AND m.material_id=rb.rb_link_value_id and m.material_category_id=mc.material_category_id";
					$result=mysqli_query($conn,$sql);
					echo "<select name='fCategory' id='fCategory' class=''>";
					echo "<option value=''>-Category-</option>";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['material_category_id']."' ".(($data['material_category_id']==$_SESSION['fCategory'])?"selected":"").">".$data['material_category_name']."</option>";
					}
					echo "</select>";
				?>
			<input type="text" name="fName" id="fName" placeholder="Nama Item" class="" style="width:120px" value="<?=$_SESSION['fName']?>"/>
			<input type="text" name="fSupplier" id="fSupplier" placeholder="Supplier" class="" style="width:120px" value="<?=$_SESSION['fSupplier']?>"/>
			<input type="text" name="fAc" id="fAc" placeholder="No AC" class="" style="width:120px" value="<?=$_SESSION['fAc']?>"/>
			<?php
				//$result=mysqli_query($conn, "SELECT unit_id, unit_name FROM master_unit WHERE unit_status='enabled' ORDER BY unit_name");
				echo "<select name='fPayment' id='fPayment' class='input'>";
				$arrPaymentStatus=array('BG','by owner','CB','Indent','Kontan','Non Cash','owner','Retur','Transfer');
				foreach($arrPaymentStatus as $paymentStatus){
					echo "<option value='".$paymentStatus."' ".(($paymentStatus==$_SESSION['fPayment'])?"selected":"").">".$paymentStatus."</option>";
				}
				echo "</select>";
			?>
			</div></td>
		</tr>
		<tr>
			<th><div style='text-align:center; width:30px'>No</div></th>
			<th><div style='text-align:center; width:80px'>Tgl Order</div></th>
			<th><div style='text-align:center; width:120px'>Item</div></th>
			<th><div style='text-align:center; width:50px'>Jml Order</div></th>
			<th><div style='text-align:center; width:50px'>Jml Terkirim</div></th>
			<th><div style='text-align:center; width:50px'>Vol Terbayar</div></th>
			<th><div style='text-align:center; width:50px'>Vol Indent</div></th>
			<th><div style='text-align:center; width:30px'>Satuan</div></th>
			<th><div style='text-align:center; width:80px'>Harga Satuan</div></th>
			<th><div style='text-align:center; width:80px'>Jml Harga</div></th>
			<th><div style='text-align:center; width:80px'>Indent</div></th>
			<th><div style='text-align:center; width:100px'>Supplier</div></th>
			<th><div style='text-align:center; width:50px'>No AC</div></th>
			<th><div style='text-align:center; width:30px'>Status Bayar</div></th>
			<th><div style='text-align:center; width:50px'>No Faktur</div></th>
			<th><div style='text-align:center; width:50px'>No Bayar</div></th>
			<th><div style='text-align:center; width:80px'>Tgl Cair</div></th>
		</tr>
	</thead>
	
	<tbody>
	
	<?php
	$arrRow=array();
	$filterRB="";
	$filterMut="";
	if($_SESSION['fOrderDate']!=""){
		$filterRB.=" AND rb_order_date='".$_SESSION['fOrderDate']."' ";
		$filterMut.=" AND mutation_date='".$_SESSION['fOrderDate']."' ";
	}
	if($_SESSION['fCategory']!=""){
		$filterRB.=" AND m.material_category_id='".$_SESSION['fCategory']."' ";
		$filterMut.=" AND m.material_category_id='".$_SESSION['fCategory']."' ";
	}
	if($_SESSION['fName']!=""){
		$filterRB.=" AND rb_link_value_name LIKE '%".$_SESSION['fName']."%'";
		$filterMut.=" AND mutation_link_value_name LIKE '%".$_SESSION['fName']."%'";
		
	}
	if($_SESSION['fSupplier']!=""){
		$filterRB.=" AND rb_supplier='".$_SESSION['fSupplier']."' ";
		$filterMut.=" AND (mutation_project_origin='".$_SESSION['fSupplier']."' OR mutation_project_dest='".$_SESSION['fSupplier']."')";
		
	}
	if($_SESSION['fAc']!=""){
		$filterRBDetail.=" AND rb_ac_no LIKE '%".$_SESSION['fAc']."%' ";
		$filterMut.=" AND mutation_billno LIKE '%".$_SESSION['fAc']."%' ";
	}
	if($_SESSION['fPayment']!=""){
		$filterRB.=" AND rb_payment_status ='".$_SESSION['fPayment']."' ";
		$filterMut.=" AND 1=0 ";
		
	}
	
	//REALBAHAN
	$sql="SELECT rb_id, rb_project_id, rb_order_date, rb_link_value_id, rb_link_value_name, rb_item_detail, 
				rb_order_total, rb_order_sent, rb_volume_paid, rb_id, u.unit_name, rb_item_price, 
				rb_supplier, rb_payment_status, rb_notes 
			FROM realbahan, master_unit u, master_material m, master_material_category mc
			WHERE rb_unit_id=u.unit_id
				AND rb_status='enabled'
				AND m.material_id=rb_link_value_id 
				AND m.material_category_id=mc.material_category_id
				AND sha1(rb_project_id) = '".$_SESSION['project_id']."' ".$filterRB."
			ORDER BY rb_order_date";
	$result=mysqli_query($conn, $sql);
	while($data=mysqli_fetch_array($result)){
		$arrDetails=array();
		$sql="SELECT rb_id, rb_ac_no, rb_invoice_no, rb_payment_no, rb_payment_date
			FROM realbahan_detail
			WHERE rb_id='".$data['rb_id']."' ".$filterRBDetail."
			ORDER BY rb_payment_date";
		$result2=mysqli_query($conn, $sql);
		while($data2=mysqli_fetch_array($result2)){
			$arrDetails[]=$data2;
		}
		
		$ac_no="";
		$invoice_no="";
		$payment_no="";
		$payment_date="";
		
		foreach($arrDetails as $arrDetail){
				$ac_no.=$arrDetail['rb_ac_no']."<br/>";
				$invoice_no.=$arrDetail['rb_invoice_no']."<br/>";
				$payment_no.=$arrDetail['rb_payment_no']."<br/>";
				$payment_date.=convertToDateID($arrDetail['rb_payment_date'])."<br/>";
		}
		$detail=end($arrDetails);
		
		$arrRow[]=array(
			"type" => "realbahan",
			"tgl_order" => $data['rb_order_date'],
			"item" => $data['rb_link_value_name']." ".$data['rb_item_detail'].(($data['rb_notes']!="")?"<span>".str_replace("\n","<br/>",$data['rb_notes'])."</span>":""),
			"jml_order" => number_format($data['rb_order_total'], 3, ",", "."),
			"jml_kirim" => number_format($data['rb_order_sent'], 3, ",", "."),
			"vol_bayar" => number_format($data['rb_volume_paid'], 3, ",", "."),
			"vol_indent" => ($data['rb_order_sent']-$data['rb_volume_paid']),
			"satuan" => $data['unit_name'],
			"harga" => $data['rb_item_price'],
			"jml_harga" => ($data['rb_volume_paid']*$data['rb_item_price']),
			"indent" => (($data['rb_order_sent']-$data['rb_volume_paid'])*$data['rb_item_price']),
			"supplier" => $data['rb_supplier'],
			"no_ac" => $ac_no,
			"status" => $data['rb_payment_status'],
			"no_faktur" => $invoice_no,
			"no_bayar" => $payment_no,
			"tgl_Cair" => $payment_date,
		);
	}	
	//MUTATION
	$sql="SELECT mutation_id, mutation_billno, mutation_date, mutation_project_origin_id, mutation_project_origin, 
				mutation_project_dest_id, mutation_project_dest, mutation_link_value_id, mutation_link_value_name, 
				mutation_total, u.unit_name, mutation_price, mutation_notes
			FROM mutation, master_unit u, master_material m, master_material_category mc
			WHERE mutation_unit_id=u.unit_id 
				AND m.material_id=mutation_link_value_id 
				AND m.material_category_id=mc.material_category_id
				AND (sha1(mutation_project_origin_id)='".$_SESSION['project_id']."'
					OR sha1(mutation_project_dest_id)='".$_SESSION['project_id']."') ".$filterMut;
	$result2=mysqli_query($conn, $sql);
	while($data2=mysqli_fetch_array($result2)){
		if(sha1($data2['mutation_project_origin_id'])==$_SESSION['project_id']){
			$total=$data2['mutation_total']*(-1);
			$supplier="Mutasi ke ".$data2['mutation_project_origin'];
			$show_total="(".number_format($data2['mutation_total'], 3, ",", ".").")";
			
		}
		if(sha1($data2['mutation_project_dest_id'])==$_SESSION['project_id']){
			$total=$data2['mutation_total'];
			$supplier="Mutasi dari ".$data2['mutation_project_dest'];
			$show_total=number_format($data2['mutation_total'], 3, ",", ".");
		}
		
		
		$arrRow[]=array(
				"type" => "mutation",
				"tgl_order" => $data2['mutation_date'],
				"item" => $data2['mutation_link_value_name'],
				"jml_order" => $show_total,
				"jml_kirim" => $show_total,
				"vol_bayar" => $show_total,
				"vol_indent" => "",
				"satuan" => $data2['unit_name'],
				"harga" => $data2['mutation_price'],
				"jml_harga" => ($total*$data2['mutation_price']),
				"indent" => "0",
				"supplier" => $supplier,
				"no_ac" => $ac_no,
				"status" => "Mutasi",
				"no_faktur" => $data2['mutation_billno'],
				"no_bayar" => "",
				"tgl_Cair" => convertToDateID($data2['mutation_date']),
			);
	}

	array_sort_by_column($arrRow, 'tgl_order');
	$no=1;
	$totalPrice=0;
	$totalIndent=0;
	foreach($arrRow as $row){
		/*
if($row['type']=='mutation'){
			echo "<pre>";
			print_r($row);
			echo "</pre>";
		}
*/
		$totalPrice+=$row['jml_harga'];
		$totalIndent+=$row['indent'];
		echo "<tr class='".$row['type']."'>";
		echo "<td><div style='width:30px; text-align:right;'>".$no."</div></td>";
		echo "<td><div style='width:80px; text-align:center;'>".convertToDateID($row['tgl_order'])."</div></td>";
		echo "<td><div style='width:150px; text-align:left;'><div class='tooltips'>".$row['item']."</div></td>";
		echo "<td><div style='width:50px; text-align:right;'>".$row['jml_order']."</div></td>";
		echo "<td><div style='width:50px; text-align:right;'>".$row['jml_kirim']."</div></td>";
		echo "<td><div style='width:50px; text-align:right;'>".$row['vol_bayar']."</div></td>";
		echo "<td><div style='width:50px; text-align:right;'>".$row['vol_indent']."</div></td>";
		echo "<td><div style='width:30px; text-align:right;'>".$row['satuan']."</div></td>";
		echo "<td><div style='width:80px; text-align:right;'>".convertToRp($row['harga'])."</div></td>";
		echo "<td><div style='width:80px; text-align:right;'>".convertToRp($row['jml_harga'])."</div></td>";
		echo "<td><div style='width:80px; text-align:right;'>".convertToRp($row['indent'])."</div></td>";
		echo "<td><div style='width:100px; text-align:left;'>".$row['supplier']."</div></td>";
		echo "<td><div style='width:50px; text-align:left;'>".$row['no_ac']."</div></td>";
		echo "<td><div style='width:50px; text-align:left;'>".$row['status']."</div></td>";
		echo "<td><div style='width:50px; text-align:left;'>".$row['no_faktur']."</div></td>";
		echo "<td><div style='width:50px; text-align:left;'>".$row['no_bayar']."</div></td>";
		echo "<td><div style='width:80px; text-align:center;'>".$row['tgl_Cair']."</div></td>";
		echo "</tr>";
		$no++;
	}
	?>

	</tbody>
	<tfoot>
		<tr>
		<td colspan="9"><div style='text-align:right; font-weight:bold;'>TOTAL</div></td>
		<td><div style='width:80px; text-align:right;'><?=convertToRp($totalPrice);?></div></td>
		<td colspan="6"><div style='width:80px; text-align:right;'><?=convertToRp($totalIndent);?></div></td>
		<td>
		</tr>
	</tfoot>
</table>
</div>
<style type="text/css">
	tr.mutation{
		background-color: #ffe7e7;
	}
</style>
<script>
$(document).ready(function(){
	var d = $('#div1');
	d.scrollTop(d.prop("scrollHeight"));
	$(".datepicker3").datepicker({
		format:'dd-mm-yyyy',
	}).on('changeDate',function(){
		$(this).datepicker('hide');
		var inputs = $(this).parents("table").eq(0).find(":input");
		var idx = inputs.index(this);
		if (idx == inputs.length - 1) {
		    inputs[0].select()
		} else {
		    inputs[idx + 1].focus(); //  handles submit buttons
		    inputs[idx + 1].select();
		}
		return false;
	});
});
$("#fSupplier").autocomplete({
		source: function(request, response) {
				$.ajax({
	                url: "process/autocomplete.php",
	                dataType:'json',
	                data: {
	                    id: 'realbahan',
	                    item: $("#fSupplier").val(),
	                    type: 'supplier'
	                },
	                success: function(data) {
	                    response(data);
	                }
	            });
	        },
		minLength:2,
		select: function( event, ui ) {
			$.post('setfilter.php',{
				fSupplier:ui.item.id
				});
			$("#table-rb").load("tables/rb.php");	
		},
		change: function( event, ui ) {
			$.post('setfilter.php',{
				fSupplier:$("#fSupplier").val()
				});
			$("#table-rb").load("tables/rb.php");	
		}
	});
$("#fCategory").change(function(){
	$.post('setfilter.php',{
		fCategory:$("#fCategory").val()
		});
	$("#table-rb").load("tables/rb.php");			
});
$("#fPayment").change(function(){
	$.post('setfilter.php',{
		fPayment:$("#fPayment").val()
		});
	$("#table-rb").load("tables/rb.php");			
});
$("#fName").change(function(){
	$.post('setfilter.php',{
		fName:$("#fName").val()
		});
	$("#table-rb").load("tables/rb.php");			
});
$("#fPayment").change(function(){
	$.post('setfilter.php',{
		fPayment:$("#fPayment").val()
		});
	$("#table-rb").load("tables/rb.php");			
});

</script>