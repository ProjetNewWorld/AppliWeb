<?php 
include('../../function.php') ;
$rayonId=$_POST['rayon'];
$html="";
$requette="select * from produit where rayonId=$rayonId";
$reponse=mysql_query($requette);
while($maLigne=mysql_fetch_array($reponse))
{
	$html.='<option value='.$maLigne["produitId"].'>'.$maLigne["produitLib"].'</option>';
}
echo $html;

 
?>