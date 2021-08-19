<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}
$reponse =$bdd->query('SELECT COUNT(DISTINCT possesseur) AS nbrpossesseur FROM jeux_video');

$donnees = $reponse->fetch();

echo $donnees['nbrpossesseur'];

$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(prix) AS sum_prix, possesseur FROM jeux_video GROUP BY possesseur');
while ($donnees = $reponse->fetch()) {
    echo $donnees['possesseur']. ' a pour ' . $donnees['sum_prix'] .' EURO de jeux<br>';
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT AVG(prix) AS prix_moyen, console FROM jeux_video WHERE possesseur = \'Patrick\' GROUP BY console HAVING prix_moyen<=10');
while ($donnees = $reponse->fetch()) {
    echo $donnees['prix_moyen']. ' Euro pour ' . $donnees['console'] .'<br>';
}
$reponse->closeCursor();