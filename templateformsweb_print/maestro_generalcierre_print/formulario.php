<?php

//---ENLACE
$valoralet = mt_rand(1, 500);
$aletorioid = $_SESSION['ces1313777_sessid_cedula'] . date("Ymdhis") . $valoralet;
//----
$enlace_general = $rs_datosmenu->fields["mnupan_campoenlace"] . "x";
$objformulario->sendvar["fechax"] = date("Y-m-d H:i:s");
$objformulario->sendvar[$enlace_general] = @$_SESSION['ces1313777_sessid_emp_id'];
$objformulario->sendvar["horax"] = date("h:i:s");
$objformulario->sendvar["usua_idx"] = @$_SESSION['ces1313777_sessid_inicio'];
$objformulario->sendvar["usr_tpingx"] = 0;
$objformulario->sendvar["clie_idx"] = $clie_id;
$objformulario->sendvar["codex"] = $aletorioid;
$objformulario->sendvar["hcx"] = $rs_atencion->fields["atenc_hc"];
$objformulario->sendvar["atenc_idx"] = $atenc_id;

//asigna medico
if (@$rs_buscadatos_fecha->fields["usua_id"]) {
	$objformulario->sendvar["usua_idx"] = @$rs_buscadatos_fecha->fields["usua_id"];
} else {
	$objformulario->sendvar["usua_idx"] = @$_SESSION['ces1313777_sessid_inicio'];
}
//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

$usua_idxd = $objformulario->contenid["usua_id"];
$centro_idxd = $objformulario->contenid["centro_id"];

$cierr_fechaxd = $objformulario->contenid["cierr_fecha"];
$cierr_fechafinxd = $objformulario->contenid["cierr_fechafin"];

$valor_id = $objformulario->contenid["cierr_id"];
$busca_sihaydata = "select * from " . $table . " where  cierr_id=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata, array($valor_id));


$tbl_plantilla = '<table width="100%" border="0" cellpadding="0" cellspacing="0" >

      <tr>
        <td><b>ID:</b>  -cierr_id-<br>
		<b>TIPO:</b> -ctpc_id- </td>
        <td><b>Fecha Inicio:</b> -cierr_fecha- <br>
		<b>Fecha Fin:</b> -cierr_fechafin- </td>
        <td><b>Usuario:</b> -usua_id- <br>
		<b>Fecha Registro:</b> -cierr_fecharegistro-</td>
      </tr>

  </table><br>';

$lee_plantilla =  $tbl_plantilla;



$campos_evo = '';
$campos_evo = "select * from gogess_sisfield where tab_name='" . $table . "' and fie_type!='campogrid' ";
$rs_camposevo = $DB_gogess->executec($campos_evo, array());
if ($rs_camposevo) {
	while (!$rs_camposevo->EOF) {

		if ($rs_camposevo->fields["fie_value"] == 'replace') {
			$lab_datos = $objformulario->replace_cmb($rs_camposevo->fields["fie_tabledb"], $rs_camposevo->fields["fie_datadb"], $rs_camposevo->fields["fie_sql"], $rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]], $DB_gogess);
		} else {
			if ($rs_camposevo->fields["fie_type"] == 'txtgraficopeker') {
				$lab_datos = '<img src="../archivo/' . $rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]] . '" alt="125x125" width="300px">';
			} else {
				$lab_datos = nl2br($rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]]);
			}
		}

		$lee_plantilla = str_replace("-" . $rs_camposevo->fields["fie_name"] . "-", $lab_datos, $lee_plantilla);

		$rs_camposevo->MoveNext();
	}
}

$cierr_enlacexd = $objformulario->contenid["cierr_enlace"];
$cierr_efectivo = $objformulario->contenid["cierr_efectivo"];
?>
<br />
<?php
$formulario_path = "../../" . $template_reemplazo;
//busca grupos

