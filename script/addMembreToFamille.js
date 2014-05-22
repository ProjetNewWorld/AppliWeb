$(document).ready(function() {
	$('#ajouterALaFamille').click(function() {
		var lePseudo=$('#pseudoAjouterALaFamille').val();
		if(lePseudo.length==0)
		{
			alert("Vous devez specifier le pseudo du membre a ajouter");
		}
		else
		{
			$('#pseudoAjouterALaFamille').val("");
			$.post("script/ajax/addmembretofamille.php", { pseudo: lePseudo }).done(function( data ) {
				$("#repAjout").html(data).hide().fadeIn(500);
				$("#repAjout").css('padding-left','20px');
				if(data!="Demande envoy&eacutee")
				{
					
					$("#repAjout").css('color','red');
				}
				else
				{
					$("#repAjout").css('color','green');
				}
			});
		}
	});
});
