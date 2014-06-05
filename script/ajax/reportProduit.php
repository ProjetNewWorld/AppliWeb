<?php 
include('../../function.php') ;
$produitId=$_POST['prod'];
$produitQte=$_POST['qte'];
$familleId=getInfosMembreByLogin("familleId");
$listeId=getNoListe();

	$requette1="select listeId from liste where familleId=$familleId and next=1";
	//echo "<script>alert(\"select listeId from liste where familleId=$familleId and next=1;\")</script>";
	$resultat=mysql_query($requette1);
	$ligne=mysql_fetch_array($resultat);
	$idNewListe=$ligne['listeId'];
	//echo "<script>alert(\"$idNewListe\")</script>";
	// si la liste suivante existe,
	if($ligne['listeId']!=null)
	{
		// ajout du produit à la nouvelle liste
		$requette3="insert into contenuliste values($idNewListe,$produitId,$produitQte,0)";

echo "<script>alert(\"insert into contenuliste values($idNewListe,$produitId,$produitQte,0)\")</script>";

		mysql_query($requette3);
		// retirer le produit de la liste en cours

		$requette5="delete from contenuliste where produitId=$produitId and listeQte=$produitQte and dansCaddy=0 and listeId=$listeId";
		mysql_query($requette5);

	}
	// si la liste suivante n'existe pas,
	else
	{
		// créer une nouvelle liste

		$requette4="insert into liste values(null,$familleId,0,1)";
		mysql_query($requette4);

		// réccupération de l'id de la nouvelle liste

		$requette2="select listeId from liste where familleId=$familleId and next=1";
		$resultat=mysql_query($requette2);
		$ligne=mysql_fetch_array($resultat);
		$idNewListe=$ligne['listeId'];

		// ajout du produit à la nouvelle liste

		$requette3="insert into contenuliste values($idNewListe,$produitId,$produitQte,0)";
		mysql_query($requette3);
		//echo "<script>alert(\"insert into contenuliste values($idNewListe,$produitId,$produitQte,0)\")</script>";

		// retirer le produit de la liste en cours

		$requette5="delete from contenuliste where produitId=$produitId and listeQte=$produitQte and dansCaddy=0 and listeId=$listeId";
		mysql_query($requette5);
	}
	afficherContenu();
?>