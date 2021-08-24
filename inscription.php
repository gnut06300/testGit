<?php
//On initialise la connection à la base de donnée
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}
$messsages_error=[];
if(isset($_POST['pseudo'])){
    if(preg_match("#^[a-zA-Z0-9-_]{2,}$#", $_POST['pseudo'])) {
        $test_pseudo = $bdd->prepare('SELECT COUNT(*) AS count_pseudo FROM membres WHERE pseudo = ?');
        $test_pseudo->execute(array($_POST['pseudo']));
        //$test_pseudo->fetch()) ;
        $test_count = $test_pseudo->fetch();
        if($test_count['count_pseudo'] == 0){
            if(isset($_POST['password']) AND $_POST['password'] === $_POST['password_confirm']){
                if(preg_match('#^[a-zA-Z0-9-_@%*]{6,}$#', $_POST['password'])){
                    // Hachage du mot de passe
                    $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    // echo 'Les mots de passes sont bons';
                    if (isset($_POST['email']) AND preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,6}$#", $_POST['email'])){
                        // echo 'Tout est Valide';
                        // Insertion
                        $req = $bdd->prepare('INSERT INTO membres(id_groupe, pseudo, pass, email, date_inscription) VALUES(1, :pseudo, :pass, :email, CURDATE())');
                        $req->execute(array(
                            'pseudo' => $_POST['pseudo'],
                            'pass' => $pass_hache,
                            'email' => $_POST['email']));
                        session_start();
                        $_SESSION['pseudo'] = $_POST['pseudo'];
                        ?>
                        <p>Vous avez bien été enregistré <br>
                        <a href="connexion.php">Aller à la page connexion</a>
                        </p> 
                        <?php
                    }
                    else
                    {
                        $messsages_error[] = 'L\'adresse email n\'est pas valide'; 
                    }
                }
                else
                {
                    $messsages_error[]='Le mot de passe doit comporter au moins 6 caractères et composer de lettres minuscules majuscules des nombres ou - _ @ % *';
                }
            }
            else
            {
                $messsages_error[]='Vos deux mots de passe ne sont pas identique';
            }
        }
        else
        {
            $messsages_error[]='Choisir un autre pseudo car '. $_POST['pseudo'] .' est déjà pris';
            
        }

    }
    else
    {
        $messsages_error[]= 'Le speudo doit comporter au moins 2 caractères et composer de lettres minuscules majuscules ou - _';
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <?php
    if(isset($messsages_error)){
        foreach($messsages_error as $message_error){
            echo $message_error . '<br />';
        }
    }
    ?>
    <form action="" method="post">
        <p><label for="pseudo">Pseudo : </label><input type="text" name="pseudo" id="pseudo" /></p>
        <p><label for="password">Mot de passe : </label><input type="password" name="password" id="password" /></p>
        <p><label for="password_confirm">Confirmer mot de passe : </label><input type="password" name="password_confirm" id="password_confirm" /></p>
        <p><label for="email">Adresse email : </label><input type="email" name="email" id="email" /></p>
        <p><input type="submit" value="Valider"></p>
    </form>
    
    
</body>
</html>