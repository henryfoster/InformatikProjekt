<?php

function passwort_pruefen($email, $passwort) {
    
    // ...
    
    return $email == $passwort;
}
function user_id($email) {
    
    // ...
    
    return $email;
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
    
    $userid = user_id($email);
            
    //Überprüfung des Passworts
    if ($userid != "" && passwort_pruefen($email, $passwort)) {
        $_SESSION['userid'] = $userid;
        $benutzer_eingeloggt = 1;
    } else {
        $fehler = "E-Mail oder Passwort war ungültig";
    }
}

?>
