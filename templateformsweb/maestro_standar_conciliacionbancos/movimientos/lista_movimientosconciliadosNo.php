<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 4444450000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();
$director = '../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");

//lpin_productocompra
//lpin_cuentacompra
//dns_activosfijos

$compra_enlace = $_POST["campo_enlace"];
$conc_fechacorte = $_POST["conc_fechacorte"];
$conc_cuenta = $_POST["conc_cuenta"];
$conc_saldobanco = $_POST["conc_saldobanco"];
$conc_id = $_POST["conc_id"];
$opcion = $_POST["opcion"];


echo "Listado:" . $conc_id;
$cuenta_seleecionos = 0;
$cuenta_noseleecionos = 0;

$bloque_registro = 0;

if ($conc_id > 0) {
	$busca_elanterior = "select * from app_conciliacion where conc_fechacorte < '" . $conc_fechacorte . "' and conc_cuenta='" . $conc_cuenta . "' order by conc_fechacorte desc limit 1";
	$rs_ultimafecha = $DB_gogess->executec($busca_elanterior, array());
} else {
	$busca_elanterior = "select * from app_conciliacion where conc_cuenta='" . $conc_cuenta . "' order by conc_id desc limit 1";
	$rs_ultimafecha = $DB_gogess->executec($busca_elanterior, array());
}

//echo $busca_elanterior;

$fecha_corteanterior = $rs_ultimafecha->fields["conc_fechacorte"];
$conc_saldocontableant = $rs_ultimafecha->fields["conc_saldocontable"];
//saca saldo anterior//


