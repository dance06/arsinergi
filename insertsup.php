<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';

      $id_sup = $_POST ['id_sup'];
      $supplier_name = $_POST ['supplier_name'];
      $addres_supplier = $_POST ['addres_supplier'];

      for($i=0;$i<count($_POST['id_sup']);$i++)
      {

        echo $id_sup[$i];
        echo $supplier_name[$i];
        echo $addres_supplier[$i];


      $sql =mysqli_query($conn,"INSERT INTO master_supplier( id_sup, supplier_name, addres_supplier)
                VALUES ('$id_sup[$i]', '$supplier_name[$i]', '$addres_supplier[$i]')");
}

                if ($sql)
                // echo json_encode($_POST);
                // exit();
                {
                header('Location: index.php');
                }
                else {
                header('Location: index.php');
                }
                mysqli_close($conn);

          ?>
