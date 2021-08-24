<?php
session_start();
//On initialise la connection à la base de donnée
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}
$affiche = true;
// echo $_COOKIE['pseudo'] . ' - ' . $_COOKIE['pass_hache'] ;
if(isset($_COOKIE['pseudo']) AND isset($_COOKIE['pass_hache'])){
    echo 'Il y a bien les cookies <br />';
    // Récupération de l'utilisateur et de son mot de pass
    $req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
    $req->execute(array(
        'pseudo' => $_COOKIE['pseudo']
    ));
    $resultat = $req->fetch();

    
    if(!$resultat){
        echo 'Mauvais identifiant ou mot de passe dans le cookie !';
    }
    else{
        // Comparaison du pass envoyé  via le formulaire avec celui de la base
        
        if($_COOKIE['pass_hache'] == $resultat['pass']){
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['pseudo'] = $_COOKIE['pseudo'];
            echo 'Vous êtes connecté ! <br /><a href=\'pageTestTp.php\'>Page test du TP</a><br /><a href="deconnexion.php">Vous déconnecter</a>';
            $affiche = false;
        }
    }
}
if(isset($_POST['pseudo']) AND isset($_POST['pass'])){
    // Récupération de l'utilisateur et de son mot de pass
    $req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
    $req->execute(array(
        'pseudo' => $_POST['pseudo']
    ));
    $resultat = $req->fetch();

    
    if(!$resultat){
        echo 'Mauvais identifiant ou mot de passe 1 !';
    }
    else{
        // Comparaison du pass envoyé  via le formulaire avec celui de la base
        $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

        if($isPasswordCorrect){
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['pseudo'] = $_POST['pseudo'];
            echo 'Vous êtes connecté ! <br /><a href=\'pageTestTp.php\'>Page test du TP</a><br /><a href="deconnexion.php">Vous déconnecter</a>';

            if(isset($_POST['connexion'])){
                echo "faire les cookies <br />";
                setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true); // On écrit un cookie pseudo
                setcookie('pass_hache', $resultat['pass'], time() + 365*24*3600, null, null, false, true); // On écrit un cookie pass_hache
            }
            $affiche = false;
        }
        else{
            echo 'Mauvais identifiant ou mot de passe 2 !';
        }
    }
}
?>
<?php
if($affiche){
?>    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/styleTp.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
</head>

<body>
    <h1>Page de connection</h1>

    <div class="formulaire">
        <form action="" method="post">
            <p><label for="pseudo">Pseudo : </label><input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_SESSION['pseudo'])) echo $_SESSION['pseudo'] ?>"></p>
            <p><label for="pass">Password : </label><input type="password" name="pass" id="pass"></p>
            <p><label for="connexion">Connexion automatique : </label><input type="checkbox" name="connexion" id="connexion"></p>
            <p><input type="submit" value="Se connecter"></p>

        </form>
        <p><a href="inscription.php">Vous inscrire</a></p>
    </div>


</body>

</html>
<?php
}
?>