<?php
	include '../init.php';
?>
<table class='table table-stripped'>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Satuan</th>
			<th>Catatan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql="SELECT unit_id, unit_name, unit_note, unit_status
			FROM master_unit
			WHERE unit_status='enabled'";
	$result=mysqli_query($conn, $sql);
	$no=1;
	while($data=mysqli_fetch_array($result)){
		echo "<tr data-id='".$data['unit_id']."'>";
		echo "<td>".$no++."</td>";
		echo "<td>".$data['unit_name']."</td>";
		echo "<td>".$data['unit_note']."</td>";
		echo "<td><a href='deletedunit.php?id=".$data['unit_id']."' class='btn btn-default btn-s' value='edit'>
						<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						</a></td>";
		echo "</tr>";

	}
	?>

	</tbody>
</table>
</table>