echo $lee_plantilla;
?>
<center><b>INGRESO EFECTIVO</b></center><br />
<table width="100%" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#BDD7EC"><b>No.</b></td>
		<td bgcolor="#BDD7EC"><b>Moneda</b></td>
		<td bgcolor="#BDD7EC"><b>Cantidad</b></td>
		<td bgcolor="#BDD7EC"><b>Valor</b></td>
	</tr>
	<?php

	$totalsumap = 0;

	$lista_area = "select * from cesdb_arextension.app_ingresoefectivo inner join cesdb_arcombos.cmb_tipomoneda on cesdb_arextension.app_ingresoefectivo.tmoned_id=cesdb_arcombos.cmb_tipomoneda.tmoned_id where cierr_enlace='" . $cierr_enlacexd . "'";

	$rs_areap = $DB_gogess->executec($lista_area, array());

	if ($rs_areap) {

		while (!$rs_areap->EOF) {



			$num_data++;

	?>



			<tr>
				<td><?php echo $num_data; ?></td>
				<td><?php echo $rs_areap->fields["tmoned_nombre"]; ?></td>
				<td><?php echo $rs_areap->fields["ingefec_cantidad"]; ?></td>
				<td style=mso-number-format:"@"><?php echo $rs_areap->fields["ingefec_valor"]; ?></td>
			</tr>

	<?php

			$totalsumap = $totalsumap + $rs_areap->fields["ingefec_valor"];



			$rs_areap->MoveNext();
		}
	}

	?>

	<tr>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC"><b>TOTAL EN DINERO:</b></td>
		<td bgcolor="#BDD7EC"><b><?php echo $totalsumap; ?></b></td>
	</tr>
</table>

<p></p>

<br />
<center><b>INGRESO - EGRESOS VARIOS </b></center><br />
<table width="100%" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#BDD7EC"><b>No.</b></td>
		<td bgcolor="#BDD7EC"><b>Nombre</b></td>
		<td bgcolor="#BDD7EC"><b>No Documento / Deposito</b></td>
		<td bgcolor="#BDD7EC"><b>Banco</b></td>
		<td bgcolor="#BDD7EC"><b>Tipo</b></td>
		<td bgcolor="#BDD7EC"><b>Valor</b></td>
		<td bgcolor="#BDD7EC"><b>Comisi&oacute;n</b></td>
		<td bgcolor="#BDD7EC"><b>Fecha</b></td>
	</tr>
	<?php

	$totales = array();
	$totalsumap = 0;

	$lista_area = "select * from cesdb_arextension.app_gastosvarios left join cesdb_arcombos.cmb_tipomov on cesdb_arextension.app_gastosvarios.tmv_id=cesdb_arcombos.cmb_tipomov.tmv_id left join cesdb_arcombos.cmb_bancos on gtvar_archivo=ban_id where cierr_enlace='" . $cierr_enlacexd . "'";
	$rs_areap = $DB_gogess->executec($lista_area, array());

	if ($rs_areap) {

		while (!$rs_areap->EOF) {



			$num_data++;

			@$totales[$rs_areap->fields["tmv_id"]] = $totales[$rs_areap->fields["tmv_id"]] + $rs_areap->fields["gtvar_valor"];

	?>

			<tr>
				<td><?php echo $num_data; ?></td>
				<td><?php echo $rs_areap->fields["gtvar_nombre"]; ?></td>
				<td><?php echo $rs_areap->fields["gtvar_ndocumento"]; ?></td>
				<td><?php echo $rs_areap->fields["ban_nombre"]; ?></td>
				<td><?php echo $rs_areap->fields["tmv_nombre"]; ?></td>
				<td><?php echo $rs_areap->fields["gtvar_valor"]; ?></td>
				<td><?php echo $rs_areap->fields["gtvar_comision"]; ?></td>
				<td><?php echo $rs_areap->fields["gtvar_fecharegistro"]; ?></td>
			</tr>

	<?php

			@$totalsumap = $totalsumap + $rs_areap->fields["ingefec_valor"];



			$rs_areap->MoveNext();
		}
	}

	?>

	<tr>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC"><b></b></td>
	</tr>
</table>

<br />

