<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM jeux_video ORDER BY prix DESC LIMIT 0,3');
while ($donnees = $reponse->fetch())
{
   echo $donnees['nom']. ' appartient à ' . $donnees['possesseur'] . ' coûte ' . $donnees['prix'] .' EUR<br>';
}
$reponse->closeCursor();

?>