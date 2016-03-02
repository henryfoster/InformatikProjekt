<?php 
session_start();
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
    if(strlen($passwort) == 0) {
        $fehler = 'Passwort fehlt';
    }
    if($passwort != $passwort2) {
        $fehler = 'Die zwei Passwörter müssen übereinstimmen';
    }
    // Prüfen, ob E-Mail schon regitriert ist
    if ($email != $passwort) {//test
        $fehler = 'Diese E-Mail-Adresse ist bereits vergeben';
    }
    
    if($fehler == "") {
        
        
        //$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        //$statement = $pdo->prepare("INSERT INTO users (email, passwort) VALUES (:email, :passwort)");
        //$result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash));
        // ...
        
        $reg = true;//erfolgreich
        
        
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
