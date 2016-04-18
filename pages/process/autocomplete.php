<?php
include '../init.php';

$term = trim(strip_tags($_GET['term']));
$a_json = array();
$a_json_row = array();
$mode=strip_tags($_GET['id']);
if($mode=="meas"){
	if ($result = mysqli_query($conn, "SELECT meas_id, meas_name FROM measurement WHERE meas_name LIKE '%".$term."%'")) {
		while($data = mysqli_fetch_array($result)) {
			$a_json_row["id"] = $data['meas_id'];
			$a_json_row["value"] = $data['meas_name'];
			$a_json_row["label"] = $data['meas_name'];
			$a_json[]=$a_json_row;
		}
	}
}
else if($mode=="mat_2"){
	if ($result = mysqli_query($conn, "SELECT material_id, material_name_1
									FROM master_material
									WHERE material_category_id ='".$_GET['mat_1']."'
									AND material_name_1 LIKE '%".trim(strip_tags($_GET['mat_2']))."%'")) {
		while($data = mysqli_fetch_array($result)) {
			$a_json_row["id"] = $data['material_id'];
			$a_json_row["value"] = $data['material_name_1'];
			$a_json_row["label"] = $data['material_name_1'];
			$a_json[]=$a_json_row;
		}
	}
}
else if($mode=="mat_3"){
	if ($result = mysqli_query($conn, "SELECT material_id, material_name_2
									FROM master_material
									WHERE material_category_id ='".$_GET['mat_1']."'
									AND material_name_1 LIKE '%".trim(strip_tags($_GET['mat_2']))."%'
									AND material_name_2 LIKE '%".trim(strip_tags($_GET['mat_3']))."%'")) {
		while($data = mysqli_fetch_array($result)) {
			$a_json_row["id"] = $data['material_id'];
			$a_json_row["value"] = $data['material_name_2'];
			$a_json_row["label"] = $data['material_name_2'];
			$a_json[]=$a_json_row;
		}
	}
}
else if($mode=="mat_4"){
	if ($result = mysqli_query($conn, "SELECT material_id, material_name_3
									FROM master_material
									WHERE material_category_id ='".$_GET['mat_1']."'
									AND material_name_1 LIKE '%".trim(strip_tags($_GET['mat_2']))."%'
									AND material_name_2 LIKE '%".trim(strip_tags($_GET['mat_3']))."%'
									AND material_name_3 LIKE '%".trim(strip_tags($_GET['mat_4']))."%'")) {
		while($data = mysqli_fetch_array($result)) {
			$a_json_row["id"] = $data['material_id'];
			$a_json_row["value"] = $data['material_name_3'];
			$a_json_row["label"] = $data['material_name_3'];
			$a_json[]=$a_json_row;
		}
	}
}
else if($mode=="mat_5"){
	if ($result = mysqli_query($conn, "SELECT material_id, material_name_4
									FROM master_material
									WHERE material_category_id ='".$_GET['mat_1']."'
									AND material_name_1 LIKE '%".trim(strip_tags($_GET['mat_2']))."%'
									AND material_name_2 LIKE '%".trim(strip_tags($_GET['mat_3']))."%'
									AND material_name_3 LIKE '%".trim(strip_tags($_GET['mat_4']))."%'
									AND material_name_4 LIKE '%".trim(strip_tags($_GET['mat_5']))."%'")) {
		while($data = mysqli_fetch_array($result)) {
			$a_json_row["id"] = $data['material_id'];
			$a_json_row["value"] = $data['material_name_4'];
			$a_json_row["label"] = $data['material_name_4'];
			$a_json[]=$a_json_row;
		}
	}
}
else if($mode=="newanalysisitem"){
	$type=trim(strip_tags($_GET['type']));
	switch($type){
		case 'material':
			if ($result = mysqli_query($conn, "SELECT m.material_id, concat(mc.material_category_name,' ',m.material_name_1,' ',m.material_name_2,' ',m.material_name_3,' ',m.material_name_4) as material_name,
											material_unit_id, material_price_value
									FROM master_material m, master_material_category mc
									WHERE m.material_category_id=mc.material_category_id
									AND
									(material_category_name LIKE '%".trim(strip_tags($_GET['item']))."%'
									OR material_name_1 LIKE '%".trim(strip_tags($_GET['item']))."%'
									OR material_name_2 LIKE '%".trim(strip_tags($_GET['item']))."%'
									OR material_name_3 LIKE '%".trim(strip_tags($_GET['item']))."%'
									OR material_name_4 LIKE '%".trim(strip_tags($_GET['item']))."%')")) {
						while($data = mysqli_fetch_array($result)) {
							$a_json_row["id"] = $data['material_id'];
							$a_json_row["value"] = trim($data['material_name']);
							$a_json_row["label"] = trim($data['material_name']);
							$a_json_row["unit"] = $data['material_unit_id'];
							$a_json_row["price"] = number_format($data['material_price_value'],2,".",",");
							$a_json[]=$a_json_row;
						}
					}
			break;
		case 'analysis':
			if ($result = mysqli_query($conn, "SELECT analysis_id, analysis_link_value_name, analysis_unit_id, u.unit_name, analysis_link_value_price
										FROM master_analysis, master_unit u
										WHERE analysis_unit_id = u.unit_id AND analysis_link_value_name LIKE '%".trim(strip_tags($_GET['item']))."%'")) {
						while($data = mysqli_fetch_array($result)) {
							$a_json_row["id"] = $data['analysis_id'];
							$a_json_row["value"] = $data['analysis_link_value_name'];
							$a_json_row["label"] = $data['analysis_link_value_name'];
							$a_json_row["unit"] = $data['analysis_unit_id'];
							$a_json_row["price"] = number_format($data['analysis_link_value_price'],2,".",",");
							$a_json[]=$a_json_row;
						}
					}
			break;
		case 'item':
			if ($result = mysqli_query($conn, "SELECT item_id, item_name, item_unit_id, u.unit_name, item_value_price
										FROM master_item, master_unit u
										WHERE item_unit_id = u.unit_id AND item_name LIKE '%".trim(strip_tags($_GET['item']))."%'")) {
						while($data = mysqli_fetch_array($result)) {
							$a_json_row["id"] = $data['item_id'];
							$a_json_row["value"] = $data['item_name']." /".$data['unit_name'];
							$a_json_row["label"] = $data['item_name']." /".$data['unit_name'];
							$a_json_row["unit"] = $data['item_unit_id'];
							$a_json_row["price"] = number_format($data['item_value_price'],2,".",",");
							$a_json[]=$a_json_row;
						}
					}
			break;
		default:

	}
}
else if($mode=="newrab"){
	if ($result = mysqli_query($conn, "SELECT material_id, concat(material_name_1,' ',material_name_2,' ',material_name_3,' ',material_name_4,' ',material_name_5) as material_name,
											material_unit_id, material_price_value
									FROM master_material
									WHERE material_name_1 LIKE '%".trim(strip_tags($_GET['item']))."%'
									OR material_name_2 LIKE '%".trim(strip_tags($_GET['item']))."%'
									OR material_name_3 LIKE '%".trim(strip_tags($_GET['item']))."%'
									OR material_name_4 LIKE '%".trim(strip_tags($_GET['item']))."%'")) {
					while($data = mysqli_fetch_array($result)) {
						$a_json_row["id"] = $data['material_id'];
						$a_json_row["value"] = trim($data['material_name']);
						$a_json_row["label"] = trim($data['material_name']);
						$a_json_row["unit"] = $data['material_unit_id'];
						$a_json_row["price"] = $data['material_price_value'];
						$a_json[]=$a_json_row;
					}
				}
}
else if($mode=="realbahan"){
	if ($result = mysqli_query($conn, "SELECT rb_supplier FROM realbahan WHERE rb_supplier LIKE '%".trim(strip_tags($_GET['item']))."%'")) {
		while($data = mysqli_fetch_array($result)) {
			$a_json_row["id"] = $data['rb_supplier'];
			$a_json_row["value"] = $data['rb_supplier'];
			$a_json_row["label"] = $data['rb_supplier'];
			$a_json[]=$a_json_row;
		}
	}
}
else if($mode=="project"){
	if ($result = mysqli_query($conn, "SELECT project_id, project_name FROM project WHERE project_name LIKE '%".trim(strip_tags($_GET['item']))."%'")) {
		while($data = mysqli_fetch_array($result)) {
			$a_json_row["id"] = $data['project_id'];
			$a_json_row["value"] = $data['project_name'];
			$a_json_row["label"] = $data['project_name'];
			$a_json[]=$a_json_row;
		}
	}
}
else if($mode=="upah"){
	if ($result = mysqli_query($conn, "SELECT wage_id, wage_item FROM realupah WHERE wage_item LIKE '%".trim(strip_tags($_GET['item']))."%'")) {
		while($data = mysqli_fetch_array($result)) {
			$a_json_row["id"] = $data['wage_id'];
			$a_json_row["value"] = $data['wage_item'];
			$a_json_row["label"] = $data['wage_item'];
			$a_json[]=$a_json_row;
		}
	}
}

echo json_encode($a_json);

?>
