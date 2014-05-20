<?php
// Connexion à la base de données
include("commun.php");
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<h1>Connexion</h1>
	<!-- FORMULAIRE DE CONNEXION -->
	<form name="fConnect" method="post" action="services.php">
		Identifiant<input type="text" name="user_identifiant"/>
		Mot de Passe<input type="password" name="user_pwd"/>
		<input type="submit" name="connect" value="Connexion"/>
	</form>
	<?php
	if(isset($_GET['isNotConnected']))
	{
		echo "<div id='error'>Login ou Mot de passe incorrect</div>";
	}
	?>
	<!-- FIN FORMULAIRE -->
	<a href="inscription.php">S'inscrire</a>
	<a href="">Mot de passe oublié</a>
</body>
</html>