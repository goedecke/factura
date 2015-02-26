<?php
class PDF extends FPDF
{
// Columna actual
var $col = 0;
// Ordenada de comienzo de la columna
var $y0;

function Header()
{
	global $data;
	// Cabacera


	$this->SetFont('Arial','B',15);
	//Titulo de Factura
	$this->SetXY(0, 0);
	$this->SetDrawColor(191,81,80);
	$this->SetFillColor(191,81,80);
	$this->SetTextColor(255,255,255);
	$this->SetLineWidth(1);
	$this->Cell(100,9,utf8_decode('Factura Electrónica (CFDI)'),1,1,'C',true);
	$this->Ln(10);


	$this->SetFont('Arial','B',10);
	$this->SetXY(101, 0);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(115,5,'Folio fiscal:',1,1,'R',true);
	$this->Ln(10);

	$this->SetFont('Arial','',12);
	$this->SetXY(101, 5);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(114,4.5,$data['TimbreFiscalDigital']['UUID'],1,1,'R',true);   //Folio Fiscal
	$this->Ln(10);


	$this->SetFont('Arial','B',10);
	$this->SetXY(101, 10);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(115,5,'No. de Serie del Certificado del CSD:',1,1,'R',true);
	$this->Ln(10);

	$this->SetFont('Arial','',12);
	$this->SetXY(101, 15);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(114,4.5,@$data['Comprobante']['noCertificado'],1,1,'R',true);   //No. Certidicado
	$this->Ln(10);


$this->SetFont('Arial','B',10);
	$this->SetXY(101, 20);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(115,5,utf8_decode('Lugar y Fecha de Expedición:'),1,1,'R',true);
	$this->Ln(10);

	$this->SetFont('Arial','B',8);
	$this->SetXY(101, 25);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(114,4.5,$data['Comprobante']['LugarExpedicion'],1,1,'R',true);   //No. Certidicado
	$this->Ln(10);


	$this->SetFont('Arial','B',8);
	$this->SetXY(101, 30);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(114,4.5,$data['Comprobante']['fecha'],1,1,'R',true);   //No. Certidicado
	$this->Ln(10);



	// Información del Emisor
	$this->SetFont('Arial','B',9);
	$this->SetXY(0, 10);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(100,5,'Emisor:',1,1,'L',true);
	$this->Ln(10);

	//RFC
	$this->SetFont('Arial','B',9);
	$this->SetXY(0, 14);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"RFC: {$data['Emisor']['rfc']}",1,1,'L',true);  //RFC
	$this->Ln(10);



