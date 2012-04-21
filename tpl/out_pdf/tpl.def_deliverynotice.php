<?php

// PDF Datei als Briefpapier hinterlegen? (empfohlen)

	/*
		Um das optimale Ergebnis zu erzielen lege Texte und wenn möglich dein Firmenlogo in der Vorlage als Vektoren an.
		Dadurch erhälst du bei Zoomen eine gleichbleibende Qualität und die Dateigröße deiner Rechnungen bleibt schön klein was beim Versand per E-Mail
		ein wichtiger Faktor ist.
	*/
	
$arrPDFConfig['use_stationery_pdf'] = $cfg['pdf_invoice_stationary'];
$arrPDFConfig['stationery_pdf_file'] = $cfg['path_absolute'].$cfg['pdf_invoice_stationary_file']; # bitte pdf Datei entsprechend hochladen!


// Mini Absender
$arrPDFConfig['print_minisender'] = $cfg['pdf_invoice_printminisender'];


// Firmenlogo einbinden

	/*
		Achtung! Möglich sind folgende Dateiformate
		- JPG Bilder (Graustufenbilder, Truecolor 24 Bit, CMYK 32 Bit)
		- PNG Bilder (Graustufenbilder 8 Bit & 256 Graustufen, Farbpaletten, Truecolor 24 Bit)
	*/
	
$arrPDFConfig['use_picture'] = $cfg['pdf_invoice_picture'];
$arrPDFConfig['picture_file'] = $cfg['path_absolute'].$cfg['pdf_invoice_picture_file']; # g*Sales Logo als Beispiel, bitte eigene Verwenden damit diese bei Updates nicht versehentlich überschrieben wird
$arrPDFConfig['picture_width'] = $cfg['pdf_invoice_picture_width'];
$arrPDFConfig['picture_posX'] = $cfg['pdf_invoice_picture_posx'];
$arrPDFConfig['picture_posY'] = $cfg['pdf_invoice_picture_posy'];


// Fußzeilenblöcke

$arrPDFConfig['print_footer_blocks'] = $cfg['pdf_invoice_printfooter'];


// Fußzeilenblöcke Content (verwendet den Konfigurationsreiter "Meine Daten")

if ($cfg['me_ustidnr'] != '' && $cfg['me_taxno']){
	$arrTaxFooter = array('headline'=>'Steuernummern', 'txt'=>'USt-IdNr. '.$cfg['me_ustidnr']."\nSt.-Nr. ".$cfg['me_taxno']);	
} else {
	if ($cfg['me_ustidnr'] != '') $arrTaxFooter = array('headline'=>'USt-IdNr.', 'txt'=>$cfg['me_ustidnr']);		
	else $arrTaxFooter = array('headline'=>'Steuernummer', 'txt'=>$cfg['me_taxno']);		
}

$arrContactFooter = array('headline'=>'Anschrift', 		'txt'=>$cfg['me_company']."\n".$cfg['me_address']."\n".$cfg['me_countrycode'].$cfg['me_zip'].' '.$cfg['me_city']);	
if ($cfg['me_owner'] != '' || $cfg['me_manager'] != '') $arrContactFooter['txt'] .= "\n";
if ($cfg['me_owner'] != '') $arrContactFooter['txt'] .= "\n".'Inh. '.$cfg['me_owner'];
if ($cfg['me_manager'] != '') $arrContactFooter['txt'] .= "\n".'GF '.$cfg['me_manager'];

// footer im g*sales 1 stil = textfelder aus konfiguration

$arrPDFConfig['footer_head_1'] = $cfg['pdf_footer_headline_1'];
$arrPDFConfig['footer_1'] = $cfg['pdf_footer_1'];
$arrPDFConfig['footer_head_2'] = $cfg['pdf_footer_headline_2'];
$arrPDFConfig['footer_2'] = $cfg['pdf_footer_2'];
$arrPDFConfig['footer_head_3'] = $cfg['pdf_footer_headline_3'];
$arrPDFConfig['footer_3'] = $cfg['pdf_footer_3'];
$arrPDFConfig['footer_head_4'] = $cfg['pdf_footer_headline_4'];
$arrPDFConfig['footer_4'] = $cfg['pdf_footer_4'];

