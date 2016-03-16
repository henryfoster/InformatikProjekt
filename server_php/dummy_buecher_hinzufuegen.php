<?php

ini_set('display_errors', 'on');

include('funktionen.php');
include('login.php');

echo('Bücher zur Datenbank hinufügen...<br>');


mysql_verbinden();
mysql_query("UPDATE Buecher SET Kategorien='Russisch' WHERE Titel LIKE 'Russisch für Anfänger'");
mysql_close();

/*
buch_aufgeben('Duden Informatik: Angewandte Informatik mit Office-Paketen Sekundarstufe I und II', '978-3-8355-6006-2', 'Duden Schulbuch', 2007, 'Info Buch, das ich verkaufe, kaum Gebrauchsspuren', 'guter Zustand', 'GustafZole@rvo.de', 30, 'Informatik', 7, 13);
buch_aufgeben('Informatische Grundbildung Sekundarstufe I Lehrbuch. Gesamtband', '978-3-8355-6004-8', '	Duden Schulbuch', 2008, 'Info Buch, kaum Gebrauchsspuren', 'Perfekter Zustand', 'hanspeter@rvo.de', 30, 'Informatik', 7, 10);
//buch_aufgeben('Schulbuch un', 30, 'Informatik', 12, 13);
buch_aufgeben('Schulbuch und Erster Weltkrieg', '756-451-181-0', 'V&R unipress', 2016, 'Geschichts Buch, das ich verkaufe zum Ersten Weltkrieg','Perfekter Zustand', 'Larahansel@rvo.de', 50, 'Geschichte', 11, 13);
buch_aufgeben('Pearl Harbor', '354-678-181-5', 'WenzelVerlag', 2000, 'Super geschichtsbuch für 7., 8. Klasse', 'guter Zustand', 'JensSchlemel@rvo.de', 12, 'Geschichte', 7, 8);
buch_aufgeben('Tagebuch der Anne Frank', '978-3-656-88572-6', 'Grin', 2015, 'Super spannendes Deutschbuch', 'schlechter Zuschtand aber lesbar', 'GünterJaucher@rvo.de', 2, 'Deustch', 8, 10);
buch_aufgeben('Formeln und Tabellen', '978-3-89818-700-8', 'Duden Schulbuch', 2003, 'Formelsammlung nie benutzt/verstanden', 'Perfekter Zustand', 'OlliKrause@rvo.de', 13, 'Mathe', 7, 13);
buch_aufgeben('Peter Pan', '695-476-789-5', 'Märchenverlag', 2012, 'Deutschbuch nur einmal gelesen', 'sehr guter Zustand', 'BellaNika@rvo.de', 13, 'Deutsch', 7, 9);
buch_aufgeben('Collins World Atlas', '978-0-00-749228-2', '	HarperCollins', 2013, 'Erdkundebuch nur ein Jahr lang genutzt', 'guter Zustand', 'hanspeter@rvo.de', 15, 'Geographie', 7, 10);
buch_aufgeben('Geschichte und Geschehen', '436-345-541-1', 'SchulbuchVerlag', 2010, 'Geschichtsbuch, das ich verkaufe, 2 Jahre genutzt', 'guter Zustand', 'raviolipetra@rvo.de', 31, 'Geschichte', 11, 12);
buch_aufgeben('Mathe Training', '244-564-345-4', 'TrainingVerlag', 2012, 'Mathe Übungsaufgaben', 'Perfekter Zustand', 'GerdMüller@rvo.de', 12, 'Mathe', 10, 10);
buch_aufgeben('Deutsch Training', '244-564-345-5', 'TrainingVerlag', 2012, 'Deutsch Übungsaufgaben, Gedichte', 'guter Zustand', 'GerdMüller@rvo.de', 12, 'Deutsch', 10, 10);
buch_aufgeben('Physik Training', '244-564-345-6', 'TrainingVerlag', 2012, 'Physik Übungsaufgaben', 'schlechter Zustand', 'GerdMüller@rvo.de', 2, 'Physik', 10, 10);
buch_aufgeben('Chemie Training', '244-564-345-7', 'TrainingVerlag', 2012, 'Chemie Übungsaufgaben mit Experimenten', 'Perfekter Zustand', 'GerdMüller@rvo.de', 12, 'Chemie', 10, 10);
buch_aufgeben('Kunst Training', '244-564-345-8', 'TrainingVerlag', 2012, 'Kunst Aufgaben zu Kunstepochen', 'Perfekter Zustand', 'GerdMüller@rvo.de', 12, 'Kunst', 10, 10);
buch_aufgeben('Geografie Training', '244-564-345-9', 'TrainingVerlag', 2012, 'Geo Übungsaufgaben', 'Perfekter Zustand', 'GerdMüller@rvo.de', 12, 'Geographie', 10, 10);
buch_aufgeben('Englisch Training', '243-564-345-0', 'TrainingVerlag', 2012, 'Englisch Übungsaufgaben', 'Perfekter Zustand', 'GerdMüller@rvo.de', 12, 'Englisch', 10, 10);
buch_aufgeben('Context Sprache 1', '236-535-221-1', 'ContextVerlag', 2011, 'Englischbuch für die 12 Klasse', 'guter Zustand', 'GerdaMüller@rvo.de', 14, 'Englisch', 12, 12);
buch_aufgeben('Context Sprache 2', '230-535-221-2', 'ContextVerlag', 2011, 'Englischbuch für die 13 Klasse', 'guter Zustand', 'GerdaMüller@rvo.de', 14, 'Englisch', 13, 13);
buch_aufgeben('Context Sprache 3', '239-535-221-3', 'ContextVerlag', 2012, 'Englischbuch für die 13 Klasse', 'guter Zustand', 'GerdaMüller@rvo.de', 14, 'Englisch', 13, 13);
buch_aufgeben('Mathe - Übergang von Sek. I in Sek II', '698-589-18-1', 'SchulbuchVerlag', 2014, 'Mathebuch mit vielen Aufgaben', 'Perfekter Zustand', 'deinemail@rvo.de', 37, 'Mathe', 7, 13);
buch_aufgeben('Geschichte und Geschehen 2', '936-385-521-5', 'SchulbuchVerlag', 2010, 'Geschichtsbuch, das ich verkaufe, 1 Jahr genutzt', 'guter Zustand', 'raviolipetra@rvo.de', 31, 'Geschichte', 12, 13);
buch_aufgeben('Geografie 5 Schulbuch', '785-908-764-3', 'GeoVerlag', 1995, 'Geobuch voll intressant', 'super Zustand', 'kaufdas@rvo.de', 30, 'Geographie', 7, 7);
buch_aufgeben('Geografie 6 Schulbuch', '785-908-764-4', 'GeoVerlag', 1996, 'Geobuch', 'guter Zustand', 'petrusavius@rvo.de', 30, 'Geographie', 8, 8);
buch_aufgeben('Geografie 7 Schulbuch', '785-908-764-5', 'GeoVerlag', 1997, 'Geobuch fast nie benutzt', 'schlechter Zustand', 'kalma@rvo.de', 30, 'Geographie', 9, 9);
buch_aufgeben('Chemie für Anfänger', '154-561-133-1', 'KausaVerlag', 2000, 'altes gutes Chemie Buch', 'guter Zustand', 'Sandrascholz@rvo.de', 12, 'Chemie', 11, 12);
buch_aufgeben('Russisch für Anfänger', '154-561-133-2', 'KausaVerlag', 2000, 'altes gutes Russisch Buch', 'guter Zustand', 'karmabuch@rvo.de', 15, 'Chemie', 11, 12);
buch_aufgeben('Französisch für Anfänger', '154-561-133-3', 'KausaVerlag', 2000, 'altes gutes Französisch Buch', 'guter Zustand', 'Sandrascholz@rvo.de', 12, 'Chemie', 11, 12);
buch_aufgeben('Biologie für Anfänger', '154-561-133-4', 'KausaVerlag', 2000, 'altes gutes Bio Buch', 'guter Zustand', 'Sandrascholz@rvo.de', 12, 'Chemie', 11, 12);
*/
echo('Alles OK<br>');

?>
