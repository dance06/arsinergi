<?php
include '../init.php';
include '../function.php';

if($_SESSION['page']!='gudang'){
	echo "[ERROR] You don't have permission";
}else{
	$warehouse= $_POST['warehouse'];
	$date_in = convertDate($_POST['date_in']);
	$link_value_id = $_POST['link_id'];
	$link_value_name = $_POST['item'];
	$size = $_POST['size'];
	$type = $_POST['type'];
	$total_in = $_POST['total_in'];
	$unit = $_POST['unit'];
	$price = $_POST['price'];
	$ac_origin = $_POST['ac_origin'];
	$project_origin = $_POST['project_origin'];
	$origin_id = $_POST['origin_id'];
	$notes = mysqli_real_escape_string($conn, $_POST['notes']);
	
	$datas=array(
		"wh_warehouse_id" => $warehouse,
		"wh_link_value_id" => $link_value_id,
		"wh_link_value_name" => $link_value_name,
		"wh_size" => $size,
		"wh_type" => $type,
		"wh_unit_id" => $unit,
		"wh_price" => $price,
		"wh_total_in" => $total_in,
		"wh_total_out" => "0",
		"wh_total_left" => "0",
		"wh_ac_origin" => $ac_origin,
		"wh_project_origin_id" => $origin_id,
		"wh_project_origin" => $project_origin,
		"wh_notes" => $notes,
	);
	
	$field="";
	$value=""; 
	foreach($datas as $key => $data){
		$field.=$key.",";
		$value.="'".$data."',";
	}
	
	if(mysqli_query($conn, "INSERT INTO warehouse (".rtrim($field,",").")
						VALUES (".rtrim($value,",").")")){
			$datas=array(
				"wh_id" => mysqli_insert_id($conn),
				"whdetail_type" => 'in',
				"whdetail_date" => $date_in,
				"whdetail_total" => $total_in,
				"whdetail_ac_dest" => "",
				"whdetail_project_dest" => "",
				"whdetail_notes" => $notes,
			);
			$field="";
			$value=""; 
			foreach($datas as $key => $data){
				$field.=$key.",";
				$value.="'".$data."',";
			}
			if(mysqli_query($conn, "INSERT INTO warehouse_detail (".rtrim($field,",").")
						VALUES (".rtrim($value,",").")")){
				echo "[SUCCESS] Data has been saved";
			}else{
				echo "[ERROR] Failed to save data".mysqli_error($conn);
			}
		}else{
			echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}


?>