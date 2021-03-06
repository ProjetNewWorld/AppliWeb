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
	$passage=0;
	while($maLigne=mysql_fetch_array($reponse))
	{
		if($maLigne['rayonLib']!=$rayonActuel)
		{
			if($passage!=0)
			{
				?>
				</table>
				</div>
				<hr>
				<?php
			}
			echo "<h3>".$maLigne['rayonLib']."</h3>";
			$rayonActuel=$maLigne['rayonLib'];
			?>
			<div class='listeCentre'>
			<table width='399'>
		<?php
		}
		$passage++;
		?>
		<tr>
			<td class='nomListe'>
				<?php
				echo $maLigne['produitLib'];
				?>
			</td>
			<td class='qteListe'>
			<?php
			 	echo " | ";
			 ?>
			</td>
			<td class='qteListe'>
			<?php
				echo "<span class='active' id='qte".$maLigne['produitId']."'>".$maLigne['listeQte']."</span>";
			?>
			</td>
			<td>
				<input type="hidden" id="<?php echo $maLigne['produitId'] ?>" value="<?php echo $maLigne['produitId'] ?>">
				<button onclick="lessQte(<?php echo $maLigne['produitId']?>)"><img src="style/img/moins.png"></button>
			</td>
			<td>
				<button onclick="moreQte(<?php echo $maLigne['produitId']?>)"><img src="style/img/plus.png"></button>
			</td>
			<td>
				<button onclick="deleteItem(<?php echo $maLigne['produitId']?>)">Supprimer de la liste</button>
			</td>
		</tr>
		<?php	
	}
	if($passage==0)
	{
			echo "<div class='info'>Votre panier est vide.</div>";
	}
	?>
	</table>
	</div>
	<?php
}

function afficherContenuListe()
{
	$listeId=getNoListe();
	$rayonActuel="";
	$requette="select produit.produitId, produitLib , rayonLib , listeQte from contenuliste natural join produit natural join rayon where listeId=$listeId and dansCaddy=0 order by rayonLib";
	//echo $requette;
	$reponse=mysql_query($requette);
	$i=0;
	while($maLigne=mysql_fetch_array($reponse))
	{
		if($maLigne['rayonLib']!=$rayonActuel)
		{
			if($i!=0)
			{
				?>
				</table>
				</div>
				<hr>
				<?php
			}
			echo "<h3>".$maLigne['rayonLib']."</h3>";
			$rayonActuel=$maLigne['rayonLib'];
			?>
			<div class='listeCentre'>
			<table width='399'>
			<?php
		}
		?>
		<tr>
			<td class='nomListe'>
			<?php
				echo $maLigne['produitLib'];
			?>
			</td>
			<td  class='qteListe'>
			<?php
				echo " | ";
			?>
			</td>
			<td  class='qteListe'>
			<?php
				echo "<span id='qte".$maLigne['produitLib']."'>".$maLigne['listeQte']."</span>";
			?>
			</td>
			<td>
				<input type="hidden" id="<?php echo "prod".$i ?>" value="<?php echo $maLigne['produitId'] ?>" />
				<div class="checkBox">
					<input type="checkbox" id="<?php echo "item".$i ?>" />
					<label for="<?php echo "item".$i ?>"></label>
				</div>
			</td>
			<td>
			<button onclick="reportProduit(<?php echo $maLigne['produitId'] ?>,<?php echo $maLigne['listeQte'] ?>)" id="<?php echo "reportItem".$i ?>">Reporter</button>
			</td>
		<?php
		$i++;
	}
	?>
	</table>
	</div>
	<?php
	?>
	<input type="hidden" id="i" value="<?php echo $i ?>" />
	<?php
	if($i>0)
	{
	?>
		<hr>
		<div class="center">
			<button class="bouton" onclick="ajoutSelection()" id="addSelectedItems">Ajouter la sélection au panier</button>
		</div>
	<?php
	}
	else
	{
		echo "<div class='info'>Votre liste est vide.</div>";
		// si il y a des produit dans le panier
		$requetteTestPanier="select count(*) nbProdCaddy from contenuliste where listeId=$listeId and dansCaddy=1";
		$resultatPanier=mysql_query($requetteTestPanier);
		$lignePanier=mysql_fetch_array($resultatPanier);
		// ou s'il y a une liste suivante
		$familleId=getInfosMembreByLogin("familleId");
		$requetteTestListeNext="select listeId from liste where familleId=$familleId and next=1";
		$resultatNext=mysql_query($requetteTestListeNext);
		$ligneNext=mysql_fetch_array($resultatNext);
		//echo "req: ".$requetteTestPanier." - rep: ".$lignePanier['nbProdCaddy'];
		if($lignePanier['nbProdCaddy']>0 || $ligneNext['listeId']!=null)
		{
			?>
			<div class="center">
				<button class="bouton" onclick="finDesCourses()" id="finDesCourses">Fin des courses</button>
			</div>
			<?php
		}
	}
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
			if($j!=0)
			{
				?>
				</table>
				</div>
				<hr>
				<?php
			}
			echo "<h3>".$maLigne2['rayonLib']."</h3>";
			$rayonActuel2=$maLigne2['rayonLib'];
			?>
			<div class='listeCentre'>
			<table width='399'>
			<?php
		}
		?>
		<tr>
			<td class='nomListe'>
			<?php
				echo $maLigne2['produitLib'];
			?>
			</td>
			<td  class='qteListe'>
			<?php
				echo " | ";
			?>
			</td>
			<td  class='qteListe'>
			<?php
				echo "<span id='qte".$maLigne2['produitLib']."'>".$maLigne2['listeQte']."</span>";
			?>
			</td>
			<td>
				<button onclick="reposerProduit(<?php echo $maLigne2['produitId'] ?>)">Reposer</button>
			</td>
		</tr>
		</br>
		<?php
		$j++;
	}
	if($j==0)
	{
		echo "<div class='info'>Votre panier est vide.</div>";				
	}
	?>
	</table>
	</div>
	<?php
	$j=0;
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

?>