?>
<div id="campo_valorx"></div>
<table class="table table-bordered" style="width:100%">
	<tbody>
		<tr>
			<td bgcolor="#DFE9EE"></td>
			<td bgcolor="#DFE9EE"></td>
			<td bgcolor="#DFE9EE">Fecha</td>
			<td bgcolor="#DFE9EE">Detalle</td>
			<td bgcolor="#DFE9EE">Referencia</td>
			<td bgcolor="#DFE9EE">Tipo</td>
			<td bgcolor="#DFE9EE">Monto</td>
		</tr>

		<?php
		if ($conc_saldocontableant) {
		?>
			<!--	<tr>
				<td></td>
				<td>Saldo Anterior</td>
				<td nowrap="nowrap"><?php echo $fecha_corteanterior; ?></td>
				<td></td>
				<td></td>
				<td nowrap="nowrap"></td>
				<td><?php echo $conc_saldocontableant; ?></td>
			</tr>  -->

		<?php
		}

		?>

		<?php
		$suma_valort = 0;
		$suma_valortno = 0;

		if (!(trim($fecha_corteanterior))) {
			$lista_renta = "select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where ((comcont_fecha<='" . $conc_fechacorte . "' and conc_idform=0) or (conc_idform='" . $conc_id . "') or (comcont_fecha<='" . $conc_fechacorte . "' and  detcc_conciliacion=0 and conc_idform=0)) and detcc_cuentacontable='" . $conc_cuenta . "' and comcont_anulado=0  order by comcont_fecha asc";
		} else {
			$lista_renta = "select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where (( comcont_fecha >'" . $fecha_corteanterior . "' and comcont_fecha<='" . $conc_fechacorte . "' and conc_idform=0 ) or (conc_idform='" . $conc_id . "') or (comcont_fecha<='" . $conc_fechacorte . "' and 	detcc_conciliacion=0 and conc_idform=0)) and detcc_cuentacontable='" . $conc_cuenta . "' and comcont_anulado=0 order by comcont_fecha asc";
		}

		//echo $lista_renta;

		$rs_listadata = $DB_gogess->executec($lista_renta, array());
		if ($rs_listadata) {
			while (!$rs_listadata->EOF) {

				if ($rs_listadata->fields["detcc_conciliacion"] != 1) {
					$contador_lista++;
				}
				$detalle = '';
				$referencia = '';
				$tipo = '';

				$comcont_tabla = $rs_listadata->fields["comcont_tabla"];

				if (!($comcont_tabla)) {
					$detalle = $rs_listadata->fields["comcont_concepto"];
					$referencia = $rs_listadata->fields["comcont_numeroc"];

					$tipoa_id = $rs_listadata->fields["tipoa_id"];

					$busca_tipo = "select * from lpin_tipoasiento where tipoa_id='" . $tipoa_id . "'";
					$rs_btipo = $DB_gogess->executec($busca_tipo, array());
					$tipo = strtoupper($rs_btipo->fields["tipoa_nombre"]);
				} else {

					switch ($comcont_tabla) {
						case 'app_anticipos': {

								$busca_datos = "select * from app_anticipos where anti_id='" . $rs_listadata->fields["comcont_idtabla"] . "'";
								$rs_bd = $DB_gogess->executec($busca_datos, array());
								$detalle = $rs_bd->fields["anti_descripcion"];
								$referencia = $rs_bd->fields["anti_comprobante"];

								$detantic_id = $rs_bd->fields["detantic_id"];
								$busca_tipo = "select * from cesdb_arcombos.cmd_tipodetallemovanticipo where detantic_id='" . $detantic_id . "'";
								$rs_btipo = $DB_gogess->executec($busca_tipo, array());
								$tipo = strtoupper($rs_btipo->fields["detantic_nombre"]);
							}
							break;
						case 'lpin_cobropago': {
								if ($rs_listadata->fields["comcont_tablas"] == 'dns_compras') {
									$busca_datos = "select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropago.crb_enlace where crb_id='" . $rs_listadata->fields["comcont_idtabla"] . "' and  compracp_id='" . $rs_listadata->fields["comcont_idtablas"] . "'";
								}

								if ($rs_listadata->fields["comcont_tablas"] == 'beko_documentocabecera') {
									$busca_datos = "select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropago.crb_enlace where crb_id='" . $rs_listadata->fields["comcont_idtabla"] . "' and  doccabcp_id='" . $rs_listadata->fields["comcont_idtablas"] . "'";
								}

								$rs_bd = $DB_gogess->executec($busca_datos, array());

								$frocob_id = $rs_bd->fields["frocob_id"];
								$busca_tipo = "select * from lpin_formadecobro where frocob_id='" . $frocob_id . "'";
								$rs_btipo = $DB_gogess->executec($busca_tipo, array());
								$tipo = strtoupper($rs_btipo->fields["frocob_nombre"]);

								$doccab_id = $rs_bd->fields["doccabcp_id"];
								$compra_id = $rs_bd->fields["compracp_id"];

								$ndoc = '';

								if ($doccab_id) {
									$busca_datos2 = "select * from beko_documentocabecera where doccab_id='" . $doccab_id . "'";
									$rs_bd2 = $DB_gogess->executec($busca_datos2, array());
									$ndoc = $rs_bd->fields["crb_ncomprobante"];
									$dscrip = $rs_bd2->fields["doccab_adicional"];
								}

								if ($compra_id) {
									$busca_datos2 = "select * from dns_compras where compra_id='" . $compra_id . "'";
									$rs_bd2 = $DB_gogess->executec($busca_datos2, array());
									$ndoc = $rs_bd->fields["crb_ncomprobante"];
									$dscrip = $rs_bd2->fields["compra_descripcion"];
								}

								$detalle = $dscrip . ' ' . $rs_bd->fields["crb_descripcion"];
								$referencia = $ndoc;
							}
							break;
						case 'app_movimientobancos': {

								$busca_datos = "select * from app_movimientobancos inner join app_proveedor on app_movimientobancos.proveemovban_id=app_proveedor.provee_id where movban_id='" . $rs_listadata->fields["comcont_idtabla"] . "'";
								$rs_bd = $DB_gogess->executec($busca_datos, array());

								$detmov_id = $rs_bd->fields["detmov_id"];
								$busca_tipo = "select * from cesdb_arcombos.cmd_tipodetallemovbancos where detmov_id='" . $detmov_id . "'";
								$rs_btipo = $DB_gogess->executec($busca_tipo, array());
								$tipo = strtoupper($rs_btipo->fields["detmov_nombre"]);


								$detalle = $rs_bd->fields["movban_descripcion"] . ' ' . $rs_bd->fields["provee_nombre"];
								$referencia = $rs_bd->fields["movban_comprobante"];
							}
							break;

						case 'lpin_lqtarjetacredito': {

								$busca_datos = "select * from lpin_lqtarjetacredito inner join app_proveedor on lpin_lqtarjetacredito.proveelq_id=app_proveedor.provee_id where ldtc_id='" . $rs_listadata->fields["comcont_idtabla"] . "'";
								$rs_bd = $DB_gogess->executec($busca_datos, array());

								$tpliq_id = $rs_bd->fields["tpliq_id"];
								$tpliq_ndocumento = $rs_bd->fields["tpliq_ndocumento"];
								$tpliq_ndeordenbc = $rs_bd->fields["tpliq_ndeordenbc"];

								$busca_tipo = "select * from cesdb_arcombos.app_tipodocliq where tpliq_id='" . $tpliq_id . "'";
								$rs_btipo = $DB_gogess->executec($busca_tipo, array());
								$tipo = strtoupper($rs_btipo->fields["tpliq_nombre"]);


								$detalle = "DOCUMENTO:" . $tpliq_ndocumento . ' - ' . $rs_bd->fields["provee_nombre"] . '- ' . $tpliq_ndeordenbc;
								$referencia = $tpliq_ndeordenbc;
							}
							break;
					}
				}

				$fila_data = '';

				$fila_data .= '<tr>';
				$fila_data .= '<td>' . $contador_lista . '</td>';
				$fila_data .= '<td>';

				$comulla_simple = "'";
				$tabla_valordata = "";
				$tabla_valordata = "'lpin_detallecomprobantecontable'";

				$campo_valor = "";
				$campo_valor = "'detcc_id'";
				$ide_producto = 'detcc_id';
				$ncampo_val = 'detcc_conciliacion';

				if ($rs_listadata->fields["detcc_conciliacion"] == 1) {

					// if($bloque_registro==0)
					//{
					$fila_data .= '<input class="form-control" name="cmb_' . $ncampo_val . $rs_listadata->fields[$ide_producto] . '" type="checkbox" id="cmb_' . $ncampo_val . $rs_listadata->fields[$ide_producto] . '" value="' . $rs_listadata->fields[$ide_producto] . '" onclick="guardar_camposf(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_listadata->fields[$ide_producto] . ',' . $comulla_simple . $ide_producto . $comulla_simple . ')";  checked />';
					//}
					//else
					//{

					//	echo 'X';	

					//}
					//$cuenta_seleecionos++;
				} else {

					//if($bloque_registro==0)
					// {
					$fila_data .= '<input class="form-control" name="cmb_' . $ncampo_val . $rs_listadata->fields[$ide_producto] . '" type="checkbox" id="cmb_' . $ncampo_val . $rs_listadata->fields[$ide_producto] . '" value="' . $rs_listadata->fields[$ide_producto] . '" onclick="guardar_camposf(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_listadata->fields[$ide_producto] . ',' . $comulla_simple . $ide_producto . $comulla_simple . ')"; />';
					//}
					//else
					//{

					//echo '';	

					//}
					//$cuenta_noseleecionos++;
				}

				//	$('input:checkbox[name=colorfavorito]:checked').val()

				$monto = 0;
				$signo = '';
				if ($rs_listadata->fields["detcc_debe"] > 0) {
					$monto = $rs_listadata->fields["detcc_debe"];
					$signo = '<i class="fa fa-plus" style="color:#000000"></i>';
					$montosuma = $rs_listadata->fields["detcc_debe"];
				}
				if ($rs_listadata->fields["detcc_haber"] > 0) {
					$monto = $rs_listadata->fields["detcc_haber"];
					$signo = '<i class="fa fa-minus" style="color:#FF0000"></i>';
					$montosuma = $rs_listadata->fields["detcc_haber"] * -1;
				}

				//$rs_listadata->fields["comcont_id"]


				$fila_data .= '</td>';
				$fila_data .= '<td nowrap="nowrap">' . $rs_listadata->fields["comcont_fecha"] . '</td>';
				$fila_data .= '<td>' . $detalle . '</td>';
				$fila_data .= '<td>' . $referencia . '</td>';
				$fila_data .= '<td nowrap="nowrap">' . $signo . ' ' . $tipo . '</td>';
				$fila_data .= '<td>' . $monto . '</td>';
				$fila_data .= '</tr>';


				if ($rs_listadata->fields["detcc_conciliacion"] != 1) {
					echo $fila_data;
					$suma_valortno = $suma_valortno + $monto;
					$cuenta_noseleecionos++;
				}



				if ($rs_listadata->fields["detcc_conciliacion"] == 1 and $rs_listadata->fields["conc_idform"] == $conc_id) {
					$suma_valort = $suma_valort + $montosuma;
				}

				$rs_listadata->MoveNext();
			}
		}


		$saldo_finalmes = 0;
		$saldo_finalmes = $conc_saldocontableant + ($suma_valort);

		$saldo_finalmesno = 0;
		$saldo_finalmesno = $suma_valortno;

		$diferencia = 0;
		$diferencia = round(($conc_saldobanco - $saldo_finalmes), 2);
		?>
		</td>
		<td></td>
		<td></td>
		<td>SALDO</td>
		<td></td>
		<td></td>
		<td></td>
		<td>
			<div id="stotal"><?php echo $saldo_finalmesno; ?></div>
		</td>
		</tr>

	</tbody>
