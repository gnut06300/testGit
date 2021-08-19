<?php
// Let's test if the file has been sent and if there is no error
if (isset($_FILES['monfichier']) and $_FILES['monfichier']['error'] == 0) {
    echo '<pre>';
    print_r($_FILES['monfichier']);
    echo '</pre>';
    // Let's test if the file is not too big
    if ($_FILES['monfichier']['size'] <= 1000000) {
        echo "Mon fichier n'est pas trop gros";
        $infosfichier = pathinfo($_FILES['monfichier']['name']);
        echo '<pre>';
        print_r($infosfichier);
        echo '</pre>';
        $extension_upload = $infosfichier['extension'];
        $extension_autorisees = array('jpg', 'JPG','jpeg', 'gif', 'png');
        if (in_array($extension_upload, $extension_autorisees)) {
            echo "Ce fichier est autorisé<br />";
            echo basename($_FILES['monfichier']['name']) . '<br />';
            echo $infosfichier['filename'] . '_' . uniqid() . '.' . $infosfichier['extension'];
            $fichierUpload = 'uploads/' . $infosfichier['filename'] . '_' . uniqid() . '.' . $infosfichier['extension'];
            move_uploaded_file($_FILES['monfichier']['tmp_name'], $fichierUpload);
            echo "<br />L'envoi du fichier a bien été effectué !<br />";
?>
            <img src="<?= $fichierUpload ?>" alt="ma photo"><br>
            <a href="formulaireFichier.php">Retour au formulaire</a>

<?php
        }
        else
        {
            echo 'Le fichier n\'est pas autorisé'; 
            echo '<br/><a href="formulaireFichier.php">Retour au formulaire</a>';
        }
    }
    else
    {
        echo "Le fichier est trop gros";
        echo '<br/><a href="formulaireFichier.php">Retour au formulaire</a>';
    }
}
?>