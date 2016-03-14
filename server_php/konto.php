<h1>Konto</h1>
<?php
echo ("<h2>".$_SESSION['userid']."</h2>");
?>
<br>
<a href='buchauf.php'>Buch aufgeben</a>
<br>
<h2>Meine Anzeigen</h2>
<?php
$anz = meine_buecher($_SESSION['userid']);
for ($i = 0; $i < count($anz); $i++) {
    $a = $anz[$i];
    echo("<div class='mein_buch'><a href='?buch=".$a['id']."'>".$a['titel']."</div>\n");
}
?>
