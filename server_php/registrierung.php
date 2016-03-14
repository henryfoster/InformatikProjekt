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
    else if(!isset($benutzer) || count($benutzer) == 0) {
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
 
<form action="?register=1" method="post">
E-Mail:<br>
<input type="email" name="email"><br><br> 
Benutzername:<br>
<input name="benutzer"><br><br> 
Passwort: <br>
<input type="password" name="passwort"><br>
Passwort wiederholen: <br>
<input type="password" name="passwort2"><br><br>
 
<input type="submit" value="Abschicken">
</form>
 
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
