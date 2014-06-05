<?php 
include('../../function.php') ;
$listeId=getNoListe();
$familleId=getInfosMembreByLogin("familleId");
	// la liste actuelle n'est plus en cours
	$requette="update liste set enCours=0 where listeId=$listeId";
	mysql_query($requette);
	// si aucune liste existe créer une nouvelle
	$requette2="select listeId from liste where familleId=$familleId and next=1";
	$resultat=mysql_query($requette2);
	$ligne=mysql_fetch_array($resultat);
	$idNewListe=$ligne['listeId'];

	if($idNewListe!=null)
	{
		// utilisé la liste suivante comme liste en cours
		$requette3="update liste set enCours=1, next=0 where listeId=$idNewListe";
		mysql_query($requette3);
	}
	else
	{
		// créer une nouvelle liste
		$requette4="insert into liste values(null,$familleId,1,0)";
		mysql_query($requette4);
	}

	afficherContenu();
?>