// footer aus "meine daten"

$arrPDFConfig['arrFooter'] = array(
	$arrContactFooter,
	array('headline'=>'Kontakt', 		'txt'=>"Tel. ".$cfg['me_phone']."\nFax ".$cfg['me_fax']."\n".$cfg['me_mail']."\n".$cfg['me_web']),
	array('headline'=>'Bankverbindung', 'txt'=>$cfg['me_bank']."\nKonto ".$cfg['me_bankaccount']."\nBLZ ".$cfg['me_bankcode']."\nIBAN ".$cfg['me_bankiban']."\nBIC ".$cfg['me_bankbic']),
	$arrTaxFooter
);


// Schrift definieren

$arrPDFConfig['font'] = 'Arial';
$arrPDFConfig['font_size_tiny'] = 6; // Verwendung in Mini-Absender
$arrPDFConfig['font_size_small'] = 8;  // Verwendung in Überschriften der Positionstabelle & Fußzeilenblöcken
$arrPDFConfig['font_size_big'] = 14; // Verwendung in Dokumenten-Headline
$arrPDFConfig['font_size'] = 10; // Standardgröße für alles weitere



// Sonstige Einstellungen

$arrPDFConfig['offsetX'] = 20; // linker Rand
$arrPDFConfig['limitToY'] = 255; // Wann soll ein Seitenumbruch geschehen?
$arrPDFConfig['startAtY'] = 101; // Ab welcher Position geht es nach einem Seitenumbruch auf der neuen Seite weiter?
$arrPDFConfig['restartAtY'] = 78; // Ab welcher Position geht es nach einem Seitenumbruch auf der neuen Seite weiter?

// Übertrag von Seite X

$arrPDFConfig['addPageCarryLine'] = $cfg['pdf_label_pagecarry_show'];
$arrPDFConfig['label_pagecarry'] = $cfg['pdf_label_pagecarry'];


// Absender (kann auch über die g*Sales Konfiguration beinflusst werden)

$arrPDFConfig['company_sender'] = $cfg['me_company'].' - '.$cfg['me_address'].' - '.$cfg['me_countrycode'].' '.$cfg['me_zip'].' '.$cfg['me_city'];


// Labels

$arrPDFConfig['label_canceled'] = $cfg['pdf_i_label_canceled'];
$arrPDFConfig['label_date'] = $cfg['pdf_i_label_date'];
$arrPDFConfig['label_customerno'] = $cfg['pdf_i_label_customerno'];
$arrPDFConfig['label_deliverydate'] = $cfg['pdf_i_label_deliverydate'];
$arrPDFConfig['label_page'] = $cfg['pdf_i_label_page'];
$arrPDFConfig['label_description'] = $cfg['pdf_i_label_description'];


$arrPDFConfig['delivery_info'] = $prefix.($data->base->id + $offset);
$arrPDFConfig['delivery_info_label'] = $label;
$arrPDFConfig['delivery_info_headline'] = $headline;


// Ab hier: Entwicklermodus ;)




// Im Blanko keine Bilder, Briefpapier und Fußzeilenblöcke ausgeben
if ($booBlanko){
	$arrPDFConfig['use_stationery_pdf'] = false;
	$arrPDFConfig['use_picture'] = false;
	$arrPDFConfig['print_footer_blocks'] = false;
}


require_once('../lib/3rdparty/fpdf16/fpdf.php');
require_once('../lib/3rdparty/fpdf16/fpdi.php');

