<?php
function generacodebarra($path, $idnumerografico, $idfac, $grafbarra)
{
	$fontSize = 10;   // GD1 in px ; GD2 in point
	$marge    = 2;   // between barcode and hri in pixel
	$x        = 165;  // barcode center
	$y        = 30;  // barcode center
	$height   = 60;   // barcode height in 1D ; module size in 2D
	$width    = 1;    // barcode height in 1D ; not use in 2D
	$angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation

	$code     = $idnumerografico; // barcode, of course ;)
	$type     = 'code128';
	$black    = '000000'; // color in hexa

	$im     = imagecreatetruecolor(340, 60);
	$black  = ImageColorAllocate($im, 0x00, 0x00, 0x00);
	$white  = ImageColorAllocate($im, 0xff, 0xff, 0xff);
	$red    = ImageColorAllocate($im, 0xff, 0x00, 0x00);
	$blue   = ImageColorAllocate($im, 0x00, 0x00, 0xff);
	imagefilledrectangle($im, 0, 0, 340, 60, $white);

	$data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);

	// -------------------------------------------------- //
	//                        HRI
	// -------------------------------------------------- //
	if (isset($font)) {
		$box = imagettfbbox($fontSize, 0, $font, $data['hri']);
		$len = $box[2] - $box[0];
		Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
		imagettftext($im, $fontSize, $angle, $x + $xt, $y + $yt, $blue, $font, $data['hri']);
	}


	imagegif($im, $path . $grafbarra . $idfac . '.gif');
	imagedestroy($im);
}

function logcarga($archivo, $linea, $error, $sql_codificado, $DB_gogess)
{

	$sql_codde = base64_encode($sql_codificado);
	$fechahoy = date("Y-m-d H:i:s");
	$insertadata = "INSERT INTO factura_logcarga (logcar_archivo, logcar_linea, logcar_error, logcar_fecha,logcar_sql) VALUES
('" . $archivo . "', '" . $linea . "', '" . $error . "', '" . $fechahoy . "','" . $sql_codde . "');";
	$rs_ok = $DB_gogess->executec($insertadata);
}

function leercampos_xml($xml)
{
	$deco_xml = base64_decode($xml);
	$struct_detail = new SimpleXMLElement($deco_xml);

	$datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente;

	return $datosrr;
}


function leercampos_xmlcompra($xml)
{
	$deco_xml = base64_decode($xml);
	$struct_detail = new SimpleXMLElement($deco_xml);




	$datosrr["numeroAutorizacion"] = $struct_detail->numeroAutorizacion->__toString();
	$datosrr["fechaAutorizacion"] = $struct_detail->fechaAutorizacion->__toString();
	$datosrr["ambiente"] = $struct_detail->ambiente->__toString();


	$struct_comprobante = new SimpleXMLElement($struct_detail->comprobante);

	// print_r($struct_comprobante);
	$datosrr["razonSocial"] = $struct_comprobante->infoTributaria->razonSocial->__toString();
	$datosrr["ruc"] = $struct_comprobante->infoTributaria->ruc->__toString();
	$datosrr["cdruc"] = '04';
	$datosrr["codDoc"] = $struct_comprobante->infoTributaria->codDoc->__toString();
	$datosrr["estab"] = $struct_comprobante->infoTributaria->estab->__toString();
	$datosrr["ptoEmi"] = $struct_comprobante->infoTributaria->ptoEmi->__toString();
	$datosrr["secuencial"] = $struct_comprobante->infoTributaria->secuencial->__toString();
	$datosrr["fechaEmision"] = $struct_comprobante->infoFactura->fechaEmision->__toString();

	$datosrr["facturacmp"] = $datosrr["estab"] . "-" . $datosrr["ptoEmi"] . "-" . $datosrr["secuencial"];


	return $datosrr;
}


