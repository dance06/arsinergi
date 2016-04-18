<?php
include '../init.php';

if($_SESSION['page']!='analysis' && $_SESSION['page']!='item'){
	echo "[ERROR] You don't have permission";
}else{
	$log=$name."; ". $ip . "; ".$_SERVER["HTTP_USER_AGENT"];
	$history="";
	
	$item_id=$_SESSION['item_id'];

	$item_option=$_POST['item_option'];
	$item=$_POST['item'];
	$volume=$_POST['volume'];
	$unit=$_POST['unit'];
	$price=$_POST['price'];
	
	
	if(substr($volume, 0,1)=="="){
		$volume_type="formula";
		$volume_formula=$volume;
		$volume_value="";
	}else {
		$volume_type="value";
		$volume_formula="";
		$volume_value=$volume;
	}
	
	if($item_option=="analysis"){
		$link_type="analysis";
		$link_value_name=$item;
		$link_value_id="";
		$link_value_price=$price;	
	}else if($item_option=="material"){
		$link_type="material";
		$link_value_name=$item;
		$link_value_id="";
		$link_value_price=$price;	
	}else{
		$link_type="manual";
		$link_value_name=$item;
		$link_value_id="";
		$link_value_price=$price;	

	}
	$datas=array(
		"analysis_item_id" => $item_id,
		"analysis_volume_type" => $volume_type,
		"analysis_volume_formula" => $volume_formula,
		"analysis_volume_value" => $volume_value,
		"analysis_unit_id" => $unit,
		"analysis_link_type" => $link_type,
		"analysis_link_value_name" => trim($link_value_name),
		"analysis_link_value_id" => $link_value_id,
		"analysis_link_value_price" => $link_value_price,
		"analysis_link_update_datetime" => date("Y-m-d H:i:s"),
		"analysis_link_update_userlog" => $log,
		"analysis_history" => $history,
	);	

	$field="";
	$value=""; 
	foreach($datas as $key => $data){
		$field.=$key.",";
		$value.="'".$data."',";
	}
	$result=mysqli_query($conn, "SELECT item_value_price FROM master_item WHERE item_id='".$item_id."'");
	$item_value_price=mysqli_fetch_array($result);
	$item_value_price=$item_value_price['item_value_price']+($volume_value*$link_value_price);
	if(!mysqli_query($conn, "UPDATE master_item SET item_value_price='".$item_value_price."' WHERE item_id='".$item_id."'")){
		echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
	
	if(mysqli_query($conn, "INSERT INTO master_analysis (".rtrim($field,",").")
					VALUES (".rtrim($value,",").")")){
		echo "[SUCCESS] Data has been saved";
	}else{
		echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}


?>