if (!class_exists('PDF_TEMPLATE_DEFAULT_INVOICE')){ // klasse nur beim ersten einbinden deklarieren
	
	class PDF_TEMPLATE_DEFAULT_INVOICE extends FPDI {

		public $pdfCfg;
		public $pdfData;
		public $booOutputHeader;
		
		function passConfiguration($arrConfig){
			$this->pdfCfg = $arrConfig;
		}
		
		function passGsalesData($arrData){
			$this->pdfData = $arrData;
		}
		
		
		function Header(){
			if($this->pdfCfg['use_stationery_pdf'] == "true"){
				$this->setSourceFile('../'.$this->pdfCfg['stationery_pdf_file']);
				$intTempplateId = $this->ImportPage(1);
				$this->useTemplate($intTempplateId,0,-1);			
			}			
			
			
			/*
			// Development: XY Skala eindrucken
			$this->SetXY(0, 0);
			$this->SetFont($this->pdfCfg['font'], '', 4);
			for ($i=0;$i<300;$i+=3) {
				$this->SetXY($i,3); $this->Cell(3,3,$i);
				$this->SetXY(3,$i); $this->Cell(3,3,$i);
			}
			*/
			
			

			// Bild eindrucken
			
			if ($this->pdfCfg['use_picture'] == "true"){
				$this->Image('../'.$this->pdfCfg['picture_file'], $this->pdfCfg['picture_posX'] , $this->pdfCfg['picture_posY'] , $this->pdfCfg['picture_width']);	
			}

			
			// Absender & Anschrift nur auf die erste Seite drucken
			
			if ($this->PageNo() == 1){
				
				// Mini-Absender über Empfänger
				if ($this->pdfCfg['print_minisender']){
					$this->SetXY($this->pdfCfg['offsetX'],50);
					$this->SetFont($this->pdfCfg['font'], '', $this->pdfCfg['font_size_tiny']);
					$this->Cell(100,0,$this->pdfText($this->pdfCfg['company_sender']));
				}
				
				// Empfängeranschrift
				$this->SetXY($this->pdfCfg['offsetX'],55);
				$this->SetFont($this->pdfCfg['font'], '', $this->pdfCfg['font_size']);
				$this->MultiCell(100,5, $this->pdfText($this->pdfData['base']['recipient_txt']),0,'L');
			
							

			
			// Dokument-Headline
			$strHeadline = $this->pdfCfg['delivery_info_headline'];
			if ($this->pdfData['base']['status_id'] == 2)  $strHeadline .= ' ('.$this->pdfCfg['label_canceled'].')';
			#$this->SetXY($this->pdfCfg['offsetX'],90);
			$this->SetXY($this->pdfCfg['offsetX'],96);
			$this->SetFont($this->pdfCfg['font'], 'B', $this->pdfCfg['font_size_big']);
			$this->Cell(100,0,$this->pdfText($strHeadline));
			
			}
			
			

			// Rechte Seite
			// Dokument-Daten auf Höhe der Empfängeranschrift beginnen
			
			$ys = 55;
			
			if ($this->booOutputHeader){
			
				// Datum Zeile
				
				$this->SetXY(140, $ys);
				$this->SetFont($this->pdfCfg['font'], 'B', $this->pdfCfg['font_size']);
				$this->Cell(25,0,$this->pdfText($this->pdfCfg['label_date']),0);

				$this->SetXY(175, $ys);
				$this->SetFont($this->pdfCfg['font'], '', $this->pdfCfg['font_size']);
				$this->Cell(20,0,$this->pdfText($_POST['date']), 0, 0, 'R' );
				
				$ys +=5;
				
				// Kunden-Nr. Zeile (nur ausgeben wenn eine Nummer vorhanden ist )
				
				if (trim($this->pdfData['base']['customerno']) != ''){				
					
					$this->SetXY(140, $ys);
					$this->SetFont($this->pdfCfg['font'], 'B', $this->pdfCfg['font_size']);
					$this->Cell(25,0,$this->pdfText($this->pdfCfg['label_customerno']),0);
	
					$this->SetXY(175, $ys);
					$this->SetFont($this->pdfCfg['font'], '', $this->pdfCfg['font_size']);
					$this->Cell(20,0,$this->pdfText($this->pdfData['base']['customerno']), 0, 0, 'R' );
					
					$ys +=5;

				}
				
				// Dokumenttypabhängige Zeilen
				
					
					// Lieferschein-Nr. Zeile
					
					$this->SetXY(140, $ys);
					$this->SetFont($this->pdfCfg['font'], 'B', $this->pdfCfg['font_size']);
					$this->Cell(25,0,$this->pdfText($this->pdfCfg['delivery_info_label']),0);

					$this->SetXY(175, $ys);
					$this->SetFont($this->pdfCfg['font'], '', $this->pdfCfg['font_size']);
					$this->Cell(20,0,$this->pdfText($this->pdfCfg['delivery_info']), 0, 0, 'R' );
					
					$ys +=5;
				
				// Seitenanzahl Zeile
				
				$this->SetXY(140, $ys);
				$this->SetFont($this->pdfCfg['font'], 'B', $this->pdfCfg['font_size']);
				$this->Cell(25,0,$this->pdfText($this->pdfCfg['label_page']),0);

				// Variable definieren für Ersetzung nach der Erstellung der Seiten
				
				$this->intPageCountYPos = $ys;
				
				
				$ys +=5;
			
			}
			
			
			$this->SetY($this->pdfCfg['startAtY']);
			#$this->SetY($this->pdfCfg['restartAtY']);
			
				
		}
		
		function Footer(){
			
			if (false == $this->pdfCfg['print_footer_blocks']) return;
			
			// Fußzeilenblöcke ausgeben
			
			$arrFooter = $this->pdfCfg['arrFooter'];
			if (!is_array($arrFooter)) return false;

			// Footer überschreiben mit komplett manuellen Fußzeilenblöcken aus Konfiguration (g*Sales 1 Stil)
			
			if ($this->pdfCfg['footer_1'] != '' || $this->pdfCfg['footer_2'] != '' || $this->pdfCfg['footer_3'] != '' || $this->pdfCfg['footer_4'] != '' || $this->pdfCfg['footer_5'] != ''){
				unset($arrFooter);
				for ($i=1;$i<=5;$i++){
					if ($this->pdfCfg['footer_'.$i] != ''){
						$arrFooter[$i-1]['headline'] = $this->pdfCfg['footer_head_'.$i];
						$arrFooter[$i-1]['txt'] = $this->pdfCfg['footer_'.$i];
					}
				}
			}
			
			$intYOffset = 270;
			$intXStart = 15;
			$intXStop = 230; // Diesen Wert modifizieren um die horizontale Verteilung der Fußzeilenblöcke zu beeinflussen
			$intCalculatedSpace = $intXStop-$intXStart;
			$intCalculatedSpacePerBlock = floor($intCalculatedSpace/count($arrFooter));

			foreach ((array)$arrFooter as $key => $value){
				$this->SetXY($intXStart+($key*$intCalculatedSpacePerBlock), $intYOffset);
				$this->SetFont($this->pdfCfg['font'], 'B', $this->pdfCfg['font_size_small']);
				$this->Cell($intCalculatedSpacePerBlock,0,$this->pdfText($value['headline']));
				
				$this->SetXY($intXStart+($key*$intCalculatedSpacePerBlock), $intYOffset+2);
				$this->SetFont($this->pdfCfg['font'], '', $this->pdfCfg['font_size_small']);
				$this->MultiCell($intCalculatedSpacePerBlock,4,$this->pdfText($value['txt']),0,'L');
			}
			
			//reset font settings
			$this->SetFont($this->pdfCfg['font'], '', $this->pdfCfg['font_size']);
		
		}
		
		function posTableHeadlines($intY, $booShowDiscountCol=true){
			$this->SetFont($this->pdfCfg['font'], 'B', $this->pdfCfg['font_size_small']);
			
			$this->setXY(27, $intY);
			$this->Cell(20,'',$this->pdfText($this->pdfCfg['label_amount']),0,0);
			
			$this->setXY(40, $intY);
			$this->Cell(60,'',$this->pdfText($this->pdfCfg['label_description']),0,0);
			
			// 80
			$this->Ln(4);
			
		}
		
		
		function pdfText($string){
			if (function_exists('iconv')){
				$retString = iconv('utf8', 'cp1252', html_entity_decode($string,ENT_QUOTES));
				if ($retString) return $retString;
			}
			return utf8_decode(html_entity_decode($string,ENT_QUOTES));
		}		
		
		function WordWrap($text, $maxwidth){
			
		    $text = trim($text);
		    if ($text==='') return 0;
		    $space = $this->GetStringWidth(' ');
		    $lines = explode("\n", $text);
		    $text = '';
		    $count = 0;
			
		    foreach ($lines as $line){
		        $words = preg_split('/ +/', $line);
		        $width = 0;
		        foreach ($words as $word){
		            $wordwidth = $this->GetStringWidth($word);
		            if ( $width + $wordwidth + $space <= $maxwidth){
		                $width += $wordwidth + $space;
		                $text .= $word.' ';
		            } else {
		                $width = $wordwidth + $space;
		                $text = rtrim($text)."\n".$word.' ';
		                $count++;
		            }
		        }
		        $text = rtrim($text)."\n";
		        $count++;
		    }
		    $text = rtrim($text);
		    return $count;

		}

	}

}
		


