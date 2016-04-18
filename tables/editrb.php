<?php

		include '../init.php';
    include '../function.php';


		function ambil_item(){
			global $conn;
			$nama='';
			$sql_nama=mysqli_query($conn, "SELECT * FROM master_item");
			while($data_nama=mysqli_fetch_array($sql_nama)){
			$nama.='"'.stripslashes($data_nama['item_name']).'",';
			}
			return(strrev(substr(strrev($nama),1)));
		}

    $sql="SELECT rb_id, rb_project_id, rb_year, rb_periode, rb_order_date, mmc.material_category_name ,rb_item, rb_item_detail, rb_order_total, rb_order_sent, rb_volume_paid, rb_volume_indent,rb_supplier,rb_payment_status,
                 u.unit_name, rb_item_price, mp.payment_status, rb_item_price_total, rb_price_indent,rb_notes, ms.supplier_name, rb_order_date_paid, rb_no_ac, rb_no_faktur, rb_no_paid,rb_unit_id,rb_gol
        FROM realbahan,master_unit u, master_supplier ms, master_material_category mmc, master_project_list mpl, master_payment mp
        WHERE rb_id=".$_GET['id']."
        AND rb_unit_id=u.unit_id
        AND mmc.material_category_id=rb_gol
        AND mp.id_payment=rb_payment_status
        AND ms.id_sup=rb_supplier";
        // AND mpl.project_id=rb_project_id";

    $result=mysqli_query($conn,$sql);
    $tempPriceTotal=0;
    $tempPriceTotalIndent=0;
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

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<form id="form1" name="form1" method="post" action="../insertrb2.php?id=<?php echo $_GET['id'] .'&rb_project_id='.$_GET['rb_project_id']; ?>">
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span></button> <a class="navbar-brand" href="../setpage.php?page=menu">ARSINERGI PROJECT MANAGER</a>
            </div>

            <div class="navbar-collapse collapse">
            </div><!--/.navbar-collapse -->
        </div>
    </div>
    <div id="content" style="position:relative; margin-top:60px; clear:both; padding:20px;width:100%;">
    	<div style="border:2px solid black;">

<div class='page-header'>
	<a class='btn-back-arrow' href="../tables/rb.php?id=<?=$_GET['rb_project_id']?>">&nbsp;</a>
	<div class='page-header-title'>Master Real Bahan</div>
