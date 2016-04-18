<?php 
	include '../init.php';
	include '../function.php';
?>
<div id="analysis-item-list">
<div>Item Pekerjaan</div>
<?php
$result=mysqli_query($conn, "SELECT item_id, item_name, item_unit_id, item_value_price FROM master_item WHERE item_status='enabled' AND item_id='".$_SESSION['item_id']."'");
$itemDetail=mysqli_fetch_array($result);
?>
<input type="text" name="analysis" id="analysis" class="analysis-detail" value="<?=$itemDetail['item_name']?>"/>
<input type="hidden" name="analysisID" id="analysisID" value="<?=$itemDetail['item_id']?>" />
<?php
	
	$result=mysqli_query($conn, "SELECT unit_id, unit_name FROM master_unit WHERE unit_status='enabled'");
	echo "<select name='analysisUnit' id='analysisUnit' class='analysis-detail'>";
	while($data=mysqli_fetch_array($result)){
		echo "<option value='".$data['unit_id']."' ".(($data['unit_id']==$itemDetail['item_unit_id'])?"selected":"").">".$data['unit_name']."</option>";
	}
	echo "</select>";
	$result2=mysqli_query($conn, "SELECT analysis_id, analysis_item_id, analysis_volume_type, analysis_volume_formula, analysis_volume_value,
					u.unit_name, analysis_unit_id, analysis_link_type, analysis_link_value_name, analysis_link_value_id, analysis_link_value_price 
				FROM master_analysis, master_unit u
				WHERE analysis_unit_id=u.unit_id AND analysis_status='enabled' AND analysis_item_id='".$_SESSION['item_id']."'");

if(mysqli_num_rows($result)>0){
?>

<table class='table table-stripped'>
	<thead>
		<tr>
			<th>Detail Item Pekerjaan</th>
			<th>Volume</th>
			<th>Formula</th>
			<th>Satuan</th>
			<th>Harga Dasar</th>
			<th>Jumlah</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$total_item_price=0;
	while($data2=mysqli_fetch_array($result2)){
		echo "<tr>";
		echo "<td>".$data2['analysis_link_value_name']."</td>";
		if($data2['analysis_volume_type']=="formula"){
			$formula=$data2['analysis_volume_formula'];
			$volume=calc1(substr($formula,1));
		}else if($data2['analysis_volume_type']=="value"){
			$formula="";
			$volume=$data2['analysis_volume_value'];
		}
		echo "<td>".round($volume,3)."</td>";
		echo "<td>".$formula."</td>";
		echo "<td>".$data2['unit_name']."</td>";
		echo "<td>Rp. <div style='text-align:right;display:inline-block;width:90px;'>".number_format($data2['analysis_link_value_price'],2,".",",")."</div></td>";
		echo "<td>Rp. <div style='text-align:right;display:inline-block;width:90px;'>".number_format(($data2['analysis_link_value_price']*$volume),2,".",",")."</div></td>";
		echo "</tr>";
	}
	?>
	<tr>
			<th colspan="5" style="text-align:right;">TOTAL</th>
			<th id="total_item_price">Rp. <div style='text-align:right;display:inline-block;width:90px;'><?=number_format($itemDetail['item_value_price'],2,".",",")?></div></th>
			<th></th>
			<th></th>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>
<script>
	$(".analysis-detail").change(function(){
	$.post('process/analysis.php',{id:$("#analysisID").val(), name:$("#analysis").val(), unit:$("#analysisUnit").val(), value:""},
        function(data) {
        	if(data.indexOf("[ERROR]")>0){
				alert(data);
        	}else{
	        	 location.reload();
        	}		
         });
	});

</script>