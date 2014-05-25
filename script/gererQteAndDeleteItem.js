$(document).ready(function() {



	$('.lessQte').click(function() {
		 var produitId=$(this).val();
		 var qte=parseInt($("#qte"+produitId).text());
		if(qte>1)
		{
			var newQte=qte-1;
			$('#qte'+produitId).text(newQte);
			$.post("script/ajax/gererQte.php", { produit: produitId , qte : newQte }).done(function( data ) {
				
			});
		}
	});
	$('.moreQte').click(function() {

		var produitId=$(this).val();
		var qte=parseInt($("#qte"+produitId).text());
		var newQte=qte+1;
		$('#qte'+produitId).text(newQte);
		$.post("script/ajax/gererQte.php", { produit: produitId , qte : newQte }).done(function( data ) {

		});
	});
	// $('.deleteItem').click(function() {
	// 	// var produitId=$(this).val();
	// 	// $.post("script/ajax/deleteItem.php", { produit: produitId }).done(function( data ) {
	// 	// 		$("#listeDesCourses").html(data).hide().fadeIn(400);
	// 	// });

	// });
});
function lessQte(produitId)
{
	 var qte=parseInt($("#qte"+produitId).text());
	if(qte>1)
	{
		var newQte=qte-1;
		$('#qte'+produitId).text(newQte);
		$.post("script/ajax/gererQte.php", { produit: produitId , qte : newQte }).done(function( data ) {
				
		});
	}
}
function moreQte(produitId)
{
	var qte=parseInt($("#qte"+produitId).text());
	var newQte=qte+1;
	$('#qte'+produitId).text(newQte);
	$.post("script/ajax/gererQte.php", { produit: produitId , qte : newQte });
}
function deleteItem(produitId)
{
	 $.post("script/ajax/deleteItem.php", { produit: produitId }).done(function( data ) {
		$("#listeDesCourses").html(data).hide().fadeIn(400);
 	});
}