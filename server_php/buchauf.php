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


?>

<div id='buch-aufgeben'>

<form action="?buchauf=1" method="post">
Titel: <input name="titel"><br>
ISBN: <input name="isbn"><br>
Verlag: <input name="verlag"><br>
Jahr: <input name="jahr"><br>
Beschreibung: <input name="beschreibung"><br>
Zustand: <input name="zustand"><br>
Kontakt: <input name="kontakt"><br>
Preis: <input name="preis"><br>
Kategorien: <input name="kategorien"><br>
Klasse1: <input name="klasse1"><br>
Klasse2: <input name="klasse2"><br>
<input type="submit" value="Abschicken">
</div>

</body>
</html>
