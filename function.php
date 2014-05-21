<?php
include("commun.php");
/**
 *  @brief Fonction qui renvoie un tableau qui contient les infos sur un membre en fonction de son pseudo
 *  
 *  @param [in] $login le login du membre
 *  @param [in] $infoVoulue l'information voule (ex : membrePrenom)
 *  @return Tableau associatif qui contient les infos du membre
 *  
 *  @details Ex : getInfosMembreByLogin("carnaud","membrePrenom"] == cyril
 */
function getInfosMembreByLogin($infoVoulue) 
{
	$login=$_SESSION["login"];
	$req="select * from membre where membreLogin='$login'";
	$rep=mysql_query($req);
	$monTableauInfoSurLeMembre=mysql_fetch_array($rep);
	return $monTableauInfoSurLeMembre["$infoVoulue"];
	
}
/**
 *  @brief Defini si un membre a une famille associé ou non
 *  
 *  @return false si le membre n'a pas de famille associée , sinon on renvoie le nom de la famille
 *  
 */
function membreHasFamille()
{
	if(getInfosMembreByLogin('familleId') !="")
	{
			return getInfosMembreByLogin('membreNom');
	}
	else
	{
		return "false";
	}
}
/**
 *  @brief Defini si un membre est chef de famille
 *  
 *  @return 1 s'il est chef de famille , 0 sinon
 *  
 */
function isChef()
{
	$membreId=getInfosMembreByLogin('membreId');
	$req="select * from cheffamille where membreId=$membreId";
	$rep=mysql_query($req);
	return mysql_num_rows($rep);
}
/**
 *  @brief Defini si une demande a été faite a un membre
 *  
 *  @return "Pas de demande" si il n y en a pas , sinon on renvoi le nom de la famille
 *  
 */
function demandFromFamille()
{
	$membreId=getInfosMembreByLogin('membreId');
	$req="select familleLibelle from demande natural join famille where membreId=$membreId";
	$rep=mysql_query($req);
	$ligne=mysql_fetch_array($rep);
	if(mysql_num_rows($rep)==0)
	{
		return "Pas de demande";
	}
	else
	{
		return $ligne['familleLibelle'];
	}
	
	
}

?>