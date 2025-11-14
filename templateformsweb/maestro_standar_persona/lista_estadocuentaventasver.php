<?php
$tiempossss = 44600000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

$director = '../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//print_r($_POST);
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if ($_SESSION['ces1313777_sessid_inicio']) {

	//header('Content-type: application/vnd.ms-excel');
	//$fechahoy = date("Y-m-d");
	//header("Content-Disposition: attachment; filename=" . "ventas_" . $fechahoy . ".xls");

	$provee_ruc = $_POST["provee_ruc"];
	$provee_cedula = $_POST["provee_cedula"];



	$busca_ventas = "";
	if ($provee_ruc) {
		$busca_ventas = "select * from beko_documentocabecera_vista where doccab_rucci_cliente='" . $provee_ruc . "' UNION ";
	}

	if ($provee_cedula) {
		$busca_ventas .= "select * from beko_documentocabecera_vista where doccab_rucci_cliente='" . $provee_cedula . "' UNION ";
	}


	if ($busca_ventas) {
		$busca_ventas = substr($busca_ventas, 0, -6);
	}


	$rs_ventas = $DB_gogess->executec($busca_ventas);
?>

	<style type="text/css">
		<!--
		.css_data {
			font-size: 10px;
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-weight: bold;
		}

		.css_txt {
			font-size: 10px;
			font-family: Verdana, Arial, Helvetica, sans-serif;
		}
		-->
	</style>
	<div align="center"><br /><b>
			<?php

			$ver_nombre = "select * from app_proveedor where provee_id='" . $_POST["provee_id"] . "'";
			$rs_nombre = $DB_gogess->executec($ver_nombre);
			echo $rs_nombre->fields["provee_nombre"];
			$SUMA_P = 0;
			?>
			<br /></b><br />
	</div>
	<table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="13">
				<div align="center" style="font-weight: bold">VENTAS</div>
			</td>
		</tr>
		<tr>
			<td bgcolor="#D6E7EB"><span class="css_data">TIPO</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">N. DOCUMENTO </span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">FECHA</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">RUC/CI</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">NOMBRE</span></td>

			<td bgcolor="#D6E7EB"><span class="css_data">SUBTOTAL</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">IVA</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">TOTAL</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">RET</span></td>

			<td bgcolor="#D6E7EB"><span class="css_data">ESTADO DOCUMENTO </span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">ESTADO SRI </span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">ESTADO</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">SALDO</span></td>
		</tr>
		<?php
		if ($rs_ventas) {
			while (!$rs_ventas->EOF) {

				$estado_p = '';
				if ($rs_ventas->fields["saldo"] == '0') {
					$estado_p = 'COBRADO';
				}

				if ($rs_ventas->fields["doccab_anulado"] == 'ANULADO') {
					$estado_p = '';
				}
		?>
				<tr>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_ventas->fields["tipocmp_nombre"]; ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt" style=mso-number-format:"@"><?php echo $rs_ventas->fields["doccab_ndocumento"]; ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_ventas->fields["doccab_fechaemision_cliente"]; ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt" style=mso-number-format:"@"><?php echo $rs_ventas->fields["doccab_rucci_cliente"]; ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_ventas->fields["doccab_nombrerazon_cliente"]; ?></td>

					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_ventas->fields["subtotal"]); ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_ventas->fields["doccab_iva"]); ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_ventas->fields["doccab_total"]); ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_ventas->fields["retencion"]); ?></td>


					<td bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_ventas->fields["doccab_anulado"]; ?></td>
					<td bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_ventas->fields["doccab_estadosri"]; ?></td>
					<td bgcolor="#FFFFFF" class="css_txt"><?php echo $estado_p; ?></td>
					<td bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_ventas->fields["saldo"]); ?></td>
				</tr>
		<?php
				$SUMA_P = $SUMA_P + $rs_ventas->fields["saldo"];

				$rs_ventas->MoveNext();
			}
		}

		?>

		<tr>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">&nbsp;</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data"><?php echo str_replace(".", ",", round($SUMA_P, 2)); ?></span></td>
		</tr>
	</table>




<?php
}
?>