<?php 
include('../../function.php') ;
$produitId=$_POST['prod'];
$qte=$_POST['qtes'];
$listeId=getNoListe();


	$requette="insert into contenuliste values($listeId,$produitId,$qte,0)";
	mysql_query($requette);
	
	creerListe();
?>