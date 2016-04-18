<?php
	include '../init.php';
	include '../function.php';
?>
<div style="width:95%; overflow:auto; float:left;">
<table class='table table-stripped' style="width:1100px;">
	<thead>
		<tr>
			<th>tes</th>
			<th>Tanggal</th>
			<th>Proyek Asal</th>
			<th>Proyek Tujuan</th>
			<th>Item</th>
			<th>Jumlah</th>
			<th>Satuan</th>
			<th>Harga</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql="SELECT mutation_id, mutation_billno, mutation_date, mutation_project_origin_id, mutation_project_origin,
				mutation_project_dest_id, mutation_project_dest, mutation_link_value_id, mutation_link_value_name,
				mutation_total, u.unit_name, mutation_price, mutation_notes
			FROM mutation, master_unit u
			WHERE mutation_unit_id=u.unit_id";
	$result=mysqli_query($conn, $sql);
	while($data=mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>".$data['mutation_billno']."</td>";
		echo "<td>".convertToDateID($data['mutation_date'])."</td>";
		echo "<td>".$data['mutation_project_origin']."</td>";
		echo "<td>".$data['mutation_project_dest']."</td>";
		echo "<td>".$data['mutation_link_value_name']."</td>";
		echo "<td>".number_format($data['mutation_total'],3,".",",")."</td>";
		echo "<td>".$data['unit_name']."</td>";
		echo "<td>".convertToRp($data['mutation_price'])."</td>";
		echo "<td>".$data['mutation_notes']."</td>";
		echo "</tr>";
	}
	?>
	</tbody>
</table>
</div>
