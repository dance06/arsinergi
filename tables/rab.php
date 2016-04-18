<?php 
	include '../init.php';
	include '../function.php';
	$sql="SELECT project_id, project_rab_total FROM project WHERE sha1(project_id)='".$_SESSION['project_id']."'";
	$result=mysqli_query($conn, $sql);
	$data=mysqli_fetch_array($result);
	$project_id=$data[0];
	$total=$data[1];
?>
<table class='table table-stripped'>
	<thead>
		<tr>
			<th>No</th>
			<th>Item Pekerjaan</th>
			<th>Volume</th>
			<th>Formula</th>
			<th>Satuan</th>
			<th>Koef Volume</th>
			<th>Vol</th>
			<th>Koef Harga</th>
			<th>Koef Profit</th>
			<th>Harga Satuan</th>
			<th>Formula</th>
			<th>Jumlah Harga</th>
		</tr>
	</thead>
	<tbody>
	<?php
		
	$sql="SELECT DISTINCT(rabc.catrab_name), rabc.catrab_id
			FROM rab r, project p, master_rab_category rabc
			WHERE r.rab_project_id=p.project_id
				AND r.rab_category_id=rabc.catrab_id
				AND r.rab_status='enabled'
				AND sha1(p.project_id) = '".$_SESSION['project_id']."'";
	$result=mysqli_query($conn, $sql);
	while($data=mysqli_fetch_array($result)){
		echo "<tr><td colspan='9' style='font-weight:bold;'>".$data['catrab_name']."</td></tr>";
		$no=1;
		$sql="SELECT rab_id, rab_project_id, rab_category_id, rab_link_type, rab_link_value_id, 
				rab_link_value_name, rab_link_value_price, rab_link_value_formula, rab_volume_value, 
				rab_volume_formula, u.unit_name, rab_coef_volume, rab_coef_price, rab_coef_profit
				FROM rab r, master_unit u 
		WHERE rab_unit_id = u.unit_id AND 
			rab_category_id='".$data['catrab_id']."' AND
			sha1(rab_project_id)='".$_SESSION['project_id']."'";
		$result2=mysqli_query($conn, $sql);
		while($data2=mysqli_fetch_array($result2)){
			echo "<tr>";
			echo "<td>".$no++."</td>";
			echo "<td>".$data2['rab_link_value_name']."</td>";
			echo "<td>".number_format($data2['rab_volume_value'],3,".",",")."</td>";
			echo "<td><div style='width:100px;overflow:hidden;'>".$data2['rab_volume_formula']."</div></td>";
			echo "<td>".$data2['unit_name']."</td>";
			echo "<td>".number_format($data2['rab_coef_volume'],3,".",",")."</td>";
			echo "<td>".number_format(($data2['rab_volume_value']*$data2['rab_coef_volume']),3,".",",")."</td>";
			echo "<td>".number_format($data2['rab_coef_price'],3,".",",")."</td>";
			echo "<td>".number_format($data2['rab_coef_profit'],3,".",",")."</td>";
			echo "<td>".convertToRp($data2['rab_link_value_price'])."</td>";
			echo "<td>".$data2['rab_link_value_formula']."</td>";
			echo "<td>".convertToRp(($data2['rab_volume_value']*$data2['rab_coef_price']*$data2['rab_coef_profit']*$data2['rab_link_value_price']))."</td>";
			echo "</tr>";
			
		}
	}
	echo "<tr style='font-weight:bold;'>";
	echo "<td colspan='11' align='right'>TOTAL</td>";
	echo "<td align='right'>".convertToRp($total)."</td>";
	echo "</tr>";
		
	?>

	</tbody>
</table>