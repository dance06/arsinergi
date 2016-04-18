<?php
include '../init.php';

if($_SESSION['page']!='measurement'){
	echo "[ERROR] You don't have permission";
}else{
	$sql="SELECT project_id, project_measurement_total FROM project WHERE sha1(project_id)='".$_SESSION['project_id']."'";
	$result=mysqli_query($conn, $sql);
	$data=mysqli_fetch_array($result);
	$project_id=$data[0];
	$total=$data[1];
	
	$datas = array(
    	"meas_project_id" => $project_id,
    	"meas_category_id" => $_POST['cat'],
    	"meas_name" => $_POST['name'],
    	"meas_area" => $_POST['area'],
    	"meas_unit_id" => $_POST['unit'],
    	"meas_coef_owner" => $_POST['owner'],
    	"meas_coef_foreman" => $_POST['foreman'],
	);       

	$field="";
	$value=""; 
	foreach($datas as $key => $data){
		$field.=$key.",";
		$value.="'".$data."',";
	}
	$total+=($_POST['area']*$_POST['owner']);
	
	if(mysqli_query($conn, "INSERT INTO measurement (".rtrim($field,",").") VALUES (".rtrim($value,",").")")){
		if(mysqli_query($conn, "UPDATE project SET project_measurement_total='".$total."' WHERE sha1(project_id)='".$_SESSION['project_id']."'")){
					echo "[SUCCESS] Data has been saved";
		}else{
			echo "[ERROR] Failed to save data".mysqli_error($conn);
		}
	}else{
		echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}


?>