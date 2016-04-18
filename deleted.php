<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';

$rb_id = $_GET['id'];
$project_id = $_GET['rb_project_id'];

//$sel=mysqli_query($conn, "SELECT rb_project_id FROM realbahan WHERE rb_project_id ='$project_id' ");
$query=mysqli_query($conn, "DELETE FROM realbahan WHERE rb_id= '$rb_id'");

if($query){
  // echo json_encode($_GET);
  // exit();
  	header('location: tables/rb.php?id='.$_GET['rb_project_id']);
	}
	else{
		echo 'Gagal';
	}
?>
