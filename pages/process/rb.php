<?php
include '../init.php';
include '../function.php';

if($_SESSION['page']!='rb'){
	echo "[ERROR] You don't have permission";
}else{

	$sql="SELECT project_id FROM project WHERE sha1(project_id)='".$_SESSION['project_id']."'";
	$result=mysqli_query($conn, $sql);
	$data=mysqli_fetch_array($result);
	$project_id=$data[0];

	$order_year = convertDate($_POST['order_year']);
	$order_date = convertDate($_POST['order_date']);
	$link_value_id = $_POST['link_id'];
	$link_value_name = $_POST['item'];
	$item_detail = $_POST['item_detail'];
	$order_total = $_POST['order_total'];
	if(substr($order_total,0,1)=="="){
		$order_total_formula=$order_total;
		$order_total=calc1(substr($order_total,1));
	}
	$order_sent = $_POST['order_sent'];
	if(substr($order_sent,0,1)=="="){
		$order_sent_formula=$order_sent;
		$order_sent=calc1(substr($order_sent,1));
	}

	$volume_paid = $_POST['volume_paid'];
	if(substr($volume_paid,0,1)=="="){
		$volume_paid_formula=$volume_paid;
		$volume_paid=calc1(substr($volume_paid,1));
	}
	$unit_id = $_POST['unit'];
	$item_price = $_POST['price'];
	$supplier = $_POST['supplier'];
	$ac_no = $_POST['ac_no'];
	$payment_status = $_POST['payment_status'];
	$invoice_no = $_POST['invoice_no'];
	$payment_no = $_POST['pay_no'];
	$payment_date = convertDate($_POST['settled_date']);
	$notes = mysqli_real_escape_string($conn, $_POST['notes']);


	$datas=array(
		"rb_project_id" => $project_id,
		"rb_order_date" => $order_date,
		"rb_link_value_id" => $link_value_id,
		"rb_link_value_name" => $link_value_name,
		"rb_item_detail" => $item_detail,
		"rb_order_total" => $order_total,
		"rb_order_total_formula" => $order_total_formula,
		"rb_order_sent" => $order_sent,
		"rb_order_sent_formula" => $order_sent_formula,
		"rb_volume_paid" => $volume_paid,
		"rb_volume_paid_formula" => $volume_paid_formula,
		"rb_unit_id" => $unit_id,
		"rb_item_price" => $item_price,
		"rb_item_price_formula" => $item_price_formula,
		"rb_supplier" => $supplier,
		"rb_payment_status" => $payment_status,
		"rb_notes" => $notes,
	);

	$field="";
	$value="";
	foreach($datas as $key => $data){
		$field.=$key.",";
		$value.="'".$data."',";
	}

	if(mysqli_query($conn, "INSERT INTO realbahan (".rtrim($field,",").")
						VALUES (".rtrim($value,",").")")){
			$datas2=array(
				"rb_id" => mysqli_insert_id($conn),
				"rb_ac_no" => $ac_no,
				"rb_invoice_no" => $invoice_no,
				"rb_payment_no" => $payment_no,
				"rb_payment_date" => $payment_date
			);
			print_r($datas);

			$field="";
			$value="";
			foreach($datas2 as $key => $data){
				$field.=$key.",";
				$value.="'".$data."',";
			}
			if(mysqli_query($conn, "INSERT INTO realbahan_detail (".rtrim($field,",").")
						VALUES (".rtrim($value,",").")")){
							echo "[SUCCESS] Data has been saved";
			}else{
				echo "[ERROR] Failed to save data".mysqli_error($conn);
			}
		}else{
			echo "[ERROR] Failed to save data".mysqli_error($conn);
	}
}


?>
