<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}
if(isset($_GET['possesseur']) AND isset($_GET['prix_max'])){
    $_GET['prix_max'] = (int) $_GET['prix_max'];
    if( $_GET['prix_max']>0 AND $_GET['prix_max']<=1000){
        /*
        $req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = ? AND prix <= ? ORDER BY prix');
        $req->execute(array($_GET['possesseur'],$_GET['prix_max']));
        */
        $req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = :possesseur AND prix <= :prixmax ORDER BY prix') or die(print_r($bdd->errorInfo()));
        $req->execute(array('possesseur'=>$_GET['possesseur'],'prixmax'=>$_GET['prix_max']));
        //var_dump($req);
        echo '<ul>';
        while ($donnees = $req->fetch())
        {
            //echo 'test';
            echo '<li>'. $donnees['nom']. ' (' . $donnees['prix'] .' EUR)</li>';
        }
        echo '</ul>';
        $req->closeCursor();
    }else{
        echo 'le prix n\'est pas autorisé'; 
    }

}else{
    echo 'Vous devez renseigner un possesseur et un prix';

}
?>