<?php
include '../arsinergi/init.php';
include '../arsinergi/function.php';

  echo json_encode($_POST);

      $project_id = $_POST ['project_id'];
      $project_name = $_POST ['project_name1'];
      $project_type = $_POST ['project_type1'];
      $project_pic = $_POST ['project_pic1'];
      $project_client_name = $_POST ['project_client_name1'];
      $project_measurement_total = $_POST ['project_measurement_total1'];
      $project_rab_total = $_POST ['project_rab_total1'];
      $project_rb_total = $_POST ['project_rb_total1'];
      $project_rbupah_total = $_POST ['project_rbupah_total1'];


      $query =mysqli_query($conn,"UPDATE master_project_list SET project_name='".$project_name."', project_category_id='".$project_type."', project_pic='".$project_pic."',
      project_client_name='".$project_client_name."', project_measurement_total='".$project_measurement_total."', project_rb_total='".$project_rb_total."',
      project_rab_total='".$project_rab_total."', project_rbupah_total='".$project_rbupah_total."' WHERE project_id =". $project_id);
      // $query =mysqli_query($conn,"UPDATE master_project_list SET project_name='".$project_name."' WHERE project_id =" . $project_id);

      if($query){
        // echo json_encode($_POST);
        // exit();
          header('location: index.php');
        }
        else{
          echo("Error description: " . mysqli_error($conn));
        }
  ?>
