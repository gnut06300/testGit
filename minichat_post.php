<?php
// Effectuer ici la requête qui insère le message
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}
if(isset($_POST['pseudo']) AND isset($_POST['message'])){
    if(!isset($_COOKIE['pseudo']) OR $_COOKIE['pseudo']!=$_POST['speudo']){
        setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true); // On écrit un cookie
    }
    $message = $bdd->prepare('INSERT INTO minichat (`pseudo`, `message`)  VALUES (?,?)');
    $message->execute(array($_POST['pseudo'],$_POST['message']));

}
// Puis rediriger vers minichat.php comme ceci :
header('Location: minichat.php');
?>