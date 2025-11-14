<?php

class sri_facturas extends sri_funciones
{

	var $_doccab_id;

	//codigo
	public function getdoccab_id()
	{
		return $this->_doccab_id;
	}

	public function setdoccab_id($doccab_id)
	{
		$this->_doccab_id = $doccab_id;
	}
	//codigo


	function genera_claveacceso_fac()
	{

		$busca_fac = "select * from beko_documentocabecera where 	doccab_id='" . $this->_doccab_id . "'";
		$rs_fac = $this->_DB_gogess->executec($busca_fac, array());

		$fechaarreglo0 = explode(" ", $rs_fac->fields["doccab_fechaemision_cliente"]);
		$fechaarreglo = explode("-", $fechaarreglo0[0]);
		$fechaclaveacceso = $fechaarreglo[2] . $fechaarreglo[1] . $fechaarreglo[0];
		$tipocx = $rs_fac->fields["tipocmp_codigo"];


		$busca_emp = "select * from app_empresa where emp_id='" . $rs_fac->fields["emp_id"] . "'";
		$rs_femp = $this->_DB_gogess->executec($busca_emp, array());
		$rucempresa = $rs_femp->fields["emp_ruc"];

		$emp_ambiente = $rs_fac->fields["ambi_valor"];
		//emis_valor
		$codigoclv8 = trim(str_replace("-", "", $rs_fac->fields["doccab_ndocumento"]));
		$numocho_dig = substr($codigoclv8, -8);

		$claveacc = trim($fechaclaveacceso . $tipocx . $rucempresa . $emp_ambiente . str_replace("-", "", $rs_fac->fields["doccab_ndocumento"]));

		$emin_valor = $rs_fac->fields["emis_valor"];
		$numerogenerado = $claveacc . trim($numocho_dig . $emin_valor);

		$numerovalidador = $this->agregar_dv($numerogenerado);
		$clavegenerada = $claveacc . trim($numocho_dig . $emin_valor . $numerovalidador);


		$actualiza_doc = "update beko_documentocabecera set doccab_nautorizacion='" . trim($clavegenerada) . "',doccab_clavedeaccesos='" . trim($clavegenerada) . "' where doccab_id='" . $this->_doccab_id . "'";
		$rs_actualiza = $this->_DB_gogess->executec($actualiza_doc, array());

		return trim($clavegenerada);
	}


	function genera_claveacceso_rec()
	{

		$busca_fac = "select * from beko_recibocabecera where doccab_id='" . $this->_doccab_id . "'";
		$rs_fac = $this->_DB_gogess->executec($busca_fac, array());

		$fechaarreglo0 = explode(" ", $rs_fac->fields["doccab_fechaemision_cliente"]);
		$fechaarreglo = explode("-", $fechaarreglo0[0]);
		$fechaclaveacceso = $fechaarreglo[2] . $fechaarreglo[1] . $fechaarreglo[0];
		$tipocx = $rs_fac->fields["tipocmp_codigo"];


		$busca_emp = "select * from app_empresa where emp_id='" . $rs_fac->fields["emp_id"] . "'";
		$rs_femp = $this->_DB_gogess->executec($busca_emp, array());
		$rucempresa = $rs_femp->fields["emp_ruc"];

		$emp_ambiente = $rs_fac->fields["ambi_valor"];
		//emis_valor
		$codigoclv8 = trim(str_replace("-", "", $rs_fac->fields["doccab_ndocumento"]));
		$numocho_dig = substr($codigoclv8, -8);

		$claveacc = trim($fechaclaveacceso . $tipocx . $rucempresa . $emp_ambiente . str_replace("-", "", $rs_fac->fields["doccab_ndocumento"]));

		$emin_valor = $rs_fac->fields["emis_valor"];
		$numerogenerado = $claveacc . trim($numocho_dig . $emin_valor);

		$numerovalidador = $this->agregar_dv($numerogenerado);
		$clavegenerada = $claveacc . trim($numocho_dig . $emin_valor . $numerovalidador);


		$actualiza_doc = "update beko_recibocabecera set doccab_nautorizacion='" . trim($clavegenerada) . "',doccab_clavedeaccesos='" . trim($clavegenerada) . "' where doccab_id='" . $this->_doccab_id . "'";
		$rs_actualiza = $this->_DB_gogess->executec($actualiza_doc, array());

		return trim($clavegenerada);
	}



	function genera_claveacceso_lq()
	{

		$busca_fac = "select * from dns_compras where compra_id='" . $this->_doccab_id . "'";
		$rs_fac = $this->_DB_gogess->executec($busca_fac, array());

		$fechaarreglo0 = explode(" ", $rs_fac->fields["compra_fecha"]);
		$fechaarreglo = explode("-", $fechaarreglo0[0]);
		$fechaclaveacceso = $fechaarreglo[2] . $fechaarreglo[1] . $fechaarreglo[0];
		$tipocx = '03';


		$busca_emp = "select * from app_empresa where emp_id='" . $rs_fac->fields["emp_id"] . "'";
		$rs_femp = $this->_DB_gogess->executec($busca_emp, array());
		$rucempresa = $rs_femp->fields["emp_ruc"];

		$emp_ambiente = '2';
		//emis_valor
		$codigoclv8 = trim(str_replace("-", "", $rs_fac->fields["compra_nfactura"]));
		$codigoclv8 = '12345678';
		$numocho_dig = substr($codigoclv8, -8);

		$claveacc = trim($fechaclaveacceso . $tipocx . $rucempresa . $emp_ambiente . str_replace("-", "", $rs_fac->fields["compra_nfactura"]));

		$emin_valor = '1';
		$numerogenerado = $claveacc . trim($numocho_dig . $emin_valor);

		$numerovalidador = $this->agregar_dv($numerogenerado);
		$clavegenerada = $claveacc . trim($numocho_dig . $emin_valor . $numerovalidador);


		$actualiza_doc = "update dns_compras set compra_autorizacion='" . trim($clavegenerada) . "',compra_claveacceso='" . trim($clavegenerada) . "' where compra_id='" . $this->_doccab_id . "'";
		$rs_actualiza = $this->_DB_gogess->executec($actualiza_doc, array());

		return trim($clavegenerada);
	}

