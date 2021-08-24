<?php
if (isset($_POST['texte']))
{
    $texte = stripslashes($_POST['texte']); // On enlève les slashs qui se seraient ajoutés automatiquement
    $texte = htmlspecialchars($texte); // On rend inoffensives les balises HTML que le visiteur a pu rentrer
    //echo $texte.'<br>';
    $texte = nl2br($texte); // On crée des <br /> pour conserver les retours à la ligne
    
    // On fait passer notre texte à la moulinette des regex
    $texte = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $texte);
    $texte = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $texte);
    $texte = preg_replace('#\[color=(red|green|blue|yellow|purple|olive)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $texte);
    $texte = preg_replace('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}#', '<a href="mailto:$0">$0</a>', $texte);
    $texte = preg_replace('#\[u\](.+)\[/u\]#isU', '<u>$1</u>', $texte);
    $texte = preg_replace('#https?://[a-z0-9._/-]+\??[a-z0-9=&;]*#i', '<a href="$0">$0</a>', $texte);
    $texte = preg_replace('#\[img\]<a href="(.+)">(.+)</a>\[/img\]#isU', '<img src="$1" />', $texte);
   
    // Et on affiche le résultat. Admirez !
    echo $texte . '<br /><hr />';
}
?>

<p>
    Bienvenue dans le parser de mon site !<br />
    Nous avons écrit ce parser ensemble, j'espère que vous saurez apprécier de voir que tout ce que vous avez appris va vous être très utile !
</p>

<p>Amusez-vous à utiliser du bbCode. Tapez par exemple :</p>

<blockquote style="font-size:0.8em">
<p>
    Je suis un grand [b]débutant[/b], et pourtant j'ai [i]tout appris[/i] sur http://www.openclassrooms.com?page=1&idee=2<br />
    Je vous [b][color=red]recommande[/color][/b] d'aller sur ce site, vous pourrez apprendre à faire ça [i][color=purple]vous aussi[/color][/i] ! <br>
    gnut@gnut.eu <br>
    [u]Texte souligné[/u] ici pas souligné <br>
    [img]https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg[/img]
</p>
</blockquote>

<form method="post">
<p>
    <label for="texte">Votre message ?</label><br />
    <textarea id="texte" name="texte" cols="50" rows="8"></textarea><br />
    <input type="submit" value="Montre-moi toute la puissance des regex" />
</p>
</form>