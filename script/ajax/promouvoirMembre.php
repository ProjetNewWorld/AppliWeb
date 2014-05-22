<?php 
include('../../function.php') ;
$membreId=$_POST['id'];
$familleId=$_POST['idFam'];

$requette2="delete from cheffamille where familleId=$familleId";
$reponse2=mysql_query($requette2);

$requette="insert into cheffamille values($familleId,$membreId)";
$reponse=mysql_query($requette);
?>