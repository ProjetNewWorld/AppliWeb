<?php 
include('../../function.php') ;
$membreId=$_POST['id'];

$requette="update membre set familleId=null where membreId=$membreId";
$reponse=mysql_query($requette);



 
?>