<table width="500" border="1" cellpadding="0" cellspacing="0">
	<?php
	$valoringresos = 0;
	$valoregresos = 0;

	$suma_total = 0;
	$lista_sumatoria = "select * from cesdb_arcombos.cmb_tipomov";
	$rs_sumatoria = $DB_gogess->executec($lista_sumatoria, array());
	if ($rs_sumatoria) {
		while (!$rs_sumatoria->EOF) {
	?>
			<tr>
				<td><b><?php echo @$rs_sumatoria->fields["tmv_nombre"]; ?> VARIOS</b></td>
				<td><?php echo @$totales[$rs_sumatoria->fields["tmv_id"]]; ?></td>
			</tr>
	<?php


			if ($rs_sumatoria->fields["tmv_id"] == 1) {
				@$suma_total = $suma_total + $totales[$rs_sumatoria->fields["tmv_id"]];
				$valoringresos = $valoringresos + $totales[$rs_sumatoria->fields["tmv_id"]];
			} else {
				@$suma_total = $suma_total - $totales[$rs_sumatoria->fields["tmv_id"]];
				$valoregresos = $valoregresos + $totales[$rs_sumatoria->fields["tmv_id"]];
			}

			$rs_sumatoria->MoveNext();
		}
	}

	?>
	<tr>
		<td><b>TOTAL</b></td>
		<td><?php echo abs($suma_total); ?></td>
	</tr>
</table>

<br /><br />
<?php
$total_actual = 0;
$total_actual = $cierr_efectivo - $valoregresos + $valoringresos;
echo '<b>DINERO EN EFECTIVO:</b> ' . $total_actual;
?>

<br /><br />
<?php

$taabla_cab = '';
$ver_linkpdf = '';
//if($_POST["ctpc_id"]==1)
//{
$taabla_cab = 'beko_documentocabecera';
$ver_linkpdf = 'ver_pdf';
//}

