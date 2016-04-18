<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';

$project_id = $_GET ['id'];

$query=mysqli_query($conn, "DELETE FROM master_project_list WHERE project_id= '$project_id'");

if($query){
  // echo json_encode($_GET);
  // exit();
  	header('location: index.php');
	}
	else{
		echo 'Gagal';
	}
?>
