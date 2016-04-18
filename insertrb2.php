<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';


      $id = $_GET ['id'];
      $rb_project_id = $_GET ['rb_project_id'];
      // echo $id;
      // exit();
      $rb_year = $_POST ['rb_year'];
      $rb_periode = $_POST ['rb_periode'];
      $rb_order_date = $_POST ['rb_order_date'];
      $rb_gol = $_POST ['rb_gol'];
      $rb_item = $_POST ['rb_item'];
      $rb_item_detail = $_POST ['rb_item_detail'];
      $rb_order_total = $_POST ['rb_order_total'];
      $rb_order_sent = $_POST ['rb_order_sent'];
      $rb_volume_paid = $_POST ['rb_volume_paid'];
      $rb_volume_indent = $_POST ['rb_volume_indent'];
      $rb_unit_id = $_POST ['rb_unit_id'];
      $rb_item_price = $_POST ['rb_item_price'];
      $rb_item_price_total = $_POST ['rb_item_price_total'];
      $rb_price_indent = $_POST ['rb_price_indent'];
      $rb_supplier = $_POST ['rb_supplier'];
      $rb_no_ac = $_POST ['rb_no_ac'];
      $rb_payment_status = $_POST ['rb_payment_status'];
      $rb_no_faktur = $_POST ['rb_no_faktur'];
      $rb_no_paid = $_POST ['rb_no_paid'];
      $rb_order_date_paid = $_POST ['rb_order_date_paid'];
      $rb_notes = $_POST ['rb_notes'];


      $query =mysqli_query($conn,"UPDATE realbahan SET rb_year='".$rb_year."', rb_periode='".$rb_periode."', rb_order_date='".$rb_order_date."', rb_project_id='".$rb_project_id."',
      rb_gol='".$rb_gol."', rb_item='".$rb_item."', rb_item_detail='".$rb_item_detail."',rb_order_total='".$rb_order_total."',rb_order_sent='".$rb_order_sent."',
      rb_volume_paid='".$rb_volume_paid."', rb_volume_indent='".$rb_volume_indent."', rb_unit_id='".$rb_unit_id."',rb_item_price='".$rb_item_price."',
      rb_item_price_total='".$rb_item_price_total."',rb_price_indent='".$rb_price_indent."',rb_supplier='".$rb_supplier."', rb_no_ac='".$rb_no_ac."',
      rb_payment_status='".$rb_payment_status."',rb_no_faktur='".$rb_no_faktur."', rb_no_paid='".$rb_no_paid."',rb_order_date_paid='".$rb_order_date_paid."',rb_notes='".$rb_notes."'
      WHERE rb_id =". $id);
      // $query =mysqli_query($conn,"UPDATE master_project_list SET project_name='".$project_name."' WHERE project_id =" . $project_id);

      if($query){
        // echo json_encode($_POST);
        // exit();
        header('location: ../arsinergi/tables/rb.php?id='.$_GET['rb_project_id']);
          // header("location: ../arsinergi/tables/rb.php?id=".$_GET['rb_project_id']);
        }
        else{
          echo("Error description: " . mysqli_error($conn));
        }
  ?>