function leer_contenido_completo($url)
{

	if (file_exists($url)) {
		//abrimos el fichero, puede ser de texto o una URL
		$fichero_url = fopen($url, "r");
		$texto = "";
		//bucle para ir recibiendo todo el contenido del fichero en bloques de 1024 bytes
		while ($trozo = fgets($fichero_url, 1024)) {
			$texto .= $trozo;
		}
	} else {
		echo 'Archivo no existe...';
	}
	return $texto;
}
function leer_xml($estructurado, $xml, $tcomp, $nauto, $fechaaut, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total, $valornograbado, $pathextrap, $offline_valor)
{
	//echo $pathextrap;


	switch ($tcomp) {
		case "99":
			//RECIBO
			if ($offline_valor == 1) {
				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/recibo_offline.php");
			} else {
				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/recibo.php");
			}
			break;
		case "01":
			//FACTURA
			if ($offline_valor == 1) {
				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/factura_offline.php");
			} else {
				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/factura.php");
			}
			break;

		case "03":
			//LQ

			$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/lq_offline.php");

			break;

		case "04":
			//NOTA DE CREDITO

			$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/notacredito_offline.php");

			break;
		case "05":
			//NOTA DE DEBITO
			if ($offline_valor == 1) {
				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/notadebito_offline.php");
			} else {
				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/notadebito.php");
			}
			break;
		case "06":
			//GUIA DE REMISION
			if ($offline_valor == 1) {

				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/guia_offline.php");
			} else {
				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/guia.php");
			}
			break;
		case "07":
			//COMPROBANTE DE RETENCION
			if ($offline_valor == 1) {

				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/sretencion_offline.php");
			} else {
				$leeplantilla = leer_contenido_completo($pathextrap . "../plantillas/sretencion.php");
			}
			break;
	}


	if ($estructurado == 1) {
		$struct = new SimpleXMLElement($xml);
		//Extraer xml embebido
		//print_r($struct);
		$xmlstr_detail = $struct->comprobante;

		$numeroAutorizacion = $struct->numeroAutorizacion;
		$fechaAutorizacion = $struct->fechaAutorizacion;
		$ambiente = $struct->ambiente;

		$struct_detail = new SimpleXMLElement($xmlstr_detail);
		//envia estructura a generador
		switch ($tcomp) {
			case "99":
				//RECIBO
				$comprobantepdf = lee_recibo($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "01":
				//FACTURA
				$comprobantepdf = lee_factura($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "03":
				//FACTURA
				$comprobantepdf = lee_lq($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "04":
				//NOTA DE CREDITO
				$comprobantepdf = lee_notadecredito($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "05":
				//NOTA DE DEBITO
				$comprobantepdf = lee_notadedebito($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "06":
				//GUIA DE REMISION
				$comprobantepdf = lee_guia($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "07":
				//COMPROBANTE DE RETENCION
				$comprobantepdf = lee_retencion($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
		}
		//envia estructura a generador

	}


	if ($estructurado == 0) {
		$struct_detail = new SimpleXMLElement($xml);
		$numeroAutorizacion = $nauto;
		$fechaAutorizacion = $fechaaut;
		//envia estructura a generador
		switch ($tcomp) {
			case "99":
				//FACTURA
				$comprobantepdf = lee_recibo($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "01":
				//FACTURA
				$comprobantepdf = lee_factura($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "03":
				//FACTURA
				$comprobantepdf = lee_lq($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "04":
				//NOTA DE CREDITO
				$comprobantepdf = lee_notadecredito($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "05":
				//NOTA DE DEBITO
				$comprobantepdf = lee_notadedebito($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);

				break;
			case "06":
				//GUIA DE REMISION
				$comprobantepdf = lee_guia($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
			case "07":
				//COMPROBANTE DE RETENCION
				$comprobantepdf = lee_retencion($struct_detail, $leeplantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total);
				break;
		}
		//envia estructura a generador

	}
	return $comprobantepdf;
}

//-----------------------------------------


function lee_guia($estructura, $plantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total)
{
	global $ambiente_code, $tipoemision_code, $impuesto_code, $tarifaiva_code;
	// print_r($estructura);
	//echo $code_barra;
	$ambiente_val = 0;
	//--infoTributaria--//
	$ambiente = $estructura->infoTributaria->ambiente->__toString();
	$tipoEmision = $estructura->infoTributaria->tipoEmision->__toString();
	$razonSocial = $estructura->infoTributaria->razonSocial;
	$nombreComercial = $estructura->infoTributaria->nombreComercial;
	$ruc = $estructura->infoTributaria->ruc;
	$claveAcceso = $estructura->infoTributaria->claveAcceso;
	$codDoc = $estructura->infoTributaria->codDoc;
	$estab = $estructura->infoTributaria->estab;
	$ptoEmi = $estructura->infoTributaria->ptoEmi;
	$secuencial = $estructura->infoTributaria->secuencial;
	$dirMatriz = $estructura->infoTributaria->dirMatriz;

	$dirEstablecimiento = $estructura->infoGuiaRemision->dirEstablecimiento->__toString();


	$razonSocialDestinatario = $estructura->destinatarios->razonSocialDestinatario;

	//--infoGuiaRemision--//
	// $fechaEmision=$estructura->infoGuiaRemision->fechaEmision->__toString();

	$fechaemisionf = explode(" ", $estructura->infoGuiaRemision->fechaEmision->__toString());
	$separafecha = explode("/", $fechaemisionf[0]);
	$nombremes = "";
	$nombremes = fecha_mes($separafecha[1]);
	$fechaEmision = $separafecha[0] . " - " . $nombremes . " - " . $separafecha[2];

	$rucTransportista = $estructura->infoGuiaRemision->rucTransportista->__toString();



	//--detalles--//

	$numdetalle = count($estructura->destinatarios->destinatario->detalles->detalle);
	//echo $numdetalle;
	//print_r($estructura->detalles->detalle[1]->codigoPrincipal);

	$nporpg = 20;


	//verificaque sea mas de una pagina
	if ($numdetalle > $nporpg) {
		$cantidad_siguientepg = $numdetalle - $nporpg;
		$inicia_en = 2;
		$pgv = 1;
		$campo_pg[1] = $nporpg - 1;
		$nporpg = 30;
		$acumulador_mp = 20;
	} else {
		$cantidad_siguientepg = $numdetalle;
		$inicia_en = 1;
	}
	//verificaque sea mas de una pagina


	$npaginas = $cantidad_siguientepg / $nporpg;

	$numero_er = explode(".", $npaginas);
	$numero_entero = $numero_er[0];

	if ($numero_er[1] > 0) {
		$numtpg = $numero_er[0] + 1;
		$numero_entero = $numero_er[0] + 1;
	}
	//$campo_pg[0]=1;

	for ($pgv = $inicia_en; $pgv <= $numero_entero; $pgv++) {
		//$campo_pg[$pgv]=$campo_pg[$pgv]+$nporpg-1;
		$acumulador_mp = $acumulador_mp + $nporpg - 1;
		$campo_pg[$pgv] = $acumulador_mp;
	}

	$recidue_final = $numdetalle - $campo_pg[$pgv];
	//$campo_pg[$pgv+1]=$recidue_final;

	$fin_pagina = $recidue_final - 1;
	//print_r($campo_pg);

	$suma = 0;
	$sumatotal = 0;
	$ipgv = 1;
	$numfilas = 1;
	for ($id = 0; $id < $numdetalle; $id++) {

		//----------------------------------
		if ($id == 0) {
			$griddata .= '<table width="747px"   >
           
             <tr>
			 		<td class="css_bordesbarra">#</td> 	   
                 <td class="css_bordesbarra">Cod. Principal</td>         
				 <td class="css_bordesbarra">Descripci&oacute;n</td>
                 <td class="css_bordesbarra">Cant</td>
                 <td class="css_bordesbarra">Cod. Almacen</td> 
			   
             </tr>';
		}
		//---------------------------------------
		if (in_array($id, $campo_pg)) {
			$ipgv++;
			$griddata .= '</table>';
			$griddata .= '<div style="page-break-after: always;" /></div>';
			$griddata .= 'Guia:' . $estab . '-' . $ptoEmi . '-' . $secuencial . ' Raz&oacute;n Social:' . $razonSocialDestinatario . '<table width="747px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 	   
                 <td class="css_bordesbarra">Cod. Principal</td>         
				 <td class="css_bordesbarra">Descripci&oacute;n</td>
                 <td class="css_bordesbarra">Cant</td>
                 <td class="css_bordesbarra">Cod. Almacen</td> 
             </tr>';
		}

		//print_r($estructura->detalles->detalle[$id]->impuestos->impuesto->codigo);
		$descriptxt = stripslashes(htmlentities($estructura->destinatarios->destinatario->detalles->detalle[$id]->descripcion));

		$detalladicionaltxt = stripslashes(htmlentities($estructura->destinatarios->destinatario->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));



		if (!(trim($detalladicionaltxt))) {

			$detalladicionaltxt = '';
		}

		$griddata .= '<tr>              
               <td bgcolor="#FFFFFF" class="css_bordes">' . $numfilas . '</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">' . $estructura->destinatarios->destinatario->detalles->detalle[$id]->codigoInterno . '</td>
			    <td bgcolor="#FFFFFF" class="css_bordes_d">' . $descriptxt . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->destinatarios->destinatario->detalles->detalle[$id]->cantidad->__toString(), 3, ".", "") . '</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">' . $detalladicionaltxt . '</td>
			 
             </tr>';
		$numfilas = $numfilas + 1;
		if ($fin_pagina == $id) {
			//----------------------
			$griddata .= '</table>';
			//----------------------
		}
	}



	//--infoAdicional--//
	$comprobante_code["01"] = "FACTURA";
	$comprobante_code["04"] = "NOTA DE CR&Eacute;DITO";
	$comprobante_code["05"] = "NOTA DE D&Eacute;BITO";
	$comprobante_code["06"] = "GU&Iacute;A DE REMISI&Iacute;N";
	$comprobante_code["07"] = "COMPROBANTE DE RETENCI&Oacute;N";


	//--platilla--//
	$razonSocial = stripslashes(htmlentities($razonSocial));
	$condatos = str_replace("-empresa-", $razonSocial, $plantilla);


	if ($dirEstablecimiento) {
		$dirEstablecimiento = stripslashes(htmlentities($dirEstablecimiento));

		if (date("Y-m-d") > '2017-08-12') {
			$condatos = str_replace("-direccions-", $dirEstablecimiento, $condatos);
		} else {
			$condatos = str_replace("-direccions-", "VIA DAULE KM 8 1/2 BODEGAS JUAN MONTALVO OFC. 5 Y 6", $condatos);
		}
	}

	if ($dirMatriz) {
		$dirMatriz = stripslashes(htmlentities($dirMatriz));
		$condatos = str_replace("-direccion-", $dirMatriz, $condatos);
	}

	$condatos = str_replace("-ruccliente-", $rucTransportista, $condatos);
	$razonSocialTransportista = $estructura->infoGuiaRemision->razonSocialTransportista->__toString();
	$condatos = str_replace("-razonsocial-", $razonSocialTransportista, $condatos);

	$placa = $estructura->infoGuiaRemision->placa->__toString();
	$condatos = str_replace("-placa-", $placa, $condatos);

	$dirEstablecimiento = $estructura->infoGuiaRemision->dirEstablecimiento->__toString();
	$condatos = str_replace("-direccion-", $dirEstablecimiento, $condatos);


	$contribuyenteEspecial = $estructura->infoGuiaRemision->contribuyenteEspecial;
	$obligadoContabilidad = $estructura->infoGuiaRemision->obligadoContabilidad;

	$condatos = str_replace("-especial-", $contribuyenteEspecial, $condatos);
	$condatos = str_replace("-obligado-", $obligadoContabilidad, $condatos);

	$dirPartida = $estructura->infoGuiaRemision->dirPartida->__toString();
	$condatos = str_replace("-partida-", $dirPartida, $condatos);

	$fechaIniTransporte = $estructura->infoGuiaRemision->fechaIniTransporte->__toString();
	$condatos = str_replace("-fechait-", $fechaIniTransporte, $condatos);

	$fechaFinTransporte = $estructura->infoGuiaRemision->fechaFinTransporte->__toString();
	$condatos = str_replace("-fechaft-", $fechaFinTransporte, $condatos);

	$codDocSustento = $estructura->destinatarios->destinatario->codDocSustento->__toString();
	$condatos = str_replace("-comprobante-", $comprobante_code[$codDocSustento], $condatos);

	$numDocSustento = $estructura->destinatarios->destinatario->numDocSustento->__toString();
	$condatos = str_replace("-numfac-", $numDocSustento, $condatos);

	$fechaEmisionDocSustento = $estructura->destinatarios->destinatario->fechaEmisionDocSustento->__toString();
	$condatos = str_replace("-fechaemi-", $fechaEmisionDocSustento, $condatos);


	$numAutDocSustento = $estructura->destinatarios->destinatario->numAutDocSustento->__toString();
	$condatos = str_replace("-nautorizacionf-", $numAutDocSustento, $condatos);


	$motivoTraslado = $estructura->destinatarios->destinatario->motivoTraslado->__toString();
	$condatos = str_replace("-motivo-", $motivoTraslado, $condatos);


	$dirDestinatario = $estructura->destinatarios->destinatario->dirDestinatario->__toString();
	$condatos = str_replace("-destino-", $dirDestinatario, $condatos);

	$identificacionDestinatario = $estructura->destinatarios->destinatario->identificacionDestinatario->__toString();
	$condatos = str_replace("-iddestinatario-", $identificacionDestinatario, $condatos);


	$razonSocialDestinatario = $estructura->destinatarios->destinatario->razonSocialDestinatario->__toString();
	$condatos = str_replace("-napdestinatario-", $razonSocialDestinatario, $condatos);

	$codEstabDestino = $estructura->destinatarios->destinatario->codEstabDestino->__toString();
	$condatos = str_replace("-codigoest-", $codEstabDestino, $condatos);

	$ruta = $estructura->destinatarios->destinatario->ruta->__toString();
	$condatos = str_replace("-ruta-", $ruta, $condatos);


	$condatos = str_replace("-especial-", $contribuyenteEspecial, $condatos);
	$condatos = str_replace("-obligado-", $obligadoContabilidad, $condatos);
	$condatos = str_replace("-rucemp-", $ruc, $condatos);
	$condatos = str_replace("-nfactura-", $estab . "-" . $ptoEmi . "-" . $secuencial, $condatos);
	$condatos = str_replace("-nautorizacion-", $numeroAutorizacion, $condatos);
	$condatos = str_replace("-fechahoraaut-", $fechaAutorizacion, $condatos);
	$valamb = $ambiente;
	$condatos = str_replace("-ambiente-", $ambiente_code[$valamb], $condatos);
	$valemi = $tipoEmision;
	$condatos = str_replace("-emision-", $tipoemision_code[$valemi], $condatos);
	$condatos = str_replace("-claveacceso-", $claveAcceso, $condatos);




	$razonSocialComprador = stripslashes(htmlentities($razonSocialComprador));


	//Lista
	$condatos = str_replace("-lista-", $griddata, $condatos);


	$condatos = str_replace("-logo-", $logotipo_imd, $condatos);
	$condatos = str_replace("-barraclave-", $code_barra, $condatos);




	for ($ib = 0; $ib < count($estructura->infoAdicional->campoAdicional); $ib++) {
		$nombrecampo = $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if ($nombrecampo == 'direccionComprador') {
			$dirclietxt = stripslashes($estructura->infoAdicional->campoAdicional[$ib]->__toString());
			$condatos = str_replace("-dircli-", $dirclietxt, $condatos);
			$dirbandera = 1;
		}
		if ($nombrecampo == 'telefonoComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-telcli-", $dirclietxt, $condatos);
			$telbandera = 1;
		}
		if ($nombrecampo == 'CorreoCliente') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$dirclietxt = str_replace(";", "<br>", $dirclietxt);
			$condatos = str_replace("-emailcli-", $dirclietxt, $condatos);
			$emailbandera = 1;
		}
		if ($nombrecampo == 'Fechaemisionguia') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-fechemisionguia-", $dirclietxt, $condatos);
			$emailbandera = 1;
		}
	}

	if (!($dirbandera)) {
		$condatos = str_replace("-dircli-", "", $condatos);
	}
	if (!($telbandera)) {
		$condatos = str_replace("-telcli-", "", $condatos);
	}
	if (!($emailbandera)) {
		$condatos = str_replace("-emailcli-", "", $condatos);
	}



	return $condatos;
}


//-----------------------------------------


function lee_factura($estructura, $plantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total)
{
	global $ambiente_code, $tipoemision_code, $impuesto_code, $tarifaiva_code, $formapago_code;
	//print_r($estructura);
	$ambiente_val = 0;
	$decimales = 4;
	$acumulador_mp = '';
	//--infoTributaria--//
	$ambiente = $estructura->infoTributaria->ambiente->__toString();
	$tipoEmision = $estructura->infoTributaria->tipoEmision->__toString();
	$razonSocial = $estructura->infoTributaria->razonSocial;
	$nombreComercial = $estructura->infoTributaria->nombreComercial;
	$ruc = $estructura->infoTributaria->ruc;
	$claveAcceso = $estructura->infoTributaria->claveAcceso;
	$codDoc = $estructura->infoTributaria->codDoc;
	$estab = $estructura->infoTributaria->estab;
	$ptoEmi = $estructura->infoTributaria->ptoEmi;
	$secuencial = $estructura->infoTributaria->secuencial;
	$dirMatriz = $estructura->infoTributaria->dirMatriz;

	//--infoFactura--//
	// $fechaEmision=$estructura->infoFactura->fechaEmision->__toString();

	$fechaemisionf = explode(" ", $estructura->infoFactura->fechaEmision->__toString());
	$separafecha = explode("/", $fechaemisionf[0]);
	$nombremes = "";
	$nombremes = fecha_mes($separafecha[1]);
	$fechaEmision = $separafecha[0] . " - " . $nombremes . " - " . $separafecha[2];


	$dirEstablecimiento = $estructura->infoFactura->dirEstablecimiento->__toString();
	$contribuyenteEspecial = $estructura->infoFactura->contribuyenteEspecial;
	$obligadoContabilidad = $estructura->infoFactura->obligadoContabilidad;
	$tipoIdentificacionComprador = $estructura->infoFactura->tipoIdentificacionComprador;
	$razonSocialComprador = $estructura->infoFactura->razonSocialComprador;
	$identificacionComprador = $estructura->infoFactura->identificacionComprador;
	$totalSinImpuestos = $estructura->infoFactura->totalSinImpuestos->__toString();
	$totalDescuento = $estructura->infoFactura->totalDescuento->__toString();

	$numimpuestos = count($estructura->infoFactura->totalConImpuestos->totalImpuesto);
	$valorconiva = '';
	$codigopivavt = '';
	$numfilas = 1;
	for ($ic = 0; $ic < $numimpuestos; $ic++) {


		if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigo == 2) {
			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 3) {
				$tvalorconiva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 2) {
				$tvalorconiva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 4) {
				$tvalorconiva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 0) {
				$tvalorsiniva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}
			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 6) {
				$tvalornogravado = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}


			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 7) {
				$tvalorexentoiva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}
		}
	}

	//forma pagos
	$numpagos = 0;
	$numpagos = count($estructura->infoFactura->pagos->pago);
	$fpago_code = '';
	$fpago_valor = '';
	$pago_platilla = '';
	if ($numpagos > 0) {
		$pago_platilla = '<table width="250"  border="0" align="center" cellpadding="1" cellspacing="1">
          <tr >
            <td class="css_bordes_d" ><p>FORMA DE PAGO</p></td>
            <td class="css_bordes_d" >VALOR</td>
			
          </tr>';

		for ($icp = 0; $icp < $numpagos; $icp++) {
			$fpago_code = '';
			$fpago_valor = '';
			$fpago_plazo = '';
			$fpago_unidad = '';
			$fpago_code = $estructura->infoFactura->pagos->pago[$icp]->formaPago->__toString();
			$fpago_valor = $estructura->infoFactura->pagos->pago[$icp]->total->__toString();

			@$fpago_plazo = $estructura->infoFactura->pagos->pago[$icp]->plazo->__toString();
			@$fpago_unidad = $estructura->infoFactura->pagos->pago[$icp]->unidadTiempo->__toString();

			$pago_platilla .= '<tr >
            <td class="css_bordes_d" >' . $formapago_code[trim($fpago_code)] . '</td>
            <td class="css_bordes_d">' . number_format($fpago_valor, 2, ".", ",") . '</td>
			
          </tr>';
		}
		$pago_platilla .= '</table>';
	}

	//forma pagos	

	//print_r($impuestos_reg);

	$propina = $estructura->infoFactura->propina->__toString();
	$importeTotal = $estructura->infoFactura->importeTotal->__toString();
	$moneda = $estructura->infoFactura->moneda;

	//--detalles--//

	$numdetalle = count($estructura->detalles->detalle);
	//echo $numdetalle;
	//print_r($estructura->detalles->detalle[1]->codigoPrincipal);

	$nporpg = 20;

	//verificaque sea mas de una pagina
	if ($numdetalle > $nporpg) {
		$cantidad_siguientepg = $numdetalle - $nporpg;
		$inicia_en = 2;
		$pgv = 1;
		$campo_pg[1] = $nporpg - 1;
		$nporpg = 26;
		$acumulador_mp = 20;
	} else {
		$cantidad_siguientepg = $numdetalle;
		$inicia_en = 1;
	}
	//verificaque sea mas de una pagina
	//echo $cantidad_siguientepg;

	$npaginas = $cantidad_siguientepg / $nporpg;
	$numero_er = explode(".", $npaginas);
	$numero_entero = $numero_er[0];

	if ($numero_er[1] > 0) {
		$numtpg = $numero_er[0] + 1;
		$numero_entero = $numero_er[0] + 1;
	}
	//$campo_pg[0]=1;

	for ($pgv = $inicia_en; $pgv <= $numero_entero; $pgv++) {
		//$campo_pg[$pgv]=$campo_pg[$pgv]+$nporpg-1;
		@$acumulador_mp = $acumulador_mp + $nporpg - 1;
		@$campo_pg[$pgv] = $acumulador_mp;
	}

	@$recidue_final = $numdetalle - $campo_pg[$pgv];
	//$campo_pg[$pgv+1]=$recidue_final;

	$fin_pagina = $recidue_final - 1;
	//print_r($campo_pg);

	$suma = 0;
	$sumatotal = 0;
	$ipgv = 1;
	for ($id = 0; $id < $numdetalle; $id++) {

		//----------------------------------
		if ($id == 0) {
			$griddata .= '<table width="700px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Atendido por</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
		}
		//---------------------------------------
		if (in_array($id, $campo_pg)) {
			$ipgv++;
			$griddata .= '</table>';
			$griddata .= '<div style="page-break-after: always;" /></div>';
			$griddata .= 'Fac:' . $estab . '-' . $ptoEmi . '-' . $secuencial . ' Raz&oacute;n Social:' . $razonSocialComprador . '<table width="700px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Atendido por</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
		}

		$descriptxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->descripcion));

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = '';
			}
		}
		if (!(trim(@$detalladicionaltxt))) {

			$detalladicionaltxt = '';
		}

		//---------

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = '';
			}
		}
		if (!(trim(@$detalladicionaltxt2))) {

			$detalladicionaltxt2 = 0;
		}

		//-------------------------------------------



		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}


		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}

		$griddata .= '<tr>              
               <td bgcolor="#FFFFFF" class="css_bordes">' . $numfilas . '</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">' . $estructura->detalles->detalle[$id]->codigoPrincipal . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->cantidad->__toString(), $decimales, ".", "") . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes_d">' . $descriptxt . '</td>
			    <td bgcolor="#FFFFFF" class="css_bordes_d">' . @$detalladicionaltxt . '</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->precioUnitario->__toString(), 4, ".", ",") . '</td> 			  
                <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",") . '</td> 
			    <td bgcolor="#FFFFFF" class="css_bordes_d">' . $tarifaiva_code[$estructura->detalles->detalle[$id]->impuestos->impuesto->codigoPorcentaje->__toString()] . '</td>';
		$griddata .= '           
               <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->precioTotalSinImpuesto->__toString(), $decimales, ".", ",") . '</td>
             </tr>';

		$detalladicionaltxt3 = '';
		$detalladicionaltxt = '';
		$detalladicionaltxt2 = '';
		$numfilas = $numfilas + 1;
		if ($fin_pagina == $id) {
			//----------------------
			$griddata .= '</table>';
			//----------------------
		}
	}



	//--infoAdicional--//



	//--platilla--//
	$razonSocial = stripslashes(htmlentities($razonSocial));

	$condatos = str_replace("-empresa-", $razonSocial, $plantilla);


	if ($dirEstablecimiento) {
		$dirEstablecimiento = stripslashes(htmlentities($dirEstablecimiento));


		$condatos = str_replace("-direccions-", $dirEstablecimiento, $condatos);
	}
	if ($dirMatriz) {
		$dirMatriz = stripslashes(htmlentities($dirMatriz));
		$condatos = str_replace("-direccion-", $dirMatriz, $condatos);
	}


	$condatos = str_replace("-especial-", $contribuyenteEspecial, $condatos);
	$condatos = str_replace("-obligado-", $obligadoContabilidad, $condatos);
	$condatos = str_replace("-rucemp-", $ruc, $condatos);
	$condatos = str_replace("-nfactura-", $estab . "-" . $ptoEmi . "-" . $secuencial, $condatos);
	$condatos = str_replace("-nautorizacion-", $numeroAutorizacion, $condatos);
	$condatos = str_replace("-fechahoraaut-", $fechaAutorizacion, $condatos);
	$valamb = $ambiente;
	$condatos = str_replace("-ambiente-", $ambiente_code[$valamb], $condatos);
	$valemi = $tipoEmision;
	$condatos = str_replace("-emision-", $tipoemision_code[$valemi], $condatos);
	$condatos = str_replace("-claveacceso-", $claveAcceso, $condatos);
	$condatos = str_replace("-ruccliente-", $identificacionComprador, $condatos);

	$razonSocialComprador = stripslashes(htmlentities($razonSocialComprador));
	$razonSocialComprador = str_replace("amp;amp;", "amp;", $razonSocialComprador);
	$condatos = str_replace("-razonsocial-", $razonSocialComprador, $condatos);

	$condatos = str_replace("-fechaemision-", $fechaEmision, $condatos);

	$condatos = str_replace("-total-", number_format($importeTotal, 2, ".", ","), $condatos);
	//Lista
	$condatos = str_replace("-lista-", $griddata, $condatos);

	//print_r($tvalorconiva);
	@$sumatotal = $tvalorconiva + $tvalorsiniva + $totalDescuento;
	@$subsinimp = $tvalorconiva + $tvalorsiniva;
	@$condatos = str_replace("-suma-", number_format($sumatotal, 2, ".", ","), $condatos);
	@$condatos = str_replace("-subtotal-", number_format($tvalorconiva, 2, ".", ","), $condatos);

	$condatos = str_replace("-subtotalsiniva-", number_format($tvalorsiniva, 2, ".", ","), $condatos);

	@$condatos = str_replace("-subtotalnograbado-", number_format($tvalornogravado, 2, ".", ","), $condatos);
	@$condatos = str_replace("-subsinimp-", number_format($subsinimp, 2, ".", ","), $condatos);
	@$condatos = str_replace("-subtotalexento-", number_format($tvalorexentoiva, 2, ".", ","), $condatos);


	@$condatos = str_replace("-subtotalexeiva-", number_format($tvalorexentoiva, $decimales, ".", ","), $condatos);
	@$condatos = str_replace("-iva-", number_format($valorivac, 2, ".", ","), $condatos);


	@$condatos = str_replace("-descuento-", number_format($totalDescuento, 2, ".", ","), $condatos);
	@$condatos = str_replace("-logo-", $logotipo_imd, $condatos);
	@$condatos = str_replace("-barraclave-", $code_barra, $condatos);

	//cambio
	$condatos = str_replace("-fpagodespliegue-", $pago_platilla, $condatos);
	//cambio


	$condatos = str_replace("-subtotalsinimp-", $totalSinImpuestos, $condatos);


	if ($codigopivavt == 2) {
		$condatos = str_replace("-ivanum-", "12%", $condatos);
	}

	if ($codigopivavt == 4) {
		$condatos = str_replace("-ivanum-", "15%", $condatos);
	}

	if ($codigopivavt == 3) {
		$condatos = str_replace("-ivanum-", "14%", $condatos);
	}

	if ($codigopivavt == '') {
		$condatos = str_replace("-ivanum-", "", $condatos);
	}

	if ($codigopivavt == 0) {
		$condatos = str_replace("-ivanum-", "", $condatos);
	}

	for ($ib = 0; $ib < count($estructura->infoAdicional->campoAdicional); $ib++) {
		$nombrecampo = $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if ($nombrecampo == 'direccionComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-dircli-", $dirclietxt, $condatos);
			$dirbandera = 1;
		}
		if ($nombrecampo == 'telefonoComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-telcli-", $dirclietxt, $condatos);
			$telbandera = 1;
		}
		if ($nombrecampo == 'CorreoCliente') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));


			$dirclietxt = str_replace(";", "<br>", $dirclietxt);
			$condatos = str_replace("-emailcli-", $dirclietxt, $condatos);
			$emailbandera = 1;
		}

		if ($nombrecampo == 'Tipo') {
			$op1 = "TIPO: " . stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}

		if ($nombrecampo == 'Convenio') {
			$op2 = "CONVENIO: " . stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}

		if ($nombrecampo == 'op3') {
			$op3 = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}

		if ($nombrecampo == 'adicionalfac') {
			$adicionalfac = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}
	}

	@$condatos = str_replace("-op-", $op1 . $op2 . $op3, $condatos);
	@$condatos = str_replace("-adicionalfac-", $adicionalfac, $condatos);


	if (!(@$dirbandera)) {
		$condatos = str_replace("-dircli-", "", $condatos);
	}
	if (!(@$telbandera)) {
		$condatos = str_replace("-telcli-", "", $condatos);
	}
	if (!(@$emailbandera)) {
		$condatos = str_replace("-emailcli-", "", $condatos);
	}

	if (!(@$adicionalfac)) {
		$condatos = str_replace("-adicionalfac-", "", $condatos);
	}


	return $condatos;
}

