<?php
/**
 * Dire Bonjour
 *
 * @param string $nom
 * @return string
 */
function DireBonjour($nom)
{
    echo 'Bonjour ' . $nom . ' !<br />';
}

DireBonjour('Marie');
DireBonjour('Patrice');
DireBonjour('Edouard');
DireBonjour('Pascale');
DireBonjour('François');
DireBonjour('Benoît');
DireBonjour('Père Noël');
DireBonjour('Gérald');
?>
<?php
// Ci-dessous, la fonction qui calcule le volume du cône
/**
 * Volume d'un cone
 *
 * @param float $rayon
 * @param float $hauteur
 * @return float
 */
function VolumeCone($rayon, $hauteur)
{
   $volume = $rayon * $rayon * 3.14 * $hauteur * (1/3); // calcul du volume
   return $volume; // indique la valeur à renvoyer, ici le volume
}

$volume = VolumeCone(3, 1);
echo 'Le volume d\'un cône de rayon 3 et de hauteur 1 est de ' . $volume;

$volume = VolumeCone(5, 2);
echo '<br />Le volume d\'un cône de rayon 5 et de hauteur 2 est de ' . VolumeCone(5, 2);

echo '<br />Le volume d\'un cône de rayon 7 et de hauteur 3 est de ' . VolumeCone(7, 3);
?>