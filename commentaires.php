<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Commentaires</title>
</head>
<body>
    <h1>Mon super Blog !</h1>
    <p><a href="blog.php">Retour à la liste des billets</a></p>
    <?php
    if(isset($_GET['billet'])){
        $_GET['billet'] = (int) $_GET['billet'];
        if ($_GET['billet'] > 0) {
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $e)
            {
                die('Erreur : ' .$e->getMessage());
            }
            $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%y à %Hh:%imin:%ss\') AS date_post  FROM billets WHERE id = ?');
            $req->execute(array($_GET['billet']));
            $billets = $req->fetch();
            ?>
            <div class="news">
            <h3><?= htmlspecialchars($billets['titre']) ?> <i> le <?= $billets['date_post'] ?></i> </h3>
            <p><?= nl2br(htmlspecialchars($billets['contenu']))  ?></p>

            </div>
            <?php
            $req->closeCursor();
            ?>
            <div class="commentaires">
            <p><strong>Commentaires :</strong></p>
            <?php
            $req_1 = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire,\'%d/%m/%y à %Hh:%imin:%ss\') AS date_post FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire DESC');
            $req_1->execute(array($_GET['billet']));
            while ($commentaire = $req_1->fetch()) {
                ?>
                <p><strong><?= htmlspecialchars($commentaire['auteur']) ?></strong> le <?= $commentaire['date_post'] ?><br>
                <?= nl2br(htmlspecialchars($commentaire['commentaire'])) ?>
                </p>
                <?php
            }
            $req_1->closeCursor();
            ?>
            </div>
            <?php
        }
        
    }
   
    ?>

    
</body>
</html>