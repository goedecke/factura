<?php



/*! 
  @function num2letras () 
  @abstract Dado un n?mero lo devuelve escrito. 
  @param $num number - N?mero a convertir. 
  @param $fem bool - Forma femenina (true) o no (false). 
  @param $dec bool - Con decimales (true) o no (false). 
  @result string - Devuelve el n?mero escrito en letra. 

*/ 
function num2letras($num, $fem = false, $dec = true) { 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 

   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 
   
   //Zi hack
   $float=explode('.',$num);
   $num=$float[0];

   $num = trim((string)@$num); 
   if (@$num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while (@$num[0] == '0') $num = substr($num, 1); 
   if (@$num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 

      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 

            $ent .= $n; 
      }else 

         break; 

   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'as'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 
         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . '?n'; 
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   //Zi hack --> return ucfirst($tex);
   $end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
   return $end_num; 
} 



function getpath($qry) {
global $xp;
$prm = array();
$nodelist = $xp->query($qry);
foreach ($nodelist as $tmpnode)  {
    $prm[] = trim($tmpnode->nodeValue);
    }
$ret = (sizeof($prm)<=1) ? @$prm[0] : $prm;
return($ret);
}




	function _getCFDI($field){
		global $data, $texto;
		$patron = "<cfdi:{$field} [\s\S]*?[\s\S]*?\ />";
		preg_match($patron, $texto, $coincidencias);
		$patron = "/(\S+)=[\"']?((?:.(?![\"']?\s+(?:\S+)=|[>\"']))+.)[\"']?/";
		preg_match_all($patron, @$coincidencias[0], $res);
			for($i=0; $i < count($res[1]);$i++){
				$data[$field][$res[1][$i]] = utf8_decode($res[2][$i]);
			}
	}

	function _getTFD($field){
		global $data, $texto;
		$patron = "<tfd:{$field} [\s\S]*?[\s\S]*?\ />";
		preg_match($patron, $texto, $coincidencias);
		$patron = "/(\S+)=[\"']?((?:.(?![\"']?\s+(?:\S+)=|[>\"']))+.)[\"']?/";

		preg_match_all($patron, $coincidencias[0], $res);
			for($i=0; $i < count($res[1]);$i++){
				$data[$field][$res[1][$i]] = utf8_decode($res[2][$i]);
			}
	}

	function _getConceptos(){
		global $data, $texto;
		$patron = "<cfdi:Concepto [\s\S]*?[\s\S]*?\ />";
		preg_match_all($patron, $texto, $coincidencias);
		$patron = "/(\S+)=[\"']?((?:.(?![\"']?\s+(?:\S+)=|[>\"']))+.)[\"']?/";
		for($d=0;$d<count($coincidencias[0]);$d++){
			preg_match_all($patron, $coincidencias[0][$d], $res);
				for($i=0; $i < count($res[1]);$i++){
					$data['Concepto'][$d][$res[1][$i]] = utf8_decode($res[2][$i]);
				}
			}
	}

	function _getdata($field){
		global $data;
		$value = getpath("//@".$field);
		if (count($value) == 2){
		    $data['emisor'][$field] = utf8_decode($value[0]);
		    $data['receptor'][$field] = utf8_decode($value[1]);
	    } else {
		    if (is_array($value)){
		    	 $data[$field] = $value[0];
		    	} else {
					$data[$field] = $value;
		    	}
	    } 
    }






// }}} 
// {{{ Valida_XSD
function valida_xsd() {
    /*
     * Todos los archivos que se requieren para hacer la validacion
     * fueron descargados del portal del SAT pero los tengo localmente
     * almacenados en mi maquina para que las validaciones sean mas rapidas.
     * Ademas el archivo prinicpal cfdv32.xsd esta 'un poco' modifcado para
     * que importe los complementos
     *
     * La version de mi maquina los pueden obtener de la misma URL
     *
     * http://www.lacorona.com.mx/fortiz/sat/cfdv32.xsd
     * http://www.lacorona.com.mx/fortiz/sat/ecc.xsd
     * http://www.lacorona.com.mx/fortiz/sat/...
     *
     * [dev@www sat]$ ls *xsd
     * Divisas.xsd                   cfdv3.xsd              implocal.xsd
     * TimbreFiscalDigital.xsd       cfdv32.xsd             leyendasFisc.xsd
     * TuristaPasajeroExtranjero.xsd cfdv32complemento.xsd  nomina.xsd
     * cfdiregistrofiscal.xsd        cfdv3complemento.xsd   nomina11.xsd
     * cfdv2.xsd                     cfdv3tfd.xsd           pfic.xsd
     * cfdv22.xsd                    detallista.xsd         spei.xsd
     * cfdv22complemento.xsd         donat11.xsd            terceros11.xsd
     * cfdv2complemento.xsd          ecc.xsd                ventavehiculos.xsd
     * cfdv2psgecfd.xsd              iedu.xsd
     *
     * */
global $data, $xml,$texto;
libxml_use_internal_errors(true);   // Gracias a Salim Giacoman
if ($data['tipo']=="retenciones") {
    switch ($data['version']) {
      case "1.0":
        echo "Version 1.0 Retenciones<br>";
        $ok = $xml->schemaValidate("retencionpagov1.xsd");
        break;
      default:
        $ok = false;
        echo "Version invalida $tipo ".$data['version']."<br>";
    }
} else {
    switch ($data['version']) {
      case "2.0":
        echo "Version 2.0 CFD<br>";
        $ok = $xml->schemaValidate("cfdv2complemento.xsd");
        break;
      case "2.2":
        echo "Version 2.2 CFD<br>";
        $ok = $xml->schemaValidate("cfdv22complemento.xsd");
        break;
      case "3.0":
        echo "Version 3.0 (CFDI)<br>";
        $ok = $xml->schemaValidate("cfdv3complemento.xsd");
        break;
      case "3.2":
        echo "Version 3.2 CFDI<br>";
        $ok = $xml->schemaValidate("cfdv32.xsd");
        break;
      default:
        $ok = false;
        echo "Version invalida $tipo ".$data['version']."<br>";
    }
}
if ($ok) {
    echo "<h3>Esquema valido</h3>";
} else {
    echo "<h3>Estructura contra esquema incorrecta</h3>";
    display_xml_errors(); 
}
echo "<hr>";
}
// }}} Valida XSD
// {{{ Valida Sello
function valida_sello() {
    /*
     * Todos los archivos que se requieren para generar la cadena original
     * fueron descargados del portal del SAT pero los tengo localmente
     * almacenados en mi maquina para que el proceso sea mas rapido.
     *
     * Todos los archivos estan modificacion por el numero de version 2 a 1,
     * para que no mande warning PHP
     *
     * La version de mi maquina los pueden obtener de la misma URL
     *
     * http://www.lacorona.com.mx/fortiz/sat/cadenaoriginal_TFD_1_0.xslt
     * http://www.lacorona.com.mx/fortiz/sat/ecc.xslt
     * http://www.lacorona.com.mx/fortiz/sat/...
     *
     * [dev@www sat]$ ls *xslt
     * Divisas.xslt                   cfdiregistrofiscal.xslt  nomina11.xslt
     * TuristaPasajeroExtranjero.xslt detallista.xslt          pfic.xslt
     * cadenaoriginal_2_0.xslt        donat11.xslt             spei.xslt
     * cadenaoriginal_2_2.xslt        ecc.xslt                 terceros11.xslt
     * cadenaoriginal_3_0.xslt        iedu.xslt                utilerias.xslt
     * cadenaoriginal_3_2.xslt        implocal.xslt          ventavehiculos.xslt
     * cadenaoriginal_TFD_1_0.xslt    leyendasFisc.xslt
     *
     *
     * */
global $data, $xml;

$xsl = new DOMDocument;
if ($data['tipo']=="retenciones") {
    switch ($data['version']) {
      case "1.0":
          $xsl->load('retenciones.xslt');
          $algo =OPENSSL_ALGO_SHA1;
          break;
      default:
          echo "version incorrecta ".$data['tipo']." ".$data['version']."\n";
          break;
    }
} else {
    switch ($data['version']) {
      case "2.0":
          $xsl->load('cadenaoriginal_2_0.xslt');
          if (substr($data['fecha'],0,4)<2011) {
              echo "md5 \n";
              $algo = OPENSSL_ALGO_MD5;
          } else {
              echo "sha1 \n";
              $algo =OPENSSL_ALGO_SHA1;
          }
          break;
      case "2.2":
          echo "2.2\n";
          $xsl->load('cadenaoriginal_2_2.xslt');
          echo "sha1 \n";
          $algo = OPENSSL_ALGO_SHA1;
          break;
      case "3.0":
          $xsl->load('cadenaoriginal_3_0.xslt');
          if (substr($data['fecha'],0,4)<2011) {
              echo "md5 \n";
              $algo = OPENSSL_ALGO_MD5;
          } else {
              echo "sha1 \n";
              $algo =OPENSSL_ALGO_SHA1;
          }
          break;
      case "3.2":
          echo "3.2\n";
          $xsl->load('cadenaoriginal_3_2.xslt');
          echo "sha1 \n";
          $algo = OPENSSL_ALGO_SHA1;
          break;
      default:
          echo "version incorrecta ".$data['tipo']." ".$data['version']."\n";
          break;
    }
}

$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); 
$cadena = $proc->transformToXML($xml);
echo "Cadena Original<br><p align=left>$cadena</p><br>";
if ($algo==OPENSSL_ALGO_SHA1) {
    $sha1=sha1($cadena);
    echo "hash sha1=$sha1<br>";
} else {
    $md5=md5($cadena);
    echo "hash md5=$md5<br>";
}

if (!mb_check_encoding($cadena,"utf-8")) {
    echo "<h3>Error no esta en UTF-8!</h3>";
}

/* 
 * El domicilio es opcional, pero si no lo ponemos el xslt del SAT genera 
 * doble pip en el pais ..., dice que el sello es correcto pero los PACs 
 * que validan bien lo rechazan ... 
 * */
$doble = preg_match('/.\|\|./',$cadena);
if ($doble===1) {
    echo "<h3><font color=red>La cadena tiene doble pipes en medio ...</font></h3>";
}
// Primer certificado (o unico) del emisor
// Los demas certificados es del PAC, Timbre, etc.
$pem = (sizeof($data['cert'])<=1) ? $data['cert'] : $data['cert'][0];

$pem = eregi_replace("[\n|\r|\n\r]", '', $pem);
$pem = preg_replace('/\s\s+/', '', $pem); 
// Si no incluye el certificado bajarlo del FTP del sat ....
if (strlen($pem)==0) {
    echo "No incluye certificado interno, descargarlo del FTP del sat ...<br>";

    $pem=get_sat_cert($data['no_cert']);

}

$cert = "-----BEGIN CERTIFICATE-----\n".chunk_split($pem,64)."-----END CERTIFICATE-----\n";
$pubkeyid = openssl_get_publickey(openssl_x509_read($cert));
if (!$pubkeyid) {
    echo "Certificado interno Incorrecto, descargarlo del FTP del sat ...<br>";
    $pem=get_sat_cert($data['no_cert']);
    $cert = "-----BEGIN CERTIFICATE-----\n".chunk_split($pem,64)."-----END CERTIFICATE-----\n";
    $pubkeyid = openssl_get_publickey(openssl_x509_read($cert));

}
$ok = openssl_verify($cadena, 
                     base64_decode($data['sell']), 
                     $pubkeyid, 
                     $algo);
if ($ok == 1) {
    echo "<h3>Sello ok</h3>";
} else {
    echo "<h3>Sello incorrecto</h3>";
    while ($msg = openssl_error_string())
        echo $msg. "\n";
}
openssl_free_key($pubkeyid);
echo "<hr>";
$paso = openssl_x509_parse($cert);
$serial = convierte($paso['serialNumber']);
if ($serial!=$data['no_cert']) {
    echo "Serie reportada ".$data['no_cert']." serie usada $serial<br>";
}

}
// }}} Valida Sello
// {{{ Valida Sello TFD





?>