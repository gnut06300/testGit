<?php
header ("Content-type: image/jpeg"); // L'image que l'on va créer est un jpeg

// On charge d'abord les images
$source = imagecreatefrompng("uploads/logo.png"); // Le logo est la source
$url_image = 'uploads/'.$_GET['image'];
$destination = imagecreatefromjpeg($url_image); // La photo est la destination

// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

// On veut placer le logo en bas à droite, on calcule les coordonnées où on doit placer le logo sur la photo
$destination_x = $largeur_destination - $largeur_source;
$destination_y =  $hauteur_destination - $hauteur_source;

// On met le logo (source) dans l'image de destination (la photo)
imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 60);

$blanc = imagecolorallocate($destination, 255, 255, 255);
imagestring($destination, 5, $largeur_destination/2-50, $hauteur_destination/2, "Copyright gnut 2021", $blanc);

// On affiche l'image de destination qui a été fusionnée avec le logo
imagejpeg($destination);
?>