//if($_POST["ctpc_id"]==2)
//{
//$taabla_cab='beko_recibocabecera'; 
//$ver_linkpdf='ver_pdfrecibo';   
//}
$grantotalg = 0;
$lista_fpago = "select * from beko_formapago";
$rs_lfpago = $DB_gogess->executec($lista_fpago, array());
if ($rs_lfpago) {
	while (!$rs_lfpago->EOF) {

		$frm_codigo = $rs_lfpago->fields["frm_codigo"];
		$frm_nombreimp = $rs_lfpago->fields["frm_nombreimp"];


		//==================================================================================


		//===
		if ($cierr_fechafinxd != '' and  $cierr_fechafinxd != '0000-00-00') {

			$busca_fp = "select count(*) as total from beko_documentocabecera inner join lpin_formapagoventa on beko_documentocabecera.doccab_id=lpin_formapagoventa.doccab_id where  beko_documentocabecera.usua_id='" . $usua_idxd . "' and (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='" . $cierr_fechaxd . "' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='" . $cierr_fechafinxd . "' )and doccab_anulado=0 and tipocmp_codigo='01' and frmc_codigo='" . $frm_codigo . "' and tippo_id!=1 ";
		} else {
			$busca_fp = "select count(*) as total from beko_documentocabecera inner join lpin_formapagoventa on beko_documentocabecera.doccab_id=lpin_formapagoventa.doccab_id where  beko_documentocabecera.usua_id='" . $usua_idxd . "' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='" . $cierr_fechaxd . "' and doccab_anulado=0 and tipocmp_codigo='01' and frmc_codigo='" . $frm_codigo . "' and tippo_id!=1";
		}

		$rs_lfp = $DB_gogess->executec($busca_fp, array());


		if ($rs_lfp->fields["total"] > 0) {
			echo "<br><b>" . $frm_nombreimp . "</b>";
			//===

?>

			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td bgcolor="#BDD7EC"><b>No.</b></td>
					<td bgcolor="#BDD7EC"><b>Fecha</b></td>
					<td bgcolor="#BDD7EC"><b>Forma de Pago</b></td>
					<td bgcolor="#BDD7EC"><b>No. Doc</b></td>
					<td bgcolor="#BDD7EC"><b>Cliente</b></td>
					<td bgcolor="#BDD7EC"><b>Ruc</b></td>
					<td bgcolor="#BDD7EC"><b>Total</b></td>
				</tr>

				<?php
				if ($cierr_fechafinxd != '' and  $cierr_fechafinxd != '0000-00-00') {
					$lista_fac = "select * from beko_documentocabecera inner join lpin_formapagoventa on beko_documentocabecera.doccab_id=lpin_formapagoventa.doccab_id where  beko_documentocabecera.usua_id='" . $usua_idxd . "' and (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='" . $cierr_fechaxd . "' and  DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='" . $cierr_fechafinxd . "') and doccab_anulado=0 and tipocmp_codigo='01' and frmc_codigo='" . $frm_codigo . "' and tippo_id!=1 order by beko_documentocabecera.doccab_id asc";
				} else {
					$lista_fac = "select * from beko_documentocabecera inner join lpin_formapagoventa on beko_documentocabecera.doccab_id=lpin_formapagoventa.doccab_id where  beko_documentocabecera.usua_id='" . $usua_idxd . "' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='" . $cierr_fechaxd . "' and doccab_anulado=0 and tipocmp_codigo='01' and frmc_codigo='" . $frm_codigo . "'  and tippo_id!=1 order by beko_documentocabecera.doccab_id asc";
				}

				$grantotal = 0;
				$num_data = 0;
				$rs_data = $DB_gogess->executec($lista_fac, array());
				if ($rs_data) {
					while (!$rs_data->EOF) {



						$forma_pago = '';


						$busca_fpagox = "select * from lpin_formapagoventa where doccab_id='" . $rs_data->fields["doccab_id"] . "' and frmc_codigo='" . $frm_codigo . "' and frmpven_id='" . $rs_data->fields["frmpven_id"] . "'";
						$rs_fpagox = $DB_gogess->executec($busca_fpagox, array());

						if ($frm_codigo == $rs_fpagox->fields["frmc_codigo"]) {
							//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++

							$num_data++;
							if ($rs_fpagox->fields["frmc_codigo"] == '01') {
								$forma_pago = 'EFECTIVO';
							}

							if ($rs_fpagox->fields["frmc_codigo"] == '19') {
								$forma_pago = 'TARJETA DE CREDITO';
							}

							if ($rs_fpagox->fields["frmc_codigo"] == '16') {
								$forma_pago = 'TARJETA DE DEBITO';
							}

							if ($rs_fpagox->fields["frmc_codigo"] == '20') {
								$forma_pago = 'TRANSFERENCIA';
							}



							//if($rs_data->fields["tippo_id"]==1)
							//{
							// $forma_pago='CUENTAS POR COBRAR'; 
							//}

							$bunombre = '';
							$bunombre = $objformulario->replace_cmb("cesdb_arextension.dns_tipoproceso", "tippo_id,tippo_nombre", "where tippo_id=", $rs_data->fields["tippo_id"], $DB_gogess);
							$nombreptxt = '';
							if ($rs_data->fields["tippo_id"] == 2 or $rs_data->fields["tippo_id"] == 8) {
								$nombreptxt = " (" . $bunombre . ")";
							}


							$saldo = $rs_data->fields["doccab_saldohoracierre"];

							$bandera = 0;

							if ($rs_data->fields["tippo_id"] == 1 or ($rs_data->fields["tippo_id"] == 2 and $saldo > 0) or ($rs_data->fields["tippo_id"] == 8 and $saldo > 0)) {
								$forma_pago = 'CUENTAS POR COBRAR' . $nombreptxt;
								$bandera = 1;
							}

							$frmpven_valor = 0;
							$frmpven_valor = $rs_fpagox->fields["frmpven_valor"];

							if ($bandera != 1) {
				?>
								<tr>
									<td><?php echo $num_data; ?></td>
									<td><?php echo $rs_data->fields["doccab_fechaemision_cliente"]; ?></td>
									<td><?php echo $forma_pago; ?></td>
									<td><?php echo $rs_data->fields["doccab_ndocumento"]; ?></td>
									<td><?php echo $rs_data->fields["doccab_nombrerazon_cliente"] . " " . $rs_data->fields["doccab_apellidorazon_cliente"]; ?></td>
									<td><?php echo $rs_data->fields["doccab_rucci_cliente"]; ?></td>
									<td><?php echo $frmpven_valor; ?></td>
								</tr>
				<?php
								$grantotal = $grantotal + $frmpven_valor;
							}



							//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
						}

						$rs_data->MoveNext();
					}
				}

				?>
				<tr>
					<td bgcolor="#BDD7EC">&nbsp;</td>
					<td bgcolor="#BDD7EC">&nbsp;</td>
					<td bgcolor="#BDD7EC">&nbsp;</td>
					<td bgcolor="#BDD7EC">&nbsp;</td>
					<td bgcolor="#BDD7EC">&nbsp;</td>
					<td bgcolor="#BDD7EC"><b>Total</b></td>
					<td bgcolor="#BDD7EC"><b><?php echo $grantotal; ?></b></td>
				</tr>
			</table>

<?php

			$grantotalg = $grantotalg + $grantotal;
		}

		//==================================================================================
		$rs_lfpago->MoveNext();
	}
}
?>