	//Nombre
	$this->SetFont('Arial','',9);
	$this->SetXY(0, 18);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"{$data['Emisor']['nombre']}",1,1,'L',true);  //RFC
	$this->Ln(10);


	//Direccion
	$this->SetFont('Arial','',9);
	$this->SetXY(0, 22);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"{$data['Emisor']['calle']}, #{$data['Emisor']['noExterior']} ".@$data['Emisor']['noInterior'],1,1,'L',true);  //RFC
	$this->Ln(10);

	//Colonia
	$this->SetFont('Arial','',9);
	$this->SetXY(0, 26);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"{$data['Emisor']['localidad']}, C.P. {$data['Emisor']['codigoPostal']}",1,1,'L',true);  //RFC
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','',9);
	$this->SetXY(0, 30);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"{$data['Emisor']['municipio']}, {$data['Emisor']['estado']}, {$data['Emisor']['pais']}",1,1,'L',true);  //RFC
	$this->Ln(10);


		//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(0, 35);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"Regimen Fiscal",1,1,'L',true);  //RFC
	$this->Ln(10);


		//Colonia
	$this->SetFont('Arial','',9);
	$this->SetXY(0, 40);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"{$data['RegimenFiscal']['Regimen']}",1,1,'L',true);  //RFC
	$this->Ln(10);

	//RECEPTOR
	$this->SetDrawColor(191,81,80);
	$this->SetLineWidth(1);
	$this->Line(101.5, 35, 215, 35);
	// Información del receptor

	$this->SetFont('Arial','B',10);
	$this->SetXY(101, 35);

	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(115,5,'Receptor:',1,1,'L',true);
	$this->Ln(10);

	//RFC
	$this->SetFont('Arial','B',9);
	$this->SetXY(101, 40);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(110,5,"RFC: {$data['Receptor']['rfc']}",1,1,'L',true);  //RFC
	$this->Ln(10);



	//Nombre
	$this->SetFont('Arial','',9);
	$this->SetXY(101, 44);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"{$data['Receptor']['nombre']}",1,1,'L',true);  //RFC
	$this->Ln(10);


	//Direccion
	$this->SetFont('Arial','',9);
	$this->SetXY(101, 48);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"{$data['Receptor']['calle']}, #{$data['Receptor']['noExterior']} {$data['Receptor']['noInterior']}",1,1,'L',true);  //RFC
	$this->Ln(10);

	//Colonia
	$this->SetFont('Arial','',9);
	$this->SetXY(101, 52);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,((@$data['Receptor']['colonia']=='')?'':$data['Receptor']['colonia'].', ')."C.P. {$data['Receptor']['codigoPostal']}",1,1,'L',true);  //RFC
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','',9);
	$this->SetXY(101, 56);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(100,5,"{$data['Receptor']['municipio']}, {$data['Receptor']['estado']}, {$data['Receptor']['pais']}",1,1,'L',true);  //RFC
	$this->Ln(10);



}

