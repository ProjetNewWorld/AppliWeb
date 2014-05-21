<?php session_start();
//connection à la base de données
//hote
$host="127.0.0.1";
//nom de l'utilisateur
$user="userLDC";
//le mot de passe de l'utilisateur
$pass="passLDC";
//nom base de données
$db="listedescourses";
mysql_connect($host,$user,$pass);
//selection de la base de donnée
mysql_select_db($db);
//passage de la liste en cours à 0
$noListeEnCours=0;
if($connexionPage!=true)//si la variable page de connexion n'est pas à vrai
{
	if(empty($_SESSION['login']))//si la varibla session login est vide
	{
		header('Location: connexion.php');//redirection sur la page connexion.php
	}
}
$connexionPage=false;
?>