<br />
<b>CUENTAS POR COBRAR</b>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#BDD7EC"><b>No.</b></td>
		<td bgcolor="#BDD7EC"><b>Fecha</b></td>
		<td bgcolor="#BDD7EC"><b>Forma de Pago</b></td>
		<td bgcolor="#BDD7EC"><b>No. Doc</b></td>
		<td bgcolor="#BDD7EC"><b>Cliente</b></td>
		<td bgcolor="#BDD7EC"><b>Ruc</b></td>
		<td bgcolor="#BDD7EC"><b>Total</b></td>
	</tr>

	<?php
	if ($cierr_fechafinxd != '' and  $cierr_fechafinxd != '0000-00-00') {
		$lista_facx = "select * from beko_documentocabecera inner join lpin_formapagoventa on beko_documentocabecera.doccab_id=lpin_formapagoventa.doccab_id where  beko_documentocabecera.usua_id='" . $usua_idxd . "' and (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='" . $cierr_fechaxd . "' and  DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='" . $cierr_fechafinxd . "') and doccab_anulado=0 and tipocmp_codigo='01'  and tippo_id in (1,2,8) order by beko_documentocabecera.doccab_id asc";
	} else {
		$lista_facx = "select * from beko_documentocabecera inner join lpin_formapagoventa on beko_documentocabecera.doccab_id=lpin_formapagoventa.doccab_id where  beko_documentocabecera.usua_id='" . $usua_idxd . "' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='" . $cierr_fechaxd . "' and doccab_anulado=0 and tipocmp_codigo='01' and tippo_id in (1,2,8) order by beko_documentocabecera.doccab_id asc";
	}
	//echo $lista_facx;
	//$grantotal=0;
	$grantotalcxp = 0;
	$num_data = 0;
	$rs_datax = $DB_gogess->executec($lista_facx, array());
	if ($rs_datax) {
		while (!$rs_datax->EOF) {



			$forma_pago = '';


			$busca_fpagox = "select * from lpin_formapagoventa where doccab_id='" . $rs_datax->fields["doccab_id"] . "'";
			$rs_fpagox = $DB_gogess->executec($busca_fpagox, array());

			//if($frm_codigo==$rs_fpagox->fields["frmc_codigo"])
			//{
			//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++

			$num_data++;
			if ($rs_fpagox->fields["frmc_codigo"] == '01') {
				$forma_pago = 'EFECTIVO';
			}

			if ($rs_fpagox->fields["frmc_codigo"] == '19') {
				$forma_pago = 'TARJETA DE CREDITO';
			}

			if ($rs_fpagox->fields["frmc_codigo"] == '16') {
				$forma_pago = 'TARJETA DE DEBITO';
			}

			if ($rs_fpagox->fields["frmc_codigo"] == '20') {
				$forma_pago = 'TRANSFERENCIA';
			}



			//if($rs_datax->fields["tippo_id"]==1)
			//{
			// $forma_pago='CUENTAS POR COBRAR'; 
			//}

			$bunombre = '';
			$bunombre = $objformulario->replace_cmb("cesdb_arextension.dns_tipoproceso", "tippo_id,tippo_nombre", "where tippo_id=", $rs_datax->fields["tippo_id"], $DB_gogess);
			$nombreptxt = '';
			if ($rs_datax->fields["tippo_id"] == 2 or $rs_datax->fields["tippo_id"] == 8) {
				$nombreptxt = " (" . $bunombre . ")";
			}


			$saldo = $rs_datax->fields["doccab_saldohoracierre"];


			if ($rs_datax->fields["tippo_id"] == 1 or ($rs_datax->fields["tippo_id"] == 2 and $saldo > 0) or ($rs_datax->fields["tippo_id"] == 8 or $saldo > 0)) {
				$forma_pago = 'CUENTAS POR COBRAR' . $nombreptxt;
			}

			$frmpven_valor = 0;
			$frmpven_valor = $rs_fpagox->fields["frmpven_valor"];

			if ($saldo > 0) {
	?>
				<tr>
					<td><?php echo $num_data; ?></td>
					<td><?php echo $rs_datax->fields["doccab_fechaemision_cliente"]; ?></td>
					<td><?php echo $forma_pago; ?></td>
					<td><?php echo $rs_datax->fields["doccab_ndocumento"]; ?></td>
					<td><?php echo $rs_datax->fields["doccab_nombrerazon_cliente"] . " " . $rs_datax->fields["doccab_apellidorazon_cliente"]; ?></td>
					<td><?php echo $rs_datax->fields["doccab_rucci_cliente"]; ?></td>
					<td><?php echo $frmpven_valor; ?></td>
				</tr>
	<?php
				$grantotalcxp = $grantotalcxp + $frmpven_valor;
			}



			//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			//}	   

			$rs_datax->MoveNext();
		}
	}



	?>
	<tr>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC"><b>Total</b></td>
		<td bgcolor="#BDD7EC"><b><?php echo $grantotalcxp; ?></b></td>
	</tr>
