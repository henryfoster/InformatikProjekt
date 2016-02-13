<meta http-equiv="content-type" content="text/html;charset=utf-8">
<html lang="de">
<head>
<title>MfSb beta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php

ini_set('display_errors', 'on');

include ('funktionen.php');


// Argumente in PHP: "seite.de/?q=suchbegriff&sort=0&kat=kategorie1,kategorie2"

// Suchbegriff: Argument "q"
$arg_q = "";
if (isset($_GET["q"]))
    $arg_q = $_GET["q"];
// Sortieren: Argument "sort"
// 0: Name aufsteigend, 1: absteigend, 2: Preis auf ...
$arg_sort = "";
if (isset($_GET["sort"]))
    $arg_q = $_GET["sort"];
// Suche in Kategorien: Argument "kat"
$arg_kat = "";
if (isset($_GET["kat"]))
    $arg_kat = $_GET["kat"];

// ...

$ergebnisse_pro_seite = 20;

?>


<body>

<?php include ('header.php'); ?>

<div id="main">

<div id="kategorie-liste">
<?php
for ($i = 0; $i < 20; $i++) {
    $kategorie = "Kategorie $i";
    
    // PHP Argumente
    $query = $_GET;
    // neue Kategorie, Suchbegriff und Sortierung bleibt das gleiche
    $query['kat'] = $kategorie;
    // Link
    $link = '?'.http_build_query($query);
    
    
    echo ("<div class='kategorie'");
    if ($kategorie == $arg_kat)
        echo (" id='kategorie-ausgewaehlt'");
    echo ("><a href='$link'><span>$kategorie</span></a></div>\n");
}
?>
</div>

<div id="ergebnisse">
<?php

// Suchergebnisse anzeigen

$ergebnisse = suche($arg_q, $arg_sort, $arg_sort);

echo("<div id='ergebnisse-anzahl'>" . count($ergebnisse) . " Ergebnisse</div>\n");

for ($i = 0; $i < $ergebnisse_pro_seite && $i < count($ergebnisse); $i++) {
    $erg = $ergebnisse[$i];
    $beschr = $erg['beschreibung'];
    if (strlen($beschr) > 100)
        $beschr = substr($beschr, 0, 100) . '...';
    
    $link = http_build_query(array( "titel" => $erg['titel'] ));
    
    echo "<a href='buch.php?$link'><div class='ergebnis'>"
        . "<div class='erg-bild'><img src='img/logo.png' /></div>\n"
        . "<div class='erg-1'>"
        . "<span class='erg-title'>".$erg['titel']."</span><br>\n"
        . "<span class='erg-jahr'>".$erg['jahr']."</span> "
        . "<span class='erg-zustand'>".$erg['zustand']."</span><br>\n"
        . "<span class='erg-beschreibung'>$beschr</span>"
        . "</div>"
        . "<div class='erg-2'>"
        . "<span class='erg-preis'>".$erg['preis']." €</span><br>\n"
        . "<span class='erg-isbn'>".$erg['isbn']."</span>"
        . "</div>"
        . "</div></a>\n";
}

?>
</div>

</div>

</body>
</html>