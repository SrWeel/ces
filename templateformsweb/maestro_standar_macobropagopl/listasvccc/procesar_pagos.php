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
$objformulario = new  ValidacionesFormulario();

if (@$_SESSION['ces1313777_sessid_inicio']) {
	$crb_id = $_POST["crb_id"];

	$cuenta_hay = 0;

	$lista_pagos = "select * from lpin_masivocobropago inner join lpin_masivocobropagodetalle on lpin_masivocobropago.crb_enlace=lpin_masivocobropagodetalle.crb_enlace where crb_id='" . $crb_id . "' and crucue_cuentax!=''";

	$rs_listadiariox = $DB_gogess->executec($lista_pagos, array());
	if ($rs_listadiariox) {
		while (!$rs_listadiariox->EOF) {

			$cuenta_hay++;
			
			$ttra_id=$rs_listadiariox->fields["ttra_id"];
			$proveem_id=$rs_listadiariox->fields["proveem_id"];
			$cuentb_id=$rs_listadiariox->fields["cuentb_id"];
			
			$nombre_proveedor='';
			$nombre_proveedor=$objformulario->replace_cmb("app_proveedor","provee_id,provee_nombre","where provee_id=",$proveem_id,$DB_gogess);
			
			if($ttra_id==1)
			{
			//cobro
			  $movantic_id=1;
			}


            if($ttra_id==2)
			{
			//pago
			  $movantic_id=2;
			}
			
			$busca_cb="select distinct cuentb_id,entif_nombre,cuentb_cuentacontable from lpin_cuentasbancarias_vista where cuentb_id='".$cuentb_id."'";
			$rs_cb = $DB_gogess->executec($busca_cb, array());
			
			$cuentb_cuentacontable=$rs_cb->fields["cuentb_cuentacontable"];

			$busca_registrado = "select * from app_anticipos where crpadetmasivo_id='" . $rs_listadiariox->fields["crpadet_id"] . "'";
			$rs_bureg = $DB_gogess->executec($busca_registrado, array());

			if ($rs_bureg->fields["anti_id"] > 0) {
				echo "Ya fue procesado...<br>";
			} else {
				//=======================================================================


				///cabecera documentos
				
//********************
	$emp_id=0;
	$centro_id=0;
	$proveeanti_id=$proveem_id;
	$tipop_id=$rs_listadiariox->fields["ttra_id"];		
	$detantic_id=$rs_listadiariox->fields["detanticm_id"];
	$anti_fechaemision=$rs_listadiariox->fields["crb_fecha"];
	$anti_ctabancaria=$cuentb_cuentacontable;
	$anti_ordenpago=$nombre_proveedor;
	$anti_cheque=$rs_listadiariox->fields["crb_ncheque"];
	$anti_fechacheque=$rs_listadiariox->fields["crb_fechacheque"];
	$anti_descripcion=$rs_listadiariox->fields["crb_descripcion"];
	$anti_comprobante=str_replace("'","",$rs_listadiariox->fields["crb_ncomprobante"]);
	$anti_ctacobro='';
	$anti_lote='';
	$usua_id=$rs_listadiariox->fields["usua_id"];
	$anti_fecharegistro=$rs_listadiariox->fields["crb_fecharegistro"];
	
	$crpadetmasivo_id=$rs_listadiariox->fields["crpadet_id"];
	
	 $codig_unicovalor='';
	 $unico_number='';
	 $unico_number=strtoupper(uniqid());			
	 $codig_unicovalor=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;
	
	$anti_enlace=$codig_unicovalor;

$inserta_data ="INSERT INTO app_anticipos ( emp_id, centro_id, proveeanti_id, tipop_id, movantic_id, detantic_id, anti_fechaemision, anti_ctabancaria, anti_ordenpago, anti_cheque, anti_fechacheque, anti_descripcion, anti_comprobante, anti_ctacobro, anti_lote, usua_id, anti_fecharegistro, anti_enlace,crpadetmasivo_id) VALUES
('".$emp_id."','".$centro_id."','".$proveeanti_id."','".$tipop_id."','".$movantic_id."','".$detantic_id."','".$anti_fechaemision."','".$anti_ctabancaria."','".$anti_ordenpago."','".$anti_cheque."','".$anti_fechacheque."','".$anti_descripcion."','".$anti_comprobante."','".$anti_ctacobro."','".$anti_lote."','".$usua_id."','".$anti_fecharegistro."','".$anti_enlace."','".$crpadetmasivo_id."');";

$rs_insdata = $DB_gogess->executec($inserta_data, array());


$plancant_id=$rs_listadiariox->fields["crucue_cuentax"];
$movanti_monto=$rs_listadiariox->fields["crpadet_valorapagar"];
$centcostant_id=0;
$usua_id=$rs_listadiariox->fields["usua_id"];
$movanti_fecharegistro=$rs_listadiariox->fields["crpadet_fecharegistro"];


$inserta_detalle = "INSERT INTO lpin_movanticipos (anti_enlace, plancant_id, movanti_monto, centcostant_id, usua_id, movanti_fecharegistro) VALUES
('".$anti_enlace."','".$plancant_id."','".$movanti_monto."','".$centcostant_id."','".$usua_id."','".$movanti_fecharegistro."');";

$rs_insdatadeta = $DB_gogess->executec($inserta_detalle, array());
//echo $inserta_detalle . "<br>============================<br>";

//********************
	
				///creando asientos++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

				$lista_pagosas = "select * from app_anticipos where anti_enlace='" . $anti_enlace . "'";
				$rs_listadiarioxas = $DB_gogess->executec($lista_pagosas, array());

				$anti_idbu = $rs_listadiarioxas->fields["anti_id"];
				$ttra_idbu = $rs_listadiarioxas->fields["ttra_id"];
				
				include('ejecuta_anticipobanco.php');

		
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
		echo '<center><b>ALERTA PARA PROCESAR DEBE AGREGAR REGISTROS EN DOCUMENTOS ... O NO SELECCIONO CUENTA EN DETALLES</b></center><br><br>';
	}
}


?>