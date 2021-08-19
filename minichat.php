<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Chat</title>
</head>
<style>
    form{
        text-align: center;
    }
</style>
<body>
    <p>
        <form action="minichat_post.php" method="POST">
            <p><label for="pseudo">Pseudo : </label><input type="text" name="pseudo" id='pseudo' <?php if(isset($_COOKIE['pseudo'])) echo 'value="'.$_COOKIE['pseudo'].'"' ; ?>> </p>
            <p><label for="message" >Message : <textarea name='message' id="message"></textarea></label></p>
            <input type="submit" value="Envoyer">
        </form>
    </p>
    <?php
    $message=$bdd->query('SELECT pseudo, message, DATE_FORMAT(date_creation, \'%d/%m/%y à %Hh:%imin:%ss\') AS date_post FROM minichat ORDER BY ID DESC LIMIT 0,10');
    while($messages= $message->fetch()){
        echo '<p><strong>'. htmlspecialchars($messages['pseudo']).' : </strong>'. htmlspecialchars($messages['message']) .' - du '.$messages['date_post'].'</p>';
    }
    $message->closeCursor();
    ?>
</body>
</html>