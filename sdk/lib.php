<?php

function obtener_resultado($datos)
{
	$rsultadosri = $datos;
	$autorizoeldato = 0;
	@$ncomprobantes = $rsultadosri["RespuestaAutorizacionComprobante"]["numeroComprobantes"];

	// echo "xxx".$ncomprobantes;
	//echo $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["estado"];
	if ($ncomprobantes >= 1) {
		//verifica si hay autorizacion	

		if ($ncomprobantes == 1) {

			//igual a uno 
			$estado_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["estado"];
			$num_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["numeroAutorizacion"];
			$fecha_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["fechaAutorizacion"];
			$ambiente_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["ambiente"];

			$clvbusca = $datos["RespuestaAutorizacionComprobante"]["claveAccesoConsultada"];


			@$motivo_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["mensaje"];
			@$identificador = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["identificador"];

			//igual a uno  

		} else {
			//mayor a uno
			for ($i = 0; $i < $ncomprobantes; $i++) {

				$estado_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["estado"];
				$num_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["numeroAutorizacion"];
				$fecha_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["fechaAutorizacion"];
				$ambiente_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["ambiente"];

				$motivo_aut = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["mensajes"]["mensaje"]["mensaje"];
				$identificador = $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["mensajes"]["mensaje"]["identificador"];

				$clvbusca = $datos["RespuestaAutorizacionComprobante"]["claveAccesoConsultada"];

				if ($estado_aut == 'AUTORIZADO') {
					$i = $ncomprobantes + 5;
				}
			}


			//mayor a uno
		}
	}

	$sridata["estado"] = @$estado_aut;
	$sridata["motivo"] = @$motivo_aut;
	$sridata["codigo"] = @$identificador;
	$sridata["numaut"] = @$num_aut;
	$sridata["fechaaut"] = @$fecha_aut;

	return $sridata;
}

function envia_sri($DB_gogess, $documento, $id_documento, $link_envio, $debug)
{

	if ($documento == '01') {
		$tabla = 'beko_documentocabecera';
		$campo_autoriza = 'doccab_nautorizacion';
		$campo_fechaaut = 'doccab_fechaaut';
		$campo_estadosri = 'doccab_estadosri';
		$campo_motivo = 'doccab_motivodev';
		$campo_id = 'doccab_id';
		$campo_xml = 'doccab_xmlfirmado';
		$tipocomp = 'tipocmp_codigo';
		$ndocumento = 'doccab_ndocumento';
	}

	if ($documento == '03') {
		$tabla = 'dns_compras';
		$campo_autoriza = 'compra_autorizacion';
		$campo_fechaaut = 'compra_fechaaut';
		$campo_estadosri = 'compra_estadosri';
		$campo_motivo = 'compra_motivodev';
		$campo_id = 'compra_id';
		$campo_xml = 'compra_xmlfirmado';
		$tipocomp = 'tipdoc_id';
		$ndocumento = 'compra_nfactura';
		$documento = 19;
	}

	if ($documento == '04') {
		$tabla = 'beko_documentocabecera';
		$campo_autoriza = 'doccab_nautorizacion';
		$campo_fechaaut = 'doccab_fechaaut';
		$campo_estadosri = 'doccab_estadosri';
		$campo_motivo = 'doccab_motivodev';
		$campo_id = 'doccab_id';
		$campo_xml = 'doccab_xmlfirmado';
		$tipocomp = 'tipocmp_codigo';
		$ndocumento = 'doccab_ndocumento';
	}

	if ($documento == '05') {
		$tabla = 'factur_credito_cab';
		$campo_autoriza = 'cre_nautorizacion';
		$campo_fechaaut = 'cre_fechaaut';
		$campo_estadosri = 'cre_estadosri';
		$campo_motivo = 'cre_motivodev';
		$campo_id = 'id_crecab';
		$campo_xml = 'cre_xmlfirmado';
		$tipocomp = 'cre_tipocomprobante';
		$ndocumento = 'cre_ncredito';
	}

	if ($documento == '06') {
		$tabla = 'factur_guia_cabecera';
		$campo_autoriza = 'guiacab_nautorizacion';
		$campo_fechaaut = 'guiacab_fechaaut';
		$campo_estadosri = 'guiacab_estadosri';
		$campo_motivo = 'guiacab_motivodev';
		$campo_id = 'id_guiacab';
		$campo_xml = 'guiacab_xmlfirmado';
		$tipocomp = 'guiacab_tipocomprobante';
		$ndocumento = 'guiacab_nguia';
	}

	if ($documento == '07') {
		$tabla = 'comprobante_retencion_cab';
		$campo_autoriza = 'compretcab_nautorizacion';
		$campo_fechaaut = 'compretcab_fechaaut';
		$campo_estadosri = 'compretcab_estadosri';
		$campo_motivo = 'compretcab_motivodev';
		$campo_id = 'compretcab_id';
		$campo_xml = 'compretcab_xmlfirmado';
		$tipocomp = 'compretcab_tipocomprobante';
		$ndocumento = 'compretcab_nretencion';
	}

	echo $busca_xml = "select " . $campo_xml . "," . $ndocumento . " from " . $tabla . " where " . $tipocomp . "='" . $documento . "' and " . $campo_id . "='" . $id_documento . "'";
	if ($debug == 1) {
		//echo $busca_xml."<br>";
		//echo $link_envio."<br>";  
	}
	$error = array();
	$resultado = array();
	$ok_bu = $DB_gogess->executec($busca_xml, array());
	$salida_xml = $ok_bu->fields[$campo_xml];
	echo $num_dpcumento = $ok_bu->fields[$ndocumento];


	$client = new nusoap_client($link_envio, true);
	$resultado = $client->call(
		"validarComprobante",
		array(
			'xml' =>  $salida_xml
		)
	);

	$error = $client->getError();
	if ($debug == 1) {
		print_r($error);
		print_r($resultado);
	}

	$arreglolista = $resultado;

	if ($error) {
		echo "ERROR DE CONEXION (" . $id_documento . ")<br>";
		$actualiza = "update " . $tabla . " set " . $campo_autoriza . "=''," . $campo_fechaaut . "=''," . $campo_estadosri . "='DEVUELTA'," . $campo_motivo . "='ERROR DE CONEXION' where " . $campo_id . "='" . $id_documento . "' and " . $tipocomp . "='" . $documento . "'";
		$okv = $DB_gogess->executec($actualiza, array());
		$ready_estado = 'ERROR DE CONEXION';
	} else {

		$ready_estado = $arreglolista["RespuestaRecepcionComprobante"]["estado"];
		echo "<b>" . $ready_estado . "</b>" . "<br>";
		if ($ready_estado == 'DEVUELTA' or $ready_estado == 'RECHAZADA') {
			echo $ready_estado . " (" . $id_documento . ")<br>";
			$motivo = '';
			$motivo = str_replace("'", " ", $arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["informacionAdicional"]) . str_replace("'", " ", $arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["motivo"]);

			$actualiza = "update " . $tabla . " set " . $campo_autoriza . "=''," . $campo_fechaaut . "=''," . $campo_estadosri . "='" . $ready_estado . "'," . $campo_motivo . "='" . $motivo . "' where " . $campo_id . "='" . $id_documento . "' and " . $tipocomp . "='" . $documento . "'";
			$okv = $DB_gogess->executec($actualiza, array());
		} else {
			echo $ready_estado . " (" . $id_documento . ")<br>";
			$actualiza = "update " . @$tabla . " set " . @$campo_autoriza . "=''," . @$campo_fechaaut . "=''," . @$campo_estadosri . "='" . @$ready_estado . "'," . @$campo_motivo . "='" . @$motivo . "' where " . @$campo_id . "='" . @$id_documento . "' and " . @$tipocomp . "='" . @$documento . "'";
			$okv = $DB_gogess->executec($actualiza, array());
		}
	}
}

