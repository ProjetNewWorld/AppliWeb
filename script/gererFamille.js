$(document).ready(function() {

	$('.promouvoirMembre').click(function() {
	var membreId=$(this).val();
	var familleId=$("#getFamilleId").val();
	$.post("script/ajax/promouvoirMembre.php", { id: membreId , idFam : familleId }).done(function( data ) {
				$(location).attr('href',"gererFamille.php");
			});
	});
	
	$('.banMembre').click(function() {
	var membreId=$(this).val();
	$.post("script/ajax/banMembre.php", { id: membreId }).done(function( data ) {
				$(location).attr('href',"gererFamille.php");
			});
	});
});
