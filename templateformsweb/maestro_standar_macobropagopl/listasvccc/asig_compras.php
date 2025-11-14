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

	$datos_data = $_POST["datos_data"];
	$crb_id = $_POST["crb_id"];
	$usua_id = $_POST["usua_id"];
	$cuenta = $_POST["cuenta"];
	$detanticm_id = $_POST["detanticm_id"];


	//echo $datos_data;

	$bsuca_data = "select * from lpin_masivocobropago where crb_id='" . $crb_id . "'";
	$rs_budata = $DB_gogess->executec($bsuca_data, array());
	$crb_enlace = $rs_budata->fields["crb_enlace"];
	$crb_fecha = $rs_budata->fields["crb_fecha"];

	$array_data = array();
	$array_data = explode(",", $datos_data);

	for ($i = 0; $i <= count($array_data); $i++) {

		if ($array_data[$i]) {

			$obtiene_arr = array();
			$obtiene_arr = explode("|", $array_data[$i]);

			$iddata = $obtiene_arr[0];
			$valordata = $obtiene_arr[1];

			$crpadet_descripcion = $obtiene_arr[2];

			$saldo_nuevo =  $valordata;

			//GENERA INSERTS
			$ttradet_id = $rs_budata->fields["ttra_id"];
			$compracp_id = '';
			$doccabcp_id = '';
			$crpadet_fechaemision = $crb_fecha;
			$tipdocdet_id = '0';
			$crpadet_valor = 0;
			$crpadet_saldo = 0;
			$crpadet_valorapagar = $valordata;
			$crpadet_fecharegistro = date("Y-m-d H:i:s");
			$crucue_cuentax = $cuenta;
			$proveem_id = $iddata;

			//busca id proveedor
			$proveeve_id = '';
			//busca ide proveedor

			$insert_comp = "insert into lpin_masivocobropagodetalle (ttradet_id,compracp_id,doccabcp_id,crpadet_fechaemision,tipdocdet_id,crpadet_valor,crpadet_saldo,crpadet_valorapagar,crb_enlace,crpadet_fecharegistro,usua_id,proveep_id,crucue_cuentax,proveem_id,detanticm_id,crpadet_descripcion) values ('" . $ttradet_id . "','" . $compracp_id . "','" . $doccabcp_id . "','" . $crpadet_fechaemision . "','" . $tipdocdet_id . "','" . $crpadet_valor . "','" . $crpadet_saldo . "','" . $crpadet_valorapagar . "','" . $crb_enlace . "','" . $crpadet_fecharegistro . "','" . $usua_id . "','" . $proveeve_id . "','" . $crucue_cuentax . "','" . $proveem_id . "','" . $detanticm_id . "','" . $crpadet_descripcion . "')";

			$rs_comp = $DB_gogess->executec($insert_comp, array());
			//echo $insert_comp."<br><br>";	

			//GENERA INSERTS


		}
	}






	echo "<br><br><br><center><b>REGISTROS ENVIADOS A LISTA PARA PROCESAR</b></center>";
}
