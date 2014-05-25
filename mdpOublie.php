<!doctype html>
<?php
include('function.php');
 ?>
<html lang="fr">
<head>
	<meta charset="utf-8"/>
	<title>Mot de passe oublié</title>
	<link rel="stylesheet" href="style/style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="./script/renvoitMotDePasse.js"></script>
</head>
<body>
	<?php include("header.html") ?>
	<nav>
        <a href="connexion.php">Retour</a>
    </nav>
	<h1>Récupération du mot de passe</h1>
	<div class="milieu">
		<form name="fInscription" method="post" action="">
			<p><label for="inputPseudoOubli">Donnez votre pseudo :</label><input type="text" id="inputPseudoOubli" placeholder="Votre pseudo" required/></p>
			<p><input class="bouton" type="submit" id="mdpOublie" value="Renvoyer mon mot de passe"/></p>
		</form>
		<div id="infoEnvoi"></div>
	</div>
	<?php include("footer.html") ?>
</body>
</html>