</div>
<div id='luasan' name='luasan' style="position:relative;padding:20px;">
<div style='font-weight:bold; font-size:1.2em; margin-top:5px;'>Edit Data</div>
<div style="width:95%; overflow-x:auto;overflow-y:visible; float:left;">
<table id="tableRB" class='table table-stripped' style="width:95%; overflow-y: visible; float:left;">
	<div id="linkscontainer">
				<div id="newlink">
	<thead>
		<tr>
			<th>Tahun</th>
			<th>Periode</th>
			<th>Tgl.order</th>
			<th>Gol</th>
			<th>Item</th>
			<th>Tipe</th>
			<th>Jml.order</th>
			<th>Jml.Terkirim</th>
			<th>Vol.Terbayar</th>
			<th>Vol.indent</th>
			<th>Sat</th>
			<th>Harga Satuan</th>
			<th>Jml.harga</th>
			<th>Indent</th>
			<th>Supplier</th>
			<th>No AC</th>
			<th>Status Bayar</th>
			<th>No Faktur</th>
			<th>No Bayar</th>
			<th>Tgl.Cair</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
    <?php

    while($data=mysqli_fetch_array($result)){
      ?>
      <td>
				<div class="form-group"  >
					<div class="input-group">
            <select style="height:34px" name="rb_year" id="rb_year">
							<option value="<?php echo $data['rb_year']?>"><?php echo $data['rb_year']?></option>
						<?php

						$now=date('Y');
						for ($a=2006;$a<=$now;$a++)
						{
     						echo "<option value=' ".$a." '>".$a."</option>";
						}
?>
            </select>
					</div>
				</div>
			</td>
      <td>
				<div class="form-group"  >
					<div class="input-group">
						<select style="height:34px" name="rb_periode" id="rb_periode">
							<option value="<?php echo $data['rb_periode']?>"><?php echo $data['rb_periode']?></option>
							<?php
							$namabulan=array("Januari","Februari","Maret","April","Mei", "Juni","July","Agustus","September","Oktober", "November","Desember");
							$bulan=count($namabulan);
							for ($c=0; $c<$bulan; $c+=1){
								echo "<option value=$namabulan[$c]> $namabulan[$c]</option>";
							}
							?>
							</select>
					</div>
				</div>
			</td>
      <td>
				<div class="form-group" >
					<div class="input-group">
						<input type="text" class="form-control date-order" name="rb_order_date" id="date-order" style="width:200px; position:static;" data-date-format="YYYY/MM/DD" value="<?= $data['rb_order_date'];?>"/>
					</div>
				</div>
			</td>
      <td>
        <div class="form-group"  >
					<div class="input-group">
        <select class="form-control" name="rb_gol" style="width:150px;" ><option value="<?php echo $data['rb_gol']?>"><?php echo $data['material_category_name']?></option>
            <?php
                $result=mysqli_query($conn, "SELECT material_category_id, material_category_name FROM master_material_category WHERE material_category_status='enabled' ORDER BY material_category_name");
                while($data1=mysqli_fetch_array($result)){

                    echo "<option value='".$data1['material_category_id']."'>".$data1['material_category_name']."</option>";
                }
            ?>
        </select>
      </div>
    </div>
      </td>
      <td>
        <div class="form-group">
          <div class="ui-widget input">
            <input type="text" class="form-control order-item" id="rb-item" name="rb_item" style="width:200px" value="<?php echo $data['rb_item'];?> "/>
          </div>
        </div>
      </td>
      <td>
        <div class="ui-widget" >
          <div class="ui-widget input">
            <input type="text" class="form-control" name="rb_item_detail" id="rb_item_detail" style="width:100px" value="<?= $data['rb_item_detail'];?>"/>
          </div>
        </div>
      </td>
      <td>
        <div class="form-group"  >
          <div class="input-group">
            <input type="number" class="form-control" name="rb_order_total" id="rb_order_total" value="<?= $data['rb_order_total'];?>" style="width:80px" onfocus="startCalculate()" onblur="stopCalc()"/>
          </div>
        </div>
      </td>
      <td>
        <div class="form-group"  >
          <div class="input-group">
            <input type="number" class="form-control" name="rb_order_sent" id="rb_order_sent" style="width:80px" value="<?= $data['rb_order_sent'];?>"/>
          </div>
        </div>
      </td>
      <td>
        <div class="form-group" >
          <div class="input-group">
            <input type="number" class="form-control" name="rb_volume_paid" id="rb_volume_paid" style="width:80px" value="<?= $data['rb_volume_paid'];?>"/>
          </div>
        </div>
      </td>
      <td>
        <div class="form-group" >
          <div class="input-group">
            <input type="text" readonly="readonly" class="form-control" name="rb_volume_indent" id="rb_volume_indent" style="width:80px" value="<?= $data['rb_volume_indent'];?>"/>
          </div>
        </div>
      </td>

      <td>
        <div class="form-group"  >
					<div class="input-group">
        <select class="form-control" name="rb_unit_id" style="width:100px;" ><option value="<?php echo $data['rb_unit_id']?>"><?php echo $data['unit_name']?></option>
      <?php
        $result=mysqli_query($conn, "SELECT unit_id, unit_name FROM master_unit WHERE unit_status='enabled' ORDER BY unit_name");
        while($data1=mysqli_fetch_array($result)){
          echo "<option value='".$data1['unit_id']."'>".$data1['unit_name']."</option>";
        }
      ?>
        </select>
      </div>
    </div>
    </td>
      <td>
        <div class="form-group"  >
          <div class="input-group">
            <div class="input-group-addon">Rp</div>
            <input type="text" class="form-control" name="rb_item_price" id="rb_item_price" style="width:100px" value="<?= $data['rb_item_price'];?>" onfocus="startCalculate()" onblur="stopCalc()"/>
            <div class="input-group-addon">,00</div>
          </div>
        </div>
      </td>
      <td>
          <div class="form-group"  >
            <div class="input-group">
              <div class="input-group-addon">Rp</div>
              <input type="text" readonly="readonly" class="form-control" name="rb_item_price_total" id="rb_item_price_total" value="<?= $data['rb_item_price_total'];?>" style="width:120px" onfocus="startCalculate()" onblur="stopCalc()"/>
              <div class="input-group-addon">,00</div>
            </div>
          </div>
        </td>
        <td>
  				<div class="form-group"  >
  					<div class="input-group">
  						<div class="input-group-addon">Rp</div>
  						<input type="text" readonly="readonly" class="form-control" name="rb_price_indent" id="rb_price_indent" style="width:120px" value="<?= $data['rb_price_indent'];?>" onfocus="startCalculate()" onblur="stopCalc()"/>
  						<div class="input-group-addon">,00</div>
  					</div>
  				</div>
  			</td>
  			<td>
          <div class="form-group"  >
  					<div class="input-group">
          <select class="form-control" name="rb_supplier" style="width:200px;" ><option value="<?php echo $data['rb_supplier']?>"><?php echo $data['supplier_name']?></option>
  			<?php
  				$result=mysqli_query($conn, "SELECT id_sup, supplier_name FROM master_supplier WHERE supplier_status='enabled' ORDER BY supplier_name");
  				while($data1=mysqli_fetch_array($result)){
  					echo "<option value='".$data1['id_sup']."'>".$data1['supplier_name']."</option>";
  				}
  			?>
          </select>
        </div>
      </div>
  	 </td>
  			<td>
  				<div class="form-group"  >
  					<div class="input-group">
  						<input type="text" class="form-control" name="rb_no_ac" id="rb_no_ac" style="width:80px" value="<?= $data['rb_no_ac'];?>"/>
  					</div>
  				</div>
  			</td>
  			<td>
          <div class="form-group"  >
            <div class="input-group">
          <select class="form-control" name="rb_payment_status" style="width:100px;" ><option value="<?php echo $data['rb_payment_status']?>"><?php echo $data['payment_status']?></option>
        <?php
  				$result=mysqli_query($conn, "SELECT id_payment, payment_status FROM master_payment WHERE payment_status_status='enabled' ORDER BY payment_status");
  				while($data1=mysqli_fetch_array($result)){
  					echo "<option value='".$data1['id_payment']."'>" .$data1['payment_status']. "</option>";
  				}
  			?>
        </select>
      </div>
      </div>
  			</td>
  			<td>
  				<div class="form-group">
  					<div class="input-group">
  						<input type="text" class="form-control" name="rb_no_faktur" id="rb_no_faktur" style="width:125px" value="<?= $data['rb_no_faktur'];?>"/>
  					</div>
  				</div>
  			</td>
  			<td>
  				<div class="form-group">
  					<div class="input-group">
  						<input type="text" class="form-control" name="rb_no_paid" id="rb_no_paid" style="width:60px" value="<?= $data['rb_no_paid'];?>"/>
  					</div>
  				</div>
  			</td>
  			<td>
  				<div class="form-group"  >
  					<div class="input-group">
  						<input type="text" class="form-control date-order-paid" name="rb_order_date_paid" id="date-order-paid" style="width:150px" data-date-format="YYYY/MM/DD" value="<?= $data['rb_order_date_paid'];?>"/>
  					</div>
  				</div>
  			</td>
  			<td>
  				<div class="form-group" >
  					<div class="input-group">
  				<input type="text" class="form-control" name="rb_notes" id="rb_notes" style="width:250px" value="<?= $data['rb_notes'];?>"/>
  					</div>
  				</div>
  			</td>
  		</tr>

    </tbody>

      <?php } ?>

	</tbody>
	</table>
