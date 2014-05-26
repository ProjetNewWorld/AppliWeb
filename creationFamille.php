<!doctype html>
<?php 
include ("function.php");
	if(empty($_SESSION['login']))//si la varible session login est vide
	{
		header('Location: connexion.php');//redirection sur la page connexion.php
	}
if(membreHasFamille()!="false")// si le membre a une famille on le redirige
{
		header('Location: accueil.php');

} 

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
		//
		<a href="connexion.php">Déconnexion</a>
	</nav>
	<h1>Création d'une famille</h1>
	<div class="milieu">
		<form name="ajoutFamille" method="POST" action="services.php">
			<p>
				<label for="famille">Nom de la famille :</p>
				<input id="famille" type="text" placeholder="Nom de votre famille..." name="new_famille_nom" required/>
			</p>
			<p><input class="bouton" type="submit" name="ajouterFamille" /></p>
		</form>
	</div>
	<?php include("footer.html") ?>
</body>
</html>