<?php 
	include '../init.php';
?>
<table class='table table-stripped'>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Bahan</th>
			<th>Satuan</th>
			<th>Harga Dasar</th>
			<th>Formula</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql="SELECT m.material_id, mc.material_category_name, m.material_name_1, m.material_name_2, m.material_name_3, m.material_name_4,
			u.unit_name, m.material_price_value, m.material_price_formula
		FROM master_material m, master_unit u, master_material_category mc
		WHERE m.material_unit_id=u.unit_id AND m.material_category_id=mc.material_category_id AND m.material_status='enabled'";
	$result=mysqli_query($conn, $sql);
	$no=1;
	while($data=mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>".$no++."</td>";
		echo "<td>".$data['material_category_name']." ".$data['material_name_1']." ".$data['material_name_2']." ".$data['material_name_3']." ".$data['material_name_4']."</td>";
		echo "<td>".$data['unit_name']."</td>";
		echo "<td>Rp. <div style='text-align:right;display:inline-block;width:90px;'>".number_format($data['material_price_value'],2,".",",")."</div></td>";
		echo "<td>".$data['material_price_formula']."</td>";
		echo "</tr>";
		
	}		
	?>

	</tbody>
</table>
</table>