//RECIBO

function lee_recibo($estructura, $plantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total)
{
	global $ambiente_code, $tipoemision_code, $impuesto_code, $tarifaiva_code, $formapago_code;
	//print_r($estructura);
	$ambiente_val = 0;
	$decimales = 4;
	$acumulador_mp = '';
	//--infoTributaria--//
	$ambiente = $estructura->infoTributaria->ambiente->__toString();
	$tipoEmision = $estructura->infoTributaria->tipoEmision->__toString();
	$razonSocial = $estructura->infoTributaria->razonSocial;
	$nombreComercial = $estructura->infoTributaria->nombreComercial;
	$ruc = $estructura->infoTributaria->ruc;
	$claveAcceso = $estructura->infoTributaria->claveAcceso;
	$codDoc = $estructura->infoTributaria->codDoc;
	$estab = $estructura->infoTributaria->estab;
	$ptoEmi = $estructura->infoTributaria->ptoEmi;
	$secuencial = $estructura->infoTributaria->secuencial;
	$dirMatriz = $estructura->infoTributaria->dirMatriz;

	//--infoFactura--//
	// $fechaEmision=$estructura->infoFactura->fechaEmision->__toString();

	$fechaemisionf = explode(" ", $estructura->infoFactura->fechaEmision->__toString());
	$separafecha = explode("/", $fechaemisionf[0]);
	$nombremes = "";
	$nombremes = fecha_mes($separafecha[1]);
	$fechaEmision = $separafecha[0] . " - " . $nombremes . " - " . $separafecha[2];


	$dirEstablecimiento = $estructura->infoFactura->dirEstablecimiento->__toString();
	$contribuyenteEspecial = $estructura->infoFactura->contribuyenteEspecial;
	$obligadoContabilidad = $estructura->infoFactura->obligadoContabilidad;
	$tipoIdentificacionComprador = $estructura->infoFactura->tipoIdentificacionComprador;
	$razonSocialComprador = $estructura->infoFactura->razonSocialComprador;
	$identificacionComprador = $estructura->infoFactura->identificacionComprador;
	$totalSinImpuestos = $estructura->infoFactura->totalSinImpuestos->__toString();
	$totalDescuento = $estructura->infoFactura->totalDescuento->__toString();

	$numimpuestos = count($estructura->infoFactura->totalConImpuestos->totalImpuesto);
	$valorconiva = '';
	$codigopivavt = '';
	$numfilas = 1;
	for ($ic = 0; $ic < $numimpuestos; $ic++) {


		if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigo == 2) {
			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 3) {
				$tvalorconiva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 2) {
				$tvalorconiva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 4) {
				$tvalorconiva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 0) {
				$tvalorsiniva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}
			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 6) {
				$tvalornogravado = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}


			if ($estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 7) {
				$tvalorexentoiva = $estructura->infoFactura->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}
		}
	}

	//forma pagos
	$numpagos = 0;
	$numpagos = count($estructura->infoFactura->pagos->pago);
	$fpago_code = '';
	$fpago_valor = '';
	$pago_platilla = '';
	if ($numpagos > 0) {
		$pago_platilla = '<table width="250"  border="0" align="center" cellpadding="1" cellspacing="1">
          <tr >
            <td class="css_bordes_d" ><p>FORMA DE PAGO</p></td>
            <td class="css_bordes_d" >VALOR</td>
			
          </tr>';

		for ($icp = 0; $icp < $numpagos; $icp++) {
			$fpago_code = '';
			$fpago_valor = '';
			$fpago_plazo = '';
			$fpago_unidad = '';
			$fpago_code = $estructura->infoFactura->pagos->pago[$icp]->formaPago->__toString();
			$fpago_valor = $estructura->infoFactura->pagos->pago[$icp]->total->__toString();

			@$fpago_plazo = $estructura->infoFactura->pagos->pago[$icp]->plazo->__toString();
			@$fpago_unidad = $estructura->infoFactura->pagos->pago[$icp]->unidadTiempo->__toString();

			$pago_platilla .= '<tr >
            <td class="css_bordes_d" >' . $formapago_code[trim($fpago_code)] . '</td>
            <td class="css_bordes_d">' . number_format($fpago_valor, 2, ".", ",") . '</td>
			
          </tr>';
		}
		$pago_platilla .= '</table>';
	}

	//forma pagos	

	//print_r($impuestos_reg);

	$propina = $estructura->infoFactura->propina->__toString();
	$importeTotal = $estructura->infoFactura->importeTotal->__toString();
	$moneda = $estructura->infoFactura->moneda;

	//--detalles--//

	$numdetalle = count($estructura->detalles->detalle);
	//echo $numdetalle;
	//print_r($estructura->detalles->detalle[1]->codigoPrincipal);

	$nporpg = 25;

	//verificaque sea mas de una pagina
	if ($numdetalle > $nporpg) {
		$cantidad_siguientepg = $numdetalle - $nporpg;
		$inicia_en = 2;
		$pgv = 1;
		$campo_pg[1] = $nporpg - 1;
		$nporpg = 26;
		$acumulador_mp = 20;
	} else {
		$cantidad_siguientepg = $numdetalle;
		$inicia_en = 1;
	}
	//verificaque sea mas de una pagina
	//echo $cantidad_siguientepg;

	$npaginas = $cantidad_siguientepg / $nporpg;
	$numero_er = explode(".", $npaginas);
	$numero_entero = $numero_er[0];

	if ($numero_er[1] > 0) {
		$numtpg = $numero_er[0] + 1;
		$numero_entero = $numero_er[0] + 1;
	}
	//$campo_pg[0]=1;

	for ($pgv = $inicia_en; $pgv <= $numero_entero; $pgv++) {
		//$campo_pg[$pgv]=$campo_pg[$pgv]+$nporpg-1;
		@$acumulador_mp = $acumulador_mp + $nporpg - 1;
		@$campo_pg[$pgv] = $acumulador_mp;
	}

	@$recidue_final = $numdetalle - $campo_pg[$pgv];
	//$campo_pg[$pgv+1]=$recidue_final;

	$fin_pagina = $recidue_final - 1;
	//print_r($campo_pg);

	$suma = 0;
	$sumatotal = 0;
	$ipgv = 1;
	for ($id = 0; $id < $numdetalle; $id++) {

		//----------------------------------
		if ($id == 0) {
			$griddata .= '<table width="700px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
		}
		//---------------------------------------
		if (in_array($id, $campo_pg)) {
			$ipgv++;
			$griddata .= '</table>';
			$griddata .= '<div style="page-break-after: always;" /></div>';
			$griddata .= 'Fac:' . $estab . '-' . $ptoEmi . '-' . $secuencial . ' Raz&oacute;n Social:' . $razonSocialComprador . '<table width="747px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
		}

		$descriptxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->descripcion));

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = '';
			}
		}
		if (!(trim(@$detalladicionaltxt))) {

			$detalladicionaltxt = '';
		}

		//---------

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = '';
			}
		}
		if (!(trim(@$detalladicionaltxt2))) {

			$detalladicionaltxt2 = 0;
		}

		//-------------------------------------------



		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}


		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}

		$griddata .= '<tr>              
               <td bgcolor="#FFFFFF" class="css_bordes">' . $numfilas . '</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">' . $estructura->detalles->detalle[$id]->codigoPrincipal . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->cantidad->__toString(), $decimales, ".", "") . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes_d">' . $descriptxt . '</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->precioUnitario->__toString(), 4, ".", ",") . '</td> 			  
                <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",") . '</td> 
			    <td bgcolor="#FFFFFF" class="css_bordes_d">' . $tarifaiva_code[$estructura->detalles->detalle[$id]->impuestos->impuesto->codigoPorcentaje->__toString()] . '</td>';
		$griddata .= '           
               <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->precioTotalSinImpuesto->__toString(), $decimales, ".", ",") . '</td>
             </tr>';

		$detalladicionaltxt3 = '';
		$detalladicionaltxt = '';
		$detalladicionaltxt2 = '';
		$numfilas = $numfilas + 1;
		if ($fin_pagina == $id) {
			//----------------------
			$griddata .= '</table>';
			//----------------------
		}
	}



	//--infoAdicional--//



	//--platilla--//
	$razonSocial = stripslashes(htmlentities($razonSocial));

	$condatos = str_replace("-empresa-", $razonSocial, $plantilla);


	if ($dirEstablecimiento) {
		$dirEstablecimiento = stripslashes(htmlentities($dirEstablecimiento));

		if (date("Y-m-d") > '2017-08-12') {
			$condatos = str_replace("-direccions-", $dirEstablecimiento, $condatos);
		} else {
			$condatos = str_replace("-direccions-", "VIA DAULE KM 8 1/2 BODEGAS JUAN MONTALVO OFC. 5 Y 6", $condatos);
		}
	}
	if ($dirMatriz) {
		$dirMatriz = stripslashes(htmlentities($dirMatriz));
		$condatos = str_replace("-direccion-", $dirMatriz, $condatos);
	}


	$condatos = str_replace("-especial-", $contribuyenteEspecial, $condatos);
	$condatos = str_replace("-obligado-", $obligadoContabilidad, $condatos);
	$condatos = str_replace("-rucemp-", $ruc, $condatos);
	$condatos = str_replace("-nfactura-", $estab . "-" . $ptoEmi . "-" . $secuencial, $condatos);
	$condatos = str_replace("-nautorizacion-", $numeroAutorizacion, $condatos);
	$condatos = str_replace("-fechahoraaut-", $fechaAutorizacion, $condatos);
	$valamb = $ambiente;
	$condatos = str_replace("-ambiente-", $ambiente_code[$valamb], $condatos);
	$valemi = $tipoEmision;
	$condatos = str_replace("-emision-", $tipoemision_code[$valemi], $condatos);
	$condatos = str_replace("-claveacceso-", $claveAcceso, $condatos);
	$condatos = str_replace("-ruccliente-", $identificacionComprador, $condatos);

	$razonSocialComprador = stripslashes(htmlentities($razonSocialComprador));
	$razonSocialComprador = str_replace("amp;amp;", "amp;", $razonSocialComprador);
	$condatos = str_replace("-razonsocial-", $razonSocialComprador, $condatos);

	$condatos = str_replace("-fechaemision-", $fechaEmision, $condatos);

	$condatos = str_replace("-total-", number_format($importeTotal, 2, ".", ","), $condatos);
	//Lista
	$condatos = str_replace("-lista-", $griddata, $condatos);

	//print_r($tvalorconiva);
	@$sumatotal = $tvalorconiva + $tvalorsiniva + $totalDescuento;
	@$subsinimp = $tvalorconiva + $tvalorsiniva;
	@$condatos = str_replace("-suma-", number_format($sumatotal, 2, ".", ","), $condatos);
	@$condatos = str_replace("-subtotal-", number_format($tvalorconiva, 2, ".", ","), $condatos);

	$condatos = str_replace("-subtotalsiniva-", number_format($tvalorsiniva, 2, ".", ","), $condatos);

	@$condatos = str_replace("-subtotalnograbado-", number_format($tvalornogravado, 2, ".", ","), $condatos);
	@$condatos = str_replace("-subsinimp-", number_format($subsinimp, 2, ".", ","), $condatos);
	@$condatos = str_replace("-subtotalexento-", number_format($tvalorexentoiva, 2, ".", ","), $condatos);


	@$condatos = str_replace("-subtotalexeiva-", number_format($tvalorexentoiva, $decimales, ".", ","), $condatos);
	@$condatos = str_replace("-iva-", number_format($valorivac, 2, ".", ","), $condatos);


	@$condatos = str_replace("-descuento-", number_format($totalDescuento, 2, ".", ","), $condatos);
	@$condatos = str_replace("-logo-", $logotipo_imd, $condatos);
	@$condatos = str_replace("-barraclave-", $code_barra, $condatos);

	//cambio
	$condatos = str_replace("-fpagodespliegue-", $pago_platilla, $condatos);
	//cambio


	$condatos = str_replace("-subtotalsinimp-", $totalSinImpuestos, $condatos);


	if ($codigopivavt == 2) {
		$condatos = str_replace("-ivanum-", "12%", $condatos);
	}

	if ($codigopivavt == 4) {
		$condatos = str_replace("-ivanum-", "15%", $condatos);
	}

	if ($codigopivavt == 3) {
		$condatos = str_replace("-ivanum-", "14%", $condatos);
	}

	if ($codigopivavt == '') {
		$condatos = str_replace("-ivanum-", "", $condatos);
	}

	if ($codigopivavt == 0) {
		$condatos = str_replace("-ivanum-", "", $condatos);
	}

	for ($ib = 0; $ib < count($estructura->infoAdicional->campoAdicional); $ib++) {
		$nombrecampo = $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if ($nombrecampo == 'direccionComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-dircli-", $dirclietxt, $condatos);
			$dirbandera = 1;
		}
		if ($nombrecampo == 'telefonoComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-telcli-", $dirclietxt, $condatos);
			$telbandera = 1;
		}
		if ($nombrecampo == 'CorreoCliente') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));


			$dirclietxt = str_replace(";", "<br>", $dirclietxt);
			$condatos = str_replace("-emailcli-", $dirclietxt, $condatos);
			$emailbandera = 1;
		}

		if ($nombrecampo == 'Tipo') {
			$op1 = "TIPO: " . stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
			$op1 = "";
			//$op1="";

		}

		//$op1x='';
		if ($nombrecampo == 'obs2') {
			$op1x = "<b>TIPO CIRUGIA: </b>" . stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}



		if ($nombrecampo == 'Convenio') {
			$op2 = "CONVENIO: " . stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}

		if ($nombrecampo == 'op3') {
			$op3 = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}


		if ($nombrecampo == 'usuario') {
			$usuariov = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
			$condatos = str_replace("-usuariod-", $usuariov, $condatos);
		}
	}

	@$condatos = str_replace("-op-", $op1x . $op1 . $op2 . $op3, $condatos);

	if (!(@$dirbandera)) {
		$condatos = str_replace("-dircli-", "", $condatos);
	}
	if (!(@$telbandera)) {
		$condatos = str_replace("-telcli-", "", $condatos);
	}
	if (!(@$emailbandera)) {
		$condatos = str_replace("-emailcli-", "", $condatos);
	}



	return $condatos;
}

