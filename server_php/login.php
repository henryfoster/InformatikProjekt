<?php

function passwort_pruefen($email, $passwort) {
    mysql_verbinden();
    
    $q = "SELECT * FROM Benutzer WHERE EMail LIKE '$email'";
    
    $pass = mysql_fetch_array(mysql_query($q))['Passwort'];
    
    mysql_close();

    return $pass == $passwort;
}
function benutzername($email) {
    
    mysql_verbinden();
    
    $q = "SELECT * FROM Benutzer WHERE EMail LIKE '$email'";
    
    $benutzer = mysql_fetch_array(mysql_query($q))['Benutzername'];
    
    mysql_close();
    
    return $benutzer;
}

session_start();

$benutzer_eingeloggt = 0;
$fehler = "";

if (isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
    $benutzer_eingeloggt = 1;
    
    if (isset($_GET[$_ARG_LOGIN]) && $_GET[$_ARG_LOGIN] == '0') {
        session_destroy();
        $_SESSION['userid'] = '';
        $benutzer_eingeloggt = 0;
        $fehler = 'Logout erfolgreich';
    }
    
} else if(isset($_GET[$_ARG_LOGIN]) && $_GET[$_ARG_LOGIN] == '1') {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    
    $userid = $email;
            
    //Überprüfung des Passworts
    if ($userid != "" && passwort_pruefen($email, $passwort)) {
        $_SESSION['userid'] = $userid;
        $benutzer_eingeloggt = 1;
    } else {
        $fehler = "E-Mail oder Passwort war ungültig";
    }
}

?>
