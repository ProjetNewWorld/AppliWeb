<?php
$connexionPage=true;
include("commun.php");?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
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
        <h1>Inscription</h1>
        <form name="fInscription" method="post" action="services.php">
            Nom<input type="text" name="new_user_nom" />
            Prenom<input type="text" name="new_user_prenom"/>
            Email<input type="email" name="new_user_email"/>
            Identifiant<input type="text" name="new_user_login"/>
            Mot de Passe<input type="password" name="new_user_pwd1"/>
            Retapez votre mot de passe<input type="password" name="new_user_pwd2"/>
            <input type="submit" name="inscription" value="Enregistrer"/>
        </form>
            <?php
        if(isset($_GET['errorPasswd']))
        {
            echo "<div id='error'>Les mots de passes ne correspondent pas</div>";
        }
        ?>
	</div>
</body>
</html>
