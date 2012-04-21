<?php
require('conf/config.php');

ini_set("soap.wsdl_cache_enabled", "0");
$client = new soapclient($strApiWsdlUrl); 

$arrResult = $client->getInvoice($strAPIKey, $_GET['iid']);
//pre_print_r($arrResult);
//unset($arrResult);	

$data = $arrResult['result'];
	
//pre_print_r($data);

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
	//print_r($var_array['pos']);
	// Get Config-Data out of the db
	mysql_connect($db[0]['host'],$db[0]['user'],$db[0]['password']);
	mysql_select_db($db[0]['database']);
	mysql_query("set names 'utf8'");
	
	$result = mysql_query('SELECT * FROM configuration');
	while($row = mysql_fetch_object($result)){
	  $cfg[$row->id] = $row->value;
	}
	require('tpl/out_pdf/tpl.def_deliverynotice.php');
}

?>
