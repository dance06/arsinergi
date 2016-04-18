<?php
include 'init.php';

$term = trim(strip_tags($_GET['term'])); 
$a_json = array();
$a_json_row = array();
$mode=$_GET['id'];
echo "tess";
if ($result = mysqli_query($conn, "SELECT project_id, project_name FROM project WHERE project_name LIKE '".$term."%'")) {
	while($data = mysqli_fetch_array($result)) {
		$a_json_row["id"] = $data['project_id'];
		$a_json_row["value"] = $data['project_name'];
		$a_json_row["label"] = $data['project_name'];
		array_push($a_json, $a_json_row);
		print_r($data);
	}
}

echo json_encode($a_json);

?>