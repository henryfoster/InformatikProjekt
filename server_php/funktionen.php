
<?php

/*

z.B.:
Suchergebnis: Liste [ ID, Titel, ISBN, Verlag, Jahr, Beschreibung, Zustand, Kontakt, Preis, [Kategorien], Klasse1, Klasse2, Datum, Status ]
Klasse: Klasse1 - Klasse2, zB.: 12-13 oder 8-8 wenn nur eine, 0-0 wenn nicht angegeben
Status: 0: aktiv, 1: deaktiviert 2: verkauft

*/

$kategorien = [ 'Allgemein', 'Biologie', 'Chemie', 'Deutsch', 'Englisch', 'Französisch', 'Geographie', 'Geschichte', 'Informatik', 'Kunst', 'Mathematik', 'Musik', 'Physik', 'Politikwissenschaft', 'Russisch', 'Tafelwerk' ];


// Vor.: ...
// Eff.: liefert die Liste der Ergebnisse ...
function suche($q, $sort, $kat) {
    $erg = array();
    
    // hier kommt die SQL-Anfrage ...
    for ($i = 0; $i < 100; $i++) {
        array_push($erg, randombuch ($q));
    }
    
    $erg = sortieren($erg, $sort);
    return $erg;
}
function suche_id($id) {
    // sql ...
    return randombuch("Buch " . $id);
}
// Vor.: keine
// Eff.: liefert die hochgeladenen Bilder zum Buch mit im Argument agbegebener ID
function bilder_zum_buch($buch_id) {
    $erg = array();
    
    // sql ...
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, 9);
        array_push($erg, "img/buch$n.jpg");
    }
    
    return $erg;
}
// Vor.: Liste besteht aus Büchern
// Eff.: liefert die sortierte Liste
function sortieren($erg, $sort) {
    $arg = "titel";// $sort 0 oder 1
    if ($sort >= 2)
        $arg = "preis";// $sort 2 oder 3
    
    $erg = quicksort($erg, $arg);
    
    if ($sort % 2 == 1)
        $erg = array_reverse($erg);
    return $erg;
    
}
// Vor.: Liste besteht aus Büchern
// Eff.: liefert die nach $arg (titel, preis, etc) sortierte Liste
function quicksort($erg, $arg) {
    if (count($erg) == 0)
        return $erg;
    
    $p = $erg[0];
    $a = array();
    $b = array();
    for ($i = 1; $i < count($erg); $i++) {
        if ($erg[$i][$arg] < $p[$arg])
            array_push($a, $erg[$i]);
        else
            array_push($b, $erg[$i]);
    }
    
    $a = quicksort($a, $arg);
    array_push($a, $p);
    return array_merge($a, quicksort($b, $arg));
}


// Nachricht [ ID, EMailSender, EMailEmpfänger, BuchID, Text, Datum ]
// Eff.: liefert die Nachrichten, die der Benutzer gesendet hat
function nachrichten_gesendetvon($email_sender) {
    $n = array();
    
    // ...
    
    return $n;
}
// Eff.: liefert die Nachrichten, die dem Benutzer gesendet sind
function nachrichten_fuer($email_ziel) {
    $n = array();
    
    // ...
    
    return $n;
}
function nachricht_senden($email_sender, $email_ziel, $buch_id, $text) {
    
    // ...
    
}


// zum Testen
function randombuch($q) {
    global $beschreibung, $kategorien;

    $jahr = rand(1990, 2016);
    $isbn = "978-3-";
    $isbnrand = rand(1, 6);
    for ($i = 0; $i < 8; $i++) {
        $isbn .= rand(0, 9);
        if ($i == $isbnrand)
            $isbn .= "-";
    }
    $isbn .= "-" . rand(0,9);
    
    $preis = rand(1, 50);
    
    $kat = array();
    array_push($kat, $kategorien[rand(0, count($kategorien)-1)]);
    array_push($kat, $kategorien[rand(0, count($kategorien)-1)]);
    
    return array (
        "id" => "B" . rand(500000, 999999),
        "titel" => "$q buch " . rand(1000, 9999),
        "isbn" => $isbn,
        "jahr" => $jahr,
        "beschreibung" => $beschreibung,
        "zustand" => "Guter Zustand",
        "kontakt" => "email" . rand(1000,9999) . "@email.com",
        "preis" => $preis,
        "kategorien" => $kat,
        "klasse1" => rand(1,13),
        "klasse2" => rand(1,13),
        "verlag" => $kat[0]."Verlag",
        "datum" => mktime(11, 14, 54, 8, 12, 2014),
        "status" => 0
    );
}

$beschreibung = "Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.
At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat. 
Consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.";

?>
