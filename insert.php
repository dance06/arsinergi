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



      $rb_project_id = $_GET ['id'];
      $item_name = $_POST['item_name'];
      $rb_year = $_POST ['rb_year'];
      $rb_periode = $_POST ['rb_periode'];
      $rb_order_date = $_POST ['rb_order_date'];
      $rb_item = $_POST ['rb_item'];
      $rb_item_detail = $_POST ['rb_item_detail'];
      $rb_gol = $_POST ['rb_gol'];
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


      // if($rb_year && $rb_periode && $rb_item && $rb_item_detail && $rb_gol && $rb_order_total && $rb_order_sent && $rb_volume_paid && $rb_volume_indent && $rb_unit_id && $rb_item_price && $rb_item_price_total && $rb_supplier && $rb_no_ac && $rb_payment_status && $rb_no_faktur && $rb_no_paid && $rb_no_date_paid && $rb_notes){

      for($i=0;$i<count($_POST['rb_order_total']);$i++)
      {
        echo $rb_project_id;
        echo $rb_year[$i];
        echo $rb_periode[$i];
        echo $rb_order_date[$i];
        echo $rb_item[$i];
        echo $rb_item_detail[$i];
        echo $rb_gol[$i];
        echo $rb_order_total[$i];
        echo $rb_order_sent[$i];
        echo $rb_volume_paid[$i];
        echo $rb_volume_indent[$i];
        echo $rb_unit_id[$i];
        echo $rb_item_price[$i];
        echo $rb_item_price_total[$i];
        echo $rb_price_indent[$i];
        echo $rb_price_indent[$i];
        echo $rb_supplier[$i];
        echo $rb_no_ac[$i];
        echo $rb_payment_status[$i];
        echo $rb_no_faktur[$i];
        echo $rb_no_paid[$i];
        echo $rb_order_date_paid[$i];
        echo $rb_notes[$i];



      // echo json_encode($_POST);
      // exit();
      $ada=0;
      $sql1 =mysqli_query($conn, "INSERT INTO realbahan(rb_project_id,rb_year, rb_periode, rb_order_date, rb_item, rb_item_detail, rb_gol, rb_order_total, rb_order_sent, rb_volume_paid, rb_volume_indent, rb_unit_id, rb_item_price, rb_item_price_total, rb_price_indent,rb_supplier, rb_no_ac, rb_payment_status, rb_no_faktur, rb_no_paid, rb_order_date_paid, rb_notes)
                VALUES ('$rb_project_id', '$rb_year[$i]', '$rb_periode[$i]', '$rb_order_date[$i]', '$rb_item[$i]', '$rb_item_detail[$i]','$rb_gol[$i]', '$rb_order_total[$i]', '$rb_order_sent[$i]', '$rb_volume_paid[$i]', '$rb_volume_indent[$i]', '$rb_unit_id[$i]',
                  '$rb_item_price[$i]','$rb_item_price_total[$i]','$rb_price_indent[$i]', '$rb_supplier[$i]', '$rb_no_ac[$i]', '$rb_payment_status[$i]', '$rb_no_faktur[$i]', '$rb_no_paid[$i]','$rb_order_date_paid[$i]', '$rb_notes[$i]')");
      $select = mysqli_query($conn, "SELECT * FROM master_item WHERE item_name='".$rb_item[$i]."'");
      while($d = mysqli_fetch_array($select)){
          $ada++;
      }
      //
      if($ada<=0){
        $sql =mysqli_query($conn,"INSERT INTO master_item(item_name) VALUES ('$rb_item[$i]')");
      }

      // $insert = $conn->query($sql);
      // $pdoExec = $pdoResult->execute();

      // $mysqli = $conn->query($pdoquery);
      //$pdoExec = $pdoResult->execute();


    }
    if ($sql||$sql1)
    // echo json_encode ($_POST);
    // exit();
    {
   header("Location: tables/rb.php?id=".$_GET['id']);
    }
    else {
    header('Location: index.php');
    }
    mysqli_close($conn);
?>
