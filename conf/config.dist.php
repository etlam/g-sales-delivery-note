<?php
/*      
                                +#W,
                                  W,       MÜNSMEDIA GbR                  MÜNSMEDIA GbR
                                  W:                                      c/o webvariants GbR
    WWW              *WWWWW@#W*   W:       Dr.-Hermann-Fleck-Allee 3      Breiter Weg 232a
    W+   ,WWWWW##W+  W@  W@ ,WW   W@       57299 Burbach                  39104 Magdeburg
    W@   W@, W@ ,WW  W@  WW  .W   WW       
    WW   W#  WW  +W  W@  *W   W.  @W       Tel. 02736 / 50 94 97 - 4      Tel. 0391 / 50 54 93 8 - 0
    +W  ,W@  @W   W  @W   W,      +W       Fax  02736 / 50 94 97 - 5      Fax  0391 / 50 54 93 8 - 8
     W   W@   W                  WWW
     W,                                    http://muensmedia.de
     WWW

   Copyright (C) 2012  MÜNSMEDIA GbR

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 
 */

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