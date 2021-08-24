<?php
session_start();
//echo $_SESSION['id'] .' - ' . $_SESSION['pseudo'];
if(isset($_SESSION['id']) AND isset($_SESSION['pseudo'])){
    echo 'Bonjour ' . $_SESSION['pseudo'];
} 
else{
    // Puis rediriger vers connexion.php comme ceci :
header('Location: connexion.php');
}

?>