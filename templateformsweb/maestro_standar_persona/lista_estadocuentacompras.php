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

	header('Content-type: application/vnd.ms-excel');
	$fechahoy = date("Y-m-d");
	header("Content-Disposition: attachment; filename=" . "compras_" . $fechahoy . ".xls");

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

	<?php

	$SUMA_C = 0;
	$busca_compras = "";
	if ($provee_ruc) {
		$busca_compras = " select * from dns_compras_vista where provee_ruc='" . $provee_ruc . "' UNION ";
	}

	if ($provee_cedula) {
		$busca_compras .= " select * from dns_compras_vista where provee_cedula='" . $provee_cedula . "' UNION ";
	}

	if ($busca_compras) {
		$busca_compras = substr($busca_compras, 0, -6);
	}

	//echo $busca_compras;

	$rs_compras = $DB_gogess->executec($busca_compras);
	?>
	<br /><br />
	<table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="13">
				<div align="center" style="font-weight: bold">COMPRAS</div>
			</td>
		</tr>
		<tr>
			<td bgcolor="#D6E7EB"><span class="css_data">TIPO </span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">N. DOCUMENTO </span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">FECHA </span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">RUC</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">CI</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">NOMBRE</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">ESTADO DOCUMENTO</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">ESTADO</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">Neto</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">Imp</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">Total</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">RET</span></td>
			<td bgcolor="#D6E7EB"><span class="css_data">SALDO</span></td>
		</tr>
		<?php
		if ($rs_compras) {
			while (!$rs_compras->EOF) {

				$estado_p = '';
				if ($rs_compras->fields["saldo"] == '0') {
					$estado_p = 'PAGADO';
				}
		?>
				<tr>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_compras->fields["tipdoc_nombre"]; ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_compras->fields["compra_nfactura"]; ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_compras->fields["compra_fecha"]; ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_compras->fields["provee_ruc"]; ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_compras->fields["provee_cedula"]; ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_compras->fields["provee_nombre"]; ?></td>
					<td bgcolor="#FFFFFF" class="css_txt"><?php echo $rs_compras->fields["compra_anulado"]; ?></td>
					<td bgcolor="#FFFFFF" class="css_txt"><?php echo $estado_p; ?></td>

					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_compras->fields["neto"]); ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_compras->fields["compra_iva"]); ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_compras->fields["compra_total"]); ?></td>
					<td nowrap="nowrap" bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_compras->fields["totalret"]); ?></td>

					<td bgcolor="#FFFFFF" class="css_txt"><?php echo str_replace(".", ",", $rs_compras->fields["saldo"]); ?></td>
				</tr>
		<?php

				$SUMA_C = $SUMA_C + $rs_compras->fields["saldo"];


				$rs_compras->MoveNext();
			}
		}

		?>

		<tr>
			<td nowrap="nowrap" bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td nowrap="nowrap" bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td nowrap="nowrap" bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td nowrap="nowrap" bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td nowrap="nowrap" bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td nowrap="nowrap" bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td bgcolor="#D6E7EB" class="css_txt">&nbsp;</td>
			<td bgcolor="#D6E7EB" class="css_txt"><b><?php echo str_replace(".", ",", round($SUMA_C, 2)); ?></b></td>
		</tr>
	</table>


<?php
}
?>