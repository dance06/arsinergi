<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';


//
// if ( isset($_POST['rb_order_total']) ) {
// $_POST['rb_order_total'] = implode(', ', $_POST['rb_order_total']);
//
// }
// if ( isset($_POST['rb_item_price']) ) {
// $_POST['rb_item_price'] = implode(', ', $_POST['rb_item_price']);
//
// }
// if ( isset($_POST['rb_item_price_total']) ) {
// $_POST['rb_item_price_total'] = implode(', ', $_POST['rb_item_price_total']);
//
// }
// if ( isset($_POST['rb_volume_paid']) ) {
// $_POST['rb_volume_paid'] = implode(', ', $_POST['rb_volume_paid']);
//
// }
// if ( isset($_POST['rb_volume_indent']) ) {
// $_POST['rb_volume_indent'] = implode(', ', $_POST['rb_volume_indent']);
//
// }
// if ( isset($_POST['rb_price_indent']) ) {
// $_POST['rb_price_indent'] = implode(', ', $_POST['rb_price_indent']);
//
// }




      // if($rb_year && $rb_periode && $rb_item && $rb_item_detail && $rb_gol && $rb_order_total && $rb_order_sent && $rb_volume_paid && $rb_volume_indent && $rb_unit_id && $rb_item_price && $rb_item_price_total && $rb_supplier && $rb_no_ac && $rb_payment_status && $rb_no_faktur && $rb_no_paid && $rb_no_date_paid && $rb_notes){

      // for($i=0;$i<count($_POST['rb_order_total']);$i++)
      // {
      //   echo $rb_year[$i];
      //   echo $rb_periode[$i];
      //   echo $rb_order_date[$i];
      //   echo $rb_item[$i];
      //   echo $rb_item_detail[$i];
      //   echo $rb_gol[$i];
      //   echo $rb_order_total[$i];
      //   echo $rb_order_sent[$i];
      //   echo $rb_volume_paid[$i];
      //   echo $rb_volume_indent[$i];
      //   echo $rb_unit_id[$i];
      //   echo $rb_item_price[$i];
      //   echo $rb_item_price_total[$i];
      //   echo $rb_price_indent[$i];
      //   echo $rb_price_indent[$i];
      //   echo $rb_supplier[$i];
      //   echo $rb_no_ac[$i];
      //   echo $rb_payment_status[$i];
      //   echo $rb_no_faktur[$i];
      //   echo $rb_no_paid[$i];
      //   echo $rb_order_date_paid[$i];
      //   echo $rb_notes[$i];




      echo json_encode($_POST);
      exit();
      if(isset($_POST['tsave'])){
            $project_id = $_POST ['project_id']
            $project_name = $_POST ['project_name'];
            $project_type = $_POST ['project_type'];
            $project_pic = $_POST ['project_pic'];
            $project_client_name = $_POST ['[project_client_name]'];
            $project_measurement_total = $_POST ['project_measurement_total'];
            $project_rab_total = $_POST ['project_rab_total'];
            $project_rb_total = $_POST ['project_rb_total'];

      $sql =mysqli_query($conn,"INSERT INTO master_project_list(project_id, project_name, project_category_id, project_client_name, project_pic, project_measurement_total, project_rb_total, project_rab_total)
                VALUES ('$project_name', '$project_type', '$project_pic', '$project_client_name', '$project_measurement_total','$project_rab_total', '$project_rb_total')");
  //
  //     // $insert = $conn->query($sql);
  //     // $pdoExec = $pdoResult->execute();
  //
  //     // $mysqli = $conn->query($pdoquery);
  //     //$pdoExec = $pdoResult->execute();
  //
  //
  //
    if ($sql)
    echo json_encode($_POST);
    exit();
    {

    header('Location: arsinergi/index.php');
    }
    else {
    header('Location: arsinergi/index.php');
    }
    mysqli_close($conn);
  }
  ?>
<!-- /*
  if(isset($_POST['tedit'])){

        $project_name = $_POST ['project_name'];
        $project_type = $_POST ['project_type'];
        $project_pic = $_POST ['project_pic'];
        $project_client_name = $_POST ['[project_client_name]'];
        $project_measurement_total = $_POST ['project_measurement_total'];
        $project_rab_total = $_POST ['project_rab_total'];
        $project_rb_total = $_POST ['project_rb_total'];

        $query =mysqli_query($conn,"UPDATE master_project_list SET project_name='".$project_name."', project_type='".$project_type."', project_pic='".$project_pic."', project_client_name'".$project_client_name."', project_measurement_total='".$project_measurement_total."', project_rb_total='".$project_rb_total."', project_rab_total='".$project_rab_total."' WHERE project_id = '".$_GET['project_id']."'");
        if($query){
        		header('location: arsinergi/index.php');
        	}
        	else{
        		echo 'Gagal';
        	}
        }
?>
*/ -->
