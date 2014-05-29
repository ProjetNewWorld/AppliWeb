$(document).ready(function() {

	$('#addSelectedItems').click(function() {
		var i=$("#i").val();//alert(i);
		var produit=new Array();
		var item;
		var prod;
		//pour chaques produit de la liste
		for(liste=0;liste<i;liste++)
		{
			item="item"+liste; //alert(item);
			prod="#prod"+liste;
			// pour chaque produit selectionné
			if(document.getElementById(item).checked)
			{
				produit[liste]=$(prod).val();
				//alert(produit[liste]);
			}
		}		

		$.post("script/ajax/ajouterAuPanier.php", { prod: produit }).done(function( data ) {
				$("#contenu").html(data).hide().fadeIn(400);
			});
	 });

	$('.cancelItem').click(function() {
		var produit=$(this).val();
		$.post("script/ajax/retirerDuPanier.php", { prod: produit }).done(function( data ) {
				$("#contenu").html(data).hide().fadeIn(400);
			});
	});

});