$pdf = new PDF_TEMPLATE_DEFAULT_INVOICE('P', 'mm', 'A4'); 
$pdf->SetAutoPageBreak(false);
$pdf->booOutputHeader = true;


$pdf->passConfiguration($arrPDFConfig);
$pdf->passGSalesData($var_array);

$pdf->AddPage();

$pdf->SetXY($arrPDFConfig['offsetX'],$arrPDFConfig['startAtY']);
$tmpY = $pdf->GetY();

// Storno Hinweis

if ($var_array['base']['status_id'] == 2){
	$pdf->SetFont($arrPDFConfig['font'], 'B', $arrPDFConfig['font_size'] );
	$txtStorno = 'Storniert am '.date('d.m.Y', strtotime($var_array['base']['status_date']));
	if ($var_array['base']['storno_txt'] != '') $txtStorno .= ' mit der Begründung: ' . $var_array['base']['storno_txt'];
	$pdf->MultiCell(170, 5, $pdf->pdfText($txtStorno),0,'L');
	$tmpY = $pdf->GetY()+3;
}


// Einleitungstext

if ($einleitungstext != ''){
	$pdf->SetXY($arrPDFConfig['offsetX'],$tmpY);
	$pdf->SetFont($arrPDFConfig['font'], '', $arrPDFConfig['font_size'] );
	$pdf->MultiCell(170, 5, $pdf->pdfText($einleitungstext),0,'L');
	$tmpY = $pdf->GetY()+3;
}

