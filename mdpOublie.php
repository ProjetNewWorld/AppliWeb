<?php include('function.php'); ?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8"/>
	<title>Mot de passe oublié</title>
	<link rel="stylesheet" href="style/style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script type="text/javascript" src="./script/renvoitMotDePasse.js"></script>
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
		<h1>Récupération du mot de passe</h1>
				Donnez votre pseudo : <input type="text" id="inputPseudoOubli" size="50" placeholder="Votre pseudo ici"/>
				<input type="submit" id="mdpOublie" value="Renvoyer mon mot de passe"/>
				<div id="infoEnvoi" ></div>
    </div>
</body>
</html>