	function xml_factura()
	{
		$salida_xml = '';
		$busca_facturaguardad = "select * from beko_documentocabecera where doccab_id='" . $this->_doccab_id . "' and doccab_estadosri!='AUTORIZADO'";
		$rs_buscaid = $this->_DB_gogess->executec($busca_facturaguardad, array());
		if ($rs_buscaid) {
			while (!$rs_buscaid->EOF) {

				//----------------------------------------------------------------------------------------------


				$datos_empresa = "select * from app_empresa inner join  efacsistema_cfgempresa on app_empresa.emp_id=efacsistema_cfgempresa.emp_id where app_empresa.emp_id=" . $rs_buscaid->fields["emp_id"];
				$rs_empresa = $this->_DB_gogess->executec($datos_empresa, array());
				if ($rs_empresa) {
					while (!$rs_empresa->EOF) {

						$emp_nombre = $rs_empresa->fields["emp_nombre"];
						$emp_ruc = $rs_empresa->fields["emp_ruc"];
						$emp_direccion = $rs_empresa->fields["emp_direccion"];

						$emp_ambiente = $rs_empresa->fields["ambi_valor"];
						$emp_emision = $rs_empresa->fields["tipoemi_codigo"];

						$emp_contabilidad = $rs_empresa->fields["cgfe_contabilidad"];
						$emp_especial = $rs_empresa->fields["cgfe_especial"];

						$cgfe_decimales = $rs_empresa->fields["cgfe_decimales"];



						$rs_empresa->MoveNext();
					}
				}

				$centro_direccion = '';
				$datos_centro = "select * from dns_centrosalud where centro_id=" . $rs_buscaid->fields["centro_id"];
				$rs_centro = $this->_DB_gogess->executec($datos_centro, array());
				if ($rs_centro) {
					while (!$rs_centro->EOF) {

						$centro_direccion = $rs_centro->fields["centro_direccion"];

						$rs_centro->MoveNext();
					}
				}


				$boques_num = explode("-", $rs_buscaid->fields["doccab_ndocumento"]);

				$salida_xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
				$salida_xml .= "<factura version=\"1.1.0\" id=\"comprobante\" >\n";
				$salida_xml .= "<infoTributaria>\n";
				$salida_xml .= "<ambiente>" . $emp_ambiente . "</ambiente>\n";
				$salida_xml .= "<tipoEmision>" . $emp_emision . "</tipoEmision>\n";
				$salida_xml .= "<razonSocial>" . $emp_nombre . "</razonSocial>\n";
				$salida_xml .= "<nombreComercial>" . $emp_nombre . "</nombreComercial>\n";
				$salida_xml .= "<ruc>" . $emp_ruc . "</ruc>\n";
				$salida_xml .= "<claveAcceso>" . $rs_buscaid->fields["doccab_clavedeaccesos"] . "</claveAcceso>\n";
				$salida_xml .= "<codDoc>" . $rs_buscaid->fields["tipocmp_codigo"] . "</codDoc>\n";
				$salida_xml .= "<estab>" . $boques_num[0] . "</estab>\n";
				$salida_xml .= "<ptoEmi>" . $boques_num[1] . "</ptoEmi>\n";
				$salida_xml .= "<secuencial>" . trim($boques_num[2]) . "</secuencial>\n";
				$salida_xml .= "<dirMatriz>" . $emp_direccion . "</dirMatriz>\n";
				$salida_xml .= "<agenteRetencion>1</agenteRetencion>\n";
				$salida_xml .= "</infoTributaria>\n";
				$salida_xml .= "<infoFactura>\n";

				$fechaemision = explode(" ", $rs_buscaid->fields["doccab_fechaemision_cliente"]);
				$separafecha = explode("-", $fechaemision[0]);
				$fechanuevaf = $separafecha[2] . "/" . $separafecha[1] . "/" . $separafecha[0];
				//
				$salida_xml .= "<fechaEmision>" . $fechanuevaf . "</fechaEmision>\n";
				$salida_xml .= "<dirEstablecimiento>" . $centro_direccion . "</dirEstablecimiento>\n";

				if (trim($emp_especial)) {
					$salida_xml .= "<contribuyenteEspecial>" . $emp_especial . "</contribuyenteEspecial>\n";
				}

				if ($emp_contabilidad == 'SI') {
					$obligadoc = 'SI';
				} else {
					$obligadoc = 'NO';
				}

				$salida_xml .= "<obligadoContabilidad>" . strtoupper($obligadoc) . "</obligadoContabilidad>\n";
				$salida_xml .= "<tipoIdentificacionComprador>" . $rs_buscaid->fields["tipoident_codigo"] . "</tipoIdentificacionComprador>\n";

				$salida_xml .= "<razonSocialComprador>" . $rs_buscaid->fields["doccab_nombrerazon_cliente"] . " " . $rs_buscaid->fields["doccab_apellidorazon_cliente"] . "</razonSocialComprador>\n";
				$salida_xml .= "<identificacionComprador>" . $rs_buscaid->fields["doccab_rucci_cliente"] . "</identificacionComprador>\n";

				$totlasinimp = $rs_buscaid->fields["doccab_subtotalsiniva"] + $rs_buscaid->fields["doccab_subtnoobjetoi"] + $rs_buscaid->fields["doccab_subtexentoiva"] + $rs_buscaid->fields["doccab_subtotaliva"];

				//total descuento

				//$busca_detalledescuento="select sum(docdet_descuento) as tdescuento from beko_documentodetalle_factur where doccab_id='".$rs_buscaid->fields["doccab_id"]."'";
				//$rs_buscadetalledesc = $this->_DB_gogess->executec($busca_detalledescuento,array());						  

				//total descuento


				$salida_xml .= "<totalSinImpuestos>" . number_format($totlasinimp, $cgfe_decimales, '.', '') . "</totalSinImpuestos>\n";
				$salida_xml .= "<totalDescuento>" . number_format($rs_buscaid->fields["doccab_descuento"], 2, '.', '') . "</totalDescuento>\n";
				$salida_xml .= "<totalConImpuestos>\n";

				//totales
				$detallesgrupo = "select sum(docdet_valorimpuesto) as docdet_valorimpuesto,impu_codigo,tari_codigo,round(sum(docdet_total),2) as tvalor from beko_documentodetalle_factur where doccab_id='" . $rs_buscaid->fields["doccab_id"] . "' group by tari_codigo";


				//$file = fopen("e_factura".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
				//fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$detallesgrupo."-->".date("Y-m-d H:i:s"). PHP_EOL);
				//fclose($file);

				$rs_grp = $this->_DB_gogess->executec($detallesgrupo, array());
				if ($rs_grp) {
					while (!$rs_grp->EOF) {

						$valorxml = 0;

						$valor_impuesto = "select * from beko_tarifa where tari_codigo='" . $rs_grp->fields["tari_codigo"] . "'";
						$rsimp_x = $this->_DB_gogess->executec($valor_impuesto, array());
						$ttotal = $rs_grp->fields["tvalor"];
						// $valorxml=round(($ttotal*$rsimp->fields["tari_valor"])/100),2);
						if ($rsimp_x->fields["tari_valor"] == 0) {
							$valorxml = 0;
						} else {
							$valorxml = ($ttotal * $rsimp_x->fields["tari_valor"]) / 100;
							$valorxml = round($valorxml, 2);
						}

						$salida_xml .= "<totalImpuesto>\n";
						$salida_xml .= "<codigo>" . $rs_grp->fields["impu_codigo"] . "</codigo>\n";
						$salida_xml .= "<codigoPorcentaje>" . $rs_grp->fields["tari_codigo"] . "</codigoPorcentaje>\n";
						$salida_xml .= "<baseImponible>" . number_format($rs_grp->fields["tvalor"], $cgfe_decimales, '.', '') . "</baseImponible>\n";
						$salida_xml .= "<valor>" . number_format($valorxml, $cgfe_decimales, '.', '') . "</valor>\n";
						$salida_xml .= "</totalImpuesto>\n";


						$rs_grp->MoveNext();
					}
				}
				$salida_xml .= "</totalConImpuestos>\n";
				//totales


				$salida_xml .= "<propina>" . number_format($rs_buscaid->fields["doccab_propina"], $cgfe_decimales, '.', '') . "</propina>\n";
				$salida_xml .= "<importeTotal>" . number_format($rs_buscaid->fields["doccab_total"], $cgfe_decimales, '.', '') . "</importeTotal>\n";
				$salida_xml .= "<moneda>DOLAR</moneda>\n";

				//cambio	

				$lista_formapago = "select * from lpin_formapagoventa inner join beko_formapago on lpin_formapagoventa.frmc_codigo=beko_formapago.frm_codigo where doccab_id='" . $this->_doccab_id . "'";
				$rs_fpago = $this->_DB_gogess->executec($lista_formapago, array());
				if ($rs_fpago->fields["doccab_id"]) {
					$salida_xml .= "<pagos>";
					if ($rs_fpago) {
						while (!$rs_fpago->EOF) {

							$salida_xml .= "<pago>";
							$salida_xml .= "<formaPago>" . $rs_fpago->fields["frm_codigo"] . "</formaPago>";
							$salida_xml .= "<total>" . $rs_fpago->fields["frmpven_valor"] . "</total>";
							$salida_xml .= "</pago>";


							$rs_fpago->MoveNext();
						}
					}
					$salida_xml .= "</pagos>";
				}

				//cambio

				$salida_xml .= "</infoFactura>\n";

				$salida_xml .= "<detalles>\n";
				$busca_detalle = "select * from beko_documentodetalle_factur where doccab_id='" . $rs_buscaid->fields["doccab_id"] . "'";
				$rs_buscadetalle = $this->_DB_gogess->executec($busca_detalle, array());
				if ($rs_buscadetalle) {
					while (!$rs_buscadetalle->EOF) {


						if (!($rs_buscadetalle->fields["docdet_codaux"])) {
							$aux_valor = $rs_buscadetalle->fields["docdet_codprincipal"];
						} else {
							$aux_valor = $rs_buscadetalle->fields["docdet_codaux"];
						}

						$salida_xml .= "<detalle>\n";


						//quitar saltos de linea

						$docdet_descripcion_limpio = '';
						$docdet_descripcion_limpio = preg_replace("[\n|\r|\n\r]", "", $rs_buscadetalle->fields["docdet_descripcion"]);
						$docdet_descripcion_limpio = preg_replace(utf8_encode("[&]"), "-", $docdet_descripcion_limpio);

						//quitar saltos de linea


						$salida_xml .= "<codigoPrincipal>" . $rs_buscadetalle->fields["docdet_codprincipal"] . "</codigoPrincipal>\n";
						$salida_xml .= "<codigoAuxiliar>" . $aux_valor . "</codigoAuxiliar>\n";
						$salida_xml .= "<descripcion>" . $docdet_descripcion_limpio . "</descripcion>\n";
						$salida_xml .= "<cantidad>" . number_format($rs_buscadetalle->fields["docdet_cantidad"], $cgfe_decimales, '.', '') . "</cantidad>\n";
						$salida_xml .= "<precioUnitario>" . number_format($rs_buscadetalle->fields["docdet_preciou"], 4, '.', '') . "</precioUnitario>\n";
						$salida_xml .= "<descuento>" . number_format($rs_buscadetalle->fields["docdet_descuento"], $cgfe_decimales, '.', '') . "</descuento>\n";
						$salida_xml .= "<precioTotalSinImpuesto>" . number_format($rs_buscadetalle->fields["docdet_total"], $cgfe_decimales, '.', '') . "</precioTotalSinImpuesto>\n";

						$impvalordata = $rs_buscadetalle->fields["tari_codigo"];
						$contenatododetadi = trim($rs_buscadetalle->fields["docdet_detallea"] . $rs_buscadetalle->fields["docdet_detalleb"] . $rs_buscadetalle->fields["docdet_detallec"]);

						if ($contenatododetadi) {

							$comilladoble = '"';
							$salida_xml .= "<detallesAdicionales>\n";
							if ($rs_buscadetalle->fields["docdet_detallea"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional1" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detallea"] . $comilladoble . " />\n";
							}

							if ($rs_buscadetalle->fields["docdet_detalleb"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional2" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detalleb"] . $comilladoble . " />\n";
							}

							if ($rs_buscadetalle->fields["docdet_detallec"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional3" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detallec"] . $comilladoble . " />\n";
							}

							$salida_xml .= " </detallesAdicionales>\n";
						}

						$valor_impuesto = "select * from beko_tarifa where tari_codigo='" . $rs_buscadetalle->fields["tari_codigo"] . "'";
						$rsimp_x = $this->_DB_gogess->executec($valor_impuesto, array());

						$salida_xml .= "<impuestos>\n";
						$salida_xml .= "<impuesto>\n";
						$salida_xml .= "<codigo>" . $rs_buscadetalle->fields["impu_codigo"] . "</codigo>\n";
						$salida_xml .= "<codigoPorcentaje>" . $rs_buscadetalle->fields["tari_codigo"] . "</codigoPorcentaje>\n";
						$salida_xml .= "<tarifa>" . $rsimp_x->fields["tari_valor"] . "</tarifa>\n";
						$baseimponivdetalle = 0.00;
						$baseimponivdetalle = $rs_buscadetalle->fields["docdet_total"];
						$salida_xml .= "<baseImponible>" . number_format($baseimponivdetalle, $cgfe_decimales, '.', '') . "</baseImponible>\n";

						$b_imponible = 0;
						$b_imponible = number_format($baseimponivdetalle, $cgfe_decimales, '.', '');



						$valorxml = 0;
						if ($rsimp_x->fields["tari_valor"] == 0) {
							$valorxml = 0;
						} else {
							$valorxml = ($b_imponible * $rsimp_x->fields["tari_valor"]) / 100;
							$valorxml = round($valorxml, 2);
						}


						$salida_xml .= "<valor>" . number_format($valorxml, $cgfe_decimales, '.', '') . "</valor>\n";
						$salida_xml .= "</impuesto>\n";
						$salida_xml .= "</impuestos>\n";
						$salida_xml .= "</detalle>\n";


						$rs_buscadetalle->MoveNext();
					}
				}

				$salida_xml .= "</detalles>\n";
				$salida_xml .= "<infoAdicional>\n";
				$salida_xml .= "<campoAdicional nombre=\"Agente de Retencion\">RESOLUCION: NAC-DNCRASC20-00000001</campoAdicional>\n";
				if ($rs_buscaid->fields["doccab_direccion_cliente"]) {
					$salida_xml .= "<campoAdicional nombre=\"direccionComprador\">" . $rs_buscaid->fields["doccab_direccion_cliente"] . "</campoAdicional>\n";
				}
				if ($rs_buscaid->fields["doccab_telefono_cliente"]) {
					$telfcli = str_replace("-", "", $rs_buscaid->fields["doccab_telefono_cliente"]);
					$telfcli = str_replace("(", "", $telfcli);
					$telfcli = str_replace(")", "", $telfcli);
					$telfcli = str_replace(" ", "", $telfcli);
					$salida_xml .= "<campoAdicional nombre=\"telefonoComprador\">" . $telfcli . "</campoAdicional>\n";
				}
				if ($rs_buscaid->fields["doccab_email_cliente"]) {
					$salida_xml .= "<campoAdicional nombre=\"CorreoCliente\">" . $rs_buscaid->fields["doccab_email_cliente"] . "</campoAdicional>\n";
				}

				if ($rs_buscaid->fields["tippo_id"]) {
					$busca_tipocobro = "select * from cesdb_arextension.dns_tipoproceso where tippo_id='" . $rs_buscaid->fields["tippo_id"] . "'";
					$rs_tipocobro = $this->_DB_gogess->executec($busca_tipocobro, array());
					$salida_xml .= "<campoAdicional nombre=\"Tipo\">" . $rs_tipocobro->fields["tippo_nombre"] . "</campoAdicional>\n";
				}

				if ($rs_buscaid->fields["conve_id"]) {
					$busca_tipocobro1 = "select * from cesdb_arextension.dns_convenios where conve_id='" . $rs_buscaid->fields["conve_id"] . "'";
					$rs_tipocobro1 = $this->_DB_gogess->executec($busca_tipocobro1, array());
					$salida_xml .= "<campoAdicional nombre=\"Convenio\">" . $rs_tipocobro1->fields["conve_nombre"] . " " . $rs_buscaid->fields["doccab_autorizacion"] . "</campoAdicional>\n";
				}

				if ($rs_buscaid->fields["doccab_adicional"]) {

					$salida_xml .= "<campoAdicional nombre=\"adicionalfac\">" . $rs_buscaid->fields["doccab_adicional"] . "</campoAdicional>\n";
				}


				$salida_xml .= "</infoAdicional>\n";
				$salida_xml .= "</factura>";

				//echo $salida_xml;
				$xmlbtval = $salida_xml;
				$xmlbase = "update beko_documentocabecera set doccab_xml='" . base64_encode($xmlbtval) . "',doccab_xmlfirmado='',doccab_firmado='',doccab_estadosri='' where doccab_id='" . $rs_buscaid->fields["doccab_id"] . "'";

				/*$file = fopen("archivof.txt", "w");
fwrite($file, $xmlbase . PHP_EOL);
fclose($file);*/


				$okxmldat = $this->_DB_gogess->executec($xmlbase, array());
				//----------------------------------------------------------------------------------------------

				$rs_buscaid->MoveNext();
			}
		}

		//return base64_encode($xmlbtval);
		return base64_encode($xmlbtval);
	}


