function addThousandsSeparator(value) {
    return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}
function hasDecimalPlace(value, x) {
    var pointIndex = value.indexOf('.');
    return  pointIndex >= 0 && pointIndex < value.length - x;
}

$(function(){
	$(".alphanumeric").keypress(function(e){
		var key;
		var keychar;

		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		keychar = keychar.toLowerCase();

		// control keys
		if ((key==null) || (key==0) || (key==8) ||
		    (key==9) || (key==13) || (key==27) )
		   return true;

		// alphas and numbers
		else if ((("abcdefghijklmnopqrstuvwxyz0123456789@ .,/\"'()-").indexOf(keychar) > -1))
		   return true;
		else
		   return false;
		});
	$(".numeric").keypress(function(e){
		var key;
		var keychar;

		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		keychar = keychar.toLowerCase();
		// numbers
		if ((("0123456789.").indexOf(keychar) > -1)){
			return true;
		}else
		   return false;
	});

	$(".numeric").focus(function(){
		$(this).val($(this).val().replace(/[^0-9.]/g, ''));
	});
	$(".numeric").blur(function(){
		$(this).val(addThousandsSeparator($(this).val()));
	});
	$('.decimal4').keypress(function (e) {
	    var character = String.fromCharCode(e.keyCode)
	    var newValue = this.value + character;
	    if (isNaN(newValue) || hasDecimalPlace(newValue, 5)) {
	        e.preventDefault();
	        return false;
	    }
	});
	$('.decimal2').keypress(function (e) {
	    var character = String.fromCharCode(e.keyCode)
	    var newValue = this.value + character;
	    if (isNaN(newValue) || hasDecimalPlace(newValue, 3)) {
	        e.preventDefault();
	        return false;
	    }
	});
	$(".formula").keypress(function(e){
		var key;
		var keychar;

		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		keychar = keychar.toLowerCase();

		// control keys
		if ((key==null) || (key==0) || (key==8) ||
		    (key==9) || (key==13) || (key==27) )
		   return true;

		// alphas and numbers
		else if ((("0123456789 .,/\"'()-+*=").indexOf(keychar) > -1))
		   return true;
		else
		   return false;
		});
	$('input').keypress(function(e) {
		/* ENTER PRESSED*/
		if (e.keyCode == 13) {
			/* FOCUS ELEMENT */
			var inputs = $(this).parents("table").eq(0).find(".input");
			var idx = inputs.index(this);
			if (idx == inputs.length - 1) {
			    inputs[0].select()
			} else {
			    inputs[idx + 1].focus(); //  handles submit buttons
			    inputs[idx + 1].select();
			}
			return false;
		}
	});
	$('select').keypress(function(e) {
		/* ENTER PRESSED*/
		if (e.keyCode == 13) {
			/* FOCUS ELEMENT */
			var inputs = $(this).parents("table").eq(0).find(".input");
			var idx = inputs.index(this);
			if (idx == inputs.length - 1) {
			    inputs[0].select()
			} else {
			    inputs[idx + 1].focus(); //  handles submit buttons
			    inputs[idx + 1].select();
			}
			return false;
		}
	});
	$(".datepicker2").datepicker({
		format:'dd-mm-yyyy',
	}).on('changeDate',function(){
		$(this).datepicker('hide');
		var inputs = $(this).parents("table").eq(0).find(":input");
		var idx = inputs.index(this);
		if (idx == inputs.length - 1) {
		    inputs[0].select()
		} else {
		    inputs[idx + 1].focus(); //  handles submit buttons
		    inputs[idx + 1].select();
		}
		return false;
	});



	$('#goToMenu').click(function(){
		window.location='setpage.php?page=menu';
	});
	$('#goToProjectlist').click(function(){
		window.location='setpage.php?page=projectlist';
	});
	$('#goToMeasurement').click(function(){
		window.location='setpage.php?page=measurement';
	});
	$('#goToRab').click(function(){
		window.location='setpage.php?page=rab';
	});

	$('#goToMaterial').click(function(){
		window.location='setpage.php?page=material';
	});
	$('#goToWarehouse').click(function(){
		window.location='setpage.php?page=gudang';
	});
	$('#goToItem').click(function(){
		window.location='setpage.php?page=item';
	});
	$('#goToAnalysis').click(function(){
		window.location='setpage.php?page=analysis';
	});
	$('#goToMutation').click(function(){
		window.location='setpage.php?page=mutation';
	});
	$('#goToUnit').click(function(){
		window.location='setpage.php?page=unit';
	});
  $('#goToRealBahan').click(function(){
		window.location='setpage.php?page=rb';
	});
  $('#goToMasterProject').click(function(){
		window.location='setpage.php?page=masterproject';
	});


});
