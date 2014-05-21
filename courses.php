<!doctype html>
<?php 
$connexionPage=false;
include ("function.php");
?>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Accueil</title>
	<link rel="stylesheet" href="style/style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="./script/addMembreToFamille.js"></script>
	<link rel="icon" type="image/ico" href="style/img/favicon.ico"/>
</head>
<body>
	<?php include("header.html") ?>
	<nav>
		<a href="accueil.php">Accueil</a>
		//
		<a href="liste.php">Ma liste</a>
		//
		<a class="active" href="courses.php">Les courses</a>
		//
		<a href="gererFamille.php">Ma famille</a>
		//
		<a href="profil.php">Mon compte</a>
	</nav>
	<div class="container">
		<h1>Mon panier</h1>
	</div>
	<?php include("footer.html") ?>
</body>
</html>
