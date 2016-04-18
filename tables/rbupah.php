<?php 
	include '../init.php';
	include '../function.php';
?>
<div style="width:95%; overflow:scroll; float:left;">
<table class='table table-stripped' style="width:2000px;">
	<thead>
		<tr>
			<th>No</th>
			<th>Tgl Bon</th>
			<th>Golongan</th>
			<th>Item</th>
			<th>Detail Item</th>
			<th>Jumlah</th>
			<th>Satuan</th>
			<th>Harga Satuan</th>
			<th>Total Harga</th>
			<th>Mandor</th>
			<th>Alat</th>
			<th>Borongan</th>
			<th>Ket</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql="SELECT wage_id, wage_project_id, wage_date, wage_type, wage_item, wage_item_detail, wage_total, u.unit_name, wage_price,wage_price_type, wage_notes, wage_status
		FROM realupah, master_unit u
		WHERE wage_unit_id=u.unit_id 
			AND sha1(wage_project_id) = '".$_SESSION['project_id']."'";
	$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));				
	$no=1;
	$total=0;
	$mandor=0;
	$alat=0;
	$borongan=0;
	while($data=mysqli_fetch_array($result)){
		switch($data['wage_type']){
			case 'alat': $type="Alat"; break;
			case 'bbm': $type="BBM"; break;
			case 'tenaga': $type="Tenaga"; break;
		}
		$total+=$data['wage_total'] * $data['wage_price'];
		$tmpMandor="";
		$tmpAlat="";
		$tmpBorongan="";
		if($type=='Tenaga' && $data['wage_price_type']=='mandor'){
			$tmpMandor=convertToRp(($data['wage_total'] * $data['wage_price']));
			$mandor+=($data['wage_total'] * $data['wage_price']);
		}
		if($type=='Alat'){
			$tmpAlat=convertToRp(($data['wage_total'] * $data['wage_price']));
			$alat+=($data['wage_total'] * $data['wage_price']);
		}
		if($type=='Tenaga' && $data['wage_price_type']=='borongan'){
			$tmpBorongan=convertToRp(($data['wage_total'] * $data['wage_price']));
			$borongan+=($data['wage_total'] * $data['wage_price']);
		}
		
		echo "<tr>";
		echo "<td>".$no."</td>";
		echo "<td>".convertToDateID($data['wage_date'])."</td>";
		echo "<td>".$type."</td>";
		echo "<td>".$data['wage_item']."</td>";
		echo "<td>".$data['wage_item_detail']."</td>";
		echo "<td>".number_format($data['wage_total'],3,".",",")."</td>";
		echo "<td>".$data['unit_name']."</td>";
		echo "<td>".convertToRp($data['wage_price'])."</td>";
		echo "<td>".convertToRp(($data['wage_total'] * $data['wage_price']))."</td>";
		echo "<td>".$tmpMandor."</td>";
		echo "<td>".$tmpAlat."</td>";
		echo "<td>".$tmpBorongan."</td>";
		echo "<td>".$data['wage_notes']."</td>";
		echo "</tr>";
		$no++;
	}	
	echo "<tr>";
	echo "<td colspan='8' align='right'>TOTAL</td>";
	echo "<td>".convertToRp($total)."</td>";
	echo "<td>".convertToRp($mandor)."</td>";
	echo "<td>".convertToRp($alat)."</td>";
	echo "<td>".convertToRp($borongan)."</td>";
	echo "<td></td>";
	echo "</tr>";
	?>
	
	
	</tbody>
</table>
</div>