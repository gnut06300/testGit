<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}
$req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = ?');
$req->execute(array($_GET['possesseur'])) ;
echo $_GET['possesseur'];

echo '<ul>';
while ($donnees = $req->fetch())
{
    echo 'test';
    echo '<li>'. $donnees['nom']. ' (' . $donnees['prix'] .' EUR)</li>';
}
echo '</ul>';
$req->closeCursor();

?>