<?php 
	include '../init.php';
	$sql="SELECT project_id, project_measurement_total FROM project WHERE sha1(project_id)='".$_SESSION['project_id']."'";
	$result=mysqli_query($conn, $sql);
	$data=mysqli_fetch_array($result);
	$project_id=$data[0];
	$total=$data[1];
?>

<table class='table table-stripped'>
	<thead>
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">Item Luasan Kerja</th>
			<th rowspan="2">Luas (A)</th>
			<th rowspan="2">Satuan</th>
			<th colspan="2" align="center">Luasan Owner</th>
			<th colspan="2" align="center">Luasan Mandor</th>
			<th rowspan="2"></th>
		</tr>
		<tr>
			<th>Koefisien (B)</th>
			<th>(AxB) M2</th>
			<th>Koefisien (B)</th>
			<th>(AxB) M2</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql="SELECT DISTINCT(cat.catmeas_name), cat.catmeas_id
		FROM measurement m, master_measurement_category cat 
		WHERE m.meas_category_id=cat.catmeas_id AND 
			sha1(m.meas_project_id)='".$_SESSION['project_id']."'
			AND m.meas_status='enabled'";
	$result=mysqli_query($conn, $sql);
	while($data=mysqli_fetch_array($result)){
		echo "<tr><td colspan='9' style='font-weight:bold;'>".$data['catmeas_name']."</td></tr>";
		$no=1;
		$sql="SELECT m.meas_id, m.meas_name, m.meas_area, u.unit_name, meas_coef_owner, meas_coef_foreman
				FROM measurement m, master_unit u 
		WHERE meas_unit_id = u.unit_id AND 
			m.meas_category_id='".$data['catmeas_id']."' AND
			sha1(m.meas_project_id)='".$_SESSION['project_id']."'";
		$result2=mysqli_query($conn, $sql);
		while($data2=mysqli_fetch_array($result2)){
			echo "<tr>";
			echo "<td>".$no++."</td>";
			echo "<td>".$data2['meas_name']."</td>";
			echo "<td>".$data2['meas_area']."</td>";
			echo "<td>".$data2['unit_name']."</td>";
			echo "<td align='right'>".$data2['meas_coef_owner']."</td>";
			echo "<td align='right'>".($data2['meas_area']*$data2['meas_coef_owner'])."</td>";
			echo "<td align='right'>".$data2['meas_coef_foreman']."</td>";
			echo "<td align='right'>".($data2['meas_area']*$data2['meas_coef_foreman'])."</td>";
			echo "</tr>";
			
		}
	}
	echo "<tr style='font-weight:bold;'>";
	echo "<td colspan='5' align='right' >TOTAL</td>";
	echo "<td align='right'>".number_format($total,3,".",",")."</td>";
	echo "<td colspan='2'></td>";
	echo "</tr>";
	
	?>

	</tbody>
</table>