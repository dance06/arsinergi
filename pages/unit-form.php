<?php
include 'init.php' ?>

<form id="form1" name="form1" method="post" action="../arsinergi/insertunit.php">
<div class='page-header'>
	<div class='btn-back-arrow' id="goToMenu">&nbsp;</div>
	<div class='page-header-title'>Unit</div>
</div>
<div id='luasan' style="position:relative;padding:20px;">
	<div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan Data Baru</div>
	<table id='tableUnit' class='table table-stripped' style='width:95%; float:left;'>
		<thead>
			<tr>
				<th>Satuan</th>
				<th>Catatan</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<input type="text" class="form-control" name="unit_name[]" id="unit-name" input style="width:200px" />
							</div>
						</div>
					</td>
					<td>
						<div class="form-group"  >
							<div class="input-group">
								<input type="text" class="form-control" name="unit_note[]" id="unit-note" style="width:150px"/>
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

<?php include 'tables/unit.php' ?>
	<script>
	$('#btn_plus').click(function(){
  	var table = $('#tableUnit').find('tbody');
  	var clone = table.find('tr:first').clone();
  	clone.find('input').val('');
  	table.append(clone);
  });

</script>
