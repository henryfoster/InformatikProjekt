<div id='konto'>
<div id='konto-titel'><h1>Konto</h1></div>
<?php
echo ("<div id='konto-benutzer'><h3>".$_SESSION['userid']."<br>".benutzername($_SESSION['userid'])."</h3></div>");
?>
<br>
<a href='buchauf.php'>Buch aufgeben</a>
<br>
<h2>Meine Anzeigen</h2>
<?php
$anz = meine_buecher($_SESSION['userid']);
if (count($anz) == 0) {
    echo("Keine aufgegebene Bücher");
}
for ($i = 0; $i < count($anz); $i++) {
    $a = $anz[$i];
    $status = $a['Status'];
    if ($status == 0)
        $status = 'Aktiv';
    else if ($status == 0)
        $status = 'Nicht aktiv';
    echo("<div class='mein-buch'><a href='?buch=".$a['BuchID']."'><b>".$a['Titel']."</b><br>
            Aufgegeben: ".$a['Datum']."<br>
            Status: $status  <a href='.'><button class='mein-buch-deaktivieren'>deaktivieren</button></a></div>\n");
}
?>

</div>
