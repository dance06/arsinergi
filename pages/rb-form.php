<?php

include 'init.php';

function ambil_item(){
	global $conn;
	$nama='';
	$sql_nama=mysqli_query($conn, "SELECT * FROM master_item");
	while($data_nama=mysqli_fetch_array($sql_nama)){
	$nama.='"'.stripslashes($data_nama['item_name']).'",';
	}
	return(strrev(substr(strrev($nama),1)));
}

?>

<form id="form1" name="form1" method="post" action="../arsinergi/caridata.php">
<div class='page-header'>
	<div class='btn-back-arrow' id="goToMenu">&nbsp;</div>
	<div class='page-header-title'>Master Real Bahan</div>
</div>
<?php include 'tables/rbproject.php' ?>
<!-- <link rel="stylesheet" href="<?= WEB_PATH ?>/vendor/datatables-1.10.7/media/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?= WEB_PATH ?>/vendor/datatables-1.10.7/media/css/dataTables.bootstrap.css" /> -->

<!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->

	<div id="table-rb"></div>
</form>

<!-- <script src="<?= WEB_PATH ?>/vendor/datatables-1.10.7/media/js/jquery.dataTables.min.js"></script>
<script src="<?= WEB_PATH ?>/vendor/datatables-1.10.7/media/js/dataTables.bootstrap.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
  <script src="../bootstrap-3.0.2/js/typeahead.min.js"></script> -->
<script type="text/javascript">
$(function() {
    var DaftarItem = [<?php echo ambil_item();?>];
    $( "#rb-item" ).autocomplete({
      source: DaftarItem
    });
  });
$("#supplier").autocomplete({
	source: function(request, response) {
						$.ajax({
								url: "process/autocomplete.php",
								dataType:'json',
								data: {
										id: 'realbahan',
										item: $("#supplier").val(),
										type: 'supplier'
								},
								success: function(data) {
										response(data);
								}
						});
				},
	minLength:2,
});


$('#btn_plus').click(function(){
	var table = $('#tableRB').find('tbody');
	var clone = table.find('tr:first').clone();
	clone.find('input').val('');
	table.append(clone);
});


function startCalculate(){
interval=setInterval("Calculate()",10)	;

}
function Calculate(){

//var a=parseFloat(document.form1.price.value);
	$('[name="rb_order_total[]"]').each(function(){
		var parent = $(this).closest('tr');
		var b = parent.find('[name="rb_item_price[]"]').val();
		var c = $(this).val();
		parent.find('[name="rb_item_price_total[]"]').val(b*c);
	});

	$('[name="rb_order_sent[]"]').each(function(){
		var parent = $(this).closest('tr');
		var d = parent.find('[name="rb_volume_paid[]"]').val();
		var e = $(this).val();
		var f = parseInt(e)-parseInt(d);
		parent.find('[name="rb_volume_indent[]"]').val(f);
	});

	$('[name="rb_volume_indent[]"]').each(function(){
		var parent = $(this).closest('tr');
		var g = parent.find('[name="rb_item_price[]"]').val();
		var h = $(this).val();
		var i = parseInt(g)*parseInt(h);
		parent.find('[name="rb_price_indent[]"]').val(i);
	});
//var b=parseFloat(document.form1.volume_indent.value);
//var c=parseFloat(document.form1.order_total.value)
//document.form1.price_total.value= a*c;
//document.form1.indent.value= a*b;
// var b=document.form1.volume_indent.value;
// var d=document.form1.indent
}

function stopCalc(){
clearInterval(interval);
}

</script>

<!-- <script>
$('#btn_save').click(function(){
		var tahun_order=$("#order_year").val();
		var item=	$("item").val()
		var data = 'order_year='+ tahun_order + '&item='+ item;
		$.ajax({
			type: 'POST',
			url: 'process/rb1.php',
			data: data,
			success:function(){
				$('#tampil').load("tables/rb.php");
			}
		});
	});
		// periode:$("#link_id").val(),
		// order_date:$("#item").val(),
		// gol:$("#item_detail").val(),
		// item:$("#item_detail").val(),
		// item_detail:$("#item_detail").val(),
		// order_total:$("#order_total").val().replace(/[^0-9.+-/*=]/g, ''),
		// order_sent:$("#order_sent").val().replace(/[^0-9.+-/*=]/g, ''),
		// volume_paid:$("#volume_paid").val().replace(/[^0-9.+-/*=]/g, ''),
		// unit_id:$("#unit").val(),
		// item_price:$("#price").val().replace(/[^0-9.+-/*=]/g, ''),
		// item_price_total:$("#price").val().replace(/[^0-9.+-/*=]/g, ''),
		// supplier:$("#supplier").val(),
		// ac_no:$("#ac_no").val(),
		// rb_payment_status:$("#payment_status").val(),
		// invoice_no:$("#invoice_no").val(),
		// pay_no:$("#pay_no").val(),
		// settled_date:$("#settled_date").val(),
		// rb_notes:$("#notes").val()





