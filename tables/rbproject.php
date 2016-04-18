<?php
	if(1==1){
	// 	include '../arsinergi/init.php';
    // include '../arsinergi/function.php';

?>
<form id="form1" name="form1" method="post" action="../arsinergi/deletedmp.php">
<div style="width:95%; overflow:auto;">&nbsp;
	<button id="btn_plus" type="button" class="btn btn-default btn-lg">
  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
	</button>
</div>
<table id="gridBookingEquipment" class="table table-striped table-hover" style="width:100%'">
	<thead>
		<tr>
      <th style="text-align:left">No</th>
      <th style="text-align:left;">Project name</th>
      <th style="text-align:left;">Status</th>
    </tr>
	</thead>
	<tbody>
	<?php
// 	$hasil1 = $db->query("SELECT rb_id, rb_year, rb_periode, rb_order_date, rb_gol ,rb_item, rb_item_detail, rb_order_total, rb_order_sent, rb_volume_paid,
//                u.unit_name, rb_item_price, rb_payment_status, rb_item_price_total,rb_notes, ms.supplier_name
// 			FROM realbahan,master_unit u, master_supplier ms
// 			WHERE rb_unit_id=u.unit_id
// 			AND ms.id_sup=rb_supplier ");
// while($row1 = $hasil1->fetch(PDO::FETCH_ASSOC))
// {
	$sql="SELECT project_id, project_name	FROM master_project_list";

	$result=mysqli_query($conn,$sql);
	while($data=mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>".$data['project_id']."</td>";
    echo "<td>".$data['project_name']."</td>";
    echo "<td><a href='tables/rb.php?id=".$data['project_id']."' class='btn btn-default btn-s' value='edit'>
        <span class='glyphicon glyphicon-edit' aria-hidden='true'></span>
        </a>&nbsp;<a href='deletedmp.php?id=".$data['project_id']."' class='btn btn-default btn-s' value='edit'>
                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                </a></td>";
		// echo "<td>".convertToDateID($data['rb_order_date'])."</td>";
		// echo "<td>".$data['material_category_name']."</td>";
		// echo "<td>".$data['rb_item']."</td>";
		// echo "<td>".$data['rb_item_detail']."</td>";
    // echo "<td>".number_format($data['rb_order_total'],2,".",",")."</td>";
		// echo "<td>".number_format($data['rb_order_sent'],2,".",",")."</td>";
    // echo "<td>".number_format($data['rb_volume_paid'],2,".",",")."</td>";
		// echo "<td>".number_format($data['rb_volume_indent'],2,".",",")."</td>";
		// echo "<td>".$data['unit_name']."</td>";
    // echo "<td>".convertToRp($data['rb_item_price'])."</td>";
    // echo "<td>".convertToRp($data['rb_item_price_total'])."</td>";
		// echo "<td>".convertToRp($data['rb_price_indent'])."</td>";
		// echo "<td>".$data['supplier_name']."</td>";
    // echo "<td>".$data['rb_no_ac']."</td>";
		// echo "<td>".$data['rb_payment_status']."</td>";
		// echo "<td>".$data['rb_no_faktur']."</td>";
		// echo "<td>".$data['rb_no_paid']."</td>";
		// echo "<td>".convertToDateID($data['rb_order_date_paid'])."</td>";
		// echo "<td>".$data['rb_notes']."</td>";
		echo "</tr>";
	}
	?>
	</tbody>
</table>
</div>
<?php
}

?>
