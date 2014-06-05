
function reportProduit(produit, quantite)
{
	//alert("Produit : "+produit+" Qte : "+quantite);
		$.post("script/ajax/reportProduit.php", { prod: produit, qte: quantite }).done(function( data ) {
				$("#contenu").html(data).hide().fadeIn(400);
			});
}