//NOTA DE CREDITO

function lee_notadecredito($estructura, $plantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total)
{
	global $ambiente_code, $tipoemision_code, $impuesto_code, $tarifaiva_code, $comprobante_code;
	//print_r($estructura);
	$ambiente_val = 0;
	$decimales = 4;
	$totalDescuento = 0;
	$descu = 0;
	//--infoTributaria--//
	$ambiente = $estructura->infoTributaria->ambiente->__toString();
	$tipoEmision = $estructura->infoTributaria->tipoEmision->__toString();
	$razonSocial = $estructura->infoTributaria->razonSocial;
	$nombreComercial = $estructura->infoTributaria->nombreComercial;
	$ruc = $estructura->infoTributaria->ruc;
	$claveAcceso = $estructura->infoTributaria->claveAcceso;
	$codDoc = $estructura->infoTributaria->codDoc;
	$estab = $estructura->infoTributaria->estab;
	$ptoEmi = $estructura->infoTributaria->ptoEmi;
	$secuencial = $estructura->infoTributaria->secuencial;
	$dirMatriz = $estructura->infoTributaria->dirMatriz;

	//--infoNotaCredito--//
	$fechaEmision = $estructura->infoNotaCredito->fechaEmision->__toString();

	$fechaemisionf = explode(" ", $fechaEmision);
	$separafecha = explode("/", $fechaemisionf[0]);
	$nombremes = "";
	$nombremes = fecha_mes($separafecha[1]);
	$fecheemidoc = $separafecha[0] . " - " . $nombremes . " - " . $separafecha[2];


	$dirEstablecimiento = $estructura->infoNotaCredito->dirEstablecimiento;
	$contribuyenteEspecial = $estructura->infoNotaCredito->contribuyenteEspecial;
	$obligadoContabilidad = $estructura->infoNotaCredito->obligadoContabilidad;

	$codDocModificado = $estructura->infoNotaCredito->codDocModificado->__toString();
	$numDocModificado = $estructura->infoNotaCredito->numDocModificado;
	// $fechaEmisionDocSustento=$estructura->infoNotaCredito->fechaEmisionDocSustento->__toString();


	$fechaemisiondf = explode(" ", $estructura->infoNotaCredito->fechaEmisionDocSustento->__toString());
	$separafecha = explode("/", $fechaemisiondf[0]);
	$nombremes = "";
	$nombremes = fecha_mes($separafecha[1]);
	$fechaEmisionDocSustento = $separafecha[0] . " - " . $nombremes . " - " . $separafecha[2];


	$tipoIdentificacionComprador = $estructura->infoNotaCredito->tipoIdentificacionComprador;
	$razonSocialComprador = $estructura->infoNotaCredito->razonSocialComprador;
	$identificacionComprador = $estructura->infoNotaCredito->identificacionComprador;
	$totalSinImpuestos = $estructura->infoNotaCredito->totalSinImpuestos->__toString();
	////  $totalDescuento=$estructura->infoNotaCredito->totalDescuento->__toString();   
	$valorModificacion = $estructura->infoNotaCredito->valorModificacion->__toString();

	$moneda = $estructura->infoNotaCredito->moneda->__toString();

	$numimpuestos = count($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto);
	$valorconiva = '';
	$codigopivavt = '';
	for ($ic = 0; $ic < $numimpuestos; $ic++) {


		if ($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigo == 2) {
			if ($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 3) {
				$tvalorconiva = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 2) {
				$tvalorconiva = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 4) {
				$tvalorconiva = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 0) {
				$tvalorsiniva = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}
			if ($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 6) {
				$tvalornogravado = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}

			if ($estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 7) {
				$tvalorexentoiva = $estructura->infoNotaCredito->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}
		}
	}

	//print_r($impuestos_reg);
	$motivo = $estructura->infoNotaCredito->motivo->__toString();

	$importeTotal = $estructura->infoNotaCredito->valorModificacion->__toString();
	//$moneda=$estructura->infoNotaCredito->moneda;			

	//--detalles--//

	$numdetalle = count($estructura->detalles->detalle);
	//echo $numdetalle;

	$nporpg = 15;
	$npaginas = $numdetalle / $nporpg;

	$numero_er = explode(".", $npaginas);
	$numero_entero = $numero_er[0];

	if ($numero_er[1] > 0) {
		$numtpg = $numero_er[0] + 1;
	}
	//$campo_pg[0]=1;

	for ($pgv = 1; $pgv <= $numero_entero; $pgv++) {
		// $campo_pg[$pgv]=$campo_pg[$pgv]+$nporpg-1;
		$acumulador_mp = $acumulador_mp + $nporpg - 1;
		$campo_pg[$pgv] = $acumulador_mp;
	}

	$recidue_final = $numdetalle - $campo_pg[$pgv];
	//$campo_pg[$pgv+1]=$recidue_final;

	$fin_pagina = $recidue_final - 1;


	$suma = 0;
	$sumatotal = 0;
	$ipgv = 1;
	//print_r($estructura->detalles->detalle[1]->codigoPrincipal);




	$numfilas = 1;
	for ($id = 0; $id < $numdetalle; $id++) {

		if ($id == 0) {
			$griddata .= '<table width="690px">
           <thead>
             <tr>			   
			   <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Atendido por</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
			   
			   
             </tr>
  </thead>	
			';
		}

		if (in_array($id, $campo_pg)) {
			$griddata .= '</table>';
			$griddata .= '<div style="page-break-after: always;" /></div>';
			$griddata .= 'Cre:' . $estab . '-' . $ptoEmi . '-' . $secuencial . ' Raz&oacute;n Social:' . $razonSocialComprador . '<table width="747px">
           <thead>
             <tr>
			   <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Atendido por</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>
  </thead>	
			';
		}

		// echo $estructura->detalles->detalle[$id]["codigoPrincipal"];
		// echo $estructura->detalles->detalle[$id]["descripcion"];
		// echo $estructura->detalles->detalle[$id]["cantidad"];
		// echo $estructura->detalles->detalle[$id]["precioUnitario"];
		// echo $estructura->detalles->detalle[$id]["descuento"];
		// echo $estructura->detalles->detalle[$id]["precioTotalSinImpuesto"];
		//print_r($estructura->detalles->detalle[$id]->impuestos->impuesto->codigo);
		$descriptxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->descripcion));
		//$detalladicionaltxt=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional["valor"]));


		//$detalladicionaltxt=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
		//if(!(trim($detalladicionaltxt)))
		//{

		//	$detalladicionaltxt=0;
		//}
		//$detalladicionaltxt2=stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
		//if(!(trim($detalladicionaltxt2)))
		///{

		//$detalladicionaltxt2=0;
		//}


		$descriptxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->descripcion));


		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = 0;
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = 0;
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = 0;
			}
		}
		if (!(trim($detalladicionaltxt))) {

			$detalladicionaltxt = 0;
		}
		//---------

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = 0;
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = 0;
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = 0;
			}
		}

		if (!(trim($detalladicionaltxt2))) {

			$detalladicionaltxt2 = 0;
		}
		//-------------------------------------------



		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}


		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}

		$griddata .= '<tr>              
			   <td bgcolor="#FFFFFF" class="css_bordes">' . $numfilas . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes">' . $estructura->detalles->detalle[$id]->codigoInterno . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->cantidad->__toString(), $decimales, ".", "") . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes_d">' . $descriptxt . '</td>
			   <td bgcolor="#FFFFFF" class="css_bordes_d"></td>
			   <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->precioUnitario->__toString(), $decimales, ".", ",") . '</td>  
			   <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",") . '</td>			   
			   <td bgcolor="#FFFFFF" class="css_bordes_d">' . $tarifaiva_code[$estructura->detalles->detalle[$id]->impuestos->impuesto->codigoPorcentaje->__toString()] . '</td>';
		$griddata .= '</td>                            
               <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->precioTotalSinImpuesto->__toString(), $decimales, ".", ",") . '</td>
             </tr>';

		$numfilas = $numfilas + 1;
		$descu = number_format($estructura->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",");
		$totalDescuento = $totalDescuento + $descu;
		if ($fin_pagina == $id) {
			//----------------------
			$griddata .= '</table>';
			//----------------------
		}
	}


	//--infoAdicional--//




	//--platilla--//
	$razonSocial = stripslashes(htmlentities($razonSocial));
	$condatos = str_replace("-empresa-", $razonSocial, $plantilla);


	if ($dirEstablecimiento) {
		$dirEstablecimiento = stripslashes(htmlentities($dirEstablecimiento));


		if (date("Y-m-d") > '2017-08-12') {
			$condatos = str_replace("-direccions-", $dirEstablecimiento, $condatos);
		} else {
			$condatos = str_replace("-direccions-", "VIA DAULE KM 8 1/2 BODEGAS JUAN MONTALVO OFC. 5 Y 6", $condatos);
		}
	}
	if ($dirMatriz) {
		$dirMatriz = stripslashes(htmlentities($dirMatriz));
		$condatos = str_replace("-direccion-", $dirMatriz, $condatos);
	}


	$condatos = str_replace("-especial-", $contribuyenteEspecial, $condatos);
	$condatos = str_replace("-obligado-", $obligadoContabilidad, $condatos);
	$condatos = str_replace("-rucemp-", $ruc, $condatos);
	$condatos = str_replace("-ndocumento-", $estab . "-" . $ptoEmi . "-" . $secuencial, $condatos);
	$condatos = str_replace("-nautorizacion-", $numeroAutorizacion, $condatos);
	$condatos = str_replace("-fechahoraaut-", $fechaAutorizacion, $condatos);
	$valamb = $ambiente;
	$condatos = str_replace("-ambiente-", $ambiente_code[$valamb], $condatos);
	$valemi = $tipoEmision;

	$condatos = str_replace("-emision-", $tipoemision_code[$valemi], $condatos);
	$condatos = str_replace("-claveacceso-", $claveAcceso, $condatos);
	$condatos = str_replace("-ruccliente-", $identificacionComprador, $condatos);

	$razonSocialComprador = stripslashes(htmlentities($razonSocialComprador));
	$condatos = str_replace("-razonsocial-", $razonSocialComprador, $condatos);

	$condatos = str_replace("-fechaemision-", $fecheemidoc, $condatos);
	$condatos = str_replace("-subtotalsinimp-", $totalSinImpuestos, $condatos);


	//comprobante de sustento


	$condatos = str_replace("-tipocomprobante-", $comprobante_code[$codDocModificado], $condatos);
	$condatos = str_replace("-ncomprobante-", $numDocModificado, $condatos);
	$condatos = str_replace("-fechacomprobante-", $fechaEmisionDocSustento, $condatos);
	$condatos = str_replace("-razon-", $motivo, $condatos);

	//comprobante de sustento


	//Lista
	$condatos = str_replace("-lista-", $griddata, $condatos);
	$sumatotal = $tvalorconiva + $tvalorsiniva + $totalDescuento;
	$subsinimp = $tvalorconiva + $tvalorsiniva;
	///$totalDescuento=$sumatotal-$subsinimp;


	//print_r($tvalorconiva);
	$condatos = str_replace("-suma-", number_format($sumatotal, 2, ".", ","), $condatos);
	$condatos = str_replace("-subtotal-", number_format($tvalorconiva, 2, ".", ","), $condatos);
	$condatos = str_replace("-subtotalsiniva-", number_format($tvalorsiniva, 2, ".", ","), $condatos);
	$condatos = str_replace("-subtotalnograbado-", number_format($tvalornogravado, 2, ".", ","), $condatos);
	$condatos = str_replace("-subsinimp-", number_format($subsinimp, 2, ".", ","), $condatos);
	$condatos = str_replace("-subtotalexento-", number_format($tvalorexentoiva, 2, ".", ","), $condatos);
	$condatos = str_replace("-iva-", number_format($valorivac, 2, ".", ","), $condatos);
	$condatos = str_replace("-descuento-", number_format($totalDescuento, 2, ".", ","), $condatos);


	$condatos = str_replace("-total-", number_format($importeTotal, 2, ".", ","), $condatos);
	$condatos = str_replace("-logo-", $logotipo_imd, $condatos);
	$condatos = str_replace("-barraclave-", $code_barra, $condatos);

	if ($codigopivavt == 2) {
		$condatos = str_replace("-ivanum-", "12%", $condatos);
	}

	if ($codigopivavt == 4) {
		$condatos = str_replace("-ivanum-", "15%", $condatos);
	}

	if ($codigopivavt == 3) {
		$condatos = str_replace("-ivanum-", "14%", $condatos);
	}

	if ($codigopivavt == 0) {
		$condatos = str_replace("-ivanum-", "", $condatos);
	}
	if ($codigopivavt == '') {
		$condatos = str_replace("-ivanum-", "", $condatos);
	}


	for ($ib = 0; $ib < count($estructura->infoAdicional->campoAdicional); $ib++) {
		$nombrecampo = $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if ($nombrecampo == 'direccionComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-dircli-", $dirclietxt, $condatos);
			$dirbandera = 1;
		}
		if ($nombrecampo == 'telefonoComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-telcli-", $dirclietxt, $condatos);
			$telbandera = 1;
		}
		if ($nombrecampo == 'CorreoCliente') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$dirclietxt = str_replace(";", "<br>", $dirclietxt);
			$condatos = str_replace("-emailcli-", $dirclietxt, $condatos);
			$emailbandera = 1;
		}

		if ($nombrecampo == 'op1') {
			$op1 = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}

		if ($nombrecampo == 'op2') {
			$op2 = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}

		if ($nombrecampo == 'op3') {
			$op3 = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}
	}
	$condatos = str_replace("-op-", $op1 . $op2 . $op3, $condatos);
	if (!($dirbandera)) {
		$condatos = str_replace("-dircli-", "", $condatos);
	}
	if (!($telbandera)) {
		$condatos = str_replace("-telcli-", "", $condatos);
	}
	if (!($emailbandera)) {
		$condatos = str_replace("-emailcli-", "", $condatos);
	}



	return $condatos;
}

