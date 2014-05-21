<?php
// Connexion à la base de données
include("function.php");
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
//AJOUT D UNE FAMILE //
if(isset($_POST['ajouterFamille'])) // quand on crée une famille
{
	$nomFamille=$_POST["new_famille_nom"];
	$idChef=getInfosMembreByLogin('membreId');
	$requette="insert into famille (familleId,familleLibelle) values (null,'$nomFamille')";
	mysql_query($requette);

	$reqAnnexe="select max(familleId) from famille"; 
	$reponseAnnexe=mysql_query($reqAnnexe); 
	$familleId=mysql_result($reponseAnnexe,0,"max(familleId)"); 
	
	$requette2="insert into cheffamille values ($familleId,$idChef)";
	mysql_query($requette2);
	
	$requette3="update membre set familleId=$familleId where membreId=$idChef";
	mysql_query($requette3);
	header('Location: accueil.php');
	
}
// FIN AJOUT FAMILLE //
// DEBUT CHOIX ALLER DANS FAMILLE //
if(isset($_POST['choixGoInFamille'])) // quand il repond a la demande d une famille
{
	$membreId=getInfosMembreByLogin("membreId"); // on recupere l id du membre connecté
	$requette1="select familleId from demande where membreId=$membreId";
	$reponse1=mysql_query($requette1);
	$ligne=mysql_fetch_array($reponse1); // on recupere l id de la famille qui a fait le demande
	$familleId=$ligne['familleId'];	
	if($_POST['choixGoInFamille']=="Accepter") // si il a accepté
	{
		$requette2="update membre set familleId=$familleId where membreId=$membreId"; // on lui affecte sa famille dans la bdd
		$reponse2=mysql_query($requette2);
		echo $requette2."<br>";
	}
	$requette3="delete from demande where familleId=$familleId and membreId=$membreId"; // on supprime la demande
	echo $requette3;
	mysql_query($requette3);
	
	header('Location: accueil.php');
}
// FIN CHOIX ALLER DANS FAMILLE //
// DEBUT QUITTER FAMILLE MEMBRE NON CHEF //
if(isset($_POST['quitFamille']))
{
	$membreId=getInfosMembreByLogin("membreId"); // on recupere l id du membre connecté
	$req="update membre set familleId=null where membreId=$membreId"; // on lui enleve la famille essocié
	mysql_query($req);
	header('Location: accueil.php');
}
// FIN QUITTER FAMILLE MEMBRE NON CHEF //
// DEBUT SUPPRIMER FAMILLE //
if(isset($_POST['supprimerFamille']))
{
	$familleId=getInfosMembreByLogin("familleId"); // on recupere l id de la famille du membre connecté
	
	$req="update membre set familleId=null where familleId=$familleId"; // on lui enleve la famille essocié
	mysql_query($req);
	$req2="delete from demande where familleId=$familleId"; // on supprime les demande qu aurait fait la famille
	mysql_query($req2);
	$req3="delete from cheffamille where familleId=$familleId"; // on supprime le chef de famille (on ne supprime pas le membre mais le fait qu il soit chef)
	mysql_query($req3);
	$req4="delete from famille where familleId=$familleId"; // on supprime la famille
	mysql_query($req4);
	
	header('Location: accueil.php');
}
// FIN SUPPRIMER FAMILLE //
// DEBUT REVOI INFO MAIL //
if(isset($_POST['mdpOublie']))
{
	$pseudo=$_POST['inputPseudoOubli'];
	echo $pseudo;
	
	$requette="select membreEmail from membre where membreLogin='$pseudo'";
	$reponse=mysql_query($requette);
	$ligne=mysql_fetch_array($reponse);
	$mess=$ligne['membreLogin']." , votre mot de passe est "
	if(mysql_num_rows($reponse)>0)
	{
		mail($ligne['membreEmail'],"Recupération de votre mot de passe",$mess,$headers); 
	}
}
// FIN REVOI INFO MAIL //
?>