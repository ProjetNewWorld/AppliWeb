<?php 
include('../../function.php') ;
$produitId=$_POST['prod'];
$listeId=getNoListe();

foreach ($produitId as $produit) {

	$requette="update contenuliste set dansCaddy=1 where listeId=$listeId and produitId=$produit";
	mysql_query($requette);
}
	afficherContenu();
?>