<?php
// Connexion à la base de données
include("commun.php");

// DECONNEXION //
if(isset($_POST['disconnect']))
{
	session_unset();
	session_destroy();
	header('Location: accueil.php');
}
// FIN DECONNEXION //

// FORMULAIRE DE CONNEXION //
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
if(isset($_POST['connect']))
{
	$login=$_POST['user_identifiant'];
	$password=$_POST['user_pwd'];
	$req="select membreNom,membrePrenom,membreLogin,membreMdp from membre where membreLogin='$login' and membreMdp='$password'";
	//echo $req;
	$result=mysql_query($req);
	//le tableau
	$monTableau = array();
	echo mysql_num_rows($result);
	if(mysql_num_rows($result))//s'il y a un resultat
	{
		$ligne=mysql_fetch_assoc($result);
		$monTableau['login'][]=$ligne;
		// connexion à la variable session
		$_SESSION['login'] = $login;
		header('Location: accueil.php');
	}
	else
	{
		header('Location: connexion.php?isNotConnected=true');
	}
	echo json_encode($monTableau);
	
}
else
{
	echo "ERREUR";
}
// FIN FORMULAIRE DE CONNEXION //

// FORMULAIRE D'INSCRIPTION //
if(isset($_POST['inscription']))
{
	$login=$_POST['new_user_login'];
	$password=$_POST['new_user_pwd1'];
	$password2=$_POST['new_user_pwd2'];
	$mail=$_POST['new_user_email'];
	$prenom=$_POST['new_user_prenom'];
	$nom=$_POST['new_user_nom'];
	$date=date("20y-m-d");
	echo $password;
	if($password==$password2)
	{
		$req="insert into membre (membreNom,membrePrenom,membreLogin,membreMdp,membreEmail,dateCreation) values('$nom','$prenom','$login','$password','$mail','$date')";
		//echo '<br>'.$req;
		mysql_query($req);
		header('Location: connexion.php');
		
	}
	else
	{
		header('Location: inscription.php?errorPasswd=true');
	}
}
// FIN FORMULAIRE D'INSCRIPTION //
?>