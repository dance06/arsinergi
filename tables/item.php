<?php 
	include 'init.php';
?>
<table class='table table-stripped'>
	<thead>
		<tr>
			<th>No</th>
			<th>Item Pekerjaan</th>
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
	$sql="SELECT i.item_id, i.item_name, u.unit_name, i.item_value_price
		FROM master_item i, master_unit u
		WHERE i.item_unit_id=u.unit_id AND i.item_status='enabled'";
	$result=mysqli_query($conn, $sql);
	$no=1;
	while($data=mysqli_fetch_array($result)){
		echo "<tr style='background-color:#efefef;font-weight:bold;'><td>".$no."</td><td colspan='5'>".$data['item_name']." /".$data['unit_name']."</td><td>Rp. <div style='text-align:right;display:inline-block;width:90px;'>".number_format($data['item_value_price'],2,".",",")."</div></td><td rowspan=''></td></tr>";
		$sql="SELECT analysis_id, analysis_item_id, analysis_volume_type, analysis_volume_formula, analysis_volume_value,
					u.unit_name, analysis_link_type, analysis_link_value_name, analysis_link_value_id, analysis_link_value_price 
				FROM master_analysis, master_unit u
				WHERE analysis_unit_id=u.unit_id AND analysis_status='enabled' AND analysis_item_id='".$data['item_id']."'";
		$result2=mysqli_query($conn, $sql);
		while($data2=mysqli_fetch_array($result2)){
			echo "<tr>";
			echo "<td></td>";
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
			echo "<td>Rp. <div style='text-align:right;display:inline-block;width:90px;'>".number_format(($volume * $data2['analysis_link_value_price']),2,".",",")."</div></td>";
			echo "<td></td>";
			echo "</tr>";
			
		}
		echo "<tr><td colspan='8'></td></tr>";
		$no++;
	}
		
	?>

	</tbody>
</table>