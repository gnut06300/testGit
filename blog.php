<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Blog</title>
</head>
<body>
    <h1>Mon super Blog !</h1>
    <p>Derniers billets du blog :</p>
    <?php
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            die('Erreur : ' .$e->getMessage());
        }
        // DATE_FORMAT(date_creation, \'%d/%m/%y à %Hh:%imin:%ss\' AS date_post 
        $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%y à %Hh:%imin:%ss\') AS date_post  FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
        while ($billets=$req->fetch()) {
         ?>
        <div class="news">
            <h3><?= htmlspecialchars($billets['titre']) ?> <i> le <?= $billets['date_post'] ?></i> </h3>
            <p><?= nl2br(htmlspecialchars($billets['contenu'])) ?><br>
            <a href="commentaires.php?billet=<?= $billets['id'] ?>">Commentaires</a>
            </p>
        </div>
        <?php
        }
        $req->closeCursor();
        ?>
</body>
</html>