<?php include("commun.php");?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <link rel="stylesheet" href="style/style.css">
</head>
<body>
	<h1>Vous devez appartenir a une famille pour continuer</h1>
	<a href="creationFamille.php">Créer une famille</a>
	Attendre une invitation dans une famille.

	<form name="fDisconnect" method="post" action="services.php">
		<input type="submit" name="disconnect" value="Déconnexion"/>
	</form>
	
</body>
</html>