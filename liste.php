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
	<script type="text/javascript" src="./script/gererListe.js"></script>
				<script>
	
				$(document).ready(function() {
				$('#lessQte').click(function() {
						//var produit="qte"+$(this).val();
						alert($(this).attr("value"));
					});
				});
			</script>

	<link rel="icon" type="image/ico" href="style/img/favicon.ico"/>
</head>
<body>
	<?php include("header.html") ?>
	<nav>
		<a href="accueil.php">Accueil</a>
		//
		<a class="active" href="liste.php">Ma liste</a>
		//
		<a href="courses.php">Les courses</a>
		//
		<a href="gererFamille.php">Ma famille</a>
		//
		<a href="profil.php">Mon compte</a>
		//
		<a href="connexion.php">Déconnexion</a>
	</nav>
	<div class="container">
		<h1>Ma liste de courses</h1>
		<h3>Ajouter un produit a la liste </h3>
		<form id="formAjoutListe" name="fAjoutListe" method="post" action="services.php">

		Choisissez le rayon : <select name="choixRayon" id="choixRayon">
		<?php
			$IsPremierRayon=true;
			$requette="select distinct rayonId , rayonLib from rayon natural join produit order by rayonLib";
			$reponse=mysql_query($requette);
			while($maLigne=mysql_fetch_array($reponse))
			{
				if($IsPremierRayon) { $firstRayon=$maLigne['rayonId']; $IsPremierRayon=false;}
				?><option value="<?php echo $maLigne['rayonId'] ?>"> <?php echo $maLigne['rayonLib'] ?></option>
				<?php
			}
		?>
		</select>
		Choisissez le Produit : <select name="choixProduit" id="choixProduit">
		<?php
			$requette2="select * from produit where rayonId=$firstRayon order by  produitLib";
			$reponse2=mysql_query($requette2);
			while($maLigne2=mysql_fetch_array($reponse2))
			{
				?><option value="<?php echo $maLigne2['produitId'] ?>"> <?php echo $maLigne2['produitLib'] ?></option>
				<?php
			}
		?>
		
		</select>
		Quantité : <input type="text" value="1" name="qteAjouterListe" size="4">
			<button name="buttonAjouterListe" class="">Ajouter ce produit a la liste</button>
		</form>
		
		
	</br></br>	
	<div id="listeDesCourses">
		<h3>Votre liste de courses : </h3></br>
		<form id="formModifListe" name="fAjoutListe" method="post" action="services.php">
		<?php
			$listeId=getNoListe();
			$rayonActuel="";
			$requette="select produitLib , rayonLib , listeQte from contenuliste natural join produit natural join rayon where listeId=$listeId order by rayonLib";
			echo $requette;
			$reponse=mysql_query($requette);
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
				<span id="lessQte" value="test">-</span>
				<span id="moreQte">+</span>
				<button id="modifierItemListe">Enregistrer</button>
				<button id="supprimerItemListe">Supprimer de la liste</button>
				</br>
				<?php
			}
		
		?>
		</form>

	</div>
		
	</div>
	<?php include("footer.html") ?>
</body>
</html>