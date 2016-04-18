<?php
include '../init.php';
include '../function.php';

if($_SESSION['page']!='mutation'){
	echo "[ERROR] You don't have permission";
}else{
	$billno= $_POST['billno'];
	$date = convertDate($_POST['date']);
	$origin_id = $_POST['origin_id'];
	$origin = $_POST['origin'];
	$dest_id = $_POST['dest_id'];
	$dest = $_POST['dest'];
	$link_value_name = $_POST['item'];
	$link_value_id = $_POST['link_id'];
	$total = $_POST['total'];
	$unit = $_POST['unit'];
	$price = $_POST['price'];
	$notes = mysqli_real_escape_string($conn, $_POST['notes']);
	
	$datas=array(
		"mutation_billno" => $billno,
		"mutation_date" => $date,
		"mutation_project_origin_id" => $origin_id,
		"mutation_project_origin" => $origin,
		"mutation_project_dest_id" =>$dest_id ,
		"mutation_project_dest" => $dest,
		"mutation_link_value_id" => $link_value_id,
		"mutation_link_value_name" => $link_value_name,
		"mutation_total" => $total,
		"mutation_unit_id" => $unit,
		"mutation_price" => $price,
		"mutation_notes" => $notes,
	);

	$field="";
	$value="";
	foreach($datas as $key => $data){
		if($data!="NULL"){
			$field.=$key.",";
			$value.="'".$data."',";
		}
	}
	print_r($datas);
	if(mysqli_query($conn, "INSERT INTO mutation (".rtrim($field,",").")
	VALUES (".rtrim($value,",").")")){
		echo "[SUCCESS] Data has been saved";	
	}else{
		echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}


?>