	function xml_recibo()
	{
		$salida_xml = '';
		$busca_facturaguardad = "select * from beko_recibocabecera where doccab_id='" . $this->_doccab_id . "' and doccab_estadosri!='AUTORIZADO'";
		$rs_buscaid = $this->_DB_gogess->executec($busca_facturaguardad, array());
		if ($rs_buscaid) {
			while (!$rs_buscaid->EOF) {

				//----------------------------------------------------------------------------------------------
				$usua_id_saca = $rs_buscaid->fields["usua_id"];
				$n_usuario = "select * from app_usuario where usua_id='" . $usua_id_saca . "'";
				$rs_nususario = $this->_DB_gogess->executec($n_usuario, array());
				$usua_nombre = $rs_nususario->fields["usua_nombre"];
				$usua_apellido = $rs_nususario->fields["usua_apellido"];
				$nusuario_data = '';
				$nusuario_data = $usua_nombre . ' ' . $usua_apellido;

				$datos_empresa = "select * from app_empresa inner join  efacsistema_cfgempresa on app_empresa.emp_id=efacsistema_cfgempresa.emp_id where app_empresa.emp_id=" . $rs_buscaid->fields["emp_id"];
				$rs_empresa = $this->_DB_gogess->executec($datos_empresa, array());
				if ($rs_empresa) {
					while (!$rs_empresa->EOF) {

						$emp_nombre = $rs_empresa->fields["emp_nombre"];
						$emp_ruc = $rs_empresa->fields["emp_ruc"];
						$emp_direccion = $rs_empresa->fields["emp_direccion"];

						$emp_ambiente = $rs_empresa->fields["ambi_valor"];
						$emp_emision = $rs_empresa->fields["tipoemi_codigo"];

						$emp_contabilidad = $rs_empresa->fields["cgfe_contabilidad"];
						$emp_especial = $rs_empresa->fields["cgfe_especial"];

						$cgfe_decimales = $rs_empresa->fields["cgfe_decimales"];



						$rs_empresa->MoveNext();
					}
				}

				$centro_direccion = '';
				$datos_centro = "select * from dns_centrosalud where centro_id=" . $rs_buscaid->fields["centro_id"];
				$rs_centro = $this->_DB_gogess->executec($datos_centro, array());
				if ($rs_centro) {
					while (!$rs_centro->EOF) {

						$centro_direccion = $rs_centro->fields["centro_direccion"];

						$rs_centro->MoveNext();
					}
				}


				$boques_num = explode("-", $rs_buscaid->fields["doccab_ndocumento"]);

				$salida_xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
				$salida_xml .= "<factura version=\"1.1.0\" id=\"comprobante\" >\n";
				$salida_xml .= "<infoTributaria>\n";
				$salida_xml .= "<ambiente>" . $emp_ambiente . "</ambiente>\n";
				$salida_xml .= "<tipoEmision>" . $emp_emision . "</tipoEmision>\n";
				$salida_xml .= "<razonSocial>" . $emp_nombre . "</razonSocial>\n";
				$salida_xml .= "<nombreComercial>" . $emp_nombre . "</nombreComercial>\n";
				$salida_xml .= "<ruc>" . $emp_ruc . "</ruc>\n";
				$salida_xml .= "<claveAcceso>" . $rs_buscaid->fields["doccab_clavedeaccesos"] . "</claveAcceso>\n";
				$salida_xml .= "<codDoc>" . $rs_buscaid->fields["tipocmp_codigo"] . "</codDoc>\n";
				$salida_xml .= "<estab>" . $boques_num[0] . "</estab>\n";
				$salida_xml .= "<ptoEmi>" . $boques_num[1] . "</ptoEmi>\n";
				$salida_xml .= "<secuencial>" . trim($boques_num[2]) . "</secuencial>\n";
				$salida_xml .= "<dirMatriz>" . $emp_direccion . "</dirMatriz>\n";
				$salida_xml .= "</infoTributaria>\n";
				$salida_xml .= "<infoFactura>\n";

				$fechaemision = explode(" ", $rs_buscaid->fields["doccab_fechaemision_cliente"]);
				$separafecha = explode("-", $fechaemision[0]);
				$fechanuevaf = $separafecha[2] . "/" . $separafecha[1] . "/" . $separafecha[0];
				//
				$salida_xml .= "<fechaEmision>" . $fechanuevaf . "</fechaEmision>\n";
				$salida_xml .= "<dirEstablecimiento>" . $centro_direccion . "</dirEstablecimiento>\n";

				if (trim($emp_especial)) {
					$salida_xml .= "<contribuyenteEspecial>" . $emp_especial . "</contribuyenteEspecial>\n";
				}

				if ($emp_contabilidad == 1) {
					$obligadoc = 'SI';
				} else {
					$obligadoc = 'NO';
				}

				$salida_xml .= "<obligadoContabilidad>" . strtoupper($obligadoc) . "</obligadoContabilidad>\n";
				$salida_xml .= "<tipoIdentificacionComprador>" . $rs_buscaid->fields["tipoident_codigo"] . "</tipoIdentificacionComprador>\n";

				$salida_xml .= "<razonSocialComprador>" . $rs_buscaid->fields["doccab_nombrerazon_cliente"] . " " . $rs_buscaid->fields["doccab_apellidorazon_cliente"] . "</razonSocialComprador>\n";
				$salida_xml .= "<identificacionComprador>" . $rs_buscaid->fields["doccab_rucci_cliente"] . "</identificacionComprador>\n";

				$totlasinimp = $rs_buscaid->fields["doccab_subtotalsiniva"] + $rs_buscaid->fields["doccab_subtnoobjetoi"] + $rs_buscaid->fields["doccab_subtexentoiva"];
				$salida_xml .= "<totalSinImpuestos>" . number_format($totlasinimp, $cgfe_decimales, '.', '') . "</totalSinImpuestos>\n";
				$salida_xml .= "<totalDescuento>" . number_format($rs_buscaid->fields["doccab_descuento"], $cgfe_decimales, '.', '') . "</totalDescuento>\n";
				$salida_xml .= "<totalConImpuestos>\n";

				//totales
				$detallesgrupo = "select docdet_valorimpuesto,impu_codigo,tari_codigo,sum(docdet_total) as tvalor from beko_recibodetalle where doccab_id='" . $rs_buscaid->fields["doccab_id"] . "' group by tari_codigo";
				$rs_grp = $this->_DB_gogess->executec($detallesgrupo, array());
				if ($rs_grp) {
					while (!$rs_grp->EOF) {

						$valorxml = 0;
						$valorxml = ($rs_grp->fields["docdet_valorimpuesto"]);
						if ($rs_grp->fields["tari_codigo"] == 2) {
							$ttotal = $rs_grp->fields["tvalor"];
							$valorxml = (($rs_grp->fields["docdet_valorimpuesto"]));
						}

						if ($rs_grp->fields["tari_codigo"] == 4) {
							$ttotal = $rs_grp->fields["tvalor"];
							$valorxml = (($rs_grp->fields["docdet_valorimpuesto"]));
						}

						if ($rs_grp->fields["tari_codigo"] == 3) {
							$ttotal = $rs_grp->fields["tvalor"];
							$valorxml = (($rs_grp->fields["docdet_valorimpuesto"]));
						}


						$salida_xml .= "<totalImpuesto>\n";
						$salida_xml .= "<codigo>" . $rs_grp->fields["impu_codigo"] . "</codigo>\n";
						$salida_xml .= "<codigoPorcentaje>" . $rs_grp->fields["tari_codigo"] . "</codigoPorcentaje>\n";
						if ($rs_grp->fields["tari_codigo"] == 0) {
							$ttotalceroimp = $rs_grp->fields["tvalor"];
						}
						$salida_xml .= "<baseImponible>" . number_format($rs_grp->fields["tvalor"], $cgfe_decimales, '.', '') . "</baseImponible>\n";
						$salida_xml .= "<valor>" . number_format($valorxml, $cgfe_decimales, '.', '') . "</valor>\n";
						$salida_xml .= "</totalImpuesto>\n";


						$rs_grp->MoveNext();
					}
				}
				$salida_xml .= "</totalConImpuestos>\n";
				//totales


				$salida_xml .= "<propina>" . number_format($rs_buscaid->fields["doccab_propina"], $cgfe_decimales, '.', '') . "</propina>\n";
				$salida_xml .= "<importeTotal>" . number_format($rs_buscaid->fields["doccab_total"], $cgfe_decimales, '.', '') . "</importeTotal>\n";
				$salida_xml .= "<moneda>DOLAR</moneda>\n";

				//cambio	

				$lista_formapago = "select * from lpin_formapagoventa inner join beko_formapago on lpin_formapagoventa.frmc_codigo=beko_formapago.frm_codigo where doccab_id='" . $this->_doccab_id . "'";
				$rs_fpago = $this->_DB_gogess->executec($lista_formapago, array());

				if (@$rs_fpago->fields["doccab_id"]) {
					$salida_xml .= "<pagos>";
					if ($rs_fpago) {
						while (!$rs_fpago->EOF) {

							$salida_xml .= "<pago>";
							$salida_xml .= "<formaPago>" . $rs_fpago->fields["frmc_codigo"] . "</formaPago>";
							$salida_xml .= "<total>" . $rs_fpago->fields["frmpven_valor"] . "</total>";
							$salida_xml .= "</pago>";


							$rs_fpago->MoveNext();
						}
					}
					$salida_xml .= "</pagos>";
				}

				//cambio

				$salida_xml .= "</infoFactura>\n";

				$salida_xml .= "<detalles>\n";
				$busca_detalle = "select * from beko_recibodetalle where doccab_id='" . $rs_buscaid->fields["doccab_id"] . "'";
				$rs_buscadetalle = $this->_DB_gogess->executec($busca_detalle, array());
				if ($rs_buscadetalle) {
					while (!$rs_buscadetalle->EOF) {


						if (!($rs_buscadetalle->fields["docdet_codaux"])) {
							$aux_valor = $rs_buscadetalle->fields["docdet_codprincipal"];
						} else {
							$aux_valor = $rs_buscadetalle->fields["docdet_codaux"];
						}

						$salida_xml .= "<detalle>\n";


						$salida_xml .= "<codigoPrincipal>" . $rs_buscadetalle->fields["docdet_codprincipal"] . "</codigoPrincipal>\n";
						$salida_xml .= "<codigoAuxiliar>" . $aux_valor . "</codigoAuxiliar>\n";
						$salida_xml .= "<descripcion>" . $rs_buscadetalle->fields["docdet_descripcion"] . "</descripcion>\n";
						$salida_xml .= "<cantidad>" . number_format($rs_buscadetalle->fields["docdet_cantidad"], $cgfe_decimales, '.', '') . "</cantidad>\n";
						$salida_xml .= "<precioUnitario>" . number_format($rs_buscadetalle->fields["docdet_preciou"], $cgfe_decimales, '.', '') . "</precioUnitario>\n";
						$salida_xml .= "<descuento>" . number_format($rs_buscadetalle->fields["docdet_descuento"], $cgfe_decimales, '.', '') . "</descuento>\n";
						$salida_xml .= "<precioTotalSinImpuesto>" . number_format($rs_buscadetalle->fields["docdet_total"], $cgfe_decimales, '.', '') . "</precioTotalSinImpuesto>\n";

						$impvalordata = $rs_buscadetalle->fields["tari_codigo"];
						$contenatododetadi = trim($rs_buscadetalle->fields["docdet_detallea"] . $rs_buscadetalle->fields["docdet_detalleb"] . $rs_buscadetalle->fields["docdet_detallec"]);

						if ($contenatododetadi) {

							$comilladoble = '"';
							$salida_xml .= "<detallesAdicionales>\n";
							if ($rs_buscadetalle->fields["docdet_detallea"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional1" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detallea"] . $comilladoble . " />\n";
							}

							if ($rs_buscadetalle->fields["docdet_detalleb"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional2" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detalleb"] . $comilladoble . " />\n";
							}

							if ($rs_buscadetalle->fields["docdet_detallec"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional3" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detallec"] . $comilladoble . " />\n";
							}

							$salida_xml .= " </detallesAdicionales>\n";
						}


						$salida_xml .= "<impuestos>\n";
						$salida_xml .= "<impuesto>\n";
						$salida_xml .= "<codigo>" . $rs_buscadetalle->fields["impu_codigo"] . "</codigo>\n";
						$salida_xml .= "<codigoPorcentaje>" . $rs_buscadetalle->fields["tari_codigo"] . "</codigoPorcentaje>\n";
						$salida_xml .= "<tarifa>" . $rs_buscadetalle->fields["docdet_porcentaje"] . "</tarifa>\n";
						$baseimponivdetalle = 0.00;
						$baseimponivdetalle = $rs_buscadetalle->fields["docdet_total"];
						$salida_xml .= "<baseImponible>" . number_format($baseimponivdetalle, $cgfe_decimales, '.', '') . "</baseImponible>\n";
						$salida_xml .= "<valor>" . number_format($rs_buscadetalle->fields["docdet_valorimpuesto"], $cgfe_decimales, '.', '') . "</valor>\n";
						$salida_xml .= "</impuesto>\n";
						$salida_xml .= "</impuestos>\n";
						$salida_xml .= "</detalle>\n";


						$rs_buscadetalle->MoveNext();
					}
				}

				$salida_xml .= "</detalles>\n";
				$salida_xml .= "<infoAdicional>\n";
				if ($rs_buscaid->fields["doccab_direccion_cliente"]) {
					$salida_xml .= "<campoAdicional nombre=\"direccionComprador\">" . $rs_buscaid->fields["doccab_direccion_cliente"] . "</campoAdicional>\n";
				}
				if ($rs_buscaid->fields["doccab_telefono_cliente"]) {
					$telfcli = str_replace("-", "", $rs_buscaid->fields["doccab_telefono_cliente"]);
					$telfcli = str_replace("(", "", $telfcli);
					$telfcli = str_replace(")", "", $telfcli);
					$telfcli = str_replace(" ", "", $telfcli);
					$salida_xml .= "<campoAdicional nombre=\"telefonoComprador\">" . $telfcli . "</campoAdicional>\n";
				}
				if ($rs_buscaid->fields["doccab_email_cliente"]) {
					$salida_xml .= "<campoAdicional nombre=\"CorreoCliente\">" . $rs_buscaid->fields["doccab_email_cliente"] . "</campoAdicional>\n";
				}

				if ($rs_buscaid->fields["doccab_observacion"]) {
					$salida_xml .= "<campoAdicional nombre=\"obs2\">" . $rs_buscaid->fields["doccab_observacion"] . "</campoAdicional>\n";
				}

				if ($rs_buscaid->fields["tippo_id"]) {
					$busca_tipocobro = "select * from cesdb_arextension.dns_tipoproceso where tippo_id='" . $rs_buscaid->fields["tippo_id"] . "'";
					$rs_tipocobro = $this->_DB_gogess->executec($busca_tipocobro, array());
					$salida_xml .= "<campoAdicional nombre=\"Tipo\">" . $rs_tipocobro->fields["tippo_nombre"] . "</campoAdicional>\n";
				}

				if ($rs_buscaid->fields["conve_id"]) {
					$busca_tipocobro1 = "select * from cesdb_arextension.dns_convenios where conve_id='" . $rs_buscaid->fields["conve_id"] . "'";
					$rs_tipocobro1 = $this->_DB_gogess->executec($busca_tipocobro1, array());
					$salida_xml .= "<campoAdicional nombre=\"Convenio\">" . $rs_tipocobro1->fields["conve_nombre"] . " " . $rs_buscaid->fields["doccab_autorizacion"] . "</campoAdicional>\n";
				}

				if ($nusuario_data) {
					$salida_xml .= "<campoAdicional nombre=\"usuario\">" . $nusuario_data . "</campoAdicional>\n";
				}



				$salida_xml .= "</infoAdicional>\n";
				$salida_xml .= "</factura>";

				//echo $salida_xml;
				$xmlbtval = $salida_xml;
				$xmlbase = "update beko_recibocabecera set doccab_xml='" . base64_encode($xmlbtval) . "',doccab_xmlfirmado='',doccab_firmado='',doccab_estadosri='' where doccab_id='" . $rs_buscaid->fields["doccab_id"] . "'";

				/*$file = fopen("archivof.txt", "w");
fwrite($file, $xmlbase . PHP_EOL);
fclose($file);*/


				$okxmldat = $this->_DB_gogess->executec($xmlbase, array());
				//----------------------------------------------------------------------------------------------

				$rs_buscaid->MoveNext();
			}
		}

		return base64_encode($xmlbtval);
	}