// Rechnung ohne Positionen macht sich nicht so gut. => Aussteigen
if (!is_array($var_array['pos'])){
	die('Keine Positionen vorhanden. pdf Datei konnte nicht erstellt werden.');
	return false;		
}


// Positionstabelle (Headlines)

$pdf->posTableHeadlines($tmpY+5, $booShowDiscountCol);

$posCounter=0;
$colorCounter=0;

foreach ($var_array['pos'] as $key => $value){
	$value = (array) $value;
	$tmpY = $pdf->GetY();

	// Wo soll die Zeile für die Position beginnen?
	// Muss berücksichtigt werden das die Zeile davor mehrzeilig war?
	
	if ($endeY > $tmpY) $tmpY = $endeY+4;
	else $tmpY += 4; 
	
	// Überprüfen wieviele Zeilen die nächste Position in Anspruch nehmen wird
	
	$intPosTxtWidth = 130;
	if ($value['headline'] == 1) $intPosTxtWidth = 160;
	$zeilen = $pdf->WordWrap($pdf->pdfText($value['vars_pos_txt']), $intPosTxtWidth);
	if ($value['headline'] == 1) $zeilen++; // nächste einzeilige position muss bei headline auch noch mit draufpassen können
	
	// Ab der zweiten Position pro Seite (sonst Schleife) überprüfen ob eine neue Seite benötigt wird.
	
	if ( ($zeilen*5)+$tmpY > $arrPDFConfig['limitToY'] && $posCounter != 0 ) {
		$posCounter=0;
		$pdf->AddPage();
		$tmpY=$arrPDFConfig['restartAtY'];
		$pdf->posTableHeadlines($tmpY+5, $booShowDiscountCol);
		$tmpY = $pdf->GetY()+2;
		
		$tmpY += 2;
		
	}

	if ($value['headline'] == 1){
		
		$pdf->SetFont($arrPDFConfig['font'], 'B', $arrPDFConfig['font_size']);		
		
		if ($posCounter == 0) $pdf->setXY(40, $tmpY-3); 
		else $pdf->setXY(40, $tmpY+2); 
		
		$pdf->MultiCell(160, 5, $pdf->pdfText($value['vars_pos_txt']),0,'L');
		
		$endeY = $pdf->GetY();		
		$pdf->SetFont($arrPDFConfig['font'], '', $arrPDFConfig['font_size']);
		
		$colorCounter = 1;
		
	
	} else {
		
		// Alternierenden Hintergrund eindrucken
		
		if ($colorCounter%2 != 0){
			$pdf->SetFillColor(230,230,230);
			$pdf->Rect(15,$tmpY-3,188,($zeilen*5)+1,'F');
		}			
		
		
		// Menge & Einheit
		
		$pdf->SetFont($arrPDFConfig['font'], '', $arrPDFConfig['font_size']);		
		$pdf->setXY(12, $tmpY);
		$pdf->Cell(25, 0, $pdf->pdfText($value['quantity']).' '.$value['unit'], 0, 0, 'R');
		
		
		
		// Positionstext
		
		$pdf->setXY(40, $tmpY-2.5); 
		$pdf->MultiCell(130, 5, $pdf->pdfText($value['vars_pos_txt']),0,'L');
		$endeY = $pdf->GetY();
		
		
	}
	
	$posCounter++;
	$colorCounter++;

	
	
}
	

