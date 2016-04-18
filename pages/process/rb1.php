<?php
    include '../init.php';
    include '../function.php';


    $tahun_order=$_POST["order_year"];
           $item=$_POST["item"];

           $save="INSERT INTO  realbahan(rb_year,rb_item)VALUES('$tahun_order','$item')";
           $run=mysqli_query($save);

            if ($run){
                echo "Proses Simpan Telah Berhasil";
           }else{
               echo "Proses Simpan Gagal...";
           }
    // if($_SESSION['page']!='rb'){
    // 	echo "[ERROR] You don't have permission";
    // }else{
    //
    //   $tahun_order = ($_POST['order_year']);
    //   $datas=array(
    //     "rb_project_id" => $project_id,
    //     "rb_year" => $tahun_order,
    //     	);
    //       $field="";
    //       $value="";
    //       foreach($datas as $key => $data){
    //         $field.=$key.",";
    //         $value.="'".$data."',";
    //       }
    //       if(mysqli_query($conn, "INSERT INTO realbahan (".rtrim($field,",").")
    //     						VALUES (".rtrim($value,",").")")){
    //     			$datas2=array(
    //     				"rb_id" => mysqli_insert_id($conn),
    //     				"rb_ac_no" => $ac_no,
    //     				"rb_invoice_no" => $invoice_no,
    //     				"rb_payment_no" => $payment_no,
    //     				"rb_payment_date" => $payment_date
    //     			);
    //     			print_r($datas);
    //
    //     			$field="";
    //     			$value="";
    //     			foreach($datas2 as $key => $data){
    //     				$field.=$key.",";
    //     				$value.="'".$data."',";
    //     			}
    //     			if(mysqli_query($conn, "INSERT INTO realbahan_detail (".rtrim($field,",").")
    //     						VALUES (".rtrim($value,",").")")){
    //     							echo "[SUCCESS] Data has been saved";
    //     			}else{
    //     				echo "[ERROR] Failed to save data".mysqli_error($conn);
    //     			}
    //     		}else{
    //     			echo "[ERROR] Failed to save data".mysqli_error($conn);
    //     	}
    //     }
    //
    //
    //

?>
