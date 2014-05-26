<?php 
include('../../function.php') ;
$produitId=$_POST['prod'];
$listeId=getNoListe();

echo "<script>alert(\"JE SUIS LA !\")</script>";

	$requette="update contenuliste set dansCaddy=1 where listeId=$listeId and produitId=$produitId";
	echo "<script>alert(\"$requette\")</script>";
	mysql_query($requette);
	
	creerListe();
?>