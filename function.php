<?php
include("commun.php");
/**
 *  @brief Fonction qui renvoie un tableau qui contient les infos sur un membre en fonction de son pseudo
 *  
 *  @param [in] $login le login du membre
 *  @param [in] $infoVoulue l'information voule (ex : membrePrenom)
 *  @return Tableau associatif qui contient les infos du membre
 *  
 *  @details Ex : getInfosMembreByLogin("carnaud","membrePrenom") == cyril
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
			$familleId=getInfosMembreByLogin('familleId');
			$requette="select familleLibelle from famille where familleId=$familleId";
			$reponse=mysql_query($requette);
			$ligne=mysql_fetch_array($reponse);
			return $ligne['familleLibelle'];
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
/**
 * @brief permet d avoir l id de la liste en cours pour le membre actuellement connecté
 * @return l'id de la liste en cours pour le membre actuellement connecté
 */
function getNoListe()
{
	$familleId=getInfosMembreByLogin('familleId');
	$requette="select * from liste where familleId=$familleId and enCours=1";
	$reponse=mysql_query($requette);
	$ligne=mysql_fetch_array($reponse);
	$listeId=$ligne['listeId'];
	return $listeId; 
}
/**
 * @brief créer le code html qui affiche la liste en cours pour le membre connecté
 * @details La fonction crée aussi des boutton - et + et supprimer qui sont géré en javascript dans le fichier gererQteAndDeleteItem.js
 * @return rien mais on affiche le code html
 */
function creerListe()
{
			$listeId=getNoListe();
			$rayonActuel="";
			$requette="select produitLib , rayonLib , listeQte , produitId from contenuliste natural join produit natural join rayon where listeId=$listeId order by rayonLib";
			$reponse=mysql_query($requette);
			while($maLigne=mysql_fetch_array($reponse))
			{
				
				if($maLigne['rayonLib']!=$rayonActuel)
				{
					echo "<h3>".$maLigne['rayonLib']."</h3>";
					$rayonActuel=$maLigne['rayonLib'];
				}
				echo $maLigne['produitLib']." | ";


				echo "<span id='qte".$maLigne['produitId']."'>".$maLigne['listeQte']."</span>";
				?>
				<input type="hidden" id="<?php echo $maLigne['produitId'] ?>" value="<?php echo $maLigne['produitId'] ?>">
				<button onclick="lessQte(<?php echo $maLigne['produitId']?>)">-</button>
				
				<button onclick="moreQte(<?php echo $maLigne['produitId']?>)">+</button>
				<button onclick="deleteItem(<?php echo $maLigne['produitId']?>)">Supprimer de la liste</button>
				</br>
				<?php
			}
}


?>
