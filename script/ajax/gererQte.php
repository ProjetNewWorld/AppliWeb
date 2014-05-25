<?php 
include('../../function.php') ;
$produitId=$_POST['produit'];
$qte=$_POST['qte'];
$listeId=getNoListe();

$requette="update contenuliste set listeQte=$qte where listeId=$listeId and produitId=$produitId";
$reponse=mysql_query($requette);

?>