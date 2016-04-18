
<?php
if(1==1){
	$select = '';
	$select .= '<select name="project_type1" class="project-input2 project-input" style="display:none">';
  $result1=mysqli_query($conn, "SELECT catpro_id, catpro_name FROM master_project_category WHERE catpro_status='enabled' ORDER BY catpro_name");
			while($data1=mysqli_fetch_array($result1)){

		$select .= "<option value='".$data1['catpro_id']."'>" .$data1['catpro_name']. "</option>";
	}
 	$select .= "</select>";
		//
		// include '../arsinergi/init.php';
  	// /include '../arsinergi/function.php';

?>
</script>
<form id="form1" name="form1" method="post" action="../arsinergi/deletedmp.php">
<div style="width:95%; overflow:auto;">
<table class='table table-stripped'>
	<thead>
		<tr>
			<th>Judul Proyek</th>
			<th>Tipe</th>
			<th>PIC</th>
			<th>Klien</th>
			<th>Luasan</th>
			<th>RAB</th>
			<th>Real Bahan</th>
			<th>Real Bahan Upah</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php

	$sql= "SELECT p.project_id, p.project_name, pc.catpro_name, p.project_pic, p.project_client_name,
			p.project_measurement_total, p.project_rab_total, p.project_rb_total, p.project_rbupah_total
		FROM master_project_list p, master_project_category pc
		WHERE p.project_category_id=pc.catpro_id";


	$result=mysqli_query ($conn,$sql);
	while($data=mysqli_fetch_array($result)){
			echo "<tr data-id='".$data['project_id']."'>";
			echo "<td><span class='project-label1 project-label'>".$data['project_name']."</span><input type='text' name='project_name1' class='project-input1 project-input' style='display:none' /></td>";
			echo "<td><span class='project-label2 project-label'>".$data['catpro_name']."</span>".$select."</td>";
			echo "<td><span class='project-label3 project-label'>".$data['project_pic']."</span><input type='text' name='project_pic1' class='project-input3 project-input' style='display:none'/></td>";
			echo "<td><span class='project-label4 project-label'>".$data['project_client_name']."</span><input type='text' name='project_client_name1' class='project-input4 project-input' style='display:none' /></td>";
			echo "<td><span class='project-label5 project-label'>".number_format($data['project_measurement_total'],3,".",",")."&nbsp;M2</span><input type='text' name='project_measurement_total1' class='project-input5 project-input' style='display:none' /></td>";
			echo "<td><span class='project-label6 project-label'>".convertToRp($data['project_rab_total'])."</span><input type='text' name='project_rab_total1' class='project-input6 project-input' style='display:none' /></div></td>";
			echo "<td><span class='project-label7 project-label'>".convertToRp($data['project_rb_total'])."</span><input type='text' name='project_rb_total1' class='project-input7 project-input' style='display:none' /></div></td>";
			echo "<td><span class='project-label8 project-label'>".convertToRp($data['project_rbupah_total'])."</span><input type='text' name='project_rbupah_total1' class='project-input8 project-input' style='display:none' /></div></td>";
			echo "<td></td>";
			// echo "<td><a href='hapus.php?id= '>".$data['project_id']."></a><input type='button'</td>"
			echo "<td><a href='#' class='btn btn-default btn-s link-edit' value='edit'>
          <span class='glyphicon glyphicon-edit' id='editproject' aria-hidden='true'></span>
        	</a>&nbsp;<a href='deletedmp.php?id=".$data['project_id']."' class='btn btn-default btn-s' value='deleted'>
			        <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
			        </a>&nbsp;<button id='btn_save' name='tedit' type='Submit' class='btn btn-default btn-s link-save'>
								  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button></td>";
			echo "</tr>";
	}

	?>

	</tbody>
</table>

<script>

	$(document).on('click', '.link-save', function(){
		var row = $(this).closest('tr');
		var id = row.data('id');
		var project_name1 = row.find('[name="project_name1"]').val();
		var project_type1 = row.find('[name="project_type1"]').val();
		var project_pic1 = row.find('[name="project_pic1"]').val();
		var project_client_name1 = row.find('[name="project_client_name1"]').val();
		var project_measurement_total1 = row.find('[name="project_measurement_total1"]').val();
		var project_rab_total1 = row.find('[name="project_rab_total1"]').val();
		var project_rb_total1 = row.find('[name="project_rb_total1"]').val();
		var project_rbupah_total1 = row.find('[name="project_rbupah_total1"]').val();
		//alert(id);
		//alert(id);
		$.post('insertmp2.php', {
			project_id : id,
			project_name1: project_name1,
			project_type1: project_type1,
			project_pic1: project_pic1,
			project_client_name1: project_client_name1,
			project_measurement_total1: project_measurement_total1,
			project_rab_total1: project_rab_total1,
			project_rb_total1: project_rb_total1,
			project_rbupah_total1: project_rbupah_total1
		}, function(val){
			//alert(val);
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
			// var label = row.find('.project-label');
			// var input = row.find('.project-input');
			// label.html(input.val());
			// label.show();
			// input.hide();

			// document.location = "index.php";


	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label1');
		var input = row.find('.project-input1');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

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
	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label4');
		var input = row.find('.project-input4');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label5');
		var input = row.find('.project-input5');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label6');
		var input = row.find('.project-input6');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});
	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label7');
		var input = row.find('.project-input7');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});
	$(document).on('click', '.link-edit', function(){
		var row = $(this).closest('tr');
		var label = row.find('.project-label8');
		var input = row.find('.project-input8');
		input.val(label.text());
		label.hide();
		input.show();
		return false;
	});

	$(".meas").click(function(){
		window.location='setpage.php?page=measurement&prid='+$(this).parent().attr('id');
	});
	$(".rab").click(function(){
		window.location='setpage.php?page=rab&prid='+$(this).parent().attr('id');
	});
	$(".rb").click(function(){
		window.location='setpage.php?page=rb&prid='+$(this).parent().attr('id');
	});
	$(".rbupah").click(function(){
		window.location='setpage.php?page=rbupah&prid='+$(this).parent().attr('id');
	});

</script>
<?php } ?>
</form>
