
<?php
include("commun.php");
/**
 *  @brief Fonction qui renvoie un tableau qui contient les infos sur un membre en fonction de son pseudo
 *  
 *  @param [in] $login le login du membre
 *  @param [in] $infoVoulue l'information voule (ex : membrePrenom)
 *  @return Tableau associatif qui contient les infos du membre
 *  
 *  @details Ex : getInfosMembreByLogin("membrePrenom") == cyril
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
	echo "<div class='center'>";
	while($maLigne=mysql_fetch_array($reponse))
	{
		if($maLigne['rayonLib']!=$rayonActuel)
		{
			echo "<hr>";
			echo "<h3>".$maLigne['rayonLib']."</h3>";
			$rayonActuel=$maLigne['rayonLib'];
			
		}
		echo $maLigne['produitLib']." | ";
		echo "<span class='active' id='qte".$maLigne['produitId']."'>".$maLigne['listeQte']."</span>";
		?>
		<input type="hidden" id="<?php echo $maLigne['produitId'] ?>" value="<?php echo $maLigne['produitId'] ?>">
		<button onclick="lessQte(<?php echo $maLigne['produitId']?>)"><img src="style/img/moins.png"></button>
		
		<button onclick="moreQte(<?php echo $maLigne['produitId']?>)"><img src="style/img/plus.png"></button>
		<button onclick="deleteItem(<?php echo $maLigne['produitId']?>)">Supprimer de la liste</button>
		</br>
		<?php
	}
	echo "</div>";
}

function afficherContenuListe()
{
	$listeId=getNoListe();
	$rayonActuel="";
	$requette="select produit.produitId, produitLib , rayonLib , listeQte from contenuliste natural join produit natural join rayon where listeId=$listeId and dansCaddy=0 order by rayonLib";
	//echo $requette;
	$reponse=mysql_query($requette);
	$i=0;
	echo "<div class='center'>";
	while($maLigne=mysql_fetch_array($reponse))
	{
		if($maLigne['rayonLib']!=$rayonActuel)
		{
			echo "<hr>";
			echo "<h3>".$maLigne['rayonLib']."</h3>";
			$rayonActuel=$maLigne['rayonLib'];
		}
		echo $maLigne['produitLib']." | ";
		echo "<span id='qte".$maLigne['produitLib']."'>".$maLigne['listeQte']."</span>";
		?>
		<input type="hidden" id="<?php echo "prod".$i ?>" value="<?php echo $maLigne['produitId'] ?>" />
		<input type="checkbox" id= "<?php echo "item".$i ?>"/>
		<button id="<?php echo "reportItem".$i ?>">Reporter</button>
		</br>
		<?php
		$i++;
	}
	?>
	<input type="hidden" id="i" value=<?php echo $i ?> />
	<?php
	if($i>0)
	{
	?>
		<hr>
		<button onclick="ajoutSelection()" id="addSelectedItems">Ajouter la sélection au panier</button>
	<?php
	}
	else
	{
		echo "Votre liste est vide.";
	}
	echo "</div>";
}

function afficherContenuPanier()
{
	$listeId=getNoListe();
	$rayonActuel2="";
	$requette2="select produit.produitId, produitLib , rayonLib , listeQte from contenuliste natural join produit natural join rayon where listeId=$listeId and dansCaddy=1 order by rayonLib";
	$reponse2=mysql_query($requette2);
	$j=0;
	echo "<div class='center'>";
	while($maLigne2=mysql_fetch_array($reponse2))
	{
		if($maLigne2['rayonLib']!=$rayonActuel2)
		{
			echo "<h3>".$maLigne2['rayonLib']."</h3>";
			$rayonActuel2=$maLigne2['rayonLib'];
		}
		echo $maLigne2['produitLib']." | ";
		echo "<span id='qte".$maLigne2['produitLib']."'>".$maLigne2['listeQte']."</span>";
		?>
		<button onclick="reposerProduit(<?php echo $maLigne2['produitId'] ?>)" class="cancelItem">Reposer</button>
		</br>
		<?php
		$j++;
	}
	if($j==0)
	{
		echo "Votre panier est vide.";				
	}
	echo "</div>";
}
function afficherContenu()
{
	?>
		<h2>Ma liste</h2>
		<div id="liste">
		<?php
			afficherContenuListe();
		?>
		</div>
		<br>
		<div id="panier">
		<h2>Mon panier</h2>
		<br>
		<?php
			afficherContenuPanier();
		?>
		</div>
		<?php
}

function cancelItem($produitId)
{
	echo "<script>alert(\"hey\")</script>";
	echo "<script>alert(\"$produitId\")</script>";
/*	$listeId=getNoListe();
	$requette="update contenuliste set dansCaddy=0 where listeId=$listeId and produitId=$produitId";
	mysql_query($requette);
	afficherContenu();*/
}
?>
