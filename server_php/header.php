<div id="header">

    <div id="logo"><a href="."><img src="img/logo.png"/></a></div>
    
    <div id="header-text">
    <div id="header-oben">
        <div id="login">
            <?php
            
                if ($benutzer_eingeloggt) {//Benutzer ist eingeloggt

                    $query = $_GET;
                    $query[$_ARG_LOGIN] = '0';
                    $link = '?'.http_build_query($query);
                    
                    $userid = benutzername($_SESSION['userid']);
                    echo("Angemeldet als: $userid<br><a href='$link'>Ausloggen</a> <a href='.'>Konto</a>");

                } else {// nicht eingeloggt

                    $query = $_GET;
                    $query[$_ARG_LOGIN] = '1';
                    $link = '?'.http_build_query($query);

            ?>
                    <form action='<?php echo $link; ?>' method='post'>
                    E-Mail: <input type='email' name='email'>
                    Passwort: <input type='password' name='passwort'>
                    <input type='submit' value='Abschicken'>
                    </form>
                    <a href='registrierung.php'>Registrierung</a>
            <?php
                    if ($fehler != '') {
                        echo("$fehler");
                    }
                }
            ?>
        </div>
    </div>

    <div id="header-unten">
        <!-- Form zur Suche "/?q=eingabe" -->
        <form name="suche" method="GET" action=".">
            <!-- Eingabefeld -->
            <input type="text" id="suchbegriff" class="header-item" placeholder="Suchbegriff oder ISBN" name="q"
            <?php // Stellt den Text im Eingabefeld auf Variable $arg_q
            echo("value=\"$arg_q\"");
            ?> autofocus />
            <!-- Taste mit Bild und Text -->
            <button type="submit" id="suchtaste" class="header-item">
                <img src="img/suche.png"/>
                <span>Suchen</span>
            </button>
        
        </form>
            
            
        <?php
            if ($arg_q != "") {
                echo("<a href='.'><button id='neuesuche' class='header-item'><img src='img/links.png'/><span>Neue Suche</span></button></a>\n");
            }
        ?>
            
        <div class='header-item' id='ergebnisliste-steuerung'>
            <?php
            
            if ($arg_buch != "") {
                $query = $_GET;
                $query[$_ARG_BUCH] = "";
                $link = '?'.http_build_query($query);
                echo "<a href='$link'><button id='zuruecktaste' class='header-item'><img src='img/links.png'/><span>Zurück zu den Ergebnissen</span></button></a>\n";
            } else if ($arg_q != "") {
                $query = $_GET;
                $query[$_ARG_SEITE] = $arg_seite - 1;
                $link1 = '?'.http_build_query($query);
                $query[$_ARG_SEITE] = $arg_seite + 1;
                $link2 = '?'.http_build_query($query);
                
                $max_seite = ceil(count($ergebnisse)/$ergebnisse_pro_seite);
                
                
                echo("<span class='header-item'>" . count($ergebnisse) . " Ergebnisse</span>\n");
                
                echo("<div class='header-item' id='seiten'>");
                if ($arg_seite > 0)
                    echo("<a href='$link1'><button class='taste-seitenwahl'><img src='img/links.png'></button></a>");
                else
                    echo("<button class='taste-seitenwahl-grau'><img src='img/links.png'></button>");
                echo("<span>Seite ".($arg_seite+1)." / ".$max_seite."</span>");
                if ($arg_seite + 1 < $max_seite)
                    echo("<a href='$link2'><button class='taste-seitenwahl'><img src='img/rechts.png'></button></a></div>");
                else
                    echo("<button class='taste-seitenwahl-grau'><img src='img/rechts.png'></button></div>");
                
                $query = $_GET;
                $query[$_ARG_SORT] = "0";
                $link_n_auf = '?'.http_build_query($query);
                $query[$_ARG_SORT] = "1";
                $link_n_ab = '?'.http_build_query($query);
                $query[$_ARG_SORT] = "2";
                $link_p_auf = '?'.http_build_query($query);
                $query[$_ARG_SORT] = "3";
                $link_p_ab = '?'.http_build_query($query);
                
                
                echo ("<div class='header-item' id='sortieren'>");
                echo ("Sortieren: ");
                
                $arr = array();
                array_push($arr, "<a href='$link_n_auf'>Name aufsteigend</a></span> / ", "<a href='$link_n_ab'>absteigend</a></span> | ",
                "<a href='$link_p_auf'>Preis aufsteigend</a></span> / ", "<a href='$link_p_ab'>absteigend</a></span>");
                
                for ($i = 0; $i < count($arr); $i++) {
                    if ($i == $arg_sort)
                        echo("<span class='sortierung' id='sortierung-ausgewaehlt'>".$arr[$i]);
                    else
                        echo("<span class='sortierung'>".$arr[$i]);
                }
                
                echo ("</div>");
            
            
            }
            ?>
        </div>
        </div>
        
    </div>

</div>
