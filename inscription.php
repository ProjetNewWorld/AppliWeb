<!doctype html>
<?php
include('commun.php');
?>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
	<link rel="stylesheet" href="style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="style/img/favicon.ico"/>
</head>
<body>
    <?php include("header.html") ?>
    <nav>
        <a href="connexion.php">Retour</a>
    </nav>
    <h1>Inscription</h1>
    <div class="milieu">
        <form name="fInscription" method="post" action="services.php">
            <p>
                <label for="nom">Nom :</label>
                <input id="nom" type="text" name="new_user_nom" required/>
            </p>
            <p>
                <label for="prenom">Prenom :</label>
                <input id="prenom" type="text" name="new_user_prenom" required/>
            </p>
            <p>
                <label for="email">Email :</label>
                <input id="email" type="email" name="new_user_email" required/>
            </p>
            <p>
                <label for="identifiant">Identifiant :</label>
                <input id="identifiant" type="text" name="new_user_login" required/>
            </p>
            <p>
                <label for="pass1">Mot de Passe :</label>
                <input id="pass1" type="password" name="new_user_pwd1"/>
            </p>
            <p>
                <label for="pass2">Retapez votre mot de passe :</label>
                <input id="pass2" type="password" name="new_user_pwd2" required/>
            </p>
            <p>
                <input class="bouton" type="submit" name="register" value="Enregistrer"/>
            </p>             
        </form>
    </div>
        <?php
        if(isset($_GET['errorPasswd']))
        {
            echo "<div class='error'>Les mots de passes ne correspondent pas</div>";
        }
        if(isset($_GET['errorLogin']))
        {
            echo "<div class='error'>Désolé cet identifiant est déjà utilisé</div>";
        }
        ?>
    <?php include("footer.html") ?>
</body>
</html>
