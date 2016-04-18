<?php
include '../init.php';

if($_SESSION['page']!='overview'){
	echo "[ERROR] You don't have permission";
}else{

	$datas = array(
		"project_name" => $_POST['name'],	
		"project_category_id" =>$_POST['category'],	
		"project_address" => $_POST['address'],
		"project_city" => $_POST['city'],
		"project_pic" => $_POST['pic'],
		"project_client_name" => $_POST['client'],	
		"project_client_phone" => $_POST['phone'],
		"project_client_email" => $_POST['email'],	
		"project_note" => $_POST['notes'],
	);       

	$field="";
	$value=""; 
	foreach($datas as $key => $data){
		$field.=$key.",";
		$value.="'".$data."',";
	}
	if(mysqli_query($conn, "INSERT INTO project (".rtrim($field,",").")
					VALUES (".rtrim($value,",").")")){
		$_SESSION['project_id']=sha1(mysqli_insert_id($conn));
		echo "[SUCCESS] Data has been saved";
	}else{
		echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}


?>