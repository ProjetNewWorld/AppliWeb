<?php include('function.php'); ?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion de famille</title>
	<link rel="stylesheet" href="style/style.css">
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
		<h1>Gérer sa famille</h1>
		
		<?php
		if(isChef())
		{
			?><h4>Liste des personnes de votre famille (chef) : </h4> 
		
			<form name="fSupprimerFamille" method="post" action="services.php">
            <input type="submit" name="supprimerFamille" value="Supprimer cette famille"/>
			</form>
			<?php
		}
		else
		{
			?><h4>Liste des personnes de votre famille : </h4> 
			
			
			<form name="fQuitFamille" method="post" action="services.php">
            <input type="submit" name="quitFamille" value="Quitter cette famille"/>
			</form>
			<?php
		}
		?>
    </div>
</body>
</html>