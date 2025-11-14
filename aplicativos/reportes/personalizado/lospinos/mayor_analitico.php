<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime", 36000);
ini_set("session.gc_maxlifetime", 36000);
session_start();
setlocale(LC_MONETARY, 'en_US');
if ($_SESSION['ces1313777_sessid_inicio']) {

	//2 excel
	//3 pdf

	function ver_ciudadpaciente($ci, $DB_gogess)
	{

		$lista_hijos = "select distinct centro_id from app_cliente inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace where repres_ci='" . trim($ci) . "'";
		$rs_datahijos = $DB_gogess->executec($lista_hijos, array());

		$centro_id = @$rs_datahijos->fields["centro_id"];
		if (!(@$rs_datahijos->fields["centro_id"])) {
			$centro_id = 1;
		}

		return $centro_id;
	}

	$previsual = 0;
	if (@$_POST["previsual"]) {
		$previsual = @$_POST["previsual"];
		$fecha_i = @$_POST["fecha_inicio"];
		$fecha_f = @$_POST["fecha_fin"];
		$centro_id = @$_POST["centro_id"];
		$clie_institucionval = @$_POST["clie_institucionval"];
		$ireport = @$_POST["ireport"];
		$cliente_ruc = @$_POST["cliente_ruc"];
		$planc_codigoc = @$_POST["planc_codigoc"];
	} else {
		$previsual = @$_GET["previsual"];
		$fecha_i = @$_GET["fecha_inicio"];
		$fecha_f = @$_GET["fecha_fin"];
		$centro_id = @$_GET["centro_id"];
		$clie_institucionval = @$_GET["clie_institucionval"];
		$ireport = @$_GET["ireport"];
		$cliente_ruc = @$_GET["cliente_ruc"];
		$planc_codigoc = @$_GET["planc_codigoc"];
	}

	if ($previsual == 2) {
		header('Content-type: application/vnd.ms-excel');
		$fechahoy = date("Y-m-d");
		header("Content-Disposition: attachment; filename=" . "repxls_" . $fechahoy . ".xls");
	}

	$director = '../../../../';
	include("../../../../cfg/clases.php");
	include("../../../../cfg/declaracion.php");
	require_once('tcpdf_include.php');

	$objformulario = new  ValidacionesFormulario();

	$bandera_t1 = 0;
	$actual = strtotime(date("Y-m-d"));
	$mesmenos = date("Y-m-d", strtotime("-2 month", $actual));

	$fecha_periodoac = '2021-01-01';


	$sql1 = "";
	$sql2 = "";
	$sql3 = "";
	$sql3ant = "";
	$sql4 = "";
	$sql5 = "";

	if ($centro_id) {
		// $sql2=" app_cliente.centro_id=".$centro_id." and ";
	}


	if ($fecha_i != '' and $fecha_f != '') {
		$sql3 = " comcont_fecha>='" . $fecha_i . " 00:00:00' and comcont_fecha<='" . $fecha_f . " 23:59:59' and ";
	} else {

		if ($fecha_i != '' and $fecha_f == '') {
			$sql3 = " comcont_fecha>='" . $fecha_i . " 00:00:00' and ";
			$sql3ant = " comcont_fecha>='" . $fecha_i . " 00:00:00' and ";
		} else {
			if ($fecha_i == '' and $fecha_f != '') {
				$sql3 = " comcont_fecha<='" . $fecha_f . " 23:59:59' and ";
				$sql3ant = " comcont_fecha<='" . $fecha_f . " 23:59:59' and ";
			}
		}
	}

	if ($clie_institucionval) {
		$sql4 = " clie_institucion like '%" . $clie_institucionval . "%' and ";
	}

	if ($cliente_ruc) {
		$sql5 = " doccab_rucci_cliente = '" . trim($cliente_ruc) . "' and ";
	}



	if ($planc_codigoc) {
		$sql6 = " detcc_cuentacontablep = '" . trim($planc_codigoc) . ".' and ";
	}





	$concatena_sql = $sql1 . $sql2 . $sql3 . $sql4 . $sql5 . $sql6;
	$concatena_sql = substr($concatena_sql, 0, -4);


	$sql3ant = " comcont_fecha>='" . $fecha_periodoac . " 00:00:00' and comcont_fecha<'" . $fecha_i . " 00:00:00' and ";
	$concatena_sqlant = $sql1 . $sql2 . $sql3ant . $sql4 . $sql5 . $sql6;
	$concatena_sqlant = substr($concatena_sqlant, 0, -4);


	$nciudad = '';
	$nciudad = $objformulario->replace_cmb("dns_centrosalud", "centro_id,centro_nombre", " where centro_id =", $centro_id, $DB_gogess);



	//area datos
	$documento = '';
	$cabecera = '';
	$cabecera = $objformulario->replace_cmb("app_empresa", "emp_id,emp_cabecerareportes", " where emp_id=", 1, $DB_gogess);

	$css = "<style type='text/css'>
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
	
.Estilo_red {color: #FF0000}

-->
</style>
";

	$reporte_pg = "select * from sth_report where rept_id=" . $ireport;
	$rs_reportepg = $DB_gogess->executec($reporte_pg, array());

	$rept_nombre = $rs_reportepg->fields["rept_nombre"];
	$documento = $css . "<div align='center' >" . $rept_nombre . "</div><p align='center'>" . $rs_reportepg->fields["rept_observacion"] . "</p>" . utf8_decode($cabecera) . "<br><center><b>" . $nciudad . "</b></center>";


	//echo $lista_servicios;
	//$xmldata=53;

	$cuenta_fac = 0;
	$documento .= '<center>
Desde: ' . $fecha_i . ' Hasta: ' . $fecha_f . '<br>
<br>';

	///programacion reporte

	$suma_debe = 0;
	$suma_haber = 0;

	$documento .= '<table width="700" border="1"  cellpadding="2" cellspacing="0">
    <tr bgcolor="#E9E9E9" >
    <td width="80" ><div align="center"><strong>ID COMPROBANTE</strong></div></td>
	<td width="60" ><div align="center"><strong>CODIGO</strong></div></td>
    <td width="60" ><div align="center"><strong>CUENTA</strong></div></td>
	<td width="60" ><div align="center"><strong>FECHA</strong></div></td>
	<td width="150" ><div align="center"><strong>OBSERVACION</strong></div></td>
	<td width="80" ><div align="center"><strong>IDENTIFICACION</strong></div></td>
	<td width="80" ><div align="center"><strong>PERSONA</strong></div></td>
	<td width="80" ><div align="center"><strong>NOMBRE CUENTA</strong></div></td>
	<td width="80" ><div align="center"><strong>DOCUMENTO</strong></div></td>
	<td width="80" ><div align="center"><strong>#. COMPROBANTE</strong></div></td>
	<td width="80" ><div align="center"><strong>DEBE</strong></div></td>
    <td width="80" ><div align="center"><strong>HABER</strong></div></td>
	 <td width="80" ><div align="center"><strong>SALDO</strong></div></td>
  </tr>';


	$busca_saldoant = "select * from lpin_detallecomprobantecontable_vista where " . $concatena_sqlant . " and comcont_anulado=0 order by comcont_fecha,detcc_id asc";
	$cuenta_dataant = 0;
	$total_haberant = 0;
	$detcc_debeant = 0;

	$valor_arrayant = array();
	$valor_arrayant[0] = 0;

	$cuentaant = 0;

	$rs_listadiarioant = $DB_gogess->executec($busca_saldoant, array());
	$ibant = 0;
	if ($rs_listadiarioant) {
		while (!$rs_listadiarioant->EOF) {

			$debe_valorant = 0;
			$haber_valorant = 0;

			$debe_valorant = round($rs_listadiarioant->fields["detcc_debe"], 2);
			$haber_valorant = round($rs_listadiarioant->fields["detcc_haber"], 2);

			$cuentaant++;

			$valor_array[$cuentaant] = $valor_array[$cuentaant - 1] + $debe_valorant - $haber_valorant;

			$saldo_valorant = $valor_array[$cuentaant];
			$negativoant = '';

			if ($saldo_valorant < 0) {
				$negativoant = ' class="Estilo_red" ';
			}

			$cuenta_data++;


			$suma_debeant = $suma_debeant + $rs_listadiarioant->fields["detcc_debe"];
			$suma_haberant = $suma_haberant + $rs_listadiarioant->fields["detcc_haber"];

			$rs_listadiarioant->MoveNext();
		}
	}



	$documento .= '
    <tr >
    <td width="80" nowrap="nowrap" ><div align="center"><strong>SALDO ANTERIO</strong></div></td>
	<td width="60" ><div align="center"><strong></strong></div></td>
    <td width="60" ><div align="center"><strong></strong></div></td>
	<td width="60" nowrap="nowrap" ><div align="center"><strong>' . $fecha_i . '</strong></div></td>
	<td width="150" ><div align="center"><strong></strong></div></td>
	<td width="80" ><div align="center"><strong></strong></div></td>
	<td width="80" ><div align="center"><strong></strong></div></td>
	<td width="80" ><div align="center"><strong></strong></div></td>
	<td width="80" ><div align="center"><strong></strong></div></td>
	<td width="80" ><div align="center"><strong></strong></div></td>
	<td width="80" nowrap="nowrap" ><div align="center"><strong>$' . number_format($suma_debeant, 2, ',', '') . '</strong></div></td>
    <td width="80" nowrap="nowrap" ><div align="center"><strong>$' . number_format($suma_haberant, 2, ',', '') . '</strong></div></td>
	 <td width="80" nowrap="nowrap" ><div align="center"><strong>$' . number_format($saldo_valorant, 2, ',', '') . '</strong></div></td>
  </tr>';



	$listadiario = "select * from lpin_detallecomprobantecontable_vista where " . $concatena_sql . " and comcont_anulado=0 order by comcont_fecha,detcc_id asc";

	//echo $lista_doc;
	$cuenta_data = 0;
	$total_haber = 0;
	$detcc_debe = 0;

	$valor_array = array();
	$valor_array[0] = 0;

	$cuenta = 0;

	$debe_valor = $suma_debeant;
	$haber_valor = $suma_haberant;
	$valor_array[0] = $saldo_valorant;

	$suma_debe = $suma_debeant;
	$suma_haber = $suma_haberant;

	$rs_listadiario = $DB_gogess->executec($listadiario, array());
	$ib = 0;
	if ($rs_listadiario) {
		while (!$rs_listadiario->EOF) {

			$debe_valor = 0;
			$haber_valor = 0;

			$debe_valor = round($rs_listadiario->fields["detcc_debe"], 2);
			$haber_valor = round($rs_listadiario->fields["detcc_haber"], 2);

			$cuenta++;

			$valor_array[$cuenta] = $valor_array[$cuenta - 1] + $debe_valor - $haber_valor;

			$saldo_valor = $valor_array[$cuenta];


			$negativo = '';

			if ($saldo_valor < 0) {
				$negativo = ' class="Estilo_red" ';
			}

			$link_ver = "";
			if ($previsual == 1) {
				$link_ver = " onclick=abrir_standarasiento('ver_asiento.php','Asiento','divBody_as','divDialog_as',500,499,'" . $rs_listadiario->fields["comcont_id"] . "',0,0,0,0,0,0)";
			}

			//busca detalles
			$busca_detvalor = "select * from lpin_comprobantecontable where comcont_id='" . $rs_listadiario->fields["comcont_id"] . "'";
			$rs_detvalor = $DB_gogess->executec($busca_detvalor, array());

			$comcont_tabla = $rs_detvalor->fields["comcont_tabla"];
			$comcont_idtabla = $rs_detvalor->fields["comcont_idtabla"];


			$comcont_tablas = $rs_detvalor->fields["comcont_tablas"];
			$comcont_idtablas = $rs_detvalor->fields["comcont_idtablas"];


			$detallcompleto = '';

			$ruccliene = '';
			$nombrecliente = '';

			if ($comcont_tabla == 'dns_compras') {
				$busca_covalor = "select compra_descripcion,proveevar_id from dns_compras where compra_id='" . $comcont_idtabla . "'";
				$rs_covalor = $DB_gogess->executec($busca_covalor, array());

				$detallcompleto = $rs_covalor->fields["compra_descripcion"];
				$proveevar_id = $rs_covalor->fields["proveevar_id"];


				$busca_provee = "select * from app_proveedor where provee_id='" . $proveevar_id . "'";
				$rs_provee = $DB_gogess->executec($busca_provee, array());

				$tipoident_codigocl = $rs_provee->fields["tipoident_codigocl"];

				if ($tipoident_codigocl == '04') {
					$ruccliene = $rs_provee->fields["provee_ruc"];
				} else {
					$ruccliene = $rs_provee->fields["provee_cedula"];
				}

				$nombrecliente = $rs_provee->fields["provee_nombre"];
			}

			if ($comcont_tabla == 'beko_documentocabecera') {
				$busca_covalor = "select doccab_adicional,doccab_rucci_cliente,doccab_nombrerazon_cliente from beko_documentocabecera where doccab_id='" . $comcont_idtabla . "'";
				$rs_covalor = $DB_gogess->executec($busca_covalor, array());

				$detallcompleto = $rs_covalor->fields["doccab_adicional"];

				$ruccliene = $rs_covalor->fields["doccab_rucci_cliente"];
				$nombrecliente = $rs_covalor->fields["doccab_nombrerazon_cliente"];
			}
			
			$crb_ncomprobante='';
			if ($comcont_tabla == 'lpin_cobropago') {
				$busca_covalorx = "select * from lpin_cobropago where crb_id='" . $comcont_idtabla . "'";
				$rs_covalorx = $DB_gogess->executec($busca_covalorx, array());

				$crb_ncomprobante = $rs_covalorx->fields["crb_ncomprobante"];

				
			}



			if (!($ruccliene)) {

				if ($comcont_tablas == 'dns_compras') {

					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					$busca_covalor = "select compra_descripcion,proveevar_id from dns_compras where compra_id='" . $comcont_idtablas . "'";
					$rs_covalor = $DB_gogess->executec($busca_covalor, array());

					$detallcompleto = $rs_covalor->fields["compra_descripcion"];
					$proveevar_id = $rs_covalor->fields["proveevar_id"];


					$busca_provee = "select * from app_proveedor where provee_id='" . $proveevar_id . "'";
					$rs_provee = $DB_gogess->executec($busca_provee, array());

					$tipoident_codigocl = $rs_provee->fields["tipoident_codigocl"];

					if ($tipoident_codigocl == '04') {
						$ruccliene = $rs_provee->fields["provee_ruc"];
					} else {
						$ruccliene = $rs_provee->fields["provee_cedula"];
					}

					$nombrecliente = $rs_provee->fields["provee_nombre"];


					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

				}

				if ($comcont_tablas == 'beko_documentocabecera') {

					$busca_covalor = "select doccab_adicional,doccab_rucci_cliente,doccab_nombrerazon_cliente from beko_documentocabecera where doccab_id='" . $comcont_idtablas . "'";
					$rs_covalor = $DB_gogess->executec($busca_covalor, array());

					$detallcompleto = $rs_covalor->fields["doccab_adicional"];

					$ruccliene = $rs_covalor->fields["doccab_rucci_cliente"];
					$nombrecliente = $rs_covalor->fields["doccab_nombrerazon_cliente"];
				}
			}


			//busca detalles

			$cuenta_data++;
			$documento .= '<tr>
			<td nowrap="nowrap" ' . $link_ver . ' >' . $rs_listadiario->fields["comcont_id"] . '</td>
			<td nowrap="nowrap" >' . $cuenta_data . '</td>
			<td nowrap="nowrap" >' . $rs_listadiario->fields["detcc_cuentacontablep"] . '</td>
			<td nowrap="nowrap" >' . $rs_listadiario->fields["comcont_fecha"] . '</td>
			<td nowrap="nowrap" >' . $rs_listadiario->fields["comcont_concepto"] . '<br><b>' . $detallcompleto . '</b></td>	
			
			<td nowrap="nowrap" >' . $ruccliene . '</td>
			<td nowrap="nowrap" >' . $nombrecliente . '</td>
						
			<td>' . $rs_listadiario->fields["detcc_descricpion"] . '</td>
			<td>' . $rs_listadiario->fields["comcont_numeroc"]. '</td>		
			<td>'.$crb_ncomprobante. '</td>			
			<td>$' . number_format($rs_listadiario->fields["detcc_debe"], 2, ',', '') . '</td>
			<td>$' . number_format($rs_listadiario->fields["detcc_haber"], 2, ',', '') . '</td>
			<td ' . $negativo . ' >$' . number_format($saldo_valor, 2, ',', '') . '</td>
		  </tr>';

			$suma_debe = $suma_debe + $rs_listadiario->fields["detcc_debe"];
			$suma_haber = $suma_haber + $rs_listadiario->fields["detcc_haber"];


			$rs_listadiario->MoveNext();
		}
	}

	$valor_final = 0;
	$valor_final = round($suma_debe, 2) - round($suma_haber, 2);

	$negativo = '';

	if ($valor_final < 0) {
		$negativo = ' class="Estilo_red" ';
	}

	$documento .= '<tr bgcolor="#E9E9E9" >
			<td></td>	
			<td nowrap="nowrap" ></td>
			<td nowrap="nowrap" ></td>
			<td nowrap="nowrap" ></td>
			<td nowrap="nowrap" ></td>	
			<td nowrap="nowrap" ></td>
			<td nowrap="nowrap" ></td>				
			<td nowrap="nowrap" ></td>	
			<td></td>
			<td></td>			
			<td><b>$' . number_format($suma_debe, 2, ',', '') . '</b></td>
			<td><b>$' . number_format($suma_haber, 2, ',', '') . '</b></td>
			<td ' . $negativo . ' ><b>$' . number_format($valor_final, 2, ',', '') . '</b></td>
		  </tr>';

	$documento .= '		  
</table>';



	///programacion reporte


	//area datos 
	if ($previsual == 1) {
		echo $documento;
	}
	if ($previsual == 2) {
		echo utf8_decode($documento);
	}


	if ($previsual == 3) {

		$comprobantepdf = '';
		$comprobantepdf = $documento;


		// Extend the TCPDF class to create custom Header and Footer
		class MYPDF extends TCPDF
		{
			var $filtro_valor_h1;
			var $filtro_valor_h2;
			var $filtro_valor_h3;
			//Page header

			// Page footer
			public function Footer()
			{
				// Position at 15 mm from bottom		
				$this->SetY(-15);
				// Set font
				$this->SetFont('helvetica', 'I', 8);
				// Page number
				$this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
				//$image_file = 'logopie.fw.png';
				// $this->Image($image_file, 80, 273, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);		
			}
		}


		$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('LOS PINOS');
		$pdf->SetTitle('LOS PINOS');
		$pdf->SetSubject('LOS PINOS');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		$pdf->filtro_valor_h1 = '';
		$pdf->filtro_valor_h2 = '';
		$pdf->filtro_valor_h3 = '';
		// set default header data
		$pdf->setPrintHeader(false);
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);
		// set header and footer fonts
		//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		// ---------------------------------------------------------
		// set font
		$pdf->SetFont('helvetica', 'B', 15);
		// add a page
		$pdf->AddPage();
		//$pdf->Write(0, 'HANOR', '', 0, 'L', true, 0, false, false, 0);
		$pdf->SetFont('helvetica', '', 7);
		$pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');
		/*if($_GET["dhoja"]==1)
{
$pdf->AddPage();
$pdf->writeHTML(utf8_encode("<strong>V. RESPONSABLES </strong><div align='center'>".$responsables_cuadro."</div>"), true, false, false, false, '');
}*/
		//echo $lee_plantilla;
		//echo $comprobantepdf="Holaa";
		$nombre_pdf = "pdfdocumento_" . date("Y-m-d") . ".pdf";
		$pdf->Output($nombre_pdf, 'I');
	}
}
