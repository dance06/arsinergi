<?php
    include '../init.php';
    include '../function.php';

    $edit = $_GET['edit'];

    if($edit != '')
    {
        $_SESSION['page'] = 'upah';

        header("location: index.php");
    }

    $data_project = mysqli_fetch_array(mysqli_query($conn, 'SELECT * FROM master_project_list'));
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ARSINERGI PROJECT MANAGER</title>

        <script src="../js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui.js"></script>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <link href="../js/datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
        <script src="../js/moment/min/moment.min.js" type="text/javascript"></script>
        <script src="../js/datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <!-- <link href="../css/datepicker.css" rel="stylesheet"> -->
    	<!-- <script src="../js/bootstrap-datepicker.js"></script> -->
    	<!-- <script src="../js/jquery-1.9.1.js"></script> -->
        <script src="../js/jquery-ui.js"></script>
    	<link href="../css/style.css" rel="stylesheet" type="text/css">
    	<script src="../js/function.js" type="text/javascript"></script>
    	<link rel="stylesheet" href="../css/jquery-ui.css">
    	<script>
    	function getParameterByName(name) {
    	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    	        results = regex.exec(location.search);
    	    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " ")); //script untuk mengulang dan memilih//
    	}
    	</script>
    </head>
    <body style="color:#494949">

        <div style="position:relative; margin:20px">
            <div style="position:relative; margin-bottom:20px; font-weight:bold; font-size:20px">UPAH</div>

            <div style="position:relative; margin-bottom:40px; background-color:#494949; height:1px"></div>

            <?php
            if($edit != '')
            {
            ?>
                <div style="position:relative; margin-top:30px">
                    <div style="position:relative; margin-bottom:10px">
                        <div style="width:50px; float:left; margin-right:0px">NO</div>
                        <div style="width:130px; float:left; margin-right:5px">TAHUN</div>
                        <div style="width:130px; float:left; margin-right:5px">PERIODE</div>
                        <div style="width:120px; float:left; margin-right:5px">TANGGAL</div>
                        <div style="width:120px; float:left; margin-right:0px">GOL</div>
                        <div style="width:120px; float:left; margin-right:5px">ITEM</div>
                        <div style="width:120px; float:left; margin-right:5px">KETERANGAN</div>
                        <div style="width:120px; float:left; margin-right:5px">QTY</div>
                        <div style="width:120px; float:left; margin-right:5px">SAT</div>
                        <div style="width:120px; float:left; margin-right:5px">HARGA SATUAN</div>
                        <div style="width:120px; float:left; margin-right:5px">JUMLAH</div>
                        <div style="width:120px; float:left; margin-right:5px">KETERANGAN</div>
                        <div style="clear:both"></div>
                    </div>
                    <?php
                    $i=1;
                    $check = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM master_upah WHERE id_project = '.$edit.''));

                    if($check != 0)
                    {
                        $data = mysqli_query($conn, 'SELECT * FROM master_upah WHERE id_project = '.$edit.'');
                        while($r = mysqli_fetch_array($data))
                        {
                        echo '<tr>
                                <td>'.$i.'</td>
                                <td>'.$r['project_name'].'</td>
                                <td><a href="upah.php?edit='.$r['project_id'].'"><button type="button" class="btn btn-primary">OPEN</button></td></a>
                              </tr>';
                        $i++;
                        }
                    }
                    else
                    {
                        for($k=1; $k<=50; $k++)
                        {
                            $k_next = $k+1;
                            if($k == 1)
                            {
                                $total = mysql_num_rows(mysql_query('SELECT * FROM master_upah
                                WHERE id_project = '.$job.'
                                AND project_count = '.$k.''));

                                $total_next = mysql_num_rows(mysql_query('SELECT * FROM master_upah
                                WHERE id_project = '.$job.'
                                AND project_count = '.$k_next.''));

                                if($total == 0)
                                {
                                    $total = 1;
                                    $total_next = 1;
                                }
                                else
                                {
                                    $total_next = 1;
                                }
                            }
                            ?>

                            <div id="upah_<?php echo $k; ?>" <?php if($total == 0) echo 'style="visibility:hidden; display:none; height:0px; margin-bottom:20px"'; else echo 'style="margin-bottom:20px"'; ?>>

    							<?php
                                    $g = mysql_fetch_array(mysql_query('SELECT * FROM master_upah
                                    WHERE id_project = '.$job.'
                                    AND project_count = '.$k.''));
                                ?>

                                <div style="position:relative">
                                    <div style="width:50px; float:left; margin-top:5px" id="btn_upah_<?php echo $k; ?>">
                                    	<div style="margin-left:10px">
    									<?php
                                        if($total_next == 1)
                                        {
                                            ?>
                                            <img src="../images/img_plus.png" style="cursor:pointer" onclick="
                                            document.getElementById('upah_<?php echo $k_next; ?>').style.visibility = 'visible';
                                            document.getElementById('upah_<?php echo $k_next; ?>').style.display = 'block';
                                            document.getElementById('upah_<?php echo $k_next; ?>').style.height = '';
                                            document.getElementById('btn_upah_<?php echo $k; ?>').style.visibility = 'hidden';
                                            ">
                                            <?
                                        }
                                        ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <?
                            $total = 0;
                        }
                    }
                    ?>
                </div>
            <?php
            }
            else
            {
            ?>
                <table class="table table-hover">
                    <tr>
                        <td><b>No</b></td>
                        <td><b>Project</b></td>
                        <td></td>
                    </tr>
                    <?php
                    $i=1;
                    $data = mysqli_query($conn, 'SELECT * FROM master_project_list');
                    while($r = mysqli_fetch_array($data))
                    {
                    echo '<tr>
                            <td>'.$i.'</td>
                            <td>'.$r['project_name'].'</td>
                            <td><a href="upah.php?edit='.$r['project_id'].'"><button type="button" class="btn btn-primary">OPEN</button></td></a>
                          </tr>';
                    $i++;
                    }
                    ?>
                </table>
            <?php
            }
            ?>
        </div>

    </body>
</html>
