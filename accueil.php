<!doctype html>
<?php 
include ("function.php");
	if(empty($_SESSION['login']))//si la varible session login est vide
	{
		header('Location: connexion.php');//redirection sur la page connexion.php
	}
?>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Accueil</title>
	<link rel="stylesheet" href="style/style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="./script/menuResponsive.js"></script>
	<link rel="icon" type="image/ico" href="style/img/favicon.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
	<?php include("header.html") ?>
	<div class="menuCache">==</div>
	<nav>
		<a class="active" href="accueil.php">Accueil</a>
		
		<?php
		if(membreHasFamille()!="false")
		{
			?>
		<a href="liste.php">Ma liste</a>
		
		<a href="courses.php">Les courses</a>
		

		<a href="gererFamille.php">Ma famille</a>
			<?php
		}
		else
		{
			?>
			<a href="creationFamille.php">Créer ma famille</a>
			<?php
		}
		?>
		
		<a href="profil.php">Mon compte</a>
		
		<a href="connexion.php">Déconnexion</a>
	</nav>
	<div class="center">
		<h1>Accueil</h1>
		<?php
		if(membreHasFamille()!="false") // si le membre a une famille
		{
			echo "<h2>Vous êtes dans la famille <span class='active'>".membreHasFamille()."</span></h2>";
		}
		else // si le membre n as pas de famille 
		{
			if(demandFromFamille()!="Pas de demande") // si une demande a été faite
			{
				?><div class="info">La famille <?php echo demandFromFamille() ?>  a effectué une demande pour vous ajouter</div>
				<form name="fAccepterOrNotFamille" method="post" action="services.php">
				<input type="submit" name="choixGoInFamille" value="Accepter"/>
				<input type="submit" name="choixGoInFamille" value="Refuser"/>
				</form>
				<?php
			}
			else // si personne ne lui a pas demandé
			{
				?><p>Pas de demande d'ajout à une famille vous concernant</p>
				<div class="info">Vous devez appartenir a une famille pour continuer</div>
				<p><a href="creationFamille.php">Créer une famille</a></p>
				<p>Attendre une invitation dans une famille.</p>
		<?php }
		}
		?>
	</div>
	<?php include("footer.html") ?>
</body>
</html>
