<?php
$source = imagecreatefromjpeg("uploads/couchersoleil.jpg"); // La photo est la source
$destination = imagecreatetruecolor(200, 150); // On crée la miniature vide

// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

// On crée la miniature
imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"
imagejpeg($destination, "uploads/mini_couchersoleil.jpg");
?>