	function xml_lq()
	{
		$salida_xml = '';
		$busca_facturaguardad = "select * from dns_compras where compra_id='" . $this->_doccab_id . "' and compra_estadosri!='AUTORIZADO'";
		$rs_buscaid = $this->_DB_gogess->executec($busca_facturaguardad, array());
		if ($rs_buscaid) {
			while (!$rs_buscaid->EOF) {

				//----------------------------------------------------------------------------------------------


				$datos_empresa = "select * from app_empresa inner join  efacsistema_cfgempresa on app_empresa.emp_id=efacsistema_cfgempresa.emp_id where app_empresa.emp_id=" . $rs_buscaid->fields["emp_id"];
				$rs_empresa = $this->_DB_gogess->executec($datos_empresa, array());
				if ($rs_empresa) {
					while (!$rs_empresa->EOF) {

						$emp_nombre = $rs_empresa->fields["emp_nombre"];
						$emp_ruc = $rs_empresa->fields["emp_ruc"];
						$emp_direccion = $rs_empresa->fields["emp_direccion"];

						$emp_ambiente = $rs_empresa->fields["ambi_valor"];
						$emp_emision = $rs_empresa->fields["tipoemi_codigo"];

						$emp_contabilidad = $rs_empresa->fields["cgfe_contabilidad"];
						$emp_especial = $rs_empresa->fields["cgfe_especial"];

						$cgfe_decimales = $rs_empresa->fields["cgfe_decimales"];



						$rs_empresa->MoveNext();
					}
				}

				$centro_direccion = '';
				$datos_centro = "select * from dns_centrosalud where centro_id=" . $rs_buscaid->fields["centro_id"];
				$rs_centro = $this->_DB_gogess->executec($datos_centro, array());
				if ($rs_centro) {
					while (!$rs_centro->EOF) {

						$centro_direccion = $rs_centro->fields["centro_direccion"];

						$rs_centro->MoveNext();
					}
				}


				$boques_num = explode("-", $rs_buscaid->fields["compra_nfactura"]);

				$salida_xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
				$salida_xml .= "<liquidacionCompra version=\"1.1.0\" id=\"comprobante\" >\n";
				$salida_xml .= "<infoTributaria>\n";
				$salida_xml .= "<ambiente>" . $emp_ambiente . "</ambiente>\n";
				$salida_xml .= "<tipoEmision>" . $emp_emision . "</tipoEmision>\n";
				$salida_xml .= "<razonSocial>" . $emp_nombre . "</razonSocial>\n";
				$salida_xml .= "<nombreComercial>" . $emp_nombre . "</nombreComercial>\n";
				$salida_xml .= "<ruc>" . $emp_ruc . "</ruc>\n";
				$salida_xml .= "<claveAcceso>" . $rs_buscaid->fields["compra_claveacceso"] . "</claveAcceso>\n";
				$salida_xml .= "<codDoc>03</codDoc>\n";
				$salida_xml .= "<estab>" . $boques_num[0] . "</estab>\n";
				$salida_xml .= "<ptoEmi>" . $boques_num[1] . "</ptoEmi>\n";
				$salida_xml .= "<secuencial>" . trim($boques_num[2]) . "</secuencial>\n";
				$salida_xml .= "<dirMatriz>" . $emp_direccion . "</dirMatriz>\n";
				$salida_xml .= "</infoTributaria>\n";
				$salida_xml .= "<infoLiquidacionCompra>\n";

				$fechaemision = explode(" ", $rs_buscaid->fields["compra_fecha"]);
				$separafecha = explode("-", $fechaemision[0]);
				$fechanuevaf = $separafecha[2] . "/" . $separafecha[1] . "/" . $separafecha[0];
				//
				$salida_xml .= "<fechaEmision>" . $fechanuevaf . "</fechaEmision>\n";
				$salida_xml .= "<dirEstablecimiento>" . $emp_direccion . "</dirEstablecimiento>\n";

				if (trim($emp_especial)) {
					$salida_xml .= "<contribuyenteEspecial>" . $emp_especial . "</contribuyenteEspecial>\n";
				}

				if ($emp_contabilidad == 'SI') {
					$obligadoc = 'SI';
				} else {
					$obligadoc = 'NO';
				}

				$busca_proveedor = "select * from app_proveedor where provee_id='" . $rs_buscaid->fields["proveevar_id"] . "'";
				$rs_proveedor = $this->_DB_gogess->executec($busca_proveedor, array());

				$salida_xml .= "<obligadoContabilidad>" . strtoupper($obligadoc) . "</obligadoContabilidad>\n";
				$salida_xml .= "<tipoIdentificacionProveedor>" . $rs_proveedor->fields["tipoident_codigocl"] . "</tipoIdentificacionProveedor>\n";

				$salida_xml .= "<razonSocialProveedor>" . $rs_proveedor->fields["provee_nombre"] . "</razonSocialProveedor>\n";
				$salida_xml .= "<identificacionProveedor>" . $rs_proveedor->fields["provee_cedula"] . "</identificacionProveedor>\n";
				$salida_xml .= "<direccionProveedor>" . $rs_proveedor->fields["provee_direccion"] . "</direccionProveedor>\n";


				//$totlasinimp=$rs_buscaid->fields["compra_subtotalceroiva"]+$rs_buscaid->fields["doccab_subtnoobjetoi"]+$rs_buscaid->fields["doccab_subtexentoiva"];	
				$totlasinimp = $rs_buscaid->fields["compra_subtotalceroiva"] + $rs_buscaid->fields["compra_subtotaliva"];

				$salida_xml .= "<totalSinImpuestos>" . number_format($totlasinimp, $cgfe_decimales, '.', '') . "</totalSinImpuestos>\n";
				$salida_xml .= "<totalDescuento>" . number_format($rs_buscaid->fields["compra_descuento"], $cgfe_decimales, '.', '') . "</totalDescuento>\n";
				$salida_xml .= "<totalConImpuestos>\n";

				//totales
				$detallesgrupo = "select docdet_valorimpuesto,impu_codigo,tari_codigo,sum(docdet_total) as tvalor from beko_lqdetalle_compra where doccab_id='" . $rs_buscaid->fields["compra_enlace"] . "' group by tari_codigo";
				$rs_grp = $this->_DB_gogess->executec($detallesgrupo, array());
				if ($rs_grp) {
					while (!$rs_grp->EOF) {

						$valorxml = 0;
						$valorxml = (($rs_grp->fields["docdet_valorimpuesto"] * $rs_grp->fields["tvalor"]) / 100);
						if ($rs_grp->fields["tari_codigo"] == 2) {
							$ttotal = $rs_grp->fields["tvalor"];
							$valorxml = (($rs_grp->fields["docdet_valorimpuesto"] * $rs_grp->fields["tvalor"]) / 100);
						}

						if ($rs_grp->fields["tari_codigo"] == 4) {
							$ttotal = $rs_grp->fields["tvalor"];
							$valorxml = (($rs_grp->fields["docdet_valorimpuesto"] * $rs_grp->fields["tvalor"]) / 100);
						}

						if ($rs_grp->fields["tari_codigo"] == 3) {
							$ttotal = $rs_grp->fields["tvalor"];
							$valorxml = (($rs_grp->fields["docdet_valorimpuesto"] * $rs_grp->fields["tvalor"]) / 100);
						}


						$salida_xml .= "<totalImpuesto>\n";
						$salida_xml .= "<codigo>" . $rs_grp->fields["impu_codigo"] . "</codigo>\n";
						$salida_xml .= "<codigoPorcentaje>" . $rs_grp->fields["tari_codigo"] . "</codigoPorcentaje>\n";
						if ($rs_grp->fields["tari_codigo"] == 0) {
							$ttotalceroimp = $rs_grp->fields["tvalor"];
						}
						$salida_xml .= "<baseImponible>" . number_format($rs_grp->fields["tvalor"], $cgfe_decimales, '.', '') . "</baseImponible>\n";
						$salida_xml .= "<valor>" . number_format($valorxml, $cgfe_decimales, '.', '') . "</valor>\n";
						$salida_xml .= "</totalImpuesto>\n";


						$rs_grp->MoveNext();
					}
				}
				$salida_xml .= "</totalConImpuestos>\n";
				//totales


				//$salida_xml .= "<propina>".number_format($rs_buscaid->fields["doccab_propina"], $cgfe_decimales, '.', '')."</propina>\n";											
				$salida_xml .= "<importeTotal>" . number_format($rs_buscaid->fields["compra_total"], $cgfe_decimales, '.', '') . "</importeTotal>\n";
				$salida_xml .= "<moneda>DOLAR</moneda>\n";

				//cambio	

				$lista_formapago = "select * from lpin_formapagocompra  where compra_enlace='" . $rs_buscaid->fields["compra_enlace"] . "'";
				$rs_fpago = $this->_DB_gogess->executec($lista_formapago, array());
				if ($rs_fpago->fields["compra_enlace"]) {
					$salida_xml .= "<pagos>";
					if ($rs_fpago) {
						while (!$rs_fpago->EOF) {

							$salida_xml .= "<pago>";
							$salida_xml .= "<formaPago>" . $rs_fpago->fields["frmc_codigo"] . "</formaPago>";
							$salida_xml .= "<total>" . $rs_fpago->fields["frmpcom_valor"] . "</total>";
							$salida_xml .= "</pago>";


							$rs_fpago->MoveNext();
						}
					}
					$salida_xml .= "</pagos>";
				}

				//cambio

				$salida_xml .= "</infoLiquidacionCompra>\n";

				$salida_xml .= "<detalles>\n";
				$busca_detalle = "select *,'' as docdet_detallea,'' as docdet_detalleb,'' as docdet_detallec from beko_lqdetalle_compra where doccab_id='" . $rs_buscaid->fields["compra_enlace"] . "'";
				$rs_buscadetalle = $this->_DB_gogess->executec($busca_detalle, array());
				if ($rs_buscadetalle) {
					while (!$rs_buscadetalle->EOF) {


						if (!($rs_buscadetalle->fields["docdet_codaux"])) {
							$aux_valor = $rs_buscadetalle->fields["docdet_codprincipal"];
						} else {
							$aux_valor = $rs_buscadetalle->fields["docdet_codaux"];
						}

						$salida_xml .= "<detalle>\n";


						$salida_xml .= "<codigoPrincipal>" . $rs_buscadetalle->fields["docdet_codprincipal"] . "</codigoPrincipal>\n";
						$salida_xml .= "<codigoAuxiliar>" . $aux_valor . "</codigoAuxiliar>\n";
						$salida_xml .= "<descripcion>" . $rs_buscadetalle->fields["docdet_descripcion"] . "</descripcion>\n";
						$salida_xml .= "<cantidad>" . number_format($rs_buscadetalle->fields["docdet_cantidad"], $cgfe_decimales, '.', '') . "</cantidad>\n";
						$salida_xml .= "<precioUnitario>" . number_format($rs_buscadetalle->fields["docdet_preciou"], $cgfe_decimales, '.', '') . "</precioUnitario>\n";
						$salida_xml .= "<descuento>" . number_format($rs_buscadetalle->fields["docdet_descuento"], $cgfe_decimales, '.', '') . "</descuento>\n";
						$salida_xml .= "<precioTotalSinImpuesto>" . number_format($rs_buscadetalle->fields["docdet_total"], $cgfe_decimales, '.', '') . "</precioTotalSinImpuesto>\n";

						$impvalordata = $rs_buscadetalle->fields["tari_codigo"];
						$contenatododetadi = trim($rs_buscadetalle->fields["docdet_detallea"] . $rs_buscadetalle->fields["docdet_detalleb"] . $rs_buscadetalle->fields["docdet_detallec"]);

						if ($contenatododetadi) {

							$comilladoble = '"';
							$salida_xml .= "<detallesAdicionales>\n";
							if ($rs_buscadetalle->fields["docdet_detallea"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional1" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detallea"] . $comilladoble . " />\n";
							}

							if ($rs_buscadetalle->fields["docdet_detalleb"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional2" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detalleb"] . $comilladoble . " />\n";
							}

							if ($rs_buscadetalle->fields["docdet_detallec"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional3" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detallec"] . $comilladoble . " />\n";
							}

							$salida_xml .= " </detallesAdicionales>\n";
						}

						$valorcalculado = 0;
						$valorcalculado = (($rs_buscadetalle->fields["docdet_valorimpuesto"] * $rs_buscadetalle->fields["docdet_total"]) / 100);


						$salida_xml .= "<impuestos>\n";
						$salida_xml .= "<impuesto>\n";
						$salida_xml .= "<codigo>" . $rs_buscadetalle->fields["impu_codigo"] . "</codigo>\n";
						$salida_xml .= "<codigoPorcentaje>" . $rs_buscadetalle->fields["tari_codigo"] . "</codigoPorcentaje>\n";
						$salida_xml .= "<tarifa>" . $rs_buscadetalle->fields["docdet_valorimpuesto"] . "</tarifa>\n";
						$baseimponivdetalle = 0.00;
						$baseimponivdetalle = $rs_buscadetalle->fields["docdet_total"];
						$salida_xml .= "<baseImponible>" . number_format($baseimponivdetalle, $cgfe_decimales, '.', '') . "</baseImponible>\n";
						$salida_xml .= "<valor>" . number_format($valorcalculado, $cgfe_decimales, '.', '') . "</valor>\n";
						$salida_xml .= "</impuesto>\n";
						$salida_xml .= "</impuestos>\n";
						$salida_xml .= "</detalle>\n";


						$rs_buscadetalle->MoveNext();
					}
				}

				$salida_xml .= "</detalles>\n";
				$salida_xml .= "<infoAdicional>\n";
				$salida_xml .= "<campoAdicional nombre=\"Agente de Retencion\">RESOLUCION: NAC-DNCRASC20-00000001</campoAdicional>\n";
				if ($rs_proveedor->fields["provee_direccion"]) {
					$salida_xml .= "<campoAdicional nombre=\"direccionComprador\">" . $rs_proveedor->fields["provee_direccion"] . "</campoAdicional>\n";
				}

				if ($rs_proveedor->fields["provee_telefono"]) {
					$telfcli = str_replace("-", "", $rs_proveedor->fields["provee_telefono"]);
					$telfcli = str_replace("(", "", $telfcli);
					$telfcli = str_replace(")", "", $telfcli);
					$telfcli = str_replace(" ", "", $telfcli);
					$salida_xml .= "<campoAdicional nombre=\"telefonoComprador\">" . $telfcli . "</campoAdicional>\n";
				}

				if ($rs_proveedor->fields["provee_email"]) {
					$salida_xml .= "<campoAdicional nombre=\"CorreoCliente\">" . $rs_proveedor->fields["provee_email"] . "</campoAdicional>\n";
				}


				$salida_xml .= "</infoAdicional>\n";
				$salida_xml .= "</liquidacionCompra>";

				//echo $salida_xml;
				$xmlbtval = $salida_xml;
				$xmlbase = "update dns_compras set compra_xmlsri='" . base64_encode($xmlbtval) . "',compra_xmlfirmado='',compra_firmado='' where compra_id='" . $rs_buscaid->fields["compra_id"] . "'";

				/*$file = fopen("archivof.txt", "w");
fwrite($file, $xmlbase . PHP_EOL);
fclose($file);*/


				$okxmldat = $this->_DB_gogess->executec($xmlbase, array());
				//----------------------------------------------------------------------------------------------

				$rs_buscaid->MoveNext();
			}
		}

		return base64_encode($xmlbtval);
	}



