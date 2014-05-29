<?php 
include('../../function.php') ;
$produitId=$_POST['prod'];
$listeId=getNoListe();

	$requette="update contenuliste set dansCaddy=0 where listeId=$listeId and produitId=$produitId";
	mysql_query($requette);

	afficherContenu();
?>