$(document).ready(function() {

	$('#buttonAjouterListe').click(function() {
		var produit=$("#choixProduit").val();
		var qte=$("#qteAjouterListe").val();
		$.post("script/ajax/ajoutProduit.php", { prod: produit , qtes : qte }).done(function( data ) {
				 $("#listeDesCourses").html(data).hide().fadeIn(400);
			});
	 });
});

