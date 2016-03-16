<meta http-equiv="content-type" content="text/html;charset=utf-8">
<html lang="de">
<?php 
session_start();
include("funktionen.php");
?>
<html> 
<head>
  <title>Registrierung</title>	
</head> 
<body>
 
<?php
$reg = false;
 
if(isset($_GET['register'])) {
    $email = $_POST['email'];
    $benutzer = $_POST['benutzer'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $fehler = "";
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fehler = 'Die E-Mail-Adresse ist ungültig';
    }
    else if(!isset($benutzer) || strlen($benutzer) == 0) {
        $fehler = 'Benutzername ist leer';
    }
    else if(strlen($passwort) == 0) {
        $fehler = 'Passwort fehlt';
    }
    else if($passwort != $passwort2) {
        $fehler = 'Die zwei Passwörter müssen übereinstimmen';
    }
    // Prüfen, ob E-Mail schon regitriert ist
    else if (registrierung_email_pruefen($email)) {
        $fehler = 'Diese E-Mail-Adresse ist bereits vergeben';
    }
    
    if($fehler == "") {
        
        $reg = registrierung($email, $passwort, $benutzer);
        
        
        if ($reg) {
            $fehler = 'Registrierung erfolgreich<br>';
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}
 
if(!$reg) {
?>
 
<div id="register">
<form style="" action="?register=1" method="post">
<div id="registera">
E-Mail:<br>
<input name="email" type="email"><br><br> 

Benutzername:<br>
<input style="outline: 1px solid rgb(255, 0, 0); -moz-outline-radius: 5px;" name="benutzer"><br><br> 

Passwort: <br>
<input name="passwort" type="password"><br>

Passwort wiederholen: <br>
<input style="outline: 1px solid rgb(255, 0, 0); -moz-outline-radius: 5px;" name="passwort2" type="password"><br><br>
 
<input value="Abschicken" type="submit">
</div></form></div>
 
<?php
    echo($fehler);
} else {
    echo($fehler);
?>
    <div id="reg_zueruck">???</div>
    <script type="text/javascript">
        reg = document.getElementById("reg_zueruck");
        z = "<a href='../.'>zurück</a>  ";
        reg.innerHTML = z+"3...";
        setTimeout(function() { reg.innerHTML = z+"2..."; }, 1000);
        setTimeout(function() { reg.innerHTML = z+"1..."; }, 2000);
        setTimeout(function() { window.location = "../.";; }, 3000);
    </script>
<?php
}
?>
 
</body>
</html>
