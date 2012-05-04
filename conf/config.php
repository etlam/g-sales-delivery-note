<?php
// Enable and generate API key in your g*Sales Installation: left main navi -> "Administration" -> "API"
$strAPIKey = 'rdkcs0xEGzKbkHxiGohM';

// Replace with your g*sales installation URL 
$strApiWsdlUrl = 'http://localhost/gsales2/api/api.php?wsdl';

// Lieferscheinprefix
$prefix = 'lfs';

// Lieferscheinoffset
$offset = 4000;

// Label Lieferschein-Nr.:
$label = 'Lieferschein-Nr';

// Headline Lieferschein
$headline = "Lieferschein";

// Einleitungstext
$einleitungstext = "Folgende Artikel wurden Ihnen ausgeliefert:";

// Abschlusstext
$abschlusstext = "Bei Fragen und Problemen zu dieser Lieferung melden Sie sich bitte.
Vielen Dank für Ihr Vertrauen und auf weiterhin gute Zusammenarbeit.";

// Lieferschein standardmäßig als blanko?
$blanko_by_default = true;

// Lieferschein im Kundenfrontend unter Dokumente anzeigen?
// 0 -> Nein
// 1 -> Ja
$public = 1;

// Lieferungsdatum automtaisch zur Rechnung hinzufügen
$addDeliveryDate = true;

?>