	//nc


	function xml_nc()
	{
		$salida_xml = '';
		$busca_facturaguardad = "select * from beko_documentocabecera where doccab_id='" . $this->_doccab_id . "' and doccab_estadosri!='AUTORIZADO'";
		$rs_buscaid = $this->_DB_gogess->executec($busca_facturaguardad, array());
		if ($rs_buscaid) {
			while (!$rs_buscaid->EOF) {

				//----------------------------------------------------------------------------------------------


				$datos_empresa = "select * from app_empresa inner join  efacsistema_cfgempresa on app_empresa.emp_id=efacsistema_cfgempresa.emp_id where app_empresa.emp_id=" . $rs_buscaid->fields["emp_id"];
				$rs_empresa = $this->_DB_gogess->executec($datos_empresa, array());
				if ($rs_empresa) {
					while (!$rs_empresa->EOF) {

						$emp_nombre = $rs_empresa->fields["emp_nombre"];
						$emp_ruc = $rs_empresa->fields["emp_ruc"];
						$emp_direccion = $rs_empresa->fields["emp_direccion"];

						$emp_ambiente = $rs_empresa->fields["ambi_valor"];
						$emp_emision = $rs_empresa->fields["tipoemi_codigo"];

						$emp_contabilidad = $rs_empresa->fields["cgfe_contabilidad"];
						$emp_especial = $rs_empresa->fields["cgfe_especial"];

						$cgfe_decimales = $rs_empresa->fields["cgfe_decimales"];



						$rs_empresa->MoveNext();
					}
				}

				$centro_direccion = '';
				$datos_centro = "select * from dns_centrosalud where centro_id=" . $rs_buscaid->fields["centro_id"];
				$rs_centro = $this->_DB_gogess->executec($datos_centro, array());
				if ($rs_centro) {
					while (!$rs_centro->EOF) {

						$centro_direccion = $rs_centro->fields["centro_direccion"];

						$rs_centro->MoveNext();
					}
				}


				$boques_num = explode("-", $rs_buscaid->fields["doccab_ndocumento"]);

				$salida_xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
				$salida_xml .= "<notaCredito version=\"1.1.0\" id=\"comprobante\" >\n";
				$salida_xml .= "<infoTributaria>\n";
				$salida_xml .= "<ambiente>" . $emp_ambiente . "</ambiente>\n";
				$salida_xml .= "<tipoEmision>" . $emp_emision . "</tipoEmision>\n";
				$salida_xml .= "<razonSocial>" . $emp_nombre . "</razonSocial>\n";
				$salida_xml .= "<nombreComercial>" . $emp_nombre . "</nombreComercial>\n";
				$salida_xml .= "<ruc>" . $emp_ruc . "</ruc>\n";
				$salida_xml .= "<claveAcceso>" . $rs_buscaid->fields["doccab_clavedeaccesos"] . "</claveAcceso>\n";
				$salida_xml .= "<codDoc>" . $rs_buscaid->fields["tipocmp_codigo"] . "</codDoc>\n";
				$salida_xml .= "<estab>" . $boques_num[0] . "</estab>\n";
				$salida_xml .= "<ptoEmi>" . $boques_num[1] . "</ptoEmi>\n";
				$salida_xml .= "<secuencial>" . trim($boques_num[2]) . "</secuencial>\n";
				$salida_xml .= "<dirMatriz>" . $emp_direccion . "</dirMatriz>\n";
				$salida_xml .= "<agenteRetencion>1</agenteRetencion>\n";
				$salida_xml .= "</infoTributaria>\n";
				$salida_xml .= "<infoNotaCredito>\n";

				$fechaemision = explode(" ", $rs_buscaid->fields["doccab_fechaemision_cliente"]);
				$separafecha = explode("-", $fechaemision[0]);
				$fechanuevaf = $separafecha[2] . "/" . $separafecha[1] . "/" . $separafecha[0];
				//
				$salida_xml .= "<fechaEmision>" . $fechanuevaf . "</fechaEmision>\n";
				$salida_xml .= "<dirEstablecimiento>" . $centro_direccion . "</dirEstablecimiento>\n";


				$salida_xml .= "<tipoIdentificacionComprador>" . $rs_buscaid->fields["tipoident_codigo"] . "</tipoIdentificacionComprador>\n";

				$salida_xml .= "<razonSocialComprador>" . $rs_buscaid->fields["doccab_nombrerazon_cliente"] . " " . $rs_buscaid->fields["doccab_apellidorazon_cliente"] . "</razonSocialComprador>\n";
				$salida_xml .= "<identificacionComprador>" . $rs_buscaid->fields["doccab_rucci_cliente"] . "</identificacionComprador>\n";

				if (trim($emp_especial)) {
					$salida_xml .= "<contribuyenteEspecial>" . $emp_especial . "</contribuyenteEspecial>\n";
				}

				if ($emp_contabilidad == 'SI') {
					$obligadoc = 'SI';
				} else {
					$obligadoc = 'NO';
				}

				$salida_xml .= "<obligadoContabilidad>" . strtoupper($obligadoc) . "</obligadoContabilidad>\n";

				$salida_xml .= "<codDocModificado>" . $rs_buscaid->fields["tipocmp_codigoafectado"] . "</codDocModificado>\n";
				$salida_xml .= "<numDocModificado>" . $rs_buscaid->fields["doccab_ndocuafecta"] . "</numDocModificado>\n";
				$fechaemisionmod = explode(" ", $rs_buscaid->fields["doccab_fechadocmodi"]);
				$separafechamod = explode("-", $fechaemisionmod[0]);
				$fechanuevafmod = $separafechamod[2] . "/" . $separafechamod[1] . "/" . $separafechamod[0];
				$salida_xml .= "<fechaEmisionDocSustento>" . $fechanuevafmod . "</fechaEmisionDocSustento>\n";



				$totlasinimp = $rs_buscaid->fields["doccab_subtotalsiniva"] + $rs_buscaid->fields["doccab_subtnoobjetoi"] + $rs_buscaid->fields["doccab_subtexentoiva"] + $rs_buscaid->fields["doccab_subtotaliva"];

				//total descuento

				//$busca_detalledescuento="select sum(docdet_descuento) as tdescuento from beko_documentodetalle_factur where doccab_id='".$rs_buscaid->fields["doccab_id"]."'";
				//$rs_buscadetalledesc = $this->_DB_gogess->executec($busca_detalledescuento,array());						  

				//total descuento


				$salida_xml .= "<totalSinImpuestos>" . number_format($totlasinimp, $cgfe_decimales, '.', '') . "</totalSinImpuestos>\n";
				//$salida_xml .= "<totalDescuento>".number_format($rs_buscaid->fields["doccab_descuento"],2, '.', '')."</totalDescuento>\n";		

				$salida_xml .= "<valorModificacion>" . number_format($rs_buscaid->fields["doccab_total"], 2, '.', '') . "</valorModificacion>\n";
				$salida_xml .= "<moneda>DOLAR</moneda>";

				$salida_xml .= "<totalConImpuestos>\n";


				//totales
				$detallesgrupo = "select sum(docdet_valorimpuesto) as docdet_valorimpuesto,impu_codigo,tari_codigo,round(sum(docdet_total),2) as tvalor from beko_documentodetalle_factur where doccab_id='" . $rs_buscaid->fields["doccab_id"] . "' group by tari_codigo";


				//$file = fopen("e_factura".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
				//fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$detallesgrupo."-->".date("Y-m-d H:i:s"). PHP_EOL);
				//fclose($file);

				$rs_grp = $this->_DB_gogess->executec($detallesgrupo, array());
				if ($rs_grp) {
					while (!$rs_grp->EOF) {

						$valorxml = 0;

						$valor_impuesto = "select * from beko_tarifa where tari_codigo='" . $rs_grp->fields["tari_codigo"] . "'";
						$rsimp_x = $this->_DB_gogess->executec($valor_impuesto, array());
						$ttotal = $rs_grp->fields["tvalor"];
						// $valorxml=round(($ttotal*$rsimp->fields["tari_valor"])/100),2);
						if ($rsimp_x->fields["tari_valor"] == 0) {
							$valorxml = 0;
						} else {
							$valorxml = ($ttotal * $rsimp_x->fields["tari_valor"]) / 100;
							$valorxml = round($valorxml, 2);
						}

						$salida_xml .= "<totalImpuesto>\n";
						$salida_xml .= "<codigo>" . $rs_grp->fields["impu_codigo"] . "</codigo>\n";
						$salida_xml .= "<codigoPorcentaje>" . $rs_grp->fields["tari_codigo"] . "</codigoPorcentaje>\n";
						$salida_xml .= "<baseImponible>" . number_format($rs_grp->fields["tvalor"], $cgfe_decimales, '.', '') . "</baseImponible>\n";
						$salida_xml .= "<valor>" . number_format($valorxml, $cgfe_decimales, '.', '') . "</valor>\n";
						$salida_xml .= "</totalImpuesto>\n";


						$rs_grp->MoveNext();
					}
				}
				$salida_xml .= "</totalConImpuestos>\n";
				//totales

				$salida_xml .= "<motivo>" . $rs_buscaid->fields["doccab_motivo"] . "</motivo>";

				//$salida_xml .= "<importeTotal>".number_format($rs_buscaid->fields["doccab_total"], $cgfe_decimales, '.', '')."</importeTotal>\n";								
				//$salida_xml .= "<moneda>DOLAR</moneda>\n";							

				//cambio	

				/*$lista_formapago="select * from lpin_formapagoventa inner join beko_formapago on lpin_formapagoventa.frmc_codigo=beko_formapago.frm_codigo where doccab_id='".$this->_doccab_id."'";
							 $rs_fpago = $this->_DB_gogess->executec($lista_formapago,array());
							 if($rs_fpago->fields["doccab_id"])
							 {
							   $salida_xml .= "<pagos>";
							   if($rs_fpago)
								  {
										while (!$rs_fpago->EOF) {
							   
											$salida_xml .= "<pago>";
											$salida_xml .= "<formaPago>".$rs_fpago->fields["frm_codigo"]."</formaPago>";
											$salida_xml .= "<total>".$rs_fpago->fields["frmpven_valor"]."</total>";
											$salida_xml .= "</pago>";
											
											
							              $rs_fpago->MoveNext();
							            }
								  } 
							   $salida_xml .= "</pagos>";
							 }*/

				//cambio

				$salida_xml .= "</infoNotaCredito>\n";

				$salida_xml .= "<detalles>\n";
				$busca_detalle = "select * from beko_documentodetalle_factur where doccab_id='" . $rs_buscaid->fields["doccab_id"] . "'";
				$rs_buscadetalle = $this->_DB_gogess->executec($busca_detalle, array());
				if ($rs_buscadetalle) {
					while (!$rs_buscadetalle->EOF) {


						if (!($rs_buscadetalle->fields["docdet_codaux"])) {
							$aux_valor = $rs_buscadetalle->fields["docdet_codprincipal"];
						} else {
							$aux_valor = $rs_buscadetalle->fields["docdet_codaux"];
						}

						$salida_xml .= "<detalle>\n";


						$salida_xml .= "<codigoInterno>" . $rs_buscadetalle->fields["docdet_codprincipal"] . "</codigoInterno>\n";
						$salida_xml .= "<codigoAdicional>" . $aux_valor . "</codigoAdicional>\n";
						$salida_xml .= "<descripcion>" . $rs_buscadetalle->fields["docdet_descripcion"] . "</descripcion>\n";
						$salida_xml .= "<cantidad>" . number_format($rs_buscadetalle->fields["docdet_cantidad"], $cgfe_decimales, '.', '') . "</cantidad>\n";
						$salida_xml .= "<precioUnitario>" . number_format($rs_buscadetalle->fields["docdet_preciou"], $cgfe_decimales, '.', '') . "</precioUnitario>\n";
						$salida_xml .= "<descuento>" . number_format($rs_buscadetalle->fields["docdet_descuento"], $cgfe_decimales, '.', '') . "</descuento>\n";
						$salida_xml .= "<precioTotalSinImpuesto>" . number_format($rs_buscadetalle->fields["docdet_total"], $cgfe_decimales, '.', '') . "</precioTotalSinImpuesto>\n";

						$impvalordata = $rs_buscadetalle->fields["tari_codigo"];
						$contenatododetadi = trim($rs_buscadetalle->fields["docdet_detallea"] . $rs_buscadetalle->fields["docdet_detalleb"] . $rs_buscadetalle->fields["docdet_detallec"]);

						if ($contenatododetadi) {

							$comilladoble = '"';
							$salida_xml .= "<detallesAdicionales>\n";
							if ($rs_buscadetalle->fields["docdet_detallea"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional1" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detallea"] . $comilladoble . " />\n";
							}

							if ($rs_buscadetalle->fields["docdet_detalleb"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional2" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detalleb"] . $comilladoble . " />\n";
							}

							if ($rs_buscadetalle->fields["docdet_detallec"]) {
								$salida_xml .= "<detAdicional nombre=" . $comilladoble . "InformacionAdicional3" . $comilladoble . " valor=" . $comilladoble . $rs_buscadetalle->fields["docdet_detallec"] . $comilladoble . " />\n";
							}

							$salida_xml .= " </detallesAdicionales>\n";
						}

						$valor_impuesto = "select * from beko_tarifa where tari_codigo='" . $rs_buscadetalle->fields["tari_codigo"] . "'";
						$rsimp_x = $this->_DB_gogess->executec($valor_impuesto, array());

						$salida_xml .= "<impuestos>\n";
						$salida_xml .= "<impuesto>\n";
						$salida_xml .= "<codigo>" . $rs_buscadetalle->fields["impu_codigo"] . "</codigo>\n";
						$salida_xml .= "<codigoPorcentaje>" . $rs_buscadetalle->fields["tari_codigo"] . "</codigoPorcentaje>\n";
						$salida_xml .= "<tarifa>" . $rsimp_x->fields["tari_valor"] . "</tarifa>\n";
						$baseimponivdetalle = 0.00;
						$baseimponivdetalle = $rs_buscadetalle->fields["docdet_total"];
						$salida_xml .= "<baseImponible>" . number_format($baseimponivdetalle, $cgfe_decimales, '.', '') . "</baseImponible>\n";

						$b_imponible = 0;
						$b_imponible = number_format($baseimponivdetalle, $cgfe_decimales, '.', '');



						$valorxml = 0;
						if ($rsimp_x->fields["tari_valor"] == 0) {
							$valorxml = 0;
						} else {
							$valorxml = ($b_imponible * $rsimp_x->fields["tari_valor"]) / 100;
							$valorxml = round($valorxml, 2);
						}


						$salida_xml .= "<valor>" . number_format($valorxml, $cgfe_decimales, '.', '') . "</valor>\n";
						$salida_xml .= "</impuesto>\n";
						$salida_xml .= "</impuestos>\n";
						$salida_xml .= "</detalle>\n";


						$rs_buscadetalle->MoveNext();
					}
				}

				$salida_xml .= "</detalles>\n";
				$salida_xml .= "<infoAdicional>\n";
				$salida_xml .= "<campoAdicional nombre=\"Agente de Retencion\">RESOLUCION: NAC-DNCRASC20-00000001</campoAdicional>\n";
				if ($rs_buscaid->fields["doccab_direccion_cliente"]) {
					$salida_xml .= "<campoAdicional nombre=\"direccionComprador\">" . $rs_buscaid->fields["doccab_direccion_cliente"] . "</campoAdicional>\n";
				}
				if ($rs_buscaid->fields["doccab_telefono_cliente"]) {
					$telfcli = str_replace("-", "", $rs_buscaid->fields["doccab_telefono_cliente"]);
					$telfcli = str_replace("(", "", $telfcli);
					$telfcli = str_replace(")", "", $telfcli);
					$telfcli = str_replace(" ", "", $telfcli);
					$salida_xml .= "<campoAdicional nombre=\"telefonoComprador\">" . $telfcli . "</campoAdicional>\n";
				}
				if ($rs_buscaid->fields["doccab_email_cliente"]) {
					$salida_xml .= "<campoAdicional nombre=\"CorreoCliente\">" . $rs_buscaid->fields["doccab_email_cliente"] . "</campoAdicional>\n";
				}

				if ($rs_buscaid->fields["tippo_id"]) {
					$busca_tipocobro = "select * from cesdb_arextension.dns_tipoproceso where tippo_id='" . $rs_buscaid->fields["tippo_id"] . "'";
					$rs_tipocobro = $this->_DB_gogess->executec($busca_tipocobro, array());
					$salida_xml .= "<campoAdicional nombre=\"Tipo\">" . $rs_tipocobro->fields["tippo_nombre"] . "</campoAdicional>\n";
				}

				if ($rs_buscaid->fields["conve_id"]) {
					$busca_tipocobro1 = "select * from cesdb_arextension.dns_convenios where conve_id='" . $rs_buscaid->fields["conve_id"] . "'";
					$rs_tipocobro1 = $this->_DB_gogess->executec($busca_tipocobro1, array());
					$salida_xml .= "<campoAdicional nombre=\"Convenio\">" . $rs_tipocobro1->fields["conve_nombre"] . " " . $rs_buscaid->fields["doccab_autorizacion"] . "</campoAdicional>\n";
				}

				if ($rs_buscaid->fields["doccab_adicional"]) {

					$salida_xml .= "<campoAdicional nombre=\"adicionalfac\">" . $rs_buscaid->fields["doccab_adicional"] . "</campoAdicional>\n";
				}


				$salida_xml .= "</infoAdicional>\n";
				$salida_xml .= "</notaCredito>";

				//echo $salida_xml;
				$xmlbtval = $salida_xml;
				$xmlbase = "update beko_documentocabecera set doccab_xml='" . base64_encode($xmlbtval) . "',doccab_xmlfirmado='',doccab_firmado='',doccab_estadosri='' where doccab_id='" . $rs_buscaid->fields["doccab_id"] . "'";

				/*$file = fopen("archivof.txt", "w");
fwrite($file, $xmlbase . PHP_EOL);
fclose($file);*/


				$okxmldat = $this->_DB_gogess->executec($xmlbase, array());
				//----------------------------------------------------------------------------------------------

				$rs_buscaid->MoveNext();
			}
		}

		//return base64_encode($xmlbtval);
		return base64_encode($xmlbtval);
	}

	//nc

}