//NOTA DE DEBITO

function lee_notadedebito($estructura, $plantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total)
{
	global $ambiente_code, $tipoemision_code, $impuesto_code, $tarifaiva_code, $comprobante_code;
	//print_r($estructura);
	$ambiente_val = 0;
	//--infoTributaria--//
	$ambiente = $estructura->infoTributaria->ambiente->__toString();
	$tipoEmision = $estructura->infoTributaria->tipoEmision->__toString();
	$razonSocial = $estructura->infoTributaria->razonSocial;
	$nombreComercial = $estructura->infoTributaria->nombreComercial;
	$ruc = $estructura->infoTributaria->ruc;
	$claveAcceso = $estructura->infoTributaria->claveAcceso;
	$codDoc = $estructura->infoTributaria->codDoc;
	$estab = $estructura->infoTributaria->estab;
	$ptoEmi = $estructura->infoTributaria->ptoEmi;
	$secuencial = $estructura->infoTributaria->secuencial;
	$dirMatriz = $estructura->infoTributaria->dirMatriz;

	//--infoNotaDebito--//
	//$fechaEmision=$estructura->infoNotaDebito->fechaEmision->__toString();

	$fechaemisiocl = explode(" ", $estructura->infoNotaDebito->fechaEmision->__toString());
	$separafecha = explode("/", $fechaemisiocl[0]);
	$nombremes = "";
	$nombremes = fecha_mes($separafecha[1]);
	$fechaEmision = $separafecha[0] . " - " . $nombremes . " - " . $separafecha[2];

	$dirEstablecimiento = $estructura->infoNotaDebito->dirEstablecimiento;
	$tipoIdentificacionComprador = $estructura->infoNotaDebito->tipoIdentificacionComprador;
	$razonSocialComprador = $estructura->infoNotaDebito->razonSocialComprador;
	$identificacionComprador = $estructura->infoNotaDebito->identificacionComprador;
	$contribuyenteEspecial = $estructura->infoNotaDebito->contribuyenteEspecial;
	$obligadoContabilidad = $estructura->infoNotaDebito->obligadoContabilidad;

	$codDocModificado = $estructura->infoNotaDebito->codDocModificado->__toString();


	$numDocModificado = $estructura->infoNotaDebito->numDocModificado;
	//$fechaEmisionDocSustento=$estructura->infoNotaDebito->fechaEmisionDocSustento->__toString();

	$fechaemisionds = explode(" ", $estructura->infoNotaDebito->fechaEmisionDocSustento->__toString());
	$separafecha = explode("/", $fechaemisionds[0]);
	$nombremes = "";
	$nombremes = fecha_mes($separafecha[1]);
	$fechaEmisionDocSustento = $separafecha[0] . " - " . $nombremes . " - " . $separafecha[2];



	$totalSinImpuestos = $estructura->infoNotaDebito->totalSinImpuestos->__toString();
	$totalDescuento = $estructura->infoNotaDebito->totalDescuento->__toString();

	$numimpuestos = count($estructura->infoNotaDebito->impuestos->impuesto);
	$valorconiva = '';
	for ($ic = 0; $ic < $numimpuestos; $ic++) {


		if ($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigo == 2) {
			if ($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigoPorcentaje == 2) {
				$tvalorconiva = $estructura->infoNotaDebito->impuestos->impuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoNotaDebito->impuestos->impuesto[$ic]->valor->__toString();
			}

			if ($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigoPorcentaje == 4) {
				$tvalorconiva = $estructura->infoNotaDebito->impuestos->impuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoNotaDebito->impuestos->impuesto[$ic]->valor->__toString();
			}

			if ($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigoPorcentaje == 0) {
				$tvalorsiniva = $estructura->infoNotaDebito->impuestos->impuesto[$ic]->baseImponible->__toString();
			}
			if ($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigoPorcentaje == 6) {
				$tvalornogravado = $estructura->infoNotaDebito->impuestos->impuesto[$ic]->baseImponible->__toString();
			}

			if ($estructura->infoNotaDebito->impuestos->impuesto[$ic]->codigoPorcentaje == 7) {
				$tvalorexentoiva = $estructura->infoNotaDebito->impuestos->impuesto[$ic]->baseImponible->__toString();
			}
		}
	}

	//print_r($impuestos_reg);

	$propina = $estructura->infoNotaDebito->propina->__toString();
	$importeTotal = $estructura->infoNotaDebito->valorTotal->__toString();
	$moneda = $estructura->infoNotaDebito->moneda;

	//--detalles--//

	$numdetalle = count($estructura->detalles->detalle);
	//echo $numdetalle;
	//print_r($estructura->detalles->detalle[1]->codigoPrincipal);


	//--infoAdicional--//




	//--platilla--//
	$razonSocial = stripslashes(htmlentities($razonSocial));
	$condatos = str_replace("-empresa-", $razonSocial, $plantilla);


	if ($dirEstablecimiento) {
		$dirEstablecimiento = stripslashes(htmlentities($dirEstablecimiento));


		if (date("Y-m-d") > '2017-08-12') {
			$condatos = str_replace("-direccions-", $dirEstablecimiento, $condatos);
		} else {
			$condatos = str_replace("-direccions-", "VIA DAULE KM 8 1/2 BODEGAS JUAN MONTALVO OFC. 5 Y 6", $condatos);
		}
	} else {
		$dirMatriz = stripslashes(htmlentities($dirMatriz));
		$condatos = str_replace("-direccion-", $dirMatriz, $condatos);
	}


	$condatos = str_replace("-especial-", $contribuyenteEspecial, $condatos);
	$condatos = str_replace("-obligado-", $obligadoContabilidad, $condatos);
	$condatos = str_replace("-rucemp-", $ruc, $condatos);
	$condatos = str_replace("-ndocumento-", $estab . "-" . $ptoEmi . "-" . $secuencial, $condatos);
	$condatos = str_replace("-nautorizacion-", $numeroAutorizacion, $condatos);
	$condatos = str_replace("-fechahoraaut-", $fechaAutorizacion, $condatos);
	$valamb = $ambiente;
	$condatos = str_replace("-ambiente-", $ambiente_code[$valamb], $condatos);
	$valemi = $tipoEmision;
	$condatos = str_replace("-emision-", $tipoemision_code[$valemi], $condatos);
	$condatos = str_replace("-claveacceso-", $claveAcceso, $condatos);
	$condatos = str_replace("-ruccliente-", $identificacionComprador, $condatos);

	$razonSocialComprador = stripslashes(htmlentities($razonSocialComprador));
	$condatos = str_replace("-razonsocial-", $razonSocialComprador, $condatos);

	$condatos = str_replace("-fechaemision-", $fechaEmision, $condatos);

	$condatos = str_replace("-total-", number_format($importeTotal, 2, ".", ","), $condatos);

	//comprobante de sustento

	$condatos = str_replace("-tipocomprobante-", $comprobante_code[$codDocModificado], $condatos);
	$condatos = str_replace("-ncomprobante-", $numDocModificado, $condatos);
	$condatos = str_replace("-fechacomprobante-", $fechaEmisionDocSustento, $condatos);


	//comprobante de sustento


	//Lista
	$condatos = str_replace("-lista-", $griddata, $condatos);

	//print_r($tvalorconiva);
	$condatos = str_replace("-subtotal-", number_format($tvalorconiva, 2, ".", ","), $condatos);

	$condatos = str_replace("-subtotalsiniva-", number_format($tvalorsiniva, 2, ".", ","), $condatos);
	$condatos = str_replace("-subtotalexeiva-", number_format($tvalorexentoiva, 2, ".", ","), $condatos);
	$condatos = str_replace("-subtotalnograbado-", number_format($tvalornogravado, 2, ".", ","), $condatos);
	$condatos = str_replace("-iva-", number_format($valorivac, 2, ".", ","), $condatos);
	$condatos = str_replace("-descuento-", number_format($totalDescuento, 2, ".", ","), $condatos);
	$condatos = str_replace("-logo-", $logotipo_imd, $condatos);
	$condatos = str_replace("-barraclave-", $code_barra, $condatos);

	//  echo count($estructura->infoAdicional->campoAdicional);

	$dirbandera = 0;
	$telbandera = 0;
	$emailbandera = 0;
	for ($ib = 0; $ib < count($estructura->infoAdicional->campoAdicional); $ib++) {
		$nombrecampo = $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if ($nombrecampo == 'direccionComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-dircli-", $dirclietxt, $condatos);
			$dirbandera = 1;
		}
		if ($nombrecampo == 'telefonoComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-telcli-", $dirclietxt, $condatos);
			$telbandera = 1;
		}
		if ($nombrecampo == 'CorreoCliente') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-emailcli-", $dirclietxt, $condatos);
			$emailbandera = 1;
		}
	}

	if (!($dirbandera)) {
		$condatos = str_replace("-dircli-", "", $condatos);
	}
	if (!($telbandera)) {
		$condatos = str_replace("-telcli-", "", $condatos);
	}
	if (!($emailbandera)) {
		$condatos = str_replace("-emailcli-", "", $condatos);
	}

	//  $estructura->infoAdicional->campoAdicional[3]["nombre"]->__toString()




	return $condatos;
}

