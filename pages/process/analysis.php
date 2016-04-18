<?php
include '../init.php';

if($_SESSION['page']!='analysis'){
	echo "[ERROR] You don't have permission";
}else{
	$mode=$_POST['mode'];
	if($mode==""){
		if($_SESSION['item_id']==""){
			$mode='newanalysis';
		}else{
			$mode='updateanalysis';
		}
	}
	if($mode=='newanalysis'){
		$datas = array(
	   		"item_name" => $_POST['name'], 	
	   		"item_unit_id" => $_POST['unit'], 		
	   		"item_value_price" => $_POST['value'], 	
	   	);
	
		$field="";
		$value=""; 
		foreach($datas as $key => $data){
			$field.=$key.",";
			$value.="'".$data."',";
		}
		
		if(mysqli_query($conn, "INSERT INTO master_item (".rtrim($field,",").")
						VALUES (".rtrim($value,",").")")){
			$_SESSION['item_id']=mysqli_insert_id($conn);
			echo "[SUCCESS] Data has been saved";
		}else{
			echo "[ERROR] Failed to save data".mysqli_error($conn);
		}
	}else if($mode=='updateanalysis'){
		$datas = array(
	   		"item_id" => $_POST['id'], 	
	   		"item_name" => $_POST['name'], 	
	   		"item_unit_id" => $_POST['unit'], 		
	   		"item_value_price" => $_POST['value'], 	
	   	);
	
		$value=""; 
		foreach($datas as $key => $data){
			$value.=$key."='".$data."',";
		}
		
		if(mysqli_query($conn, "UPDATE master_item SET ".rtrim($value,",")."WHERE item_id='".$_POST['id']."'")){
			$_SESSION['item_id']=$_POST['id'];
			echo "[SUCCESS] Data has been saved";
		}else{
			echo "[ERROR] Failed to update data".mysqli_error($conn);
		}
	}
}


?>