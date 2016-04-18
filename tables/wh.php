<?php 
	include '../init.php';
	include '../function.php';
?>
<div style="width:95%; overflow:scroll; float:left;">
<table class='table table-stripped' style="width:1100px;">
	<thead>
		<tr>
			<th style="text-align:center;">No</th>
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
	<?php
	$sql="SELECT wh_id, mwh.warehouse_name, wh_link_value_id, wh_link_value_name, wh_size, wh_type, u.unit_name,
			wh_price, wh_total_in, wh_total_out, wh_total_left, wh_ac_origin, wh_project_origin, wh_notes
		FROM warehouse, master_warehouse mwh, master_unit u
		WHERE wh_warehouse_id=mwh.warehouse_id
			AND u.unit_id=wh_unit_id";
	$no=1;
	$result=mysqli_query($conn, $sql);
	while($data=mysqli_fetch_array($result)){
		$sql="SELECT whdetail_id, wh_id, whdetail_type, whdetail_date, whdetail_total, 
				whdetail_ac_dest, whdetail_project_dest, whdetail_notes
				FROM warehouse_Detail
			WHERE wh_id='".$data['wh_id']."'";
		$result2=mysqli_query($conn, $sql);
		$data2=mysqli_fetch_array($result2);
		echo "<tr>";
		echo "<td>".$no."</td>";
		echo "<td>".$data['warehouse_name']."</td>";
		echo "<td>".convertToDateID($data2['whdetail_date'])."</td>";
		echo "<td>".$data['wh_link_value_name']."</td>";
		echo "<td>".$data['wh_size']."</td>";
		echo "<td>".$data['wh_type']."</td>";
		echo "<td>".number_format($data['wh_total_in'],3,".",",")."</td>";
		echo "<td>".$data['unit_name']."</td>";
		echo "<td>".convertToRp($data['wh_price'])."</td>";
		echo "<td>".$data['wh_ac_origin']."</td>";
		echo "<td>".$data['wh_project_origin']."</td>";
		echo "<td>".$data['wh_notes']."</td>";
		echo "</tr>";
		$no++;
	}	
	?>
	</tbody>
</table>
</div>