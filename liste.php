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
	<script type="text/javascript" src="./script/gererListe.js"></script>
	<script type="text/javascript" src="./script/gererQteAndDeleteItem.js"></script>
	<script type="text/javascript" src="./script/ajoutProduit.js"></script>


	<link rel="icon" type="image/ico" href="style/img/favicon.ico"/>
</head>
<body>
	<?php include("header.html") ?>
	<nav>
		<a href="accueil.php">Accueil</a>
		//
		<a class="active" href="liste.php">Ma liste</a>
		//
		<a href="courses.php">Les courses</a>
		//
		<a href="gererFamille.php">Ma famille</a>
		//
		<a href="profil.php">Mon compte</a>
		//
		<a href="connexion.php">Déconnexion</a>
	</nav>
	<div class="container">
		<h1>Ma liste de courses</h1>
		<h3>Ajouter un produit a la liste </h3>
<<<<<<< HEAD
		<form id="formAjoutListe" name="fAjoutListe" method="post" action="services.php">
		<p>Choisissez le rayon : <select name="choixRayon" id="choixRayon"></p>
=======
		Choisissez le rayon : <select name="choixRayon" id="choixRayon">
>>>>>>> FETCH_HEAD
		<?php
			$IsPremierRayon=true;
			$requette="select distinct rayonId , rayonLib from rayon natural join produit order by rayonLib";
			$reponse=mysql_query($requette);
			while($maLigne=mysql_fetch_array($reponse))
			{
				if($IsPremierRayon) { $firstRayon=$maLigne['rayonId']; $IsPremierRayon=false;}
				?><option value="<?php echo $maLigne['rayonId'] ?>"> <?php echo $maLigne['rayonLib'] ?></option>
				<?php
			}
		?>
		</select>
		<p>Choisissez le Produit : <select name="choixProduit" id="choixProduit"></p>
		<?php
			$requette2="select * from produit where rayonId=$firstRayon order by  produitLib";
			$reponse2=mysql_query($requette2);
			while($maLigne2=mysql_fetch_array($reponse2))
			{
				?><option value="<?php echo $maLigne2['produitId'] ?>"> <?php echo $maLigne2['produitLib'] ?></option>
				<?php
			}
		?>
		
		</select>
<<<<<<< HEAD
		<p>Quantité : <input id="qte" type="text" value="1" name="qteAjouterListe" size="4"></p>
		<p><button name="buttonAjouterListe" class="">Ajouter ce produit a la liste</button></p>
		</form>
=======
		Quantité : <input type="text" value="1" id="qteAjouterListe" size="4">
			<button id="buttonAjouterListe" class="">Ajouter ce produit a la liste</button>
>>>>>>> FETCH_HEAD
		
		
	</br></br>	
	
		<h3>Votre liste de courses : </h3></br>
		<div id="listeDesCourses">
		<?php
			creerListe();
		
		?>

	</div>
		
	</div>
	<?php include("footer.html") ?>
</body>
</html>