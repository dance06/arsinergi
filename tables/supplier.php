<?php
	if(1==1){
	// 	include '../arsinergi/init.php';
    // include '../arsinergi/function.php';

?>
<form id="form1" name="form1" method="post" action="../arsinergi/deletedmp.php">
<div style="width:95%; overflow:auto;">&nbsp;

</div>
<table id="gridBookingEquipment" class="table table-striped table-hover" style="width:100%'">
	<thead>
		<tr>
      <th style="text-align:left">No</th>
      <th style="text-align:left;">Supplier</th>
			<th style="text-align:left;">Lokasi</th>
			<th style="text-align:left;">Status</th>
    </tr>
	</thead>
	<tbody>
	<?php
	$sql="SELECT id, id_sup, supplier_name, addres_supplier	FROM master_supplier";

	$result=mysqli_query($conn,$sql);
	while($data=mysqli_fetch_array($result)){
		echo "<tr data-id='".$data['id_sup']."'>";
		echo "<td>".$data['id_sup']."</td>";
    echo "<td><span class='project-label2 project-label'>".$data['supplier_name']."</span><input type='text' name='supplier_name1' class='project-input2 project-input' style='display:none'/></td>";
		echo "<td><span class='project-label3 project-label'>".$data['addres_supplier']."</span><input type='text' name='addres_supplier1' class='project-input3 project-input' style='display:none'/></td>";
    echo "<td><a href='#' class='btn btn-default btn-s link-edit' value='edit'>
				<span class='glyphicon glyphicon-edit' id='editsupplier' aria-hidden='true'></span>
				</a>&nbsp;<a href='deletedsup.php?id=".$data['id']."' class='btn btn-default btn-s' value='edit'>
                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                </a>&nbsp;<button id='btn_save' name='tedit' type='Submit' class='btn btn-default btn-s link-save'>
									  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button></td>";
		echo "</tr>";
	}
	?>
	</tbody>
</table>
</div>

<script>

$(document).on('click', '.link-save', function(){
	var row = $(this).closest('tr');
	var id = row.data('id');
	var supplier_name1 = row.find('[name="supplier_name1"]').val();
	var addres_supplier1 = row.find('[name="addres_supplier1"]').val();
	$.post('insertsup2.php', {
		id_sup : id,
		supplier_name1: supplier_name1,
		addres_supplier1: addres_supplier1
	}, function(val){
		// alert(val);
		row.find('.project-input').each(function(){
			var label = $(this).parent().find('.project-label');
			var input = $(this);
			label.html(input.val());
			label.show();
			input.hide();
		});
	});
	return false;
});

	// $(document).on('click', '.link-edit', function(){
	// 	var row = $(this).closest('tr');
	// 	var label = row.find('.project-label1');
	// 	var input = row.find('.project-input1');
	// 	input.val(label.text());
	// 	label.hide();
	// 	input.show();
	// 	return false;
	// });


	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label2');
		var input = row.find('.project-input2');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label3');
		var input = row.find('.project-input3');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});
</script>
<?php
}

?>
