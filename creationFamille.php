<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Créer une famille</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php include("header.html") ?>
	<nav>
		Accueil // BLABLA // BLABLA
	</nav>
	<div class="container">
        <h1>Création d'une famille</h1>
        <form name="ajoutFamille" method="POST" action="services.php">
            Nom de la famille : <input type="text" name="new_famille_nom" />
            <input type="submit"  name="ajouterFamille" />
        </form>

		
		
	</div>
</body>
</html>