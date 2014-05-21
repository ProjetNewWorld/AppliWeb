$(document).ready(function() {
	$('#mdpOublie').click(function() {
		var lePseudo=$('#inputPseudoOubli').val();
		if(lePseudo.length==0)
		{
			alert("Vous devez specifier le pseudo du membre");
		}
		else
		{
			alert("ok");
			$.post("script/ajax/renvoitMotDePasse.php", { pseudo: lePseudo }).done(function( data ) {
				alert(data);
				$("#infoEnvoi").html(data);
				$("#infoEnvoi").css('padding-left','20px');
				if(data!="mail send")
				{
					
					$("#infoEnvoi").css('background','red');
				}
				else
				{
					$("#infoEnvoi").css('background','green');
				}
			});
		}
	});
});