</table>


<?php
//echo $conc_saldocontableant . "<br>";
//echo $conc_saldobanco . "<br>";
//echo $suma_valort . "<br>";
if ($diferencia == -0) {
	$diferencia = 0;
}

//echo $diferencia . "<br>";
?>

<?php
//echo "Seleccionados:" . $cuenta_seleecionos . "<br>";
echo "No Seleccionados:" . $cuenta_noseleecionos;
?>

<script language="javascript">
	<!--
	function guardar_camposf(tabla, campo, id, campoidtabla) {

		if ($('#conc_id').val() == '') {
			alert("Para poder seleccionar debe guardar el Registro Conciliacion...");
			$('#cmb_' + campo + id).prop("checked", false);
			return false;
		}

		$("#campo_valorx").load("templateformsweb/maestro_standar_conciliacionbancos/guarda_campocon.php", {
			tabla: tabla,
			campo: campo,
			id: id,
			valor: $('#cmb_' + campo + id).is(":checked"),
			campoidtabla: campoidtabla,
			compra_enlace: '<?php echo $compra_enlace; ?>',
			conc_fechacorte: $('#conc_fechacorte').val(),
			conc_cuenta: $('#conc_cuenta').val(),
			conc_saldobanco: $('#conc_saldobanco').val(),
			conc_idform: $('#conc_id').val()
		}, function(result) {



		});

		$("#campo_valorx").html("Espere un momento...");

	}

	<?php
	if ($diferencia == 0) {
		$estcomp_id = 2;
	?>
		$('#estcomp_id').val('2');
		$('#despliegue_estcomp_id').html('CONCLUIDA');
		$("#despliegue_estcomp_id").css('color', '#ffffff');
		$("#despliegue_estcomp_id").css('background-color', '#009933');
	<?php
	} else {
		$estcomp_id = 1;
	?>
		$('#estcomp_id').val('1');
		$('#despliegue_estcomp_id').html('PENDIENTE');
		$("#despliegue_estcomp_id").css('color', '#ffffff');
		$("#despliegue_estcomp_id").css('background-color', '#990000');
	<?php

	}
	?>

	$('#conc_saldocontable').val('<?php echo $saldo_finalmes; ?>');
	$('#conc_diferencia').val('<?php echo $diferencia; ?>');

	//enviar_formulariodata('form_app_conciliacion');

	<?php
	if ($conc_id > 0) {
		$actualiza_data = "update app_conciliacion set conc_saldobanco='" . $conc_saldobanco . "',conc_saldocontable='" . $saldo_finalmes . "',conc_diferencia='" . $diferencia . "',estcomp_id='" . $estcomp_id . "' where conc_id='" . $conc_id . "'";

		$rsokac = $DB_gogess->executec($actualiza_data, array());
	}

	?>

	desplegar_grid_conciliacionbancos();

	//
	-->
</script>