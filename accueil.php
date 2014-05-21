<?php
$connexionPage=false;
include("commun.php");?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <link rel="stylesheet" href="style/style.css">
  <link rel="icon" type="image/ico" href="style/img/favicon.ico"/>
</head>
<body>
    	<header>
		<div id="logo"></div>
		<div id="titreHeader">
			<div id="titreHeader-l1">Liste de courses</div>
			<div id="titreHeader-l2">Projet New World</div>
			<div id="titreHeader-l3">Les courses pour tous !</div>
		</div>
	</header>
	<nav>
		Accueil // BLABLA // BLABLA
	</nav>
	<div class="container">
		<h1>Accueil</h1>
		<h2>Vous devez appartenir a une famille pour continuer</h2>
		<p><a href="creationFamille.php">Créer une famille</a></p>
		<p>Attendre une invitation dans une famille.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <form name="fDisconnect" method="post" action="services.php">
            <input type="submit" name="disconnect" value="Déconnexion"/>
        </form>
    </div>
</body>
</html>
