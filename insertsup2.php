<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';

  echo json_encode($_POST);

      $id_sup = $_POST ['id_sup'];
      $supplier_name = $_POST ['supplier_name1'];
      $addres_supplier = $_POST ['addres_supplier1'];


      $query =mysqli_query($conn,"UPDATE master_supplier SET supplier_name='".$supplier_name."', addres_supplier='".$addres_supplier."' WHERE id_sup=". $id_sup);

                if ($query)
                // echo json_encode($_POST);
                // exit();
                {
                header('Location: index.php');
                }
                else {
                  echo("Error description: " . mysqli_error($conn));
                }
          ?>
