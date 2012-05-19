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
require('conf/config.php');

ini_set("soap.wsdl_cache_enabled", "0");
$client = new soapclient($strApiWsdlUrl); 

$arrResult = $client->getInvoice($strAPIKey, $_GET['iid']);
$data = $arrResult['result'];
	
$path_to_gsales = str_replace('mm-delivery-note/index.php', '', $_SERVER['SCRIPT_FILENAME']);

function pre_print_r($arr){
	echo '<pre>';
		print_r($arr);
	echo '</pre>';
}

if(count($_POST) == 0){
	require('tpl/out_html.php');
}
else{
	$i = 0;
	while(isset($data->pos[$i])){
		if(!isset($_POST['print_'.$data->pos[$i]->id]))
			unset($data->pos[$i]);
		$i++;
	}
		
	require('../lib/inc.cfg.php');
	$var_array = (array) $data;
	$var_array['base'] = (array) $var_array['base'];
	$var_array['pos'] = (array) $var_array['pos'];
	$var_array['summ'] = (array) $var_array['summ'];
	
	// Blanko oder Briefpapier
	if($_POST['dlvry-form'] == 'Blanko'){
		$booBlanko = true; 
		$docname = $prefix.($data->base->id + $offset).'_b.pdf';
	} else {
		$booBlanko = false;
		$docname = $prefix.($data->base->id + $offset).'.pdf';
	}
	
	// Get Config-Data out of the db
	mysql_connect($db[0]['host'],$db[0]['user'],$db[0]['password']);
	mysql_select_db($db[0]['database']);
	mysql_query("set names 'utf8'");
	
	$result = mysql_query('SELECT * FROM configuration');
	while($row = mysql_fetch_object($result)){
	  $cfg[$row->id] = $row->value;
	}
	
	// Check wheter file already exists
	if (file_exists($path_to_gsales.$cfg['dir_data'].$cfg['dir_documents'].$docname)){
		if($_POST['dlvry-form'] == 'Blanko')
			$docname = $prefix.($data->base->id + $offset).'_'.time().'_b.pdf';
		else 
			$docname = $prefix.($data->base->id + $offset).'_'.time().'.pdf';
	}
	
	require('tpl/out_pdf/tpl.def_deliverynotice.php');
	
	// Save delivery date to bill
	if($addDeliveryDate){
		$date = explode('.', $_POST['date']);
		$arrResult = $client->updateInvoice($strAPIKey, $_GET['iid'], array('deliverydate' => $date['2'].'-'.$date['1'].'-'.$date['0']));
	}
	
	// Save Delivery Notice to User-Documents
	$query = "INSERT INTO documents SET user_id = '".$_COOKIE['UID']."', username = '".$_COOKIE['UNAME']."', created = '".date('Y-m-d H:i:s', time())."', sub = 'subcustomer', recordid = '".$data->base->customers_id."', original_filename = '".$docname."', file = '".$docname."', title = 'Lieferschein ".$prefix.($data->base->id + $offset)."', description = '".$label." ".$prefix.($data->base->id + $offset)." vom ".$_POST['date']."', public = '".$public."'";
	if(mysql_query($query)){
		echo($label." ".$prefix.($data->base->id + $offset)." vom ".$_POST['date']." wurde erfolgreich erstellt.<br /><br />
			Sie können diesen Dialog nun schließen.".
			'<script type="text/javascript">
				window.open(\'../index.php?p=file&loc='.$cfg['dir_documents'].$docname.'\');
			</script>');
	}
	else{
		echo ("Es ist ein Fehler bei der Erstellung des Lieferscheins aufgetreten.");
	}
}

?>
