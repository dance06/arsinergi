<?php
include '../init.php';
include '../function.php';

if($_SESSION['page']!='rbupah'){
	echo "[ERROR] You don't have permission";
}else{
	$sql="SELECT project_id FROM project WHERE sha1(project_id)='".$_SESSION['project_id']."'";
	$result=mysqli_query($conn, $sql);
	$data=mysqli_fetch_array($result);
	$project_id=$data[0];
	
	$date = convertDate($_POST['order_date']);
	$type = $_POST['group'];
	$item = $_POST['item'];
	$item_detail = $_POST['item_detail'];
	$total = $_POST['order_total'];
	$unit = $_POST['unit'];
	$price = $_POST['price'];
	$type = $_POST['type'];
	$notes = mysqli_real_escape_string($conn, $_POST['notes']);
	
	
	$datas=array(
		"wage_project_id" => $project_id,
		"wage_date" => $date,
		"wage_type" => $type,
		"wage_item" => $item,
		"wage_item_detail" => $item_detail,
		"wage_total" => $total,
		"wage_unit_id" => $unit,
		"wage_price" => $price,
		"wage_price_type" => $type,
		"wage_notes" => $notes,
	);

	$field="";
	$value="";
	foreach($datas as $key => $data){
		$field.=$key.",";
		$value.="'".$data."',";
	}
	if(mysqli_query($conn, "INSERT INTO realupah (".rtrim($field,",").")
		VALUES (".rtrim($value,",").")")){
		echo "[SUCCESS] Data has been saved";
	}else{
		echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}
?>