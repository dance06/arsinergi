<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';

$id_sup = $_GET ['id'];

$query=mysqli_query($conn, "DELETE FROM master_supplier WHERE id= '$id_sup'");

if($query){
  // echo json_encode($_GET);
  // exit();
  	header('location: index.php');
	}
	else{
		echo 'Gagal';
	}
?>
