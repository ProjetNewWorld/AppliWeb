$(document).ready(function(){
	$(window).resize(function(){
		if ($(".menuCache").is(":hidden")){
	    	$("nav").show();
		}
		else{
			if ($("nav").is(":visible")){
				$("nav").hide();
			}
		}
	});

	$(".menuCache").click(function(){
		if ($("nav").is(":hidden")){
			$("nav").slideDown(250);
			$("nav").show();
		}
		else{
			$("nav").slideUp(250);
			$("nav").hide();
		}
	});
});