//LQ


function lee_lq($estructura, $plantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra, $griddata, $valor_total, $valorsiniva_total)
{
	global $ambiente_code, $tipoemision_code, $impuesto_code, $tarifaiva_code, $formapago_code;
	//print_r($estructura);
	$ambiente_val = 0;
	$decimales = 4;
	$acumulador_mp = '';
	//--infoTributaria--//
	$ambiente = $estructura->infoTributaria->ambiente->__toString();
	$tipoEmision = $estructura->infoTributaria->tipoEmision->__toString();
	$razonSocial = $estructura->infoTributaria->razonSocial;
	$nombreComercial = $estructura->infoTributaria->nombreComercial;
	$ruc = $estructura->infoTributaria->ruc;
	$claveAcceso = $estructura->infoTributaria->claveAcceso;
	$codDoc = $estructura->infoTributaria->codDoc;
	$estab = $estructura->infoTributaria->estab;
	$ptoEmi = $estructura->infoTributaria->ptoEmi;
	$secuencial = $estructura->infoTributaria->secuencial;
	$dirMatriz = $estructura->infoTributaria->dirMatriz;

	//--infoFactura--//
	// $fechaEmision=$estructura->infoFactura->fechaEmision->__toString();

	$fechaemisionf = explode(" ", $estructura->infoLiquidacionCompra->fechaEmision->__toString());
	$separafecha = explode("/", $fechaemisionf[0]);
	$nombremes = "";
	$nombremes = fecha_mes($separafecha[1]);
	$fechaEmision = $separafecha[0] . " - " . $nombremes . " - " . $separafecha[2];


	$dirEstablecimiento = $estructura->infoLiquidacionCompra->dirEstablecimiento->__toString();
	$contribuyenteEspecial = $estructura->infoLiquidacionCompra->contribuyenteEspecial;
	$obligadoContabilidad = $estructura->infoLiquidacionCompra->obligadoContabilidad;
	$tipoIdentificacionComprador = $estructura->infoLiquidacionCompra->identificacionProveedor;
	$razonSocialComprador = $estructura->infoLiquidacionCompra->razonSocialProveedor;
	$identificacionComprador = $estructura->infoLiquidacionCompra->identificacionProveedor;
	$totalSinImpuestos = $estructura->infoLiquidacionCompra->totalSinImpuestos->__toString();
	$totalDescuento = $estructura->infoLiquidacionCompra->totalDescuento->__toString();

	$numimpuestos = count($estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto);
	$valorconiva = '';
	$codigopivavt = '';
	$numfilas = 1;
	for ($ic = 0; $ic < $numimpuestos; $ic++) {


		if ($estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigo == 2) {
			if ($estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 3) {
				$tvalorconiva = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 2) {
				$tvalorconiva = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 4) {
				$tvalorconiva = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
				$valorivac = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->valor->__toString();
				$codigopivavt = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje;
			}

			if ($estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 0) {
				$tvalorsiniva = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}
			if ($estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 6) {
				$tvalornogravado = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}


			if ($estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->codigoPorcentaje == 7) {
				$tvalorexentoiva = $estructura->infoLiquidacionCompra->totalConImpuestos->totalImpuesto[$ic]->baseImponible->__toString();
			}
		}
	}

	//forma pagos
	$numpagos = 0;
	$numpagos = count($estructura->infoLiquidacionCompra->pagos->pago);
	$fpago_code = '';
	$fpago_valor = '';
	$pago_platilla = '';
	if ($numpagos > 0) {
		$pago_platilla = '<table width="250"  border="0" align="center" cellpadding="1" cellspacing="1">
          <tr >
            <td class="css_bordes_d" ><p>FORMA DE PAGO</p></td>
            <td class="css_bordes_d" >VALOR</td>
			
          </tr>';

		for ($icp = 0; $icp < $numpagos; $icp++) {
			$fpago_code = '';
			$fpago_valor = '';
			$fpago_plazo = '';
			$fpago_unidad = '';
			$fpago_code = $estructura->infoLiquidacionCompra->pagos->pago[$icp]->formaPago->__toString();
			$fpago_valor = $estructura->infoLiquidacionCompra->pagos->pago[$icp]->total->__toString();

			@$fpago_plazo = $estructura->infoLiquidacionCompra->pagos->pago[$icp]->plazo->__toString();
			@$fpago_unidad = $estructura->infoLiquidacionCompra->pagos->pago[$icp]->unidadTiempo->__toString();

			$pago_platilla .= '<tr >
            <td class="css_bordes_d" >' . $formapago_code[trim($fpago_code)] . '</td>
            <td class="css_bordes_d">' . number_format($fpago_valor, 2, ".", ",") . '</td>
			
          </tr>';
		}
		$pago_platilla .= '</table>';
	}

	//forma pagos	

	//print_r($impuestos_reg);

	$propina = $estructura->infoLiquidacionCompra->propina->__toString();
	$importeTotal = $estructura->infoLiquidacionCompra->importeTotal->__toString();
	$moneda = $estructura->infoLiquidacionCompra->moneda;

	//--detalles--//

	$numdetalle = count($estructura->detalles->detalle);
	//echo $numdetalle;
	//print_r($estructura->detalles->detalle[1]->codigoPrincipal);

	$nporpg = 20;

	//verificaque sea mas de una pagina
	if ($numdetalle > $nporpg) {
		$cantidad_siguientepg = $numdetalle - $nporpg;
		$inicia_en = 2;
		$pgv = 1;
		$campo_pg[1] = $nporpg - 1;
		$nporpg = 26;
		$acumulador_mp = 20;
	} else {
		$cantidad_siguientepg = $numdetalle;
		$inicia_en = 1;
	}
	//verificaque sea mas de una pagina
	//echo $cantidad_siguientepg;

	$npaginas = $cantidad_siguientepg / $nporpg;
	$numero_er = explode(".", $npaginas);
	$numero_entero = $numero_er[0];

	if ($numero_er[1] > 0) {
		$numtpg = $numero_er[0] + 1;
		$numero_entero = $numero_er[0] + 1;
	}
	//$campo_pg[0]=1;

	for ($pgv = $inicia_en; $pgv <= $numero_entero; $pgv++) {
		//$campo_pg[$pgv]=$campo_pg[$pgv]+$nporpg-1;
		@$acumulador_mp = $acumulador_mp + $nporpg - 1;
		@$campo_pg[$pgv] = $acumulador_mp;
	}

	@$recidue_final = $numdetalle - $campo_pg[$pgv];
	//$campo_pg[$pgv+1]=$recidue_final;

	$fin_pagina = $recidue_final - 1;
	//print_r($campo_pg);

	$suma = 0;
	$sumatotal = 0;
	$ipgv = 1;
	for ($id = 0; $id < $numdetalle; $id++) {

		//----------------------------------
		if ($id == 0) {
			$griddata .= '<table width="700px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Atendido por</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
		}
		//---------------------------------------
		if (in_array($id, $campo_pg)) {
			$ipgv++;
			$griddata .= '</table>';
			$griddata .= '<div style="page-break-after: always;" /></div>';
			$griddata .= 'Fac:' . $estab . '-' . $ptoEmi . '-' . $secuencial . ' Raz&oacute;n Social:' . $razonSocialComprador . '<table width="747px"   >
             <tr>
			 <td class="css_bordesbarra">#</td> 
			   <td class="css_bordesbarra">Cod</td>          
               <td class="css_bordesbarra">Cant</td>
               <td class="css_bordesbarra">Descripci&oacute;n</td>
			   <td class="css_bordesbarra">Atendido por</td>
			   <td class="css_bordesbarra">Precio Unitario </td>
			   <td class="css_bordesbarra">Dscto $</td>
			   <td class="css_bordesbarra">IVA</td>
               <td class="css_bordesbarra">Precio Total </td>
             </tr>';
		}

		$descriptxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->descripcion));

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional1") {
			$detalladicionaltxt = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt))) {

				$detalladicionaltxt = '';
			}
		}
		if (!(trim(@$detalladicionaltxt))) {

			$detalladicionaltxt = '';
		}

		//---------

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = '';
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional2") {
			$detalladicionaltxt2 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));
			if (!(trim($detalladicionaltxt2))) {

				$detalladicionaltxt2 = '';
			}
		}
		if (!(trim(@$detalladicionaltxt2))) {

			$detalladicionaltxt2 = 0;
		}

		//-------------------------------------------



		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[0]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}


		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[1]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}

		$detalladicionaltx = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["nombre"]));
		if ($detalladicionaltx == "InformacionAdicional3") {

			$detalladicionaltxt3 = stripslashes(htmlentities($estructura->detalles->detalle[$id]->detallesAdicionales->detAdicional[2]["valor"]));

			if (!(trim($detalladicionaltxt3))) {

				$detalladicionaltxt3 = 0;
			}
		}

		$griddata .= '<tr>              
               <td bgcolor="#FFFFFF" class="css_bordes">' . $numfilas . '</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">' . $estructura->detalles->detalle[$id]->codigoPrincipal . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->cantidad->__toString(), $decimales, ".", "") . '</td>
               <td bgcolor="#FFFFFF" class="css_bordes_d">' . $descriptxt . '</td>
			    <td bgcolor="#FFFFFF" class="css_bordes_d">' . @$detalladicionaltxt . '</td>
			   <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->precioUnitario->__toString(), 4, ".", ",") . '</td> 			  
                <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",") . '</td> 
			    <td bgcolor="#FFFFFF" class="css_bordes_d">' . $tarifaiva_code[$estructura->detalles->detalle[$id]->impuestos->impuesto->codigoPorcentaje->__toString()] . '</td>';
		$griddata .= '           
               <td bgcolor="#FFFFFF" class="css_bordes">' . number_format($estructura->detalles->detalle[$id]->precioTotalSinImpuesto->__toString(), $decimales, ".", ",") . '</td>
             </tr>';

		$detalladicionaltxt3 = '';
		$detalladicionaltxt = '';
		$detalladicionaltxt2 = '';
		$numfilas = $numfilas + 1;
		if ($fin_pagina == $id) {
			//----------------------
			$griddata .= '</table>';
			//----------------------
		}
	}



	//--infoAdicional--//



	//--platilla--//
	$razonSocial = stripslashes(htmlentities($razonSocial));

	$condatos = str_replace("-empresa-", $razonSocial, $plantilla);


	if ($dirEstablecimiento) {
		$dirEstablecimiento = stripslashes(htmlentities($dirEstablecimiento));


		$condatos = str_replace("-direccions-", $dirEstablecimiento, $condatos);
	}
	if ($dirMatriz) {
		$dirMatriz = stripslashes(htmlentities($dirMatriz));
		$condatos = str_replace("-direccion-", $dirMatriz, $condatos);
	}


	$condatos = str_replace("-especial-", $contribuyenteEspecial, $condatos);
	$condatos = str_replace("-obligado-", $obligadoContabilidad, $condatos);
	$condatos = str_replace("-rucemp-", $ruc, $condatos);
	$condatos = str_replace("-nfactura-", $estab . "-" . $ptoEmi . "-" . $secuencial, $condatos);
	$condatos = str_replace("-nautorizacion-", $numeroAutorizacion, $condatos);
	$condatos = str_replace("-fechahoraaut-", $fechaAutorizacion, $condatos);
	$valamb = $ambiente;
	$condatos = str_replace("-ambiente-", $ambiente_code[$valamb], $condatos);
	$valemi = $tipoEmision;
	$condatos = str_replace("-emision-", $tipoemision_code[$valemi], $condatos);
	$condatos = str_replace("-claveacceso-", $claveAcceso, $condatos);
	$condatos = str_replace("-ruccliente-", $identificacionComprador, $condatos);

	$razonSocialComprador = stripslashes(htmlentities($razonSocialComprador));
	$razonSocialComprador = str_replace("amp;amp;", "amp;", $razonSocialComprador);
	$condatos = str_replace("-razonsocial-", $razonSocialComprador, $condatos);

	$condatos = str_replace("-fechaemision-", $fechaEmision, $condatos);

	$condatos = str_replace("-total-", number_format($importeTotal, 2, ".", ","), $condatos);
	//Lista
	$condatos = str_replace("-lista-", $griddata, $condatos);

	//print_r($tvalorconiva);
	@$sumatotal = $tvalorconiva + $tvalorsiniva + $totalDescuento;
	@$subsinimp = $tvalorconiva + $tvalorsiniva;
	@$condatos = str_replace("-suma-", number_format($sumatotal, 2, ".", ","), $condatos);
	@$condatos = str_replace("-subtotal-", number_format($tvalorconiva, 2, ".", ","), $condatos);

	$condatos = str_replace("-subtotalsiniva-", number_format($tvalorsiniva, 2, ".", ","), $condatos);

	@$condatos = str_replace("-subtotalnograbado-", number_format($tvalornogravado, 2, ".", ","), $condatos);
	@$condatos = str_replace("-subsinimp-", number_format($subsinimp, 2, ".", ","), $condatos);
	@$condatos = str_replace("-subtotalexento-", number_format($tvalorexentoiva, 2, ".", ","), $condatos);


	@$condatos = str_replace("-subtotalexeiva-", number_format($tvalorexentoiva, $decimales, ".", ","), $condatos);
	@$condatos = str_replace("-iva-", number_format($valorivac, 2, ".", ","), $condatos);


	@$condatos = str_replace("-descuento-", number_format($totalDescuento, 2, ".", ","), $condatos);
	@$condatos = str_replace("-logo-", $logotipo_imd, $condatos);
	@$condatos = str_replace("-barraclave-", $code_barra, $condatos);

	//cambio
	$condatos = str_replace("-fpagodespliegue-", $pago_platilla, $condatos);
	//cambio


	$condatos = str_replace("-subtotalsinimp-", $totalSinImpuestos, $condatos);


	if ($codigopivavt == 2) {
		$condatos = str_replace("-ivanum-", "12%", $condatos);
	}

	if ($codigopivavt == 4) {
		$condatos = str_replace("-ivanum-", "15%", $condatos);
	}

	if ($codigopivavt == 3) {
		$condatos = str_replace("-ivanum-", "14%", $condatos);
	}

	if ($codigopivavt == '') {
		$condatos = str_replace("-ivanum-", "", $condatos);
	}

	if ($codigopivavt == 0) {
		$condatos = str_replace("-ivanum-", "", $condatos);
	}

	for ($ib = 0; $ib < count($estructura->infoAdicional->campoAdicional); $ib++) {
		$nombrecampo = $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if ($nombrecampo == 'direccionComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-dircli-", $dirclietxt, $condatos);
			$dirbandera = 1;
		}
		if ($nombrecampo == 'telefonoComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-telcli-", $dirclietxt, $condatos);
			$telbandera = 1;
		}
		if ($nombrecampo == 'CorreoCliente') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));


			$dirclietxt = str_replace(";", "<br>", $dirclietxt);
			$condatos = str_replace("-emailcli-", $dirclietxt, $condatos);
			$emailbandera = 1;
		}

		if ($nombrecampo == 'Tipo') {
			$op1 = "TIPO: " . stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}

		if ($nombrecampo == 'Convenio') {
			$op2 = "CONVENIO: " . stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}

		if ($nombrecampo == 'op3') {
			$op3 = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString())) . "<br>";
		}
	}

	@$condatos = str_replace("-op-", $op1 . $op2 . $op3, $condatos);

	if (!(@$dirbandera)) {
		$condatos = str_replace("-dircli-", "", $condatos);
	}
	if (!(@$telbandera)) {
		$condatos = str_replace("-telcli-", "", $condatos);
	}
	if (!(@$emailbandera)) {
		$condatos = str_replace("-emailcli-", "", $condatos);
	}



	return $condatos;
}

