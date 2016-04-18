<?php
    include '../init.php';
    include '../function.php';
    include '../lib.php';

    function ambil_item(){
    	global $conn;
    	$nama='';
    	$sql_nama=mysqli_query($conn, "SELECT * FROM master_item");
    	while($data_nama=mysqli_fetch_array($sql_nama)){
    	$nama.='"'.stripslashes($data_nama['item_name']).'",';
    	}
    	return(strrev(substr(strrev($nama),1)));
    }

    $edit = $_GET['edit'];
    $scs = $_GET['scs'];
    $del = $_GET['del'];

    if($del != '')
    {
        mysqli_query($conn, 'DELETE FROM master_upah WHERE id = '.$del.'');
    }

    if($_POST['save'] == 1)
    {
        $id_project = $_POST['id_project'];

        mysqli_query($conn, 'DELETE FROM master_upah WHERE id_project = '.$id_project.'');

        for($i=1; $i<=90; $i++)
        {
            $tahun = $_POST['tahun_'.$i];
            $periode = $_POST['periode_'.$i];
            $tanggal = date("Y-m-d", strtotime($_POST['tanggal_'.$i]));
            $gol = $_POST['gol_'.$i];

            $item = str_replace('"',"##",$_POST['item_'.$i]);
            $item = str_replace("'","#",$item);

            $keterangan1 = str_replace('"',"##",$_POST['keterangan1_'.$i]);
            $keterangan1 = str_replace("'","#",$keterangan1);

            $qty = $_POST['qty_'.$i];
            $sat = $_POST['sat_'.$i];

            $harga_satuan = str_replace(",","",$_POST['harga_satuan_'.$i]);
            $jumlah = $qty*$harga_satuan;
            $tenaga_mandor = str_replace(",","",$_POST['tenaga_mandor_'.$i]);
            $alat = str_replace(",","",$_POST['alat_'.$i]);
            $borongan = str_replace(",","",$_POST['borongan_'.$i]);

            $keterangan2 = str_replace('"',"##",$_POST['keterangan2_'.$i]);
            $keterangan2 = str_replace("'","#",$keterangan2);

            $check_item = mysqli_num_rows(mysqli_query('SELECT * FROM master_item WHERE item_name = "'.$item.'"'));
            if($check_item == 0)
            {
                $sql = 'INSERT INTO master_item (
                item_name
        		)

        		VALUES (
        		"'.$item.'"
        		)';

            	mysqli_query($conn, $sql);
            }

            if($item != '' && $qty != '' && $harga_satuan != '' && $jumlah != '')
            {
                $sql = 'INSERT INTO master_upah (
                id_project,
                project_count,
                tahun,
                periode,
                tanggal,
                gol,
                item,
                keterangan1,
                qty,
                satuan,
                harga_satuan,
                jumlah,
                tenaga_mandor,
                alat,
                borongan,
                keterangan2
        		)

        		VALUES (
        		"'.$id_project.'",
        		"'.$i.'",
        		"'.$tahun.'",
        		"'.$periode.'",
        		"'.$tanggal.'",
        		"'.$gol.'",
        		"'.$item.'",
        		"'.$keterangan1.'",
        		"'.$qty.'",
        		"'.$sat.'",
        		"'.$harga_satuan.'",
        		"'.$jumlah.'",
                "'.$tenaga_mandor.'",
                "'.$alat.'",
                "'.$borongan.'",
                "'.$keterangan2.'"
        		)';

            	mysqli_query($conn, $sql);
            }
        }

        header("location: upah.php?edit=".$id_project."&scs=1");
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
        <script src="../js/jquery-ui.js"></script>
    	<link href="../css/style.css" rel="stylesheet" type="text/css">
    	<script src="../js/function.js" type="text/javascript"></script>
    	<link rel="stylesheet" href="../css/jquery-ui.css">

        <script>
            function format(num) {
                val = num.value;
                val = val.replace(/[^\d.]/g,"");
                arr = val.split('.');
                lftsde = arr[0];
                rghtsde = arr[1];
                result = "";
                lng = lftsde.length;
                j = 0;
                for (i = lng; i > 0; i--){
                    j++;
                    if (((j % 3) == 1) && (j != 1)){
                        result = lftsde.substr(i-1,1) + "," + result;
                    }else{
                        result = lftsde.substr(i-1,1) + result;
                    }
                }
                if(rghtsde==null){
                    num.value = result;
                }else{
                    num.value = result+'.'+arr[1];
                }
            }

            function total(a)
            {
                var i = 1;

                for(i=1; i<=90; i++)
                {
                    var qty = document.getElementById('qty_jml_'+i).value;
                    var jml = document.getElementById('per_jml_'+i).value;
                    var res = jml.replace(",", "");
                    var total = qty*res;
                    var total_done = total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');

                    document.getElementById('jml_'+i).value = total_done;

                    var ck = document.getElementById('golongan_'+i).value;

                    if(ck == 1)
                    {
                        document.getElementById('jml_tenaga_'+i).value = total_done;
                    }
                    else if(ck == 2)
                    {
                        document.getElementById('jml_alat_'+i).value = total_done;
                    }
                    else if(ck == 3)
                    {
                        document.getElementById('jml_borongan_'+i).value = total_done;
                    }
                }
            }
        </script>

        <style>
            .table_header
            {
                float:left; padding:5px; background-color:#ccc; border-right:1px #999 solid;  text-align:center;
            }
            .table_content
            {
                float:left; padding:5px; background-color:white; text-align:center;
            }
        </style>
    </head>

    <body style="color:#494949">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span></button> <a class="navbar-brand" href="../index.php">ARSINERGI PROJECT MANAGER</a>
                </div>

                <div class="navbar-collapse collapse">
                </div><!--/.navbar-collapse -->
            </div>
        </div>

        <div style="position:relative; padding:20px">
            <?php
            if($edit != '')
            {
            $prj = mysqli_fetch_array(mysqli_query($conn, 'SELECT * FROM master_project_list WHERE project_id = '.$edit.''));
            ?>
                <form method="post" action="upah.php">
                    <div style="position:relative; margin-top:0px; width:2320px">

                        <a href="upah.php">
                            <button type="button" class="btn btn-warning" style="width:100px; height:30px; margin-bottom:20px; margin-top:50px">BACK</button>
                        </a>
                        <!-- <input type="text" onkeyup="total(this.value)"><input type="text" id="jml"> -->
                        <div style="position:relative; margin-bottom:20px; margin-top:20px; font-weight:bold; font-size:20px">
                            UPAH - <?php echo $prj['project_name'];?>
                        </div>

                        <div style="position:relative; margin-bottom:40px; background-color:#494949; height:1px"></div>

                        <?php
                        if($scs != '')
                        {
                            echo '<div class="bg-success" align="center" style="height:50px; line-height:50px; margin-bottom:30px">Sukses Update Data</div>';
                        }
                        ?>

                        <div style="position:relative; margin-bottom:10px">
                            <div class="table_header" style="width:50px;">NO</div>
                            <div class="table_header" style="width:100px;">TAHUN</div>
                            <div class="table_header" style="width:120px;">PERIODE</div>
                            <div class="table_header" style="width:120px;">TANGGAL</div>
                            <div class="table_header" style="width:120px;">GOL</div>
                            <div class="table_header" style="width:200px;">ITEM <span style="color:red">*</span></div>
                            <div class="table_header" style="width:200px;">KETERANGAN</div>
                            <div class="table_header" style="width:70px;">QTY <span style="color:red">*</span></div>
                            <div class="table_header" style="width:70px;">SAT</div>
                            <div class="table_header" style="width:200px;">HARGA SATUAN <span style="color:red">*</span></div>
                            <div class="table_header" style="width:200px;">TOTAL</div>
                            <div class="table_header" style="width:200px;">TENAGA MANDOR</div>
                            <div class="table_header" style="width:200px;">ALAT</div>
                            <div class="table_header" style="width:200px;">BORONGAN</div>
                            <div class="table_header" style="width:200px;">KETERANGAN</div>
                            <div class="table_header" style="width:50px;">DEL</div>
                            <div style="clear:both"></div>
                        </div>
                        <?php
                        $i=1;
                        for($k=1; $k<=70; $k++)
                        {
                            $k_next = $k+1;

                            $check_total = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM master_upah
                            WHERE id_project = '.$edit.''));

                            if($check_total == 0)
                            {
                                if($k == 1)
                                {
                                    $total = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM master_upah
                                    WHERE id_project = '.$edit.'
                                    AND project_count = '.$k.''));


                                    $total_next = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM master_upah
                                    WHERE id_project = '.$edit.'
                                    AND project_count = '.$k_next.''));

                                    $total = 1;
                                    $total_next = 0;
                                }
                            }
                            else
                            {
                                $total = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM master_upah
                                WHERE id_project = '.$edit.'
                                AND project_count = '.$k.''));


                                $total_next = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM master_upah
                                WHERE id_project = '.$edit.'
                                AND project_count = '.$k_next.''));
                            }
                            ?>

                            <div id="upah_<?php echo $k; ?>" <?php if($total == 0) echo 'style="visibility:hidden; display:none; height:0px; margin-bottom:20px"'; else echo 'style="margin-bottom:20px"'; ?>>

    							<?php
                                    $g = mysqli_fetch_array(mysqli_query($conn, 'SELECT * FROM master_upah
                                    WHERE id_project = '.$edit.'
                                    AND project_count = '.$k.''));

                                    $item1 = str_replace("##", '"', $g['item']);
                                    $item = str_replace("#", "'", $item1);

                                    $keterangan_a = str_replace("##", '"', $g['keterangan1']);
                                    $keterangan1 = str_replace("#", "'",  $keterangan_a);

                                    $keterangan_b = str_replace("##", '"', $g['keterangan2']);
                                    $keterangan2 = str_replace("#", "'", $keterangan_b);
                                ?>

                                <div style="position:relative">
                                    <div class="table_content" style="width:50px;" id="btn_upah_<?php echo $k; ?>">
    									<?php
                                        if($total_next == 0)
                                        {
                                            ?>
                                            <img src="../images/img_plus.png" style="cursor:pointer; margin-top:5px" onclick="
                                            document.getElementById('upah_<?php echo $k_next; ?>').style.visibility = 'visible';
                                            document.getElementById('upah_<?php echo $k_next; ?>').style.display = 'block';
                                            document.getElementById('upah_<?php echo $k_next; ?>').style.height = '';
                                            document.getElementById('btn_upah_<?php echo $k; ?>').style.visibility = 'hidden';
                                            ">
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="table_content" style="width:100px;">
                                        <?php
                                        if($g['tahun'] == '')
                                        {
                                            loadComboBoxTahun('tahun_'.$k.'', date('Y'));
                                        }
                                        else
                                        {
                                            loadComboBoxTahun('tahun_'.$k.'', $g['tahun']);
                                        }
                                        ?>
                                    </div>
                                    <div class="table_content" style="width:120px;">
                                        <?php
                                        if($g['periode'] == '')
                                        {
                                            loadComboBoxBulan_full('periode_'.$k.'', date('m'));
                                        }
                                        else
                                        {
                                            loadComboBoxBulan_full('periode_'.$k.'', $g['periode']);
                                        }

                                        ?>
                                    </div>
                                    <div class="table_content" style="width:120px;">
                                        <input type="text" name="tanggal_<?php echo $k; ?>" class="input datepicker2 form-control" style="width:100%; height:33px; text-align:center" value="<?php echo $g['tanggal'];?>"/>
                                    </div>
                                    <div class="table_content" style="width:120px;">
                                        <?php
                                            if($g['gol'] == 1)
                                            {
                                                $sel_gol1 = 'selected';
                                            }
                                            elseif($g['gol'] == 2)
                                            {
                                                $sel_gol2 = 'selected';
                                            }
                                            elseif($g['gol'] == 3)
                                            {
                                                $sel_gol3 = 'selected';
                                            }

                                            echo '<select id="golongan_'.$k.'" name="gol_'.$k.'" class="form-control">';
                                            echo '  <option value="1" '.$sel_gol1.'>Tenaga Mandor</option>';
                                            echo '  <option value="2" '.$sel_gol2.'>Alat</option>';
                                            echo '  <option value="3" '.$sel_gol3.'>Borongan</option>';
                                                    $sel_gol1 = '';
                                                    $sel_gol2 = '';
                                                    $sel_gol3 = '';
                        					echo '</select>';
                                        ?>
                                    </div>
                                    <div class="table_content" style="width:200px;">
                                        <input type="text" class="form-control rb-item" name="item_<?php echo $k; ?>" value="<?php echo $item;?>">
                                    </div>
                                    <div class="table_content" style="width:200px;">
                                        <input type="text" class="form-control" name="keterangan1_<?php echo $k; ?>" value="<?php echo $keterangan1;?>">
                                    </div>
                                    <div class="table_content" style="width:70px;">
                                        <input type="text" class="form-control" name="qty_<?php echo $k; ?>" value="<?php echo $g['qty'];?>" onkeyup="total(this.value)" id="qty_jml_<?php echo $k;?>">
                                    </div>
                                    <div class="table_content" style="width:70px;">
                                        <?php
                                            $data_sat = mysqli_query($conn, 'SELECT * FROM master_unit');

                                            echo '<select name="sat_'.$k.'" class="form-control">';
                        					while($ds = mysqli_fetch_array($data_sat))
                                            {

                                                if($g['satuan'] == $ds['unit_id'])
                                                {
                                                    $sel_sat = 'selected';
                                                }

                        						echo '<option value="'.$ds['unit_id'].'" '.$sel_sat.'>'.$ds['unit_name'].'</option>';

                                                $sel_sat = '';
                        					}
                        					echo '</select>';
                                        ?>
                                    </div>
                                    <div class="table_content" style="width:200px;">
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp</div>
                                            <input onblur="format(this);" type="text" class="form-control" name="harga_satuan_<?php echo $k; ?>" id="per_jml_<?php echo $k;?>" value="<?php echo number_format($g['harga_satuan']);?>" onkeyup="total(this.value)">
                                            <div class="input-group-addon">.00</div>
                                        </div>
                                    </div>
                                    <div class="table_content" style="width:200px;">
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp</div>
                                            <input type="text" class="form-control" name="jumlah_<?php echo $k; ?>" value="<?php echo number_format($g['jumlah']);?>" id="jml_<?php echo $k;?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="table_content" style="width:200px;">
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp</div>
                                            <input type="text" class="form-control" name="tenaga_mandor_<?php echo $k; ?>" id="jml_tenaga_<?php echo $k;?>" value="<?php echo number_format($g['tenaga_mandor']);?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="table_content" style="width:200px;">
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp</div>
                                            <input type="text" class="form-control" name="alat_<?php echo $k; ?>" id="jml_alat_<?php echo $k;?>" value="<?php echo number_format($g['alat']);?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="table_content" style="width:200px;">
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp</div>
                                            <input type="text" class="form-control" name="borongan_<?php echo $k; ?>" id="jml_borongan_<?php echo $k;?>" value="<?php echo number_format($g['borongan']);?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="table_content" style="width:200px;">
                                        <input type="text" class="form-control" name="keterangan2_<?php echo $k; ?>" value="<?php echo $keterangan2;?>">
                                    </div>
                                    <div class="table_content" style="width:50px;">
                                        <a href="upah.php?edit=<?php echo $edit;?>&del=<?php echo $g['id'];?>" onclick="return confirm('Are you sure?')">
                                            <img src="../images/img_waiting.png" style="margin-top:6px; ">
                                        </a>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                            <?php
                            $total = 0;
                            $tot_jumlah = $tot_jumlah + intval($g['jumlah']);
                            $tot_tenaga_mandor = $tot_tenaga_mandor + intval($g['tenaga_mandor']);
                            $tot_alat = $tot_alat + intval($g['alat']);
                            $tot_borongan = $tot_borongan + intval($g['borongan']);
                        }
                        ?>
                        <div style="position:relative; margin-bottom:10px">
                            <div class="table_header" style="width:50px;">&nbsp;</div>
                            <div class="table_header" style="width:100px;">&nbsp;</div>
                            <div class="table_header" style="width:120px;">&nbsp;</div>
                            <div class="table_header" style="width:120px;">&nbsp;</div>
                            <div class="table_header" style="width:120px;">&nbsp;</div>
                            <div class="table_header" style="width:200px;">&nbsp;</div>
                            <div class="table_header" style="width:200px;">&nbsp;</div>
                            <div class="table_header" style="width:70px;">&nbsp;</div>
                            <div class="table_header" style="width:70px;">&nbsp;</div>
                            <div class="table_header" style="width:200px;">&nbsp;</div>
                            <div class="table_header" style="width:200px;"><?php echo number_format($tot_jumlah);?></div>
                            <div class="table_header" style="width:200px;"><?php echo number_format($tot_tenaga_mandor);?></div>
                            <div class="table_header" style="width:200px;"><?php echo number_format($tot_alat);?></div>
                            <div class="table_header" style="width:200px;"><?php echo number_format($tot_borongan);?></div>
                            <div class="table_header" style="width:200px;">&nbsp;</div>
                            <div class="table_header" style="width:50px;">&nbsp;</div>
                            <div style="clear:both"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info" style="width:200px; height:50px">SAVE</button>
                    <input type="hidden" name="id_project" value="<?php echo $edit;?>">
                    <input type="hidden" name="save" value="1">
                </form>
            <?php
            }
            else
            {
            ?>
                <a href="../index.php">
                    <button type="button" class="btn btn-warning" style="width:100px; height:30px; margin-bottom:20px; margin-top:50px">BACK</button>
                </a>

                <div style="position:relative; margin-bottom:20px; font-weight:bold; font-size:20px">UPAH</div>

                <div style="position:relative; margin-bottom:40px; background-color:#494949; height:1px"></div>

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

        <script type="text/javascript">
        $(function()
        {
            var DaftarItem = [<?php echo ambil_item();?>];
            $( ".rb-item" ).autocomplete({
            source: DaftarItem
            });
        });
        </script>

    </body>
</html>