</table>

<?php
$grantotalg = $grantotalg + $grantotalcxp;

?>
<table>
	<tr>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC"><b>Total Facturas</b></td>
		<td bgcolor="#BDD7EC"><b><?php echo $grantotalg; ?></b></td>
	</tr>
</table>

<br /><br />
<b>LISTA FACTURAS ANULADAS</b>
<?php
$lista_fac = "select * from " . $taabla_cab . " where  usua_id='" . $usua_idxd . "' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='" . $cierr_fecha . "' and doccab_anulado=1 and tipocmp_codigo='01' order by doccab_id asc";
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#BDD7EC"><b>No.</b></td>
		<td bgcolor="#BDD7EC"><b>Fecha</b></td>
		<td bgcolor="#BDD7EC"><b>Forma de Pago</b></td>
		<td bgcolor="#BDD7EC"><b>No. Doc</b></td>
		<td bgcolor="#BDD7EC"><b>Cliente</b></td>
		<td bgcolor="#BDD7EC"><b>Ruc</b></td>
		<td bgcolor="#BDD7EC"><b>Total</b></td>
		<td bgcolor="#BDD7EC"><b>MOTIVO</b></td>
		<td bgcolor="#BDD7EC"><b>FECHA ANULADO</b></td>
	</tr>

	<?php
	$grantotal = 0;
	$num_data = 0;
	$rs_data = $DB_gogess->executec($lista_fac, array());
	if ($rs_data) {
		while (!$rs_data->EOF) {

			$num_data++;

			$forma_pago = '';

			$busca_fpagox = "select * from lpin_formapagoventa where doccab_id='" . $rs_data->fields["doccab_id"] . "'";
			$rs_fpagox = $DB_gogess->executec($busca_fpagox, array());

			if ($rs_fpagox->fields["frmc_codigo"] == '01') {
				$forma_pago = 'EFECTIVO';
			}

			if ($rs_fpagox->fields["frmc_codigo"] == '19') {
				$forma_pago = 'TARJETA DE CREDITO';
			}

			if ($rs_fpagox->fields["frmc_codigo"] == '16') {
				$forma_pago = 'TARJETA DE DEBITO';
			}

			if ($rs_fpagox->fields["frmc_codigo"] == '20') {
				$forma_pago = 'TRANSFERENCIA';
			}

			if ($rs_data->fields["tippo_id"] == 1) {
				$forma_pago = 'CUENTAS POR COBRAR';
			}

	?>
			<tr>
				<td><?php echo $num_data; ?></td>
				<td><?php echo $rs_data->fields["doccab_fechaemision_cliente"]; ?></td>
				<td><?php echo $forma_pago; ?></td>
				<td><?php echo $rs_data->fields["doccab_ndocumento"]; ?></td>
				<td><?php echo $rs_data->fields["doccab_nombrerazon_cliente"] . " " . $rs_data->fields["doccab_apellidorazon_cliente"]; ?></td>
				<td><?php echo $rs_data->fields["doccab_rucci_cliente"]; ?></td>
				<td><?php echo $rs_data->fields["doccab_total"]; ?></td>
				<td><?php echo $rs_data->fields["doccab_motivoanulado"]; ?></td>
				<td><?php echo $rs_data->fields["doccab_fechaanulado"]; ?></td>
			</tr>
	<?php

			$grantotal = $grantotal + $rs_data->fields["doccab_total"];

			$rs_data->MoveNext();
		}
	}

	?>
	<tr>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC"><b>Total</b></td>
		<td bgcolor="#BDD7EC"><b><?php echo $grantotal; ?></b></td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
		<td bgcolor="#BDD7EC">&nbsp;</td>
	</tr>
