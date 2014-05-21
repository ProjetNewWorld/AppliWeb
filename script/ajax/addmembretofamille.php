<?php 
include('../../function.php') ;
$pseudo=$_POST['pseudo'];
 
$requette="select * from membre where membreLogin='$pseudo'";
$reponse=mysql_query($requette);
$ligne=mysql_fetch_array($reponse);
$nbRep=mysql_num_rows($reponse);
if($nbRep==0)
{
	echo "Aucun membre trouv&eacute; avec pour pseudo : ".$pseudo;
}
else
{
	if($ligne['familleId']!="")
	{
	echo "Ce membre est d&eacute;j&agrave dans une famille";
	} 
	else
	{
		$familleId=getInfosMembreByLogin('familleId');
		$membreId=$ligne['membreId'];
		$requette2="insert into demande values ($familleId,$membreId)";
		mysql_query($requette2);
		echo "Demande envoy&eacutee";
	}
}
 

 
?>