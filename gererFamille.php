<?php
include('function.php');
	if(empty($_SESSION['login']))//si la varible session login est vide
	{
		header('Location: connexion.php');//redirection sur la page connexion.php
	}
	?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion de famille</title>
	<link rel="stylesheet" href="style/style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="./script/gererFamille.js"></script>
	<script type="text/javascript" src="./script/addMembreToFamille.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/ico" href="style/img/favicon.ico"/>
</head>
<body>
    <?php include("header.html") ?>
	<nav>
		<a href="accueil.php">Accueil</a>
		//
		<a href="liste.php">Ma liste</a>
		//
		<a href="courses.php">Les courses</a>
		//
		<a class="active" href="gererFamille.php">Ma famille</a>
		//
		<a href="profil.php">Mon compte</a>
		//
		<a href="connexion.php">Déconnexion</a>
	</nav>
		<h1>Gérer sa famille</h1>
		<?php
		if(isChef())
		{
			?>
		<h2>Ajouter un membre à ma famille : </h2>
		<br>
		<div class="center">
			<p><input type="text" name="addMembreToFamille" id="pseudoAjouterALaFamille" placeholder='Pseudo du membre a ajouter' required/></p>
			<p><input class="bouton" type="submit" id="ajouterALaFamille" value="Ajouter" /></p>
		</div>
		<div class="center" id="repAjout"></div>
		<br>
		<h2>Liste des personnes de votre famille (chef) : </h2>
		<br>
		<div class="center">
		<?php
		$membreFamilleId=getInfosMembreByLogin("familleId"); // on recupere l id de la famille du membre
		$requette="select * from membre where familleId=$membreFamilleId";
		$reponse=mysql_query($requette);
		while($maLigne=mysql_fetch_array($reponse)) // pour tous les membres de la famille
		{
			?>
			<div id="infoMemebreFamille"> 
			<input id="getFamilleId" type="hidden" value="<?php echo $maLigne["familleId"]?>">
			<?php
			$requetteAnnexe="select * from cheffamille where familleId=$membreFamilleId"; // on recupere l id du chef de famille
			$reponseAnnexe=mysql_query($requetteAnnexe);
			$ligneAnnexe=mysql_fetch_array($reponseAnnexe);
			if($ligneAnnexe['membreId']==$maLigne["membreId"]) // si c est le chef de famille
			{
				echo "Chef de famille : ";
				echo $maLigne["membreNom"]." ".$maLigne["membrePrenom"]." , pseudo : ".$maLigne["membreLogin"] ; // on affiche ses infos
			}
			else
			{
				echo $maLigne["membreNom"]." ".$maLigne["membrePrenom"]." , pseudo : ".$maLigne["membreLogin"] ; // sinon on affiche les infos et la possibilité de ban ou de promouvoir
				?>
				<button class="promouvoirMembre" value="<?php echo $maLigne["membreId"]?>"><img src="style/img/chef.png" alt="devenir chef"></button>
				<button class="banMembre" value="<?php echo $maLigne["membreId"]?>"><img src="style/img/supprimer.png" alt="supprimer"></button>
			<?php } ?>
			</div>
			<?php
			}
			?>
			<form name="fSupprimerFamille" method="post" action="services.php">
				<br>
				<input class="bouton" type="submit" name="supprimerFamille" value="Supprimer cette famille"/>
			</form>
			<?php
		}
		else
		{
			?><h2>Liste des personnes de votre famille : </h2>
			<br>
			<div class="center">
			<?php
				$membreFamilleId=getInfosMembreByLogin("familleId"); // on recupere l id de la famille du membre
				$requette="select * from membre where familleId=$membreFamilleId";
				$reponse=mysql_query($requette);
				while($maLigne=mysql_fetch_array($reponse)) // pour tous les membres de la famille
				{
					?>
					<div id="infoMemebreFamille"> <?php
						$requetteAnnexe="select * from cheffamille where familleId=$membreFamilleId"; // on recupere l id du chef de famille
						$reponseAnnexe=mysql_query($requetteAnnexe);
						$ligneAnnexe=mysql_fetch_array($reponseAnnexe);
						if($ligneAnnexe['membreId']==$maLigne["membreId"]) // si c est le chef de famille
						{
							echo "Chef de famille : "; // on l affiche
						}
						echo $maLigne["membreNom"]." ".$maLigne["membrePrenom"]." , pseudo : ".$maLigne["membreLogin"] ; // on affiche les infos du membre
						?>
					</div>
					<?php
				}
				?>
				<form name="fQuitFamille" method="post" action="services.php">
					<br>
					<input class="bouton" type="submit" name="quitFamille" value="Quitter cette famille"/>
				</form>
			</div>
			<?php
		}
		?>
	</div>
	<?php include("footer.html") ?>
</body>
</html>