</table>

<?php
$tbl_plantilla2 = '<br><br><table width="100%" border="0" cellpadding="0" cellspacing="0">

	<tr>
		<td><b>No. Transacciones</b> -cierr_ntransacciones-<br>
			<b>Efectivo:</b> -cierr_efectivo-
		</td>
		<td><b>Tarjeta de Credito: </b> -cierr_tarjetacredito- <br>
			<b>Transferencia:</b> -cierr_transferencia-
		</td>
		<td><b>Cuenta x Cobrar:</b> -cierr_cuentaxcobrar- <br>
			<b>Total:</b> -cierr_total-
		</td>
		<td><b>Total dinero:</b> -cierr_totaldinero- <br>
			<b>Estado: </b> -estac_id-
		</td>
	</tr>

</table><br>';

$lee_plantilla =  $tbl_plantilla2;



$campos_evo = '';
$campos_evo = "select * from gogess_sisfield where tab_name='" . $table . "' and fie_type!='campogrid' ";
$rs_camposevo = $DB_gogess->executec($campos_evo, array());
if ($rs_camposevo) {
	while (!$rs_camposevo->EOF) {

		if ($rs_camposevo->fields["fie_value"] == 'replace') {
			$lab_datos = $objformulario->replace_cmb($rs_camposevo->fields["fie_tabledb"], $rs_camposevo->fields["fie_datadb"], $rs_camposevo->fields["fie_sql"], $rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]], $DB_gogess);
		} else {
			if ($rs_camposevo->fields["fie_type"] == 'txtgraficopeker') {
				$lab_datos = '<img src="../archivo/' . $rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]] . '" alt="125x125" width="300px">';
			} else {
				$lab_datos = nl2br($rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]]);
			}
		}

		$lee_plantilla = str_replace("-" . $rs_camposevo->fields["fie_name"] . "-", $lab_datos, $lee_plantilla);

		$rs_camposevo->MoveNext();
	}
}

echo $lee_plantilla;
?>


<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="50" valign="bottom">________________________________________________</td>
	</tr>
	<tr>
		<td><strong>
				<?php echo utf8_decode($rs_us->fields["usua_siglastitulo"] . " " . $rs_us->fields["usua_nombre"] . " " . $rs_us->fields["usua_apellido"]); ?>
			</strong></td>
	</tr>
	<tr>
		<td><strong>
				<?php echo utf8_decode($rs_us->fields["usua_piefirma"]); ?><br>
				FIRMA<br>

			</strong></td>
	</tr>
	<tr>
		<td><strong>
				<?php
				//	$ncentro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$objformulario->contenid["centro_id"],$DB_gogess);

				//	echo utf8_decode($ncentro);
				?>
			</strong></td>
	</tr>
</table>