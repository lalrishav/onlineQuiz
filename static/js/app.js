$(window).load(function() {
	$(".loader").fadeOut("slow");
	
	$( ".datepicker" ).datepicker({ 
		autoSize: true,
		minDate: 0,
		appendText: '(yyyy-mm-dd)',
		dateFormat: 'yy-mm-dd',
	});	

})