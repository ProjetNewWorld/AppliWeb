<!doctype html>
<?php 
include ("function.php");
	if(empty($_SESSION['login']))//si la varible session login est vide
	{
		header('Location: connexion.php');//redirection sur la page connexion.php
	}
?>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Accueil</title>
	<link rel="stylesheet" href="style/style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="./script/ajouterSelectionAuPanier.js"></script>

	<link rel="icon" type="image/ico" href="style/img/favicon.ico"/>
</head>
<body>
	<?php include("header.html") ?>
	<nav>
		<a href="accueil.php">Accueil</a>
		//
		<a href="liste.php">Ma liste</a>
		//
		<a class="active" href="courses.php">Les courses</a>
		//
		<a href="gererFamille.php">Ma famille</a>
		//
		<a href="profil.php">Mon compte</a>
		//
		<a href="connexion.php">Déconnexion</a>
	</nav>
	<div class="container">
		<h1>Ma liste</h1>
		<?php
			$listeId=getNoListe();
			$rayonActuel="";
			$requette="select produitLib , rayonLib , listeQte from contenuliste natural join produit natural join rayon where listeId=$listeId and dansCaddy=0 order by rayonLib";
			//echo $requette;
			$reponse=mysql_query($requette);
			$i=0;
			while($maLigne=mysql_fetch_array($reponse))
			{
				if($maLigne['rayonLib']!=$rayonActuel)
				{
					echo "<h3>".$maLigne['rayonLib']."</h3>";
					$rayonActuel=$maLigne['rayonLib'];
				}
				echo $maLigne['produitLib']." | ";
				echo "<span id='qte".$maLigne['produitLib']."'>".$maLigne['listeQte']."</span>";
				?>

				<input type="hidden" id="test" value="BEH"/>

				<input type="checkbox" id= "<?php echo "item".$i ?>"/>
				<button id="<?php echo "reportItem".$i ?>">Reporter</button>
				</br>
				<?php
				$i++;
			}
			
		?>
		<button id="addSelectedItems">Ajouter la sélection au panier</button>

		<h1>Mon panier</h1>
		<?php
		$rayonActuel2="";
		$requette2="select produitLib , rayonLib , listeQte from contenuliste natural join produit natural join rayon where listeId=$listeId and dansCaddy=1 order by rayonLib";
		$reponse2=mysql_query($requette2);
					$j=0;
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
				<button id="<?php echo "reportItem".$j ?>">Reposer</button>
				</br>
				<?php
				$j++;
			}
		?>
	</div>
	<?php include("footer.html") ?>
</body>
</html>