function Footer()
{

	global $data;
	$this->SetFont('Arial','B',9);
	$this->SetXY(1, 170);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(143,5,'Cantidad con letra:',1,1,'L',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(1, 175);
	$this->SetDrawColor(225,225,225);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(1);
	$this->MultiCell(143,5,"( ".num2letras($data['Comprobante']['total'])." )",0,'L',true);  //RFC
	$this->Ln(10);


	global $data;
	$this->SetFont('Arial','B',9);
	$this->SetXY(1, 180);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(143,5,@$data['Comprobante']['formaDePago'],1,1,'L',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(1, 185);
	$this->SetDrawColor(225,225,225);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(1);
	$this->MultiCell(143,5,"Metodo de Pago: ".@$data['Comprobante']['metodoDePago'],0,'L',true);  //RFC
	$this->Ln(10);

	//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(1, 185);
	$this->SetDrawColor(225,225,225);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(1);
	$this->MultiCell(143,5,"Metodo de Pago: ".@$data['Comprobante']['metodoDePago'],0,'L',true);  //RFC
	$this->Ln(10);




	$this->SetFont('Arial','B',9);
	$this->SetXY(145, 170);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(30,5,'Subtotal:',1,1,'R',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(175, 170);
	$this->SetDrawColor(225,225,225);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(1);
	$this->Cell(30,5,money_format('$%i',@$data['Comprobante']['subTotal']),0,1,'R',true);  //RFC
	$this->Ln(10);


	$this->SetFont('Arial','B',9);
	$this->SetXY(145, 175);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(30,5,'Descuento:',1,1,'R',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(175, 175);
	$this->SetDrawColor(225,225,225);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(1);
	$this->Cell(30,5,money_format('$%i',@$data['Comprobante']['descuento']),0,1,'R',true);  //RFC
	$this->Ln(10);

	$this->SetFont('Arial','B',9);
	$this->SetXY(145, 180);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(30,5,'IVA ('.number_format(@$data['Traslado']['tasa'],0).'%):',1,1,'R',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(175, 180);
	$this->SetDrawColor(225,225,225);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(1);
	$this->Cell(30,5,money_format('$%i',@$data['Traslado']['importe']),0,1,'R',true);  //RFC
	$this->Ln(10);

	$this->SetFont('Arial','B',9);
	$this->SetXY(145, 185);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(30,5,'ISR Retenido:',1,1,'R',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(175, 185);
	$this->SetDrawColor(225,225,225);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(1);
	$this->Cell(30,5,money_format('$%i',"0"),0,1,'R',true);  //RFC
	$this->Ln(10);

	$this->SetFont('Arial','B',9);
	$this->SetXY(145, 190);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(30,5,'IVA Retenido:',1,1,'R',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(175, 190);
	$this->SetDrawColor(225,225,225);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(1);
	$this->Cell(30,5,money_format('$%i',"0"),0,1,'R',true);  //RFC
	$this->Ln(10);

	$this->SetFont('Arial','B',9);
	$this->SetXY(145, 195);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(30,5,'Total:',1,1,'R',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','B',9);
	$this->SetXY(175, 195);
	$this->SetDrawColor(225,225,225);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(1);
	$this->Cell(30,5,money_format('$%i',@$data['Comprobante']['total']),0,1,'R',true);  //RFC
	$this->Ln(10);




	$this->SetFont('Arial','B',9);
	$this->SetXY(43, 200);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(215.5,5,'Sello Digital del CFDI:',1,1,'L',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','',8);
	$this->SetXY(45, 205);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->MultiCell(0,4,@$data['sellocfd'],0,'T','C',true);  //RFC
	$this->Ln(10);





	$this->SetFont('Arial','B',9);
	$this->SetXY(43, 215);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(215.5,5,'Sello SAT:',1,1,'L',true);
	$this->Ln(10);


	//Colonia
	$this->SetFont('Arial','',8);
	$this->SetXY(45, 220);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->MultiCell(0,4,@$data['sellocfd'],0,'T','C',true);  //RFC
	$this->Ln(10);


	$this->SetFont('Arial','B',9);
	$this->SetXY(43, 230);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(215.5,5,utf8_decode('Cadena Original del complemento de certificación digital del SAT:'),1,1,'L',true);
	$this->Ln(10);

	$original = "||1.0|9B090610-3F15-417A-A1B0-6CF83939DA53|2015-02-08T11:23:40|KnjqSjLIt4M/BM6GgqgXn/IitYnrP6jP3843o5zFTl47C53daZd279Wx42WcyKYpD1G3cnOEcBQpn8khSdFwMLFSaqVIS/Olu4KlgtR5Ii70yXfDB/6Pzx1GHL7kjYAjHa8Les3GQGaBpZQMs1UM6aL8zkh7IVrUIZplAZEGbNA=|00001000000202865018||";
	//Colonia
	$this->SetFont('Arial','',8);
	$this->SetXY(45, 235);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->MultiCell(0,4,"$original",0,'T','C',true);  //RFC
	$this->Ln(10);


	$this->SetFont('Arial','B',9);
	$this->SetXY(0, 250);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(225,225,225);
	$this->SetTextColor(191,81,80);
	$this->SetLineWidth(0);
	$this->Cell(215.5,5,utf8_decode('Este documento es una representación impresa de un cfdi'),1,1,'C',false);
	$this->Ln(10);

    $qrcode = new QRcode($original, 'L'); // error level : L, M, Q, H
    $qrcode->displayFPDF($this, 1, 205, 40);


	//RECEPTOR
	$this->SetDrawColor(191,81,80);
	$this->SetLineWidth(1);
	$this->Line(1, 200, 215, 200);
	// Información del receptor

	//RECEPTOR
	$this->SetDrawColor(191,81,80);
	$this->SetLineWidth(1);
	$this->Line(1, 258, 215, 258);


	//Colonia
	$this->SetFont('Arial','B',6);
	$this->SetXY(0, 260);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(0,4,"HERRAMIENTASCONTABLES.COM | CUITLAHUAC NO. 537 INT. 12 | COL. ANALCO | GUADALAJARA, JALISCO | MEXICO",1,1,'C',true);  //RFC
	$this->Ln(10);
		//Colonia
	$this->SetFont('Arial','B',6);
	$this->SetXY(0, 263);
	$this->SetDrawColor(255,255,255);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(0);
	$this->Cell(0,4,"TEL. (33) 12 10 1985 | E-MAIL: CONTACTO@HERRAMIENTASCONTABLES.COM",1,1,'C',true);  //RFC
	$this->Ln(10);

	// Pie de página
	$this->SetY(-15);
	$this->SetFont('Arial','I',8);
	$this->SetTextColor(128);
	$this->Cell(0,10,utf8_decode('Página '.$this->PageNo()),0,0,'C');
}

function cabezera($header){

	$this->AddPage();
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(225,225,225);
    $this->SetTextColor(191,81,80);
    $this->SetDrawColor(225,225,225);
    $this->SetLineWidth(0);
    $this->SetFont('Arial','B',12);
    // Cabecera
//    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    for($i=0;$i<count($header);$i++){
    		if ($header[$i] == 'cantidad'){
    			$w[$i] = 25;
	        	$this->Cell($w[$i] ,6,'Cant.',1,0,'C',true);
    		} else if ($header[$i]== 'unidad'){
    			$w[$i] = 30;
	        	$this->Cell($w[$i] ,6,'Unidad',1,0,'C',true);
    		} else if ($header[$i] == 'descripcion'){
    			$w[$i] = 80;
	        	$this->Cell($w[$i] ,6,'Descipcion',1,0,'C',true);
    		} else if ($header[$i] == 'valorUnitario'){
    			$w[$i] = 30;
	        	$this->Cell($w[$i] ,6,'Unitario',1,0,'C',true);
    		} else if ($header[$i] == 'importe'){
    			$w[$i] = 30;
	        	$this->Cell($w[$i],6,'Importe',1,0,'C',true);
    		} 

        }
    $this->Ln();
}

function FancyTable($header, $data)
{
	$this->cabezera($header);
    // Datos
    $fill = false;
    $i = 0;
    $conceptos = 0;
    for ($i=0;$i<count($data);$i++){
    	$d =0;
	    foreach($data[$i] as $key => $row)
    	{

    // Restauración de colores y fuentes
    $this->SetFillColor(225,225,225);
    $this->SetTextColor(0,0,0);
    $this->SetFont('');
    		if ($key == 'cantidad'){
	        	$this->Cell(25,6,$row,'LR',0,'L',$fill);
    		} else if ($key == 'unidad'){
	        	$this->Cell(30,6,$row,'LR',0,'L',$fill);
    		} else if ($key == 'descripcion'){
	        	$this->Cell(80,6,$row,'LR',0,'L',$fill);
    		} else if ($key == 'valorUnitario'){
		        $this->Cell(30,6,money_format('$%i',$row),'LR',0,'R',$fill);
    		} else if ($key == 'importe'){
		        $this->Cell(30,6,money_format('$%i',$row),'LR',0,'R',$fill);
	    	} else if ($key == 'cantidad'){
	        	$this->Cell(30,6,$row,'LR',0,'L',$fill);
    		} 

	        $d++;
	    }	
	        $this->Ln();
	        $fill = !$fill;
	    	if ($conceptos == 15){
    			$this->cabezera($header);
    			$conceptos = 0;
    		}
    	    $conceptos++;
	}
	    // Línea de cierre
    //$this->Cell(array_sum($w),0,'','T');
}

function AcceptPageBreak()
{
	// Método que acepta o no el salto automático de página
	if($this->col<2)
	{
		// Ir a la siguiente columna
		$this->SetCol($this->col+1);
		// Establecer la ordenada al principio
		$this->SetY($this->y0);
		// Seguir en esta página
		return false;
	}
	else
	{
		// Volver a la primera columna
		$this->SetCol(0);
		// Salto de página
		return true;
	}
}

}

?>