//RETENCIONES


function lee_retencion($estructura, $plantilla, $numeroAutorizacion, $fechaAutorizacion, $logotipo_imd, $code_barra)
{
	global $ambiente_code, $tipoemision_code, $impuesto_code, $tarifaiva_code, $retencion_code, $comprobante_code, $renta_cod_un;
	//print_r($estructura);
	$ambiente_val = 0;
	//--infoTributaria--//
	$ambiente = $estructura->infoTributaria->ambiente->__toString();
	$tipoEmision = $estructura->infoTributaria->tipoEmision->__toString();
	$razonSocial = $estructura->infoTributaria->razonSocial;
	$nombreComercial = $estructura->infoTributaria->nombreComercial;
	$ruc = $estructura->infoTributaria->ruc;
	$claveAcceso = $estructura->infoTributaria->claveAcceso;
	$codDoc = $estructura->infoTributaria->codDoc;
	$estab = $estructura->infoTributaria->estab;
	$ptoEmi = $estructura->infoTributaria->ptoEmi;
	$secuencial = $estructura->infoTributaria->secuencial;
	$dirMatriz = $estructura->infoTributaria->dirMatriz;

	//--infoCompRetencion--//



	$fechaemisionds = explode(" ", $estructura->infoCompRetencion->fechaEmision->__toString());
	$separafecha = explode("/", $fechaemisionds[0]);
	$nombremes = "";
	$nombremes = fecha_mes($separafecha[1]);
	$fechaEmision = $separafecha[0] . " - " . $nombremes . " - " . $separafecha[2];


	$dirEstablecimiento = $estructura->infoCompRetencion->dirEstablecimiento;
	$contribuyenteEspecial = $estructura->infoCompRetencion->contribuyenteEspecial;

	if (!(trim($contribuyenteEspecial))) {
		$contribuyenteEspecial = 'NO';
	}

	$obligadoContabilidad = $estructura->infoCompRetencion->obligadoContabilidad;

	$tipoIdentificacionSujetoRetenido = $estructura->infoCompRetencion->tipoIdentificacionSujetoRetenido;
	$razonSocialSujetoRetenido = $estructura->infoCompRetencion->razonSocialSujetoRetenido;
	$identificacionSujetoRetenido = $estructura->infoCompRetencion->identificacionSujetoRetenido;
	$periodoFiscal = $estructura->infoCompRetencion->periodoFiscal;

	$totalSinImpuestos = $estructura->infoCompRetencion->totalSinImpuestos->__toString();
	$totalDescuento = $estructura->infoCompRetencion->totalDescuento->__toString();



	//print_r($impuestos_reg);

	$propina = $estructura->infoCompRetencion->propina->__toString();
	$importeTotal = $estructura->infoCompRetencion->importeTotal->__toString();
	$moneda = $estructura->infoCompRetencion->moneda;



	//--info adicional--//


	//print_r($estructura->infoAdicional->campoAdicional[0]["nombre"]->__toString());
	$iad = 0;
	$numfilas = 1;
	for ($ib = 0; $ib < count($estructura->infoAdicional->campoAdicional); $ib++) {
		//echo $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString(); 

		$pos = 0;
		$pos = strpos($estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString(), "formacionAdicio");

		if ($pos) {
			$adicion[$iad] = $estructura->infoAdicional->campoAdicional[$ib]->__toString();
		}
		//echo $pos."<br>";
		//----------------------------------------



		//----------------------------------------
		$iad++;
	}


	//--detalles--//


	//echo $numdetalle;
	//print_r($estructura->detalles->detalle[1]->codigoPrincipal);
	//<th class="css_bordesbarra">Comprobante</th>
	// <th class="css_bordesbarra">N&uacute;mero</th>
	//  <th class="css_bordesbarra">Fecha de emisi&oacute;n</th>
	// <th class="css_bordesbarra">Ejercicio Fiscal</th>

	//<td bgcolor="#FFFFFF" class="css_bordes_d">'.$estructura->docsSustento->docSustento->retenciones->retencion[$id]->codDocSustento->__toString().'</td>
	// <td bgcolor="#FFFFFF" class="css_bordes_d">'.$estructura->docsSustento->docSustento->retenciones->retencion[$id]->numDocSustento->__toString().'</td>
	// <td bgcolor="#FFFFFF" class="css_bordes_d">'.$estructura->docsSustento->docSustento->retenciones->retencion[$id]->fechaEmisionDocSustento->__toString().'</td>
	//<td bgcolor="#FFFFFF" class="css_bordes_d">'.$periodoFiscal.'</td>

	//print_r($estructura->docsSustento);
	$docsustento = $estructura->docsSustento->docSustento->codDocSustento;
	$ndocsus = $estructura->docsSustento->docSustento->numDocSustento->__toString();
	$fechaemidos = $estructura->docsSustento->docSustento->fechaEmisionDocSustento->__toString();

	$numimpuesto = count($estructura->docsSustento->docSustento->retenciones->retencion);

	$griddata .= '<table width="700px">
           <thead>
             <tr>
	            <th class="css_bordesbarra">#</th>
				<th class="css_bordesbarra">Impuesto</th>
			  <th class="css_bordesbarra">Cod. Ret.</th>
               <th class="css_bordesbarra">Base imponible</th>
                <th class="css_bordesbarra">% de retenci&oacute;n</th>
               <th class="css_bordesbarra">Valor Retenido </th>
			   
             </tr>
  </thead>	
			<tbody>';

	$ix = 1;

	for ($id = 0; $id < $numimpuesto; $id++) {

		$descripcioncodret = '';



		$codigoRetencion = $estructura->docsSustento->docSustento->retenciones->retencion[$id]->codigoRetencion->__toString();
		// $descripcioncodret=$estructura->impuestos->campoAdicional->InformacionAdicional1->__toString();


		$descripcioncodret = $estructura->infoAdicional->campoAdicional[$id]["nombre"];

		if ($descripcioncodret == InformacionAdicional1 . $ix) {
			$descodigorett = $estructura->infoAdicional->campoAdicional[$id]->__toString();
		}
		$ix++;

		// $baseimpd=$estructura->docsSustento->docSustento->retenciones->retencion[$id]->baseImponible;


		//$estructura->docsSustento->docSustento->retenciones->retencion[$id]->codDocSustento->__toString();


		//<docsSustento>
		//<docSustento>

		$griddata .= '<tr>  
			
			             <td bgcolor="#FFFFFF" class="css_bordes"><center>' . $numfilas . '</center></td>
						 <td bgcolor="#FFFFFF" class="css_bordes_d"><center>' . $retencion_code[$estructura->docsSustento->docSustento->retenciones->retencion[$id]->codigo->__toString()] . '</center></td>';

		if ($descodigorett) {

			//$griddata.='<td bgcolor="#FFFFFF" class="css_bordes_d">'.$codigoRetencion.' : '.$descodigorett.'</td>';
			$griddata .= '<td bgcolor="#FFFFFF" class="css_bordes_d"><center>' . $codigoRetencion . '</center></td>';
		} else {

			//$griddata.='<td bgcolor="#FFFFFF" class="css_bordes_d">'.$codigoRetencion.' : '.$renta_cod_un[trim($codigoRetencion)].'</td>';
			$griddata .= '<td bgcolor="#FFFFFF" class="css_bordes_d"><center>' . $codigoRetencion . '</center></td>';
		}


		$griddata .= '<td bgcolor="#FFFFFF" class="css_bordes"><center>' . number_format($estructura->docsSustento->docSustento->retenciones->retencion[$id]->baseImponible->__toString(), 2, ".", ",") . '</center></td> 
			   <td bgcolor="#FFFFFF" class="css_bordes"><center>' . $estructura->docsSustento->docSustento->retenciones->retencion[$id]->porcentajeRetener . '</center></td>';
		$griddata .= '</td>
               <td bgcolor="#FFFFFF" class="css_bordes"><center>' . number_format($estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString(), 2, ".", ",") . '</center></td>             
              
             </tr>';
		$totalvalorss = $estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
		$totalvalorp = $totalvalorp + $totalvalorss;
		$numfilas = $numfilas + 1;
	}


	$griddata .= '
	 
	 <tr>
	   
			   <td class="css_bordes"></td>
               <td class="css_bordes"></td>
               <td class="css_bordes"></td>
			   <td class="css_bordes"></td>
               <td class="css_bordes"><b>Total</b></td>
               <td class="css_bordes"><b>' . number_format($totalvalorp, 2, ".", ",") . '</b></td>
			   
             </tr>
	 
	 </tbody>
           </table>';
	//--infoAdicional--//

	$ley_data = '';
	$ley_data = '<span style="color:#000000"><b>AGENTE DE RETENCI&Oacute;N</b></span>';



	//--platilla--//
	$razonSocial = stripslashes(htmlentities($razonSocial));
	$string = str_replace("&amp;", '&', $razonSocial);
	$condatos = str_replace("-empresa-", $razonSocial . "<br>" . $ley_data, $plantilla);


	if ($dirEstablecimiento) {
		$dirEstablecimiento = stripslashes(htmlentities($dirEstablecimiento));
		if (date("Y-m-d") > '2017-08-12') {
			$condatos = str_replace("-direccions-", $dirEstablecimiento, $condatos);
		} else {
			$condatos = str_replace("-direccions-", "VIA DAULE KM 8 1/2 BODEGAS JUAN MONTALVO OFC. 5 Y 6", $condatos);
		}
	}
	if ($dirMatriz) {
		$dirMatriz = stripslashes(htmlentities($dirMatriz));
		$condatos = str_replace("-direccion-", $dirMatriz, $condatos);
	}


	$condatos = str_replace("-especial-", $contribuyenteEspecial, $condatos);
	$condatos = str_replace("-obligado-", $obligadoContabilidad, $condatos);
	$condatos = str_replace("-rucemp-", $ruc, $condatos);
	$condatos = str_replace("-nretencion-", $estab . "-" . $ptoEmi . "-" . $secuencial, $condatos);
	$condatos = str_replace("-nautorizacion-", $numeroAutorizacion, $condatos);
	$condatos = str_replace("-fechahoraaut-", $fechaAutorizacion, $condatos);
	$valamb = $ambiente;
	$condatos = str_replace("-ambiente-", $ambiente_code[$valamb], $condatos);
	$valemi = $tipoEmision;
	$condatos = str_replace("-emision-", $tipoemision_code[$valemi], $condatos);
	$condatos = str_replace("-claveacceso-", $claveAcceso, $condatos);
	$condatos = str_replace("-ruccliente-", $identificacionSujetoRetenido, $condatos);

	$razonSocialSujetoRetenido = stripslashes(htmlentities($razonSocialSujetoRetenido));
	$condatos = str_replace("-razonsocial-", $razonSocialSujetoRetenido, $condatos);

	$condatos = str_replace("-fechaemision-", $fechaEmision, $condatos);

	$condatos = str_replace("-total-", number_format($importeTotal, 2, ".", ","), $condatos);
	//Lista
	$condatos = str_replace("-lista-", $griddata, $condatos);

	//print_r($tvalorconiva);
	$condatos = str_replace("-subtotal-", number_format($tvalorconiva, 2, ".", ","), $condatos);

	$condatos = str_replace("-subtotalsiniva-", number_format($tvalorsiniva, 2, ".", ","), $condatos);

	$condatos = str_replace("-subtotalnograbado-", number_format($tvalornogravado, 2, ".", ","), $condatos);
	$condatos = str_replace("-iva-", number_format($valorivac, 2, ".", ","), $condatos);
	$condatos = str_replace("-descuento-", number_format($totalDescuento, 2, ".", ","), $condatos);
	$condatos = str_replace("-logo-", $logotipo_imd, $condatos);
	$condatos = str_replace("-barraclave-", $code_barra, $condatos);

	$condatos = str_replace("-csustento-", $docsustento, $condatos);
	$condatos = str_replace("-nsustento-", $ndocsus, $condatos);
	$condatos = str_replace("-fsustento-", $fechaemidos, $condatos);
	$condatos = str_replace("-efiscal-", $periodoFiscal, $condatos);

	$iad = 0;
	for ($ib = 0; $ib < count($estructura->infoAdicional->campoAdicional); $ib++) {
		//echo $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString(); 

		$nombrecampo = $estructura->infoAdicional->campoAdicional[$ib]["nombre"]->__toString();
		if ($nombrecampo == 'direccionComprador') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			// $dirclietxt=utf8_encode($dirclietxt);
			// $dirclietxt=str_replace("Quito Quito","Quito",$dirclietxt);
			//$dirclietxt=mb_convert_encoding($dirclietxt,'HTML-ENTITIES','UTF-8');
			// $dirclietxt=str_replace("Lotización","cierto",$dirclietxt);
			$condatos = str_replace("-dircli-", $dirclietxt, $condatos);



			//$condatos=utf8_decode($condatos);
			$dirbandera = 1;
		}
		if ($nombrecampo == 'telefonoSujetoRetenido') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$condatos = str_replace("-telcli-", $dirclietxt, $condatos);
			// $dirclietxt=mb_convert_encoding($dirclietxt,'HTML-ENTITIES','UTF-8');
			$telbandera = 1;
		}
		if ($nombrecampo == 'CorreoSujetoRetenido') {
			$dirclietxt = stripslashes(htmlentities($estructura->infoAdicional->campoAdicional[$ib]->__toString()));
			$dirclietxt = str_replace(";", "<br>", $dirclietxt);
			$condatos = str_replace("-emailcli-", $dirclietxt, $condatos);
			// $dirclietxt=mb_convert_encoding($dirclietxt,'HTML-ENTITIES','UTF-8');
			$emailbandera = 1;
		}


		//----------------------------------------
		$iad++;
	}

	if (!($dirbandera)) {
		$condatos = str_replace("-dircli-", "", $condatos);
	}
	if (!($telbandera)) {
		$condatos = str_replace("-telcli-", "", $condatos);
	}
	if (!($emailbandera)) {
		$condatos = str_replace("-emailcli-", "", $condatos);
	}




	return $condatos;
}
