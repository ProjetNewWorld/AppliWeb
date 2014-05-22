<?php
$connexionPage=false;
include('function.php'); ?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion de famille</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php include("header.html") ?>
	<nav>
		<a href="accueil.php">Accueil</a>
		//
		<a href="liste.php">Ma liste</a>
		//
		<a href="courses.php">Les courses</a>
		//
		<a class="active" href="gererFamille.php">Ma famille</a>
		//
		<a href="profil.php">Mon compte</a>
	</nav>
	<div class="container">
		<h1>Gérer sa famille</h1>
		<?php
		if(isChef())
		{
			?><h4>Liste des personnes de votre famille (chef) : </h4> 
			<form name="fSupprimerFamille" method="post" action="services.php">
			<input type="submit" name="supprimerFamille" value="Supprimer cette famille"/>
			</form>
			<?php
		}
		else
		{
			?><h4>Liste des personnes de votre famille : </h4> 
			<form name="fQuitFamille" method="post" action="services.php">
			<input type="submit" name="quitFamille" value="Quitter cette famille"/>
			</form>
			<?php
		}
		?>
	</div>
	<?php include("footer.html") ?>
</body>
</html>
