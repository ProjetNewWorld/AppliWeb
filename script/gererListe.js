$(document).ready(function() {
	$('#choixRayon').change(function() {
		
		var rayonId=$('#choixRayon').val();
		$.post("script/ajax/genererListeProduit.php", { rayon: rayonId }).done(function( data ) {

			$('#choixProduit').html(data);
		});
		
	});
});
