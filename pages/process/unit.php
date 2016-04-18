<?php
include '../init.php';
include '../function.php';

if($_SESSION['page']!='unit'){
	echo "[ERROR] You don't have permission";
}else{

	$datas=array(
		"unit_name" => $_POST['name'],
		"unit_note" => $_POST['notes'],
	);	
	$field="";
	$value=""; 
	foreach($datas as $key => $data){
		$field.=$key.",";
		$value.="'".$data."',";
	}
	
	if(mysqli_query($conn, "INSERT INTO master_unit (".rtrim($field,",").")
					VALUES (".rtrim($value,",").")")){
		echo "[SUCCESS] Data has been saved";
	}else{
		echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}


?>