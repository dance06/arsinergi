<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';

$cari     = isset($_GET['cari']) ? $_GET['cari']:'';
$strsql	  = "SELECT * from master_item where item_name like '".$cari."%'";
$data     = array();
if ( $res = $conn->query($strsql) ) {

    while ($row = $res->fetch_assoc()) {
		$data[] =$row['item_name'];
    }
	echo (json_encode($data));
}

/* tutup koneksinya */
$database->close();
?>
