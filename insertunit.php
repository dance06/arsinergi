<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';

      $unit_name = $_POST ['unit_name'];
      $unit_note = $_POST ['unit_note'];

      for($i=0;$i<count($_POST['unit_name']);$i++)
      {

        echo $unit_name[$i];
        echo $unit_note[$i];


      $sql =mysqli_query($conn,"INSERT INTO master_unit( unit_name, unit_note)
                VALUES ( '$unit_name[$i]', '$unit_note[$i]')");
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