</div>
</div>



<button id="btn_save" type="Submit" class="btn btn-default btn-lg">
<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
</button>

</div>
</div>
</div>
</div>

<script>
$(document).on('focus',".date-order", function(){ //bind to all instances of class "date".
    $(this).datetimepicker();
		// showButtonPanel: true,
		//                   //minDate: new Date(),
		                  // showTime: true
	});
	$(document).on('focus',".date-order-paid", function(){ //bind to all instances of class "date".
	    $(this).datetimepicker();
		});
// $(document).ready(
//          function() {
//    		  $(function() {
//                $("#date-order").datetimepicker({
// 								 	dateFormat: "yy/mm/dd",
// 									showButtonPanel: true,
//                   //minDate: new Date(),
//                   showTime: true
//                });
//             });
//    	   });
// $(document).ready(
//         function() {
//         $(function() {
//               $("#date-order-paid").datetimepicker({
//                   dateFormat: "yy/mm/dd",
//                   showButtonPanel: true,
//                   //minDate: new Date(),
//                   showTime: true
//                 });
//               });
//             });

$(function() {
    var DaftarItem = [<?php echo ambil_item();?>];
    $( "#rb-item" ).autocomplete({
      source: DaftarItem
    });
  });


function startCalculate(){
interval=setInterval("Calculate()",10)	;

}
function Calculate(){

//var a=parseFloat(document.form1.price.value);
	$('[name="rb_order_total"]').each(function(){
		var parent = $(this).closest('tr');
		var b = parent.find('[name="rb_item_price"]').val();
		var c = $(this).val();
		parent.find('[name="rb_item_price_total"]').val(b*c);
	});

	$('[name="rb_volume_indent"]').each(function(){
		var parent = $(this).closest('tr');
		var d = parent.find('[name="rb_volume_paid"]').val();
		var e = parent.find('[name="rb_order_sent"]').val();
		var f = parseInt(e)-parseInt(d);
		parent.find('[name="rb_volume_indent"]').val(f);
	});

	$('[name="rb_volume_indent"]').each(function(){
		var parent = $(this).closest('tr');
		var g = parent.find('[name="rb_item_price"]').val();
		var h = $(this).val();
		var i = parseInt(g)*parseInt(h);
		parent.find('[name="rb_price_indent"]').val(i);
	});
}

function stopCalc(){
clearInterval(interval);
}

</script>

</form>
</body>
</html>
