<?php session_start();
mysql_connect('127.0.0.1','userLDC','passLDC');

mysql_select_db('listedescourses'); 
$noListeEnCours=0;


if($connexionPage!=true)
{
	if(empty($_SESSION['login']))
	{
		header('Location: connexion.php');
	}
}
$connexionPage=false;
?>
