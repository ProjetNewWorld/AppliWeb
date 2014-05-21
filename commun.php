<?php session_start();
mysql_connect('localhost','root','');

mysql_select_db('dblistecourses'); 
$noListeEnCours=0;


if($_SERVER['PHP_SELF']!="/AppliWeb/connexion.php")
{
	if(empty($_SESSION['login']))
	{
		header('Location: connexion.php');
	}
}
?>
