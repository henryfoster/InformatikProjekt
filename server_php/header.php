<div id="header">

<div id="header-oben">
<div id="logo"><a href="."><img src="img/logo.png"/></a> TEST</div>
<div id="login"><a href="login.php">Einloggen / Resgistrieren</a></div>
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
</div>

</div>