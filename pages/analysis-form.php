<div class='page-header'>
	<div class='btn-back-arrow' id="goToItem">&nbsp;</div>
	<div class='page-header-title'>Analisa Harga</div>
</div>
<div id='luasan' style="position:relative;padding:20px;">
	<div style='font-weight:bold; font-size:1.2em; margin-top:50px;'>Tambahkan data Baru</div>
	<div id="table-analysis"></div>
	
	<table class='table table-stripped' style='width:95%; float:left;'>
		<thead>
			<tr>
				<th>Item Pekerjaan</th>
				<th>Volume</th>
				<th>Satuan</th>
				<th>Harga Dasar</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div>
						<div style="display:inline-block; float:left; width:33%; height:2.2em; line-height:2em;"><input type="radio" name="item_option" id="item_option" value="manual" checked="checked">
							Manual Input</div>
						<div style="display:inline-block; float:left; width:33%; height:2.2em; line-height:2em;"><input type="radio" name="item_option" id="item_option" value="material"> Link Bahan</div>
						<div style="display:inline-block; float:left; width:33%; height:2.2em; line-height:2em;"><input type="radio" name="item_option" id="item_option" value="item"> Link Analisa</div>
						<div style="clear:both"></div>
					</div>
					<div>
						<input type="text" name="item" id="item" class="" style="width:90%" autocomplete="on"/>
					</div>
				</td>
				<td>
					<div style="display:inline-block; width:100%;height:2.2em; line-height:2em;" id="formula_result">&nbsp;</div>
					<div><input type="text" name="volume" id="volume" class="autocalc" style="width:100px; font-size:1em;position:absolute;"/></div>
				</td>
				<td>
					<div style="display:inline-block; width:100%; height:2.2em; line-height:2em;">&nbsp;</div>
				<?php
					$result=mysqli_query($conn, "SELECT unit_id, unit_name FROM master_unit WHERE unit_status='enabled' ORDER BY unit_name");
					echo "<select name='unit' id='unit'>";
					while($data=mysqli_fetch_array($result)){
						echo "<option value='".$data['unit_id']."'>".$data['unit_name']."</option>";
					}
					echo "</select>";
				?>
				</td>
				<td>
					<div style="display:inline-block; width:100%; height:2.2em; line-height:2em;">&nbsp;</div>
					<input type="text" name="price" id="price" class="numeric autocalc" style="width:90px;"/>
				</td>
				<td>
					<div style="display:inline-block; width:100%; height:2.2em; line-height:2em;">&nbsp;</div>
					<div id="total_price"></div>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="width:20px; float:left">
		<div id="btn-add"></div>
	</div>
	<div style="clear:both"></div>
</div>
<script>
$(document).ready(function(){
	$("#table-analysis").load("tables/analysis.php");
	$("#item").autocomplete({
		source: function(request, response) {
	            $.ajax({
	                url: "process/autocomplete.php",
	                dataType:'json',
	                data: {
	                    id: 'newanalysisitem',
	                    item: $("#item").val(),
	                    type: $("input[name='item_option']:checked").val()
	                },
	                success: function(data) {
	                    response(data);
	                }
	            });
	        },
		minLength:2,
		select: function(event,ui){
				var unit = ui.item.unit;
				var price = ui.item.price;
				$("#unit").val(unit);
				$("#price").val(price);
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
})

$("#item").change(function(){
	if($("input[name='item_option']:checked").val()=="manual"){
		if($(this).val().indexOf("upah")>=0){
			var firstItemName=$("#analysis-item-list > table > tbody > tr > td:nth-child(1)").html().toLowerCase();
			var firstItemVolume=$("#analysis-item-list > table > tbody > tr > td:nth-child(2)").html();
			if(firstItemName.indexOf("readymix")==0 || firstItemName.indexOf("setmix")==0){
				$('#volume').val(firstItemVolume);
			}
		}
		
	}
});

$('#volume').on('focus', function(){
	$(this).css("width","600px").css("z-index", "5").css("font-size","2.3em");
});
$('#volume').blur('focus', function(){
	$(this).css("width","100px").css("z-index", "1").css("font-size","1em");
});

$('#btn-add').click(function(){
	var item_option=$("input[name='item_option']:checked").val();
	var item=$("#item").val();
	var volume=$("#volume").val();
	var unit=$("#unit").val();
	var price=$("#price").val().replace(/[^0-9.]/g, '');
	$.post('process/item.php',{item_option:item_option, item:item, volume:volume, unit:unit, price:price},
	        function(data) {
	        	if(data.indexOf("[ERROR]"<-1))
	            	 $("#table-analysis").load("tables/analysis.php");	
	           	else
	           		alert(data);				
	         }
		);
});


$('.autocalc').change(function(){
	var volume=$("#volume").val();
	var price=$("#price").val().replace(/[^0-9.]/g, '');
	var total_price=0;
	if(volume.indexOf("=")==0){
		var formula=eval(volume.substr(1)).toFixed(3);
		$("#formula_result").html(formula);
		total_price=formula*price;
	}else{
		total_price=volume*price;
	}
	
	if(!isNaN(total_price))
		$("#total_price").html(addThousandsSeparator("Rp. "+total_price));
});

</script>