// $('date').datetimepicker({
// 	format : 'DD-MM-YYYY'
// });
// $('year').datetimepicker({
// 	format : 'YYYY'
// });


$(document).ready(function(){
	$("#table-rb").load("tables/rb.php");
});
// $(document).ready(function(){
// 	$("#table-rb").load("tables/rb.php");
// 	$("#origin").autocomplete({
// 		source: function(request, response) {
// 	            $.ajax({
// 	                url: "process/autocomplete.php",
// 	                dataType:'json',
// 	                data: {
// 	                    id: 'project',
// 	                    item: $("#origin").val(),
// 	                },
// 	                success: function(data) {
// 	                    response(data);
// 	                }
// 	            });
// 	        },
// 		minLength:2,
// 		select: function(event,ui){
// 				var id = ui.item.id;
// 				$("#origin_id").val(id);
// 			},
// 		change: function( event, ui ) {
// 			if ( !ui.item ) {
// 				$("#origin_id").val("NULL");
// 				return false;
// 			}
// 		}
// 	});
$(document).ready(function(){
	$("#table-rb").load("tables/rb.php");
	$("#item").autocomplete({
		source: function(request, response) {
	            $.ajax({
	                url: "process/autocomplete.php",
	                dataType:'json',
	                data: {
	                    id: 'newanalysisitem',
	                    item: $("#item").val(),
	                    type: 'material'
	                },
	                success: function(data) {
	                    response(data);
	                }
	            });
	        },
		minLength:2,
		select: function(event,ui){
				var id = ui.item.id;
				var unit = ui.item.unit;
				var price = ui.item.price;
				$("#link_id").val(id);
				$("#unit").val(unit);

			},
		change: function( event, ui ) {
			if ( !ui.item ) {
				$(this).val("");
				select.val("");
				input.data("autocomplete").term = "";
				return false;
			}
		}
	});

});
<!--  -->

<!--  -->
<!-- //
// $(".formula").change(function(){
// 	var value=$(this).val();
// 	if($(this).val().indexOf("=")==0){
// 		value=eval($(this).val().substr(1));
//
// 	}
// 	$(this).parent().children(0).text(value);
// });
//
// $('.calVolIndent').change(function(){
// 	var volume_indent=0;
// 	var order_sent=$("#order_sent").val();
//
// 	if(order_sent.indexOf("=")==0){
// 		order_sent=eval(order_sent.substr(1));
// 	}else{
// 		order_sent=parseFloat($("#order_sent").val());
// 	}
//
//
// 	var volume_paid=$("#volume_paid").val();
// 	if(volume_paid.indexOf("=")==0){
// 		volume_paid=eval(volume_paid.substr(1));
// 	}else{
// 		volume_paid=parseFloat($("#volume_paid").val());
// 	}
//
// 	volume_indent=order_sent-volume_paid;
//
// 	if(!isNaN(volume_indent))
// 		$("#volume_indent").html(volume_indent);
// });
//
// $('.calPriceTotal').change(function(){
// 	var price_total=0;
// 	var volume_paid=$("#volume_paid").val();
// 	if(volume_paid.indexOf("=")==0){
// 		volume_paid=eval(volume_paid.substr(1));
// 	}else{
// 		volume_paid=parseFloat($("#volume_paid").val());
// 	}
//
// 	var price=$("#price").val().replace(/[^0-9.+-/*=]/g, '');
// 	if(price.indexOf("=")==0){
// 		price=eval(price.substr(1));
// 	}
//
// 	price_total=volume_paid*price;
//
// 	if(!isNaN(price_total))
// 		$("#price_total").html(price_total);
// });
//
// $('.calIndent').change(function(){
// 	var indent=0;
// 	var order_sent=$("#order_sent").val();
// 	if(order_sent.indexOf("=")==0){
// 		order_sent=eval(order_sent.substr(1));
// 	}else{
// 		order_sent=parseFloat($("#order_sent").val()); -->
<!-- // 	}
//
// 	var volume_paid=$("#volume_paid").val();
// 	if(volume_paid.indexOf("=")==0){
// 		volume_paid=eval(volume_paid.substr(1));
// 	}else{
// 		volume_paid=parseFloat($("#volume_paid").val());
// 	}
//
// 	var price=$("#price").val().replace(/[^0-9.+-/*=]/g, '');
// 	if(price.indexOf("=")==0){
// 		price=eval(price.substr(1));
// 	}
// 	volume_indent=order_sent-volume_paid;
// 	indent=volume_indent*price;
//
// 	if(!isNaN(indent))
// 		$("#indent").html(indent);
// });
 -->
 </script>

<?php

 //end of project_id check

?>
