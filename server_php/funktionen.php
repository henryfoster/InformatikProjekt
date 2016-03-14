
<?php

/*

z.B.:
Suchergebnis: Liste [ ID, Titel, ISBN, Verlag, Jahr, Beschreibung, Zustand, Kontakt, Preis, [Kategorien], Klasse1, Klasse2, Datum, Status ]
Klasse: Klasse1 - Klasse2, zB.: 12-13 oder 8-8 wenn nur eine, 0-0 wenn nicht angegeben
Status: 0: aktiv, 1: deaktiviert 2: verkauft

*/

$kategorien = array ( 'Allgemein', 'Biologie', 'Chemie', 'Deutsch', 'Englisch', 'Französisch', 'Geographie', 'Geschichte', 'Informatik', 'Kunst', 'Mathematik', 'Musik', 'Physik', 'Politikwissenschaft', 'Russisch', 'Tafelwerk' );


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




// Vor.: ...
// Eff.: liefert die Liste der Ergebnisse ...
function suche($q, $sort, $kat) {
    $sql = "SELECT * FROM Buecher WHERE Status LIKE 0";
    if ($kat != "" && $kat != 'alle') {
        $sql .= " AND Kategorien LIKE '$kat'";
    }

    mysql_verbinden();
    $query = mysql_query($sql);
    mysql_close();

    $erg = array();

    while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
        if ($row['ISBN'] == $q) {
            array_push($erg, $row);
        } else if ($q == '' || suche_im_titel($row['Titel'], $q)) {
            array_push($erg, $row);
        }
    }
    
    $erg = sortieren($erg, $sort);
    return $erg;
}
function suche_im_titel($titel, $suchbegriff) {
    $t = strtolower($titel);
    $qs = explode(' ', strtolower($suchbegriff));
    
    $begr_max = count($qs);
    $begr_gefunden = 0;

    foreach ($qs as $q) {
        if (strpos($t, $q) !== false)
            $begr_gefunden++;
    }

    return ($begr_gefunden > 0 && $begr_gefunden > $begr_max*0.8);
}
function suche_id($id) {
    mysql_verbinden();
    $erg = mysql_fetch_array(mysql_query("SELECT * FROM Buecher WHERE BuchID = '$id'"));
    mysql_close();
    return $erg;
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
    $arg = "Titel";// $sort 0 oder 1
    if ($sort >= 2)
        $arg = "Preis";// $sort 2 oder 3
    
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


// eigene Bücher verwalten
function meine_buecher($email) {
    $sql = "SELECT * FROM Buecher WHERE EMail LIKE '$email'";

    mysql_verbinden();
    $query = mysql_query($sql);
    mysql_close();

    $erg = array();

    while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
        array_push($erg, $row);
    }
    
    $erg = quicksort($erg, 'Datum');
    $erg = array_reverse($erg);
    return $erg;
}
function buch_aufgeben($tt, $isbn, $verl, $jahr, $besc, $zust, $email, $preis, $kat, $kl1, $kl2) {
    
    $id = buch_neue_id();

    $q = "INSERT INTO Buecher VALUES ('$id', '$tt', '$isbn', '$verl', $jahr, '$besc', '$zust', '$email', $preis, '$kat', $kl1, $kl2, 0, NOW());";
    
    mysql_verbinden();
    $erfolg = mysql_query($q);
    mysql_close();

    return $erfolg;
}
function buch_neue_id() {
    $id = rand(10000000, 99999999);
    mysql_verbinden();
    $q = "SELECT * FROM Buecher WHERE BuchID LIKE '$id'";
    $erfolg = (mysql_num_rows(mysql_query($q)) == 0);
    mysql_close();
    if ($erfolg)
        return $id;
    return buch_neue_id();
}



// Registration
function registrierung_email_pruefen($email) {
    mysql_verbinden();
    
    $q = "SELECT * FROM Benutzer WHERE EMail LIKE '$email'";
    
    $erfolg = mysql_num_rows(mysql_query($q));

    mysql_close();

    return $erfolg != 0;
}
function registrierung($email, $passwort, $benutzer) {
    mysql_verbinden();
    
    $q = "INSERT INTO Benutzer VALUES ('$email', '$benutzer', '$passwort', NOW());";
    
    $erfolg = mysql_query($q);

    mysql_close();

    return $erfolg;
    
}


// SQL Tabellen erstellen
function mysql_verbinden() {
    $servername = "mysql1.000webhost.com";
    $username = "a5059333_mfsb";
    $password = "InfoProjekt2016";
    $dbname = "a5059333_mfsb";
    $servername = "localhost";
    $username = "root";
    $password = "pass";
    $dbname = "mfsb";
    
    mysql_connect($servername, $username, $password);
    mysql_select_db($dbname);
}
function mysql_test() {
    echo('Verbindung wird hergestellt...<br>');
    mysql_verbinden();
    echo('Verbindung ok<br>');
    
/*
- Benutzer: EMail, Benutzername, Passwort, Datum
- Bücher: BuchID, Titel, ISBN, Verlag, Jahr, Beschreibung, Zustand, EMail, Preis, Kategorien, Klasse1, Klasse2, Datum, Status
- Bilder: BildID, BuchID
- Nachrichten: NachrichtID, EMailSender EMailZiel, BuchID, Text, Gelesen, Datum
*/
    tabelle_erstellen('Benutzer', 'CREATE TABLE Benutzer (
        EMail VARCHAR(50) NOT NULL,
        Benutzername VARCHAR(30) NOT NULL,
        Passwort VARCHAR(30) NOT NULL,
        Datum TIMESTAMP
    )');
    tabelle_erstellen('Buecher', 'CREATE TABLE Buecher (
        BuchID INT(10),
        Titel VARCHAR(30) NOT NULL,
        ISBN VARCHAR(30) NOT NULL,
        Verlag VARCHAR(30) NOT NULL,
        Jahr VARCHAR(30) NOT NULL,
        Beschreibung TEXT NOT NULL,
        Zustand VARCHAR(30) NOT NULL,
        EMail VARCHAR(30) NOT NULL,
        Preis INT(10),
        Kategorien VARCHAR(30) NOT NULL,
        Klasse1 INT(2),
        Klasse2 INT(2),
        Status INT(2),
        Datum TIMESTAMP
    )');
    tabelle_erstellen('Bilder', 'CREATE TABLE Bilder (
        BildID INT(10),
        BuchID INT(10)
    )');
    tabelle_erstellen('Nachrichten', 'CREATE TABLE Nachrichten (
        NachrichtID INT(10),
        EMailSender VARCHAR(30) NOT NULL,
        EMailZiel VARCHAR(30) NOT NULL,
        BuchID INT(10),
        Text TEXT NOT NULL,
        Gelesen INT(1),
        Datum TIMESTAMP
    )');
    

    mysql_close();
}
function tabelle_erstellen($name, $sqlcode) {
    if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '$name'"))==1) {
        echo "Tabelle $name existiert<br>OK<br>";
    } else {
        echo "Tabelle $name erstellen...<br>";
        
        if (mysql_query($sqlcode) === TRUE) {
            echo "OK<br>";
        } else {
            echo "Fehler <br>";
        }
    }
    
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

