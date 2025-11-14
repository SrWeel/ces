<?php

use Sabberworm\CSS\Value\ValueList;

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
$objformulario = new  ValidacionesFormulario();

if (@$_SESSION['ces1313777_sessid_inicio']) {
	$crb_id = $_POST["crb_id"];

	$cuenta_hay = 0;

	$lista_pagos = "select * from lpin_masivocobropago inner join lpin_masivocobropagodetalle on lpin_masivocobropago.crb_enlace=lpin_masivocobropagodetalle.crb_enlace where crb_id='" . $crb_id . "' and crucue_cuentax!=''";

	$rs_listadiariox = $DB_gogess->executec($lista_pagos, array());
	if ($rs_listadiariox) {
		while (!$rs_listadiariox->EOF) {

			$cuenta_hay++;

			$busca_registrado = "select * from lpin_crucedocumentos where crpadetmasivo_id='" . $rs_listadiariox->fields["crpadet_id"] . "'";
			$rs_bureg = $DB_gogess->executec($busca_registrado, array());

			if ($rs_bureg->fields["crb_id"] > 0) {
				echo "Ya fue procesado...<br>";
			} else {
				//=======================================================================


				///cabecera documentos
				$emp_id = 0;
				$estaf_id = 0;
				$tipocmp_codigo = '';
				$crudoc_fechaemision = $rs_listadiariox->fields["crb_fecha"];
				$proveecru_id = $rs_listadiariox->fields["proveep_id"];
				$crudoc_ndocumento = $rs_listadiariox->fields["compracp_id"];
				$crudoc_ndocumentoventa = $rs_listadiariox->fields["doccabcp_id"];
				$crudoc_saldo = $rs_listadiariox->fields["crpadet_valor"] - $rs_listadiariox->fields["crpadet_valorapagar"];
				$crudoc_tipotransaccion = $rs_listadiariox->fields["ttra_id"];
				$crudoc_descripcion = $rs_listadiariox->fields["crb_descripcion"];
				$usua_id = $rs_listadiariox->fields["usua_id"];
				$tipase_id = 0;
				$tippo_id = 0;

				$codig_unicovalor = '';
				$unico_number = '';
				$unico_number = strtoupper(uniqid());
				$codig_unicovalor = date("Y-m-d") . $_SESSION['ces1313777_sessid_inicio'] . $unico_number;

				$crudoc_enlace = $codig_unicovalor;
				$crudoc_fecharegistro = $rs_listadiariox->fields["crb_fecha"];
				$doccabcr_id = $rs_listadiariox->fields["doccabcp_id"];
				$compracr_id = $rs_listadiariox->fields["compracp_id"];
				$tipop_id = 7;
				$crpadetmasivo_id = $rs_listadiariox->fields["crpadet_id"];
				///cabecera documentos

				$inserta_data = "INSERT INTO lpin_crucedocumentos (emp_id, estaf_id, tipocmp_codigo, crudoc_fechaemision, proveecru_id, crudoc_ndocumento, crudoc_ndocumentoventa, crudoc_saldo, crudoc_tipotransaccion, crudoc_descripcion, usua_id, tipase_id, tippo_id, crudoc_enlace, crudoc_fecharegistro, doccabcr_id, compracr_id, tipop_id, crpadetmasivo_id) VALUES ('" . $emp_id . "','" . $estaf_id . "','" . $tipocmp_codigo . "','" . $crudoc_fechaemision . "','" . $proveecru_id . "','" . $crudoc_ndocumento . "','" . $crudoc_ndocumentoventa . "','" . $crudoc_saldo . "','" . $crudoc_tipotransaccion . "','" . $crudoc_descripcion . "','" . $usua_id . "','" . $tipase_id . "','" . $tippo_id . "','" . $crudoc_enlace . "','" . $crudoc_fecharegistro . "','" . $doccabcr_id . "','" . $compracr_id . "','" . $tipop_id . "','" . $crpadetmasivo_id . "')";
				$rs_insdata = $DB_gogess->executec($inserta_data, array());

				//echo $inserta_data . "<br>";

				$crucue_cuenta = $rs_listadiariox->fields["crucue_cuentax"];
				$crucue_persona = $rs_listadiariox->fields["proveep_id"];
				$crucue_valorpago = $rs_listadiariox->fields["crpadet_valorapagar"];
				$crucue_fecharegistro = $rs_listadiariox->fields["crpadet_fecharegistro"];
				$usua_id = $rs_listadiariox->fields["usua_id"];
				$crudoc_enlace = $codig_unicovalor;


				$inserta_detalle = "INSERT INTO cesdb_arextension.lpin_crucecuentas (crucue_cuenta, crucue_persona, crucue_valorpago, crucue_fecharegistro, usua_id, crudoc_enlace) VALUES ('" . $crucue_cuenta . "','" . $crucue_persona . "','" . $crucue_valorpago . "','" . $crucue_fecharegistro . "','" . $usua_id . "','" . $crudoc_enlace . "')";

				$rs_insdatadeta = $DB_gogess->executec($inserta_detalle, array());

				//echo $inserta_detalle . "<br>============================<br>";



				///creando asientos++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

				/*$lista_pagosas = "select * from lpin_cobropago where crb_enlace='" . $crb_enlace . "'";
				$rs_listadiarioxas = $DB_gogess->executec($lista_pagosas, array());

				$crb_idbu = $rs_listadiarioxas->fields["crb_id"];
				$ttra_idbu = $rs_listadiarioxas->fields["ttra_id"];

				if ($crb_idbu > 0) {
					//==================
					if ($ttra_idbu == 1) {
						///cobro
						include('ejecuta_cobro.php');
						//cobro
					}


					if ($ttra_idbu == 2) {
						///pago

						include('ejecuta_pago.php');

						//pago
					}

					//==================
				}*/




				///creando asientos+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++





				//=======================================================================
			}

			$rs_listadiariox->MoveNext();
		}
	}






	if ($cuenta_hay > 0) {
		echo '<center><b>PROCESADO</b></center><br><br>';
		$lista_pagoscerrar = "update lpin_masivocobropago set crb_procesado=1,crb_fechaprocesado='" . date("Y-m-d H:i:s") . "' where crb_id='" . $crb_id . "'";
		$rs_listadiariocerrar = $DB_gogess->executec($lista_pagoscerrar, array());
?>

		<script type="text/javascript">
			<!--
			$('#btn_ghj').hide();
			$('#btn_ghj1').hide();

			//  End 
			-->
		</script>

<?php
	} else {
		echo '<center><b>ALERTA PARA PROCESAR DEBE AGREGAR REGISTROS EN DOCUMENTOS PARA PAGOS</b></center><br><br>';
	}
}


?>