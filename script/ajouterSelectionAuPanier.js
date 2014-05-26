$(document).ready(function() {

	$('#addSelectedItems').click(function() {
/*		var i=$i;
		alert("i="+$i);*/
		var produit=$("#test").val();
		alert(produit);
		$.post("script/ajax/ajouterAuPanier.php", { prod: produit }).done(function( data ) {

			})
	 });
});

