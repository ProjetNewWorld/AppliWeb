<?php
$connexionPage=true;
// Connexion à la base de données
include("commun.php");
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="stylesheet" href="style/styleConnexion.css">
	<link rel="icon" type="image/ico" href="style/img/favicon.ico"/>
</head>
<body class="bodyConnexion">
	<?php include("header.html") ?>
	<div id="blocConnexion">
		<form id="formConnexion" name="fConnect" method="post" action="services.php">
			<p><label for="identifiant">Identifiant :</label><input id="identifiant" type="text" name="user_identifiant" required/></p>
			<p><label for="passe">Mot de Passe :</label><input id="passe" type="password" name="user_pwd" required /></p>
			<input type="submit" name="connect" value="Connexion"/>
			<a href="mdpOublie.php">Mot de passe oublié</a>
			<a href="inscription.php">S'inscrire</a>
		</form><!-- Fin du formulaire de connexion -->
	</div><!-- Fin de la DIV blocConnexion -->
	<?php
	if(isset($_GET['isNotConnected']))
	{
		echo "<div class='error'>Login ou Mot de passe incorrect</div>";
	}
	?>
	<!-- FIN FORMULAIRE -->
	<?php include("footer.html") ?>
</body>
</html>