if (($endeY+35) > $arrPDFConfig['limitToY']){ // Checken ob die nächsten Zeilen noch auf die Seite passen
	$pdf->AddPage();
	$endeY = $arrPDFConfig['restartAtY'];
} 

$tmpY = $endeY+3;

// Linie

$tmpY = $pdf->GetY()+2;
$pdf->SetLineWidth(0.25);
$pdf->Line(15,$tmpY+2.5,203,$tmpY+2.5);

// Rechnungsabschlusstext


if ($abschlusstext != ''){
	
	$endeY = $pdf->GetY()+6;
	
	if (true == $arrPDFConfig['bc_show']){
		$intRowCount = $pdf->WordWrap($pdf->pdfText($abschlusstext), 155);	
	} else {
		$intRowCount = $pdf->WordWrap($pdf->pdfText($abschlusstext), 170);	
	}
	
	if (($intRowCount*5)+$endeY > $arrPDFConfig['limitToY']){ // Checken ob der kommende Text noch auf die Seite passt
		$pdf->AddPage(); 
		$endeY=$arrPDFConfig['restartAtY'];
	} 
	
	$pdf->SetXY($arrPDFConfig['offsetX'],$endeY);
	$pdf->SetFont($arrPDFConfig['font'], '', $arrPDFConfig['font_size'] );
	
	if (true == $arrPDFConfig['bc_show']){	
		$pdf->MultiCell(155,5,$pdf->pdfText($abschlusstext),0,'L');
	} else {
		$pdf->MultiCell(170,5,$pdf->pdfText($abschlusstext),0,'L');	
	}
	
}	





// Platzhalter für Gesamtzahlen ersetzen (werden nun manuell ersetzt - dadurch rechtsbündig)

// bis rev.812, fpdf funktion
# $pdf->AliasNbPages('{nb}');

// ab rev813, manuell durchlaufen
	$pdf->SetAutoPageBreak(false);
	$intLastPage = $pdf->PageNo();
	
	for ($i=1; $i<=$intLastPage; $i++){
		$pdf->page = $i;
		$pdf->SetXY(175,$pdf->intPageCountYPos);
		$pdf->Cell(20, 0, $i.'/'.$intLastPage, 0, 0, 'R' );
		$pdf->page = $intLastPage;
	}


// PDF Datei schreiben
/*
if ($booBlanko) $pdf->Output($savetoblanko,'F');
else  $pdf->Output($saveto,'F');*/
print_R($pdf->Output());

// Reset für den nächsten Durchgang (blanko modus)

unset($tmpY, $endeY, $pageCarrLineTotal, $intLastPage, $txtTax, $booFirstRun);