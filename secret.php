<?php
$password = 'kangourou';
if (isset($_POST['password']) and $_POST['password'] == $password) {
    echo 'Les codes de la NASA 12345 et 452587';
} else {
    echo 'Vous n\'avez pas acces à cette page';
?>
    <br>
    <a href="formulaireTp.php">Retour au formulaire</a>
<?php
}
