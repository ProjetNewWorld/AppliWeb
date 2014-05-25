<?php 
include('../../function.php') ;
$produitId=$_POST['produit'];
$listeId=getNoListe();

$requette="delete from contenuliste where listeId=$listeId and produitId=$produitId";
$reponse=mysql_query($requette);
creerListe();
?>