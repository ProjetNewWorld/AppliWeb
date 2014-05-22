<!doctype html>
<?php 
$connexionPage=false;
include ("function.php");
?>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Créer une famille</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<?php include("header.html") ?>
	<nav>
		<a href="accueil.php">Accueil</a>
		//
		<a class="active" href="creationFamille.php">Créer ma famille</a>
		//
		<a href="profil.php">Mon compte</a>
	</nav>
	<div class="container">
		<h1>Création d'une famille</h1>
		<form name="ajoutFamille" method="POST" action="services.php">
			<label for="famille">Nom de la famille :</label><input id="famille" type="text" name="new_famille_nom" required/>
			<input type="submit" name="ajouterFamille" />
		</form>
	</div>
	<?php include("footer.html") ?>
</body>
</html>