function autoriza_sri($DB_gogess, $documento, $id_documento, $link_envio, $debug)
{

	if ($documento == '01') {
		$tabla = 'beko_documentocabecera';
		$campo_autoriza = 'doccab_nautorizacion';
		$campo_fechaaut = 'doccab_fechaaut';
		$campo_estadosri = 'doccab_estadosri';
		$campo_motivo = 'doccab_motivodev';
		$campo_id = 'doccab_id';
		$campo_xml = 'doccab_xmlfirmado';
		$clave_acceo = 'doccab_clavedeaccesos';
		$tipocomp = 'tipocmp_codigo';
		$ndocumento = 'doccab_ndocumento';
	}

	if ($documento == '03') {
		$tabla = 'dns_compras';
		$campo_autoriza = 'compra_autorizacion';
		$campo_fechaaut = 'compra_fechaaut';
		$campo_estadosri = 'compra_estadosri';
		$campo_motivo = 'compra_motivodev';
		$campo_id = 'compra_id';
		$campo_xml = 'compra_xmlfirmado';
		$clave_acceo = 'compra_claveacceso';
		$tipocomp = 'tipdoc_id';
		$ndocumento = 'compra_nfactura';
		$documento = 19;
	}

	if ($documento == '04') {
		$tabla = 'beko_documentocabecera';
		$campo_autoriza = 'doccab_nautorizacion';
		$campo_fechaaut = 'doccab_fechaaut';
		$campo_estadosri = 'doccab_estadosri';
		$campo_motivo = 'doccab_motivodev';
		$campo_id = 'doccab_id';
		$campo_xml = 'doccab_xmlfirmado';
		$clave_acceo = 'doccab_clavedeaccesos';
		$tipocomp = 'tipocmp_codigo';
		$ndocumento = 'doccab_ndocumento';
	}

	if ($documento == '05') {
		$tabla = 'factur_credito_cab';
		$campo_autoriza = 'cre_nautorizacion';
		$campo_fechaaut = 'cre_fechaaut';
		$campo_estadosri = 'cre_estadosri';
		$campo_motivo = 'cre_motivodev';
		$campo_id = 'id_crecab';
		$campo_xml = 'cre_xmlfirmado';
		$clave_acceo = 'cre_clavedeaccesos';
		$tipocomp = 'cre_tipocomprobante';
		$ndocumento = 'cre_ncredito';
	}

	if ($documento == '06') {
		$tabla = 'factur_guia_cabecera';
		$campo_autoriza = 'guiacab_nautorizacion';
		$campo_fechaaut = 'guiacab_fechaaut';
		$campo_estadosri = 'guiacab_estadosri';
		$campo_motivo = 'guiacab_motivodev';
		$campo_id = 'id_guiacab';
		$campo_xml = 'guiacab_xmlfirmado';
		$clave_acceo = 'guiacab_clavedeaccesos';
		$tipocomp = 'guiacab_tipocomprobante';
		$ndocumento = 'guiacab_nguia';
	}

	if ($documento == '07') {
		$tabla = 'comprobante_retencion_cab';
		$campo_autoriza = 'compretcab_nautorizacion';
		$campo_fechaaut = 'compretcab_fechaaut';
		$campo_estadosri = 'compretcab_estadosri';
		$campo_motivo = 'compretcab_motivodev';
		$campo_id = 'compretcab_id';
		$campo_xml = 'compretcab_xmlfirmado';
		$clave_acceo = 'compretcab_clavedeaccesos';
		$tipocomp = 'compretcab_tipocomprobante';
		$ndocumento = 'compretcab_nretencion';
	}

	$busca_xml = "select " . $clave_acceo . "," . $ndocumento . " from " . $tabla . " where " . $tipocomp . "='" . $documento . "' and " . $campo_id . "='" . $id_documento . "'";
	if ($debug == 1) {
		//echo $busca_xml."<br>";
		//echo $link_envio."<br>";  
	}
	$ok_bu = $DB_gogess->executec($busca_xml, array());
	$listcg_claveAcceso = $ok_bu->fields[$clave_acceo];

	$acceso_clv = $listcg_claveAcceso;
	$num_dpcumento = $ok_bu->fields[$ndocumento];

	//echo "....";

	$cliente = new nusoap_client($link_envio, true);
	$resultado = $cliente->call(
		"autorizacionComprobante",
		array(
			'claveAccesoComprobante' => $listcg_claveAcceso
		)
	);

	$error = $cliente->getError();
	if ($debug == 1) {
		print_r($error);
		print_r($resultado);
	}
	$resultados_sri = obtener_resultado($resultado);

	$arreglolista = $resultado;
	echo "<b>" . $resultados_sri["estado"] . "</b>" . "<br>";
	echo "<b>" . $resultados_sri["motivo"] . "</b>" . "<br>";
	if ($error) {

		echo "<b>" . $resultados_sri["estado"] . "</b>" . "(" . $id_documento . ")<br>";
		$actualiza = "update " . $tabla . " set " . $campo_autoriza . "=''," . $campo_fechaaut . "=''," . $campo_estadosri . "='DEVUELTA'," . $campo_motivo . "='ERROR DE CONEXION SRI' where " . $campo_id . "='" . $id_documento . "' and " . $tipocomp . "='" . $documento . "'";
		$okv = $DB_gogess->executec($actualiza, array());
	} else {

		$ready_estado = $resultados_sri["estado"];
		$motivo = str_replace("'", " ", $resultados_sri["codigo"] . " " . $resultados_sri["motivo"]);
		if ($ready_estado == 'DEVUELTA' or $ready_estado == 'RECHAZADA') {
			echo "<b>" . $ready_estado . "</b>" . "(" . $id_documento . ") " . $motivo . "<br>";
			$actualiza = "update " . $tabla . " set " . $campo_autoriza . "=''," . $campo_fechaaut . "=''," . $campo_estadosri . "='" . $ready_estado . "'," . $campo_motivo . "='" . $motivo . "' where " . $campo_id . "='" . $id_documento . "' and " . $tipocomp . "='" . $documento . "'";
			$okv = $DB_gogess->executec($actualiza, array());
		} else {

			$actualiza = "update " . $tabla . " set " . $campo_autoriza . "='" . $resultados_sri["numaut"] . "'," . $campo_fechaaut . "='" . $resultados_sri["fechaaut"] . "'," . $campo_estadosri . "='" . $ready_estado . "'," . $campo_motivo . "='" . $motivo . "' where " . $campo_id . "='" . $id_documento . "' and " . $tipocomp . "='" . $documento . "'";

			$okv = $DB_gogess->executec($actualiza, array());
			if ($ready_estado == 'AUTORIZADO') {
				echo $ready_estado . "(" . $id_documento . ") <br>";
				$date = date("Y-m-d");

				if ($documento == '01') {
?>
					<script language="javascript">
						<!--
						ver_formularioenpantalla('aplicativos/documental/datos_ventas.php', 'Editar', 'divBody_ext', '<?php echo $id_documento; ?>', '183', 0, 0, 0, 0, 0);

						//
						-->
					</script>
<?php
				}
				////////////			   
			} else {
				print_r($resultado);
			}
		}
	}
}



?>