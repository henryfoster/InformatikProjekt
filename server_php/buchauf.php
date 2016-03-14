<meta http-equiv="content-type" content="text/html;charset=utf-8">
<html lang="de">
<head>
<title>Buch aufgeben</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php
include ('funktionen.php');
include ('login.php');

include('header.php');

if(isset($_GET['buchauf']) && $_GET['buchauf'] == 1) {
    $tt = $_POST['titel'];
    $isbn = $_POST['isbn'];
    $verl = $_POST['verlag'];
    $jahr = $_POST['jahr'];
    $besc = $_POST['beschreibung'];
    $zust = $_POST['zustand'];
    $email = $_SESSION['userid'];
    $preis = $_POST['preis'];
    $kat = $_POST['kategorien'];
    $kl1 = $_POST['klasse1'];
    $kl2 = $_POST['klasse2'];
    
    $erfolg = buch_aufgeben($tt, $isbn, $verl, $jahr, $besc, $zust, $email, $preis, $kat, $kl1, $kl2);

    if ($erfolg) {
        echo("Efolgreich");
    } else {        
        echo("Fehler");
    }
}

?>

<div id='buch-aufgeben'>

<form action="?buchauf=1" method="post">
Titel: <input name="titel"><br>
ISBN: <input name="isbn"><br>
Verlag: <input name="verlag"><br>
Jahr: <input name="jahr"><br>
Beschreibung: <input name="beschreibung"><br>
Zustand: <input name="zustand"><br>
Preis: <input name="preis"><br>
Kategorien: <input name="kategorien"><br>
Klasse1: <input name="klasse1"><br>
Klasse2: <input name="klasse2"><br>
<input type="submit" value="Abschicken">
</div>

</body>
</html>
