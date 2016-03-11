<meta http-equiv="content-type" content="text/html;charset=utf-8">
<html lang="de">
<head>
<title>MfSb beta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php

ini_set('display_errors', 'on');

include ('funktionen.php');


// Argumente in PHP: "seite.de/?q=suchbegriff&sort=0&kat=kategorie1..."
// Details zum Buch: "seite.de/?q=suchbegriff&sort=0&kat=kategorie1...&buch=BuchID"

// Argumente
$_ARG_Q = "q";// Suchbegriff
$_ARG_SORT = "sort";// Sortieren: 0: Name aufsteigend, 1: absteigend, 2: Preis auf ...
$_ARG_KAT = "kat";// Suche in Kategorien
$_ARG_SEITE = "p";// Nummer der Seite in Trefferliste
$_ARG_BUCH = "buch";// Details zum Buch
$_ARG_LOGIN = "login";// Ein- / Ausloggen
$_ARG_NACHRICHT = "nachricht";

// Abfrege der Argumente aus URL
$arg_q = "";
if (isset($_GET[$_ARG_Q]))
    $arg_q = $_GET[$_ARG_Q];
$arg_sort = "0";
if (isset($_GET[$_ARG_SORT]))
    $arg_sort = $_GET[$_ARG_SORT];
$arg_kat = "";
if (isset($_GET[$_ARG_KAT]))
    $arg_kat = $_GET[$_ARG_KAT];
$arg_seite = "";
if (isset($_GET[$_ARG_SEITE]))
    $arg_seite = $_GET[$_ARG_SEITE];
$arg_buch = "";
if (isset($_GET[$_ARG_BUCH]))
    $arg_buch = $_GET[$_ARG_BUCH];
if (isset($_GET[$_ARG_NACHRICHT])) {
    unset($_GET[$_ARG_NACHRICHT]);
    nachricht_senden($_POST['nachricht-sender'], $_POST['nachricht-ziel'], $_POST['nachricht-buch'], $_POST['nachricht-text']);
}

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
    // Suchergebnisse anzeigen
    
    $ergebnisse = array_slice($ergebnisse, $arg_seite*$ergebnisse_pro_seite, $ergebnisse_pro_seite);
    
    
    for ($i = 0; $i < $ergebnisse_pro_seite && $i < count($ergebnisse); $i++) {
        $erg = $ergebnisse[$i];
        $beschr = $erg['beschreibung'];
        if (strlen($beschr) > 100)
            $beschr = substr($beschr, 0, 100) . '...';
        
        
        // PHP Argumente
        $query = $_GET;
        $query[$_ARG_BUCH] = $erg['id'];
        $link = '?'.http_build_query($query);
        
        $bilder = bilder_zum_buch($erg['id']);
        $bild = $bilder[0];
        
        echo "<a href='$link'>"
            . "<div class='ergebnis'>\n"
            . "  <div class='erg-bild'><img src='$bild' /></div>\n"
            . "  <div class='erg-1'>\n"
            . "    <div class='erg-title'>".$erg['titel']."</div>\n"
            . "    <div>\n"
            . "      <span class='erg-jahr'>".$erg['jahr']."</span>\n"
            . "      <span class='erg-zustand'>".$erg['zustand']."</span>\n"
            . "    </div\n>"
            . "    <div class='erg-beschreibung'>$beschr</div>\n"
            . "  </div>\n"
            . "  <div class='erg-2'>\n"
            . "    <div class='erg-preis'>".$erg['preis']." €</div>\n"
            . "    <div class='erg-isbn'>".$erg['isbn']."</div>\n"
            . "  </div>\n"
            . "</div></a>\n";
    }
}

?>
</div>

</div>


<!-- START OF HIT COUNTER CODE --><br><script language="JavaScript" src="http://www.counter160.com/js.js?img=14"></script><br><a href="https://www.000webhost.com"><img src="http://www.counter160.com/images/14/left.png" alt="Free web hosting" border="0" align="texttop"></a><a href="http://www.hosting24.com"><img alt="Web hosting" src="http://www.counter160.com/images/14/right.png" border="0" align="texttop"></a><!-- END OF HIT COUNTER CODE -->

</body>
</html>
