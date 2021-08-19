<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de la NASA</title>
</head>

<body>
    <?php
    if (!isset($_POST['password'])) {
    ?>
        <form action="formulaireTp2.php" method="POST">
            <p><label for="password">Mot de passe : </label> <input type="password" name="password" id="password"></p>
            <input type="submit" value="Valider">
        </form>
    <?php
    }
    elseif($_POST['password'] != "kangourou"){
        echo 'Vous n\'avez pas acces à cette page';
        ?>
            <br>
            <a href="formulaireTp2.php">Retour au formulaire</a>
        <?php
    }
    else{
        echo 'Les codes de la NASA 12345 et 452587';
    }

    ?>
</body>

</html>