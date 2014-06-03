function finDesCourses()
{
		$.post("script/ajax/finDesCourses.php", {}).done(function( data ) {
				$("#contenu").html(data).hide().fadeIn(400);
			});
}