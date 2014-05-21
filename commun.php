<?php session_start();
$host="127.0.0.1"; //replace with database hostname 
$username="root"; //replace with database username 
$password="230956"; //replace with database password 
$db_name="listedescourses"; //replace with database name
//echo $host." ".$username." ".$password;
mysql_connect($host, $username, $password)or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$noListeEnCours=0;


if($_SERVER['PHP_SELF']!="/appliWeb/connexion.php")
{
	if(empty($_SESSION['login']))
	{
		header('Location: connexion.php');
	}
}
?>
