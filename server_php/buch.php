<?php
$buch = suche_id($arg_buch);
$bilder = bilder_zum_buch($buch['id']);
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
            <div id="buch-titel"><?php echo($buch['titel']); ?></div>
            <div id="buch-isbn">ISBN: <?php echo($buch['isbn']); ?></div>
            <div id="buch-jahr">Jahr: <?php echo($buch['jahr']); ?></div>
            <div id="buch-zustand"><?php echo($buch['zustand']); ?></div>
            <div id="buch-kontakt">Kontakt: <?php echo($buch['kontakt']); ?></div>
            <div id="buch-preis">Preis: <b><?php echo($buch['preis']); ?> €</b></div>
        </div>
    </div>
    <div id="buch-beschreibung">
        <?php echo($buch['beschreibung']); ?>
    </div>
</div>