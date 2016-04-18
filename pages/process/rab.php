<?php
include '../init.php';
include '../function.php';

if($_SESSION['page']!='rab'){
	echo "[ERROR] You don't have permission";
}else{
	
	$sql="SELECT project_id, project_rab_total FROM project WHERE sha1(project_id)='".$_SESSION['project_id']."'";
	$result=mysqli_query($conn, $sql);
	$data=mysqli_fetch_array($result);
	$project_id=$data[0];
	$total=$data[1];


	$category=$_POST['cat'];
	$item=$_POST['item'];
	$link_id=$_POST['link_id'];
	$volume_value=$_POST['volume'];
	$unit=$_POST['unit'];
	$coef_volume=$_POST['coef_volume'];
	$price=str_replace(",", "", $_POST['price']);
	$coef_price=$_POST['coef_price'];
	$coef_profit=$_POST['coef_profit'];
	
	if($link_id>0){
		$link_type="item";
		$link_formula="";
	}else if(strpos($price, "=")=="0"){
		$link_type="formula";
		$link_formula=$price;
	}else{
		$link_type="input";
		$link_formula="";
	}
	if(substr($price,0,1)=="="){
		$link_id=0;
		$link_type="formula";
		$link_formula=$price;
		$price=calc1(substr($price,1));
	}else{
		if($link_id>0){
			$link_type="item";
			$link_formula="";
			$price=$price;
		}else{
			$link_id=0;
			$link_type="input";
			$link_formula="";
			$price=$price;
		}
	}
	
	if(substr($volume_value,0,1)=="="){
		$volume_formula=$volume_value;
		$volume_value=calc1(substr($volume_value,1));
	}else{
		$volume_formula="";
		$volume_value=$volume_value;
	}
	
	
	$datas=array(
		'rab_project_id' => $project_id,
		'rab_category_id' => $category,
		'rab_link_type' => $link_type,
		'rab_link_value_id' => $link_id,
		'rab_link_value_name' => $item,
		'rab_link_value_price' => $price,
		'rab_link_value_formula' => $link_formula,
		'rab_volume_value' => $volume_value,
		'rab_volume_formula' => $volume_formula,
		'rab_unit_id' => $unit,
		'rab_coef_volume' => $coef_volume,
		'rab_coef_price' => $coef_price,
		'rab_coef_profit' => $coef_profit,
		
	);	

	$field='';
	$value=''; 
	foreach($datas as $key => $data){
		$field.=$key.',';
		$value.='"'.$data.'",';
	}
	
	print_r($datas);
	$total+=$volume_value * $coef_price * $coef_profit * $price;
	if(mysqli_query($conn, 'INSERT INTO rab ('.rtrim($field,',').')VALUES ('.rtrim($value,',').')')){
		if(mysqli_query($conn, 'UPDATE project SET project_rab_total="'.$total.'" WHERE sha1(project_id)="'.$_SESSION["project_id"].'"')){
					echo "[SUCCESS] Data has been saved";
		}else{
			echo "[ERROR] Failed to save data".mysqli_error($conn);
		}
	}else{
		echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}


?>