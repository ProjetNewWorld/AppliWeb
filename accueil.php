<?php 
$connexionPage=false;
include ("function.php");
?>
<!doctype html>
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
		<a class="active" href="accueil.php">Accueil</a>
		//
		<a href="liste.php">Ma liste</a>
		//
		<a href="courses.php">Les courses</a>
		//
		<a href="gererFamille.php">Ma famille</a>
		//
		<a href="profil.php">Mon compte</a>
	</nav>
	<div class="container">
		<h1>Accueil</h1>
		<?php

		if(membreHasFamille()!="false") // si le membre a une famille
		{
			echo "<h2>Vous êtes dans la famille ".membreHasFamille()."</h2>";
			if(isChef()) // si c est le chef de la famille
			{
				?>
				<h3>Ajouter un membre à la famille : </h3> 
				<input type="text" name="addMembreToFamille" id="pseudoAjouterALaFamille" size='50' placeholder='Pseudo du membre a ajouter'/>
				<input type="submit"  id="ajouterALaFamille" value="Ajouter" />
				<div id="repAjout"></div>
				<?php
			}
		}
		else // si le membre n as pas de famiille 
		{
			if(demandFromFamille()!="Pas de demande") // si une demande a été faite
			{
				?><h3>La famille <?php echo demandFromFamille() ?>  a effectué une demande pour vous ajouter</h3>
				<form name="fAccepterOrNotFamille" method="post" action="services.php">
				<input type="submit" name="choixGoInFamille" value="Accepter"/>
				<input type="submit" name="choixGoInFamille" value="Refuser"/>
				</form>
				<?php
			}
			else // si personne ne lui a demandé
			{
				?><h3>Pas de demande d'ajout à une famille vous concernant</h3>
		
				<h2>Vous devez appartenir a une famille pour continuer</h2>
				<p><a href="creationFamille.php">Créer une famille</a></p>
				<p>Attendre une invitation dans une famille.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<?php }
		}
		?>
		<form name="fDisconnect" method="post" action="services.php">
			<input type="submit" name="disconnect" value="Déconnexion"/>
		</form>
	</div>
	<?php include("footer.html") ?>
</body>
</html>
