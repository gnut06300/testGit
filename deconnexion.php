<?php 
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Suppression des cookies de connexion automatique
setcookie('pseudo', '');
setcookie('pass_hache', '');

// Puis rediriger vers connexion.php comme ceci :
header('Location: connexion.php');