<?php 
include('../../function.php') ;
$pseudo=$_POST['pseudo'];
 
	$requette="select membreEmail from membre where membreLogin='$pseudo'";
	$reponse=mysql_query($requette);
	$ligne=mysql_fetch_array($reponse);
	$mess=$ligne['membreLogin']." , votre mot de passe est ".$ligne['membreMdp'];
	if(mysql_num_rows($reponse)>0)
	{
		mail($ligne['membreEmail'],"Recupération de votre mot de passe",$mess); 
		echo "mail send";
		
	}
	else
	{
		echo "Pas de membre correspondant";
	}
 

 
?>