<?php
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
	<header>
		<div id="logo"></div>
		<div id="titreHeader">
			<div id="titreHeader-l1">Liste de courses</div>
			<div id="titreHeader-l2">Projet New World</div>
			<div id="titreHeader-l3">Les courses pour tous !</div>
		</div>
	</header>
	<div id="blocConnexion">
        <form id="formConnexion" name="fConnect" method="post" action="services.php">
            <p><label for="id">Identifiant :</label><input type="text" name="user_identifiant"/></p>
            <p><label for="id">Mot de Passe :</label><input type="password" name="user_pwd"/></p>
            <a href="">Mot de passe oublié</a>
            <a href="inscription.php">S'inscrire</a>
            <input type="submit" name="connect" value="Connexion"/>
        </form><!-- Fin du formulaire de connexion -->
    </div><!-- Fin de la DIV blocConnexion -->
	<?php
	if(isset($_GET['isNotConnected']))
	{
		echo "<div id='error'>Login ou Mot de passe incorrect</div>";
	}
	?>
	<!-- FIN FORMULAIRE -->
</body>
</html>