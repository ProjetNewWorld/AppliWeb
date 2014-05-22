<!doctype html>
<?php
$connexionPage=true;
include('commun.php');
?>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php include("header.html") ?>
	<div class="container">
        <h1>Inscription</h1>
        <form name="fInscription" method="post" action="services.php">
            <label for="nom">Nom</label><input id="nom" type="text" name="new_user_nom" required/>
            <label for="prenom">Prenom</label><input id="prenom" type="text" name="new_user_prenom" required/>
            <label for="email">Email</label><input id="email" type="email" name="new_user_email" required/>
            <label for="identifiant">Identifiant</label><input id="identifiant" type="text" name="new_user_login" required/>
            <label for="pass1">Mot de Passe</label><input id="pass1" type="password" name="new_user_pwd1"/>
            <label for="pass2">Retapez votre mot de passe</label><input id="pass2" type="password" name="new_user_pwd2" required/>
            <input type="submit" name="inscription" value="Enregistrer"/>
        </form>
        <?php
        if(isset($_GET['errorPasswd']))
        {
            echo "<div id='error'>Les mots de passes ne correspondent pas</div>";
        }
        ?>
	</div>
    <?php include("footer.html") ?>
</body>
</html>
