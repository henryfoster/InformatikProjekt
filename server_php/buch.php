<?php
$buch = suche_id($arg_buch);
$bilder = bilder_zum_buch($buch['BuchID']);
?>

<div id="buch-details">
    <div id="buch-oben">
        <div id="buch-bilder">
            <div id="buch-bild-gross"><img id="bild-gross" src="<?php echo($bilder[0]); ?>" /></div>
            <div id="buch-bilder-klein">
                <?php
                for ($i = 0; $i < count($bilder); $i++) {
                    echo("<div class='buch-bild-klein' onMouseOver=\"getElementById('bild-gross').src='$bilder[$i]'\"><img src='$bilder[$i]' /></div>");
                }
                ?>
            </div>
        </div>
        <div id="buch-daten">
            <div id="buch-titel"><?php echo($buch['Titel']); ?></div>
            <div id="buch-isbn">ISBN: <?php echo($buch['ISBN']); ?></div>
            <div id="buch-verlag">Verlag: <?php echo($buch['Verlag']); ?></div>
            <div id="buch-jahr">Jahr: <?php echo($buch['Jahr']); ?></div>
            <div id="buch-kategorien">Fach <?php echo($buch['Kategorien']); ?></div>
            <div id="buch-klasse">Klasse: <?php
                if ($buch['Klasse1'] == 0)
                    echo("Nicht angegeben");
                else if ($buch['Klasse1'] == $buch['Klasse2'])
                    echo($buch['Klasse1']);
                else
                    echo($buch['Klasse1'] . ' - ' . $buch['Klasse2']);
            ?></div>
            <div id="buch-zustand"><?php echo($buch['Zustand']); ?></div>
            <div id="buch-datum">Aufgegeben: <?php echo($buch['Datum']); ?></div>
            <div id="buch-preis">Preis: <b><?php echo($buch['Preis']); ?> €</b></div>
            
            <?php
                $query = $_GET;
                $query[$_ARG_NACHRICHT] = '1';
                $link = '?'.http_build_query($query);
                if ($benutzer_eingeloggt) { ?>
                <div id="buch-kontakt">
                    Verkäufer: <?php echo($buch['EMail']); ?><br>
                    <form action='<?php echo $link; ?>' method='post'>
                    <input type='hidden' name='nachricht-sender' value='<?php echo($_SESSION['userid']); ?>'></input>
                    <input type='hidden' name='nachricht-ziel' value='<?php echo($buch['kontakt']); ?>'></input>
                    <input type='hidden' name='nachricht-buch' value='<?php echo($buch['id']); ?>'></input>
                    <input name='nachricht-text'></input>
                    <input type='submit' value='Nachricht senden'>
                    </form>
                </div>
            <?php } else { ?>
                <div id="buch-kontakt">Um den Verkäufer zu kontaktieren, melden Sie sich bitte an.</div>
            <?php } ?>
        </div>
    </div>
    <div id="buch-beschreibung">Beschreibung:<br>
        <?php echo($buch['Beschreibung']); ?>
    </div>
</div>
