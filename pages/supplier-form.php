<?php
include 'init.php'
 ?>
<form id="form1" name="form1" method="post" action="../arsinergi/insertsup.php">
<div class='page-header'>
	<div class='btn-back-arrow' id="btn-menu">&nbsp;</div>
	<div class='page-header-title'>Master Project</div>
</div>
<div id='luasan' style="position:relative; width:auto; padding:10px;">
	<div style='font-weight:bold; font-size:1.2em; margin-top:10px;'>Tambahkan Project Baru</div>
	<table id="tableSup" class='table table-stripped' style='width:95%; float:left; overflow:auto; clear:both;'>
		<thead>
			<tr>
				<th>id</th>
				<th>Supplier</th>
				<th>Lokasi</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<input type="number" class="form-control" name="id_sup[]" id="id-sup" input style="width:75px" />
							</div>
						</div>
					</td>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<input type="text" class="form-control" name="supplier_name[]" id="supplier-name" input style="width:200px" />
							</div>
						</div>
					</td>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<input type="text" class="form-control" name="addres_supplier[]" id="addres-supplier" style="width:150px"/>
							</div>
						</div>
					</td>
			</tr>
		</tbody>
	</table>

<button id="btn_plus" type="button" class="btn btn-default btn-lg">
<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
</button>
<button id="btn_save" name="tsave" type="Submit" class="btn btn-default btn-lg">
<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
</button>
	<div style="clear:both"></div>
</div>

<?php include 'tables/supplier.php' ?>
	<!-- <div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan Data Baru</div>
	<div style="width:95%; overflow:auto; float:left;">
	<table id="tableRB" class='table table-stripped' style='width:1050px;'> -->

 <script>
 $('#btn_plus').click(function(){
 	var table = $('#tableSup').find('tbody');
 	var clone = table.find('tr:first').clone();
 	clone.find('input').val('');
 	table.append(clone);
 });

	$('#btn-menu').click(function(){
		window.location='setpage.php?page=menu';
	});
 </script>
</form>
