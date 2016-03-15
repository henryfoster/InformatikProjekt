<meta http-equiv="content-type" content="text/html;charset=utf-8">
<html lang="de">
<head>
<title>Markt für Schulbücher</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php

ini_set('display_errors', 'on');

include ('funktionen.php');

// ...

$ergebnisse_pro_seite = 20;

?>


<body>

<?php
include("login.php");

if ($arg_buch == "" && ($arg_q != "" || $arg_kat != ""))
    $ergebnisse = suche($arg_q, $arg_sort, $arg_kat);
else if (!$benutzer_eingeloggt)
    $ergebnisse = suche($arg_q, $arg_sort, $arg_kat);//ggf leere Suche -> zB neueste Bücher usw

include ('header.php');
?>

<div id="main">

<div id="kategorie-liste">
<?php
$query = $_GET;
$query[$_ARG_KAT] = "alle";
$query[$_ARG_BUCH] = "";
if ($arg_buch != "")
    $query[$_ARG_SEITE] = "";
$link = '?'.http_build_query($query);
echo ("<div class='kategorie'");
    if ($arg_kat == '' || $arg_kat == 'alle')
        echo (" id='kategorie-ausgewaehlt'");
    echo ("><a href='$link'><span>Alle</span></a></div>\n");
for ($i = 0; $i < count($kategorien); $i++) {
    $kategorie = $kategorien[$i];
    
    // PHP Argumente
    $query = $_GET;
    // neue Kategorie, Suchbegriff und Sortierung bleibt das gleiche
    $query[$_ARG_KAT] = $kategorie;
    // zurück zur Trefferliste, falls Buch ausgewählt
    $query[$_ARG_BUCH] = "";
    if ($arg_buch != "")
        $query[$_ARG_SEITE] = "";
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

if ($arg_buch != "") {
    include ('buch.php');
} else if ($benutzer_eingeloggt && $arg_q == "" && $arg_kat == "") {
    include ('konto.php');
} else {
    
    if (count($ergebnisse) == 0) {
        echo('Keine Bücher gefunden');
    }


    // Suchergebnisse anzeigen
    
    $ergebnisse = array_slice($ergebnisse, $arg_seite*$ergebnisse_pro_seite, $ergebnisse_pro_seite);
    
    
    for ($i = 0; $i < $ergebnisse_pro_seite && $i < count($ergebnisse); $i++) {
        $erg = $ergebnisse[$i];
        $beschr = $erg['Beschreibung'];
        if (strlen($beschr) > 100)
            $beschr = substr($beschr, 0, 100) . '...';
        
        
        // PHP Argumente
        $query = $_GET;
        $query[$_ARG_BUCH] = $erg['BuchID'];
        $link = '?'.http_build_query($query);
        
        $bilder = bilder_zum_buch($erg['BuchID']);
        $bild = $bilder[0];
        
        echo "<a href='$link'>"
            . "<div class='ergebnis'>\n"
            . "  <div class='erg-bild'><img src='$bild' /></div>\n"
            . "  <div class='erg-1'>\n"
            . "    <div class='erg-title'>".$erg['Titel']."</div>\n"
            . "    <div>\n"
            . "      <span class='erg-jahr'>".$erg['Jahr']."</span>\n"
            . "      <span class='erg-zustand'>".$erg['Zustand']."</span>\n"
            . "    </div\n>"
            . "    <div class='erg-beschreibung'>$beschr</div>\n"
            . "  </div>\n"
            . "  <div class='erg-2'>\n"
            . "    <div class='erg-preis'>".$erg['Preis']." €</div>\n"
            . "    <div class='erg-isbn'>".$erg['ISBN']."</div>\n"
            . "  </div>\n"
            . "</div></a>\n";
    }
}

?>
</div>

</div>


<?php include ('unten.php'); ?>


</body>
</html>
