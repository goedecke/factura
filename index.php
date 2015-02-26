<?php
setlocale(LC_MONETARY, 'es_MX');
require('./include/fpdf.php');
require_once('./include/qrcode.class.php');
require_once('./include/xml2array.php');
require_once('./include/makepdf.php');
require_once('./include/funciones.php');



 $texto = file_get_contents("./F3970190-D5AD-49B4-A5BC-E38258926183.xml");    // FACTURA QUE SE MANDARA AL PDF

/////////////////////////////////////////////////////////////////////////////

libxml_use_internal_errors(true);   // Gracias a Salim Giacoman
$xml = new DOMDocument();
$ok = $xml->loadXML($texto);
if (!$ok) {
   display_xml_errors(); 
   die();
}


if (strpos($texto,"cfdi:Comprobante")!==FALSE) {
    $tipo="cfdi";
} elseif (strpos($texto,"<Comprobante")!==FALSE) {
    $tipo="cfd";
} elseif (strpos($texto,"retenciones:Retenciones")!==FALSE) {
    $tipo="retenciones";
} else {
    die("Tipo de XML no identificado ....");
}




////////////////////////////////////////////////////////////////////////////
//   Con XPath obtenemos el valor de los atributos del XML
$xp = new DOMXpath($xml);
$data['tipo']=$tipo;

if ($tipo=="retenciones") {
    $data['rfc'] = utf8_decode(getpath("//@RFCEmisor"));
    $data['rfc_receptor'] = utf8_decode(getpath("//@RFCRecep"));

    // $data['total'] = getpath("//@montoTotOperacion");
    $data['total'] = getpath("//@montoTotGrav");
    if (is_array($data['total'])) $data['total'] = $data['total'][0];
    $data['version'] = getpath("//@Version");
    if (is_array($data['version'])) $data['version'] = $data['version'][0];
    $data['version'] = trim($data['version']);
    if (is_array($data['version'])) $data['version'] = $data['version'][0];
    $data['no_cert'] = getpath("//@NumCert");
    if (is_array($data['no_cert'])) $data['no_cert'] = $data['no_cert'][0];
    $data['no_cert'] = trim($data['no_cert']);
    $data['cert'] = getpath("//@Cert");
    $data['sell'] = getpath("//@Sello");
} else {

	_getCFDI('Comprobante');
	_getCFDI('Emisor');
	_getCFDI('DomicilioFiscal');
	_getCFDI('ExpedidoEn');
	_getCFDI('RegimenFiscal');
	_getCFDI('Receptor');
	_getCFDI('Domicilio');
	_getConceptos();
	_getCFDI('Impuestos');
	_getCFDI('Traslado');
	_getTFD('TimbreFiscalDigital');

$data['version'] = getpath("//@Version");
    if (is_array($data['version'])) $data['version'] = $data['version'][0];
    $data['version'] = trim($data['version']);
    if (is_array($data['version'])) $data['version'] = $data['version'][0];
$data['sellocfd'] = getpath("//@selloCFD");
$data['sellosat'] = getpath("//@selloSAT");
$data['no_cert_sat'] = getpath("//@noCertificadoSAT");
}

$i = 0;
foreach($data['Concepto'] as $key => $val){
	$d=0;
		foreach($val as $k => $v){
			$header[$d] = $k;
			$d++;
			$body[$i][$k] = $v; 
		}
		$i++;
}

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->FancyTable($header, $data['Concepto']);
$pdf->Output();

?>
