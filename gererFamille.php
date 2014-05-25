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
	<div class="container">
		<h1>Gérer sa famille</h1>
		<?php
		if(isChef())
		{
			?>
			<h3>Ajouter un membre à ma famille : </h3> 
			<input type="text" name="addMembreToFamille" id="pseudoAjouterALaFamille" placeholder='Pseudo du membre a ajouter' required/>
			<input type="submit" id="ajouterALaFamille" value="Ajouter" />
			<div id="repAjout"></div>
			<h3>Liste des personnes de votre famille (chef) : </h3> 
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
							<button class="promouvoirMembre" value="<?php echo $maLigne["membreId"]?>">Promouvoir chef de famille</button>
							<button class="banMembre" value="<?php echo $maLigne["membreId"]?>">Supprimer de la famille</button>
						<?php } ?>
						</div>
						<?php
					}
			?>
			<form name="fSupprimerFamille" method="post" action="services.php">
			<input type="submit" name="supprimerFamille" value="Supprimer cette famille"/>
			</form>
			<?php
		}
		else
		{
			?><h4>Liste des personnes de votre famille : </h4> 
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
			<input type="submit" name="quitFamille" value="Quitter cette famille"/>
			</form>
			<?php
		}
		?>
	</div>
	<?php include("footer.html") ?>
</body>
</html>
