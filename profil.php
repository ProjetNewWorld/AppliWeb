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
    <?php
    if(membreHasFamille()!="false")
    {
      ?>
    <a href="liste.php">Ma liste</a>
    //
    <a href="courses.php">Les courses</a>
    //

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
    //
    <a class="active" href="profil.php">Mon compte</a>
    //
    <a href="connexion.php">Déconnexion</a>
  </nav>
	<div class="container">
		<h1>Gérer mon profil</h1>
		
	<?php
		$login=$_SESSION['login'];
		$nom=getInfosMembreByLogin('membreNom');
		$prenom=getInfosMembreByLogin('membrePrenom');
		$mail=getInfosMembreByLogin('membreEmail');
		$creation=getInfosMembreByLogin('dateCreation');
		$creation=date("d / m / Y", strtotime($creation));
	?>
	<?php
	if(isset($_GET['edit']) && $_GET['edit']=="true")
	{
	?>

	<form id="formEditProfil" name="fEditProfil" method="post" action="services.php">
		<p><label for="nom">Nom </label><input id="nom" type="text" name="user_name" value="<?php echo $nom ?>" required/></p>
		<p><label for="prenom">Prenom </label><input id="prenom" type="text" name="user_firstname" value="<?php echo $prenom ?>"required/></p>
		<p><label for="mail">E-mail </label><input id="mail" type="text" name="user_mail" value="<?php echo $mail ?>" size=30 required/></p>
		<p><label for="pwd0">Ancien mot de passe </label><input id="pwd0" type="password" name="old_user_pwd" required/></p>
		<p><label for="pwd1">Nouveau mot de passe </label><input id="pwd1" type="password" name="new_user_pwd1" required/></p>
		<p><label for="pwd2">Retapez votre mot de passe </label><input id="pwd2" type="password" name="new_user_pwd2" required/></p>
		<input type="submit" name="applyEdit" value="Appliquer les modifications"/>
    <input type="reset" name="cancelEdit" value="Annuler" onclick="self.location.href='profil.php';"/>
	</form>	
	<?php
		if(isset($_GET['errorPasswd']) && $_GET['errorPasswd']=="true")
		{
			echo "<div class='error'>Les nouveaux mots de passes ne correspondent pas</div>";
		}
		if(isset($_GET['errorOldPasswd']) && $_GET['errorOldPasswd']=="true")
		{
			echo "<div class='error'>Ancien mot de passe incorrect</div>";
		}
	}
	else
	{ ?>
	<form id="formProfil" name="fProfil" method="post" action="profil.php?edit=true">
		<p>Identifiant : <?php echo $login ?></p>
		<p>Nom : <?php echo $nom ?></p>
		<p>Prénom : <?php echo $prenom ?></p>
		<p>E-mail : <?php echo $mail ?></p>
		<p>Date d'inscription : <?php echo $creation ?></p>
		<input type="submit" name="edit" value="Editer"/>
	</form>	
	<?php
	}
	?>	
  	</div>
  <?php include("footer.html") ?>
</body>
</html>