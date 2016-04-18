<?php
include '../init.php';
include '../function.php';

if($_SESSION['page']!='material'){
	echo "[ERROR] You don't have permission";
}else{
	$ip="";
	$history="";
	$log=$name."; ". $ip . "; ".$_SERVER["HTTP_USER_AGENT"];
	
	
	if(substr($_POST['price'], 0,1)=="="){
		$price_value=calc1(substr($_POST['price'],1));
		$price_formula=$_POST['price'];
	}else {
		$price_value=$_POST['price'];
		$price_formula="";
	}
	
	$datas = array(
    	"material_category_id" => $_POST['name_1'],
    	"material_name_1" => $_POST['name_2'],
    	"material_name_2" => $_POST['name_3'],
    	"material_name_3" => $_POST['name_4'],
    	"material_name_4" => $_POST['name_5'],
    	"material_unit_id" => $_POST['unit_id'],
    	"material_price_value" => $price_value,
    	"material_price_formula" => $price_formula,
    	"material_update_datetime" => date("Y-m-d H:i:s"),
    	"material_update_userlog" => $log,
    	"material_history" => $history,
	);
	
	$field="";
	$value=""; 
	foreach($datas as $key => $data){
		$field.=$key.",";
		$value.="'".$data."',";
	}
	
	if(mysqli_query($conn, "INSERT INTO master_material (".rtrim($field,",").")
					VALUES (".rtrim($value,",").")")){
		echo "[SUCCESS] Data has been saved";
	}else{
		echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}


?>