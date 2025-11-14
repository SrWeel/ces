<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
$numero = count($_GET);
$tags = array_keys($_GET); // obtiene los nombres de las varibles
$valores = array_values($_GET); // obtiene los valores de las varibles

for ($i = 0; $i < $numero; $i++) {
	///
	if ($tags[$i] == 'xml') {
		///
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget = '';
			$nombrevarget = $tags[$i];
			$$nombrevarget = $valores[$i];
		} else {
			//$$tags[$i]=0;	
			$nombrevarget = '';
			$nombrevarget = $tags[$i];
			$$nombrevarget = 0;
		}
		///
	}
	///
}

$compra_id = $_POST["compra_id"];

$director = '../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");

include("lib.php");
include("lib/nusoap.php");
include("configcentro2.php");

$link_envio = "https://cel.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl";
$debug = 1;

//envia documento

function envia_documentos($tipocmp_tabla, $tipocmp_campofirmado, $tipocmp_sinfirma, $tipocmp_campoxmlfirmado, $tipocmp_campoid, $tipocmp_estadosri, $tipocmp_motivodev, $tipocmp_codigo, $link_envio, $debug, $valcentro, $tipocmp_campofecha, $compra_id, $DB_gogess)
{



	$fechah = date('Y-m-d');
	$nuevaFechah = date("Y-m-d", strtotime('-1 day', strtotime($fechah)));

	$lista_fac = "select * from " . $tipocmp_tabla . " where " . $tipocmp_campofirmado . "='SI' and (" . $tipocmp_estadosri . "='' or " . $tipocmp_estadosri . " not in('RECIBIDA','AUTORIZADO','NO AUTORIZADO')) and compra_anulado=0 and compra_id='" . $compra_id . "' limit 1 ";

	//and doccab_ndocumento='012-002-000208399'
	//echo $tipocmp_tabla."<br>";
	//echo $lista_fac."<br>";
	//$lista_fac='';
	//echo $tipocmp_codigo."<br>";
	$resultlist_fac = $DB_gogess->executec($lista_fac);

	if ($resultlist_fac) {

		while (!$resultlist_fac->EOF) {

			//$doc['xml']=$_POST["xml"];
			$documento = $tipocmp_codigo;
			$id_documento = $resultlist_fac->fields[$tipocmp_campoid];
			echo "<br>==========================<br>" . $id_documento . "<br>==========================<br>";
			//funcion envia SRI
			envia_sri($DB_gogess, $documento, $id_documento, $link_envio, $debug);
			echo "<br><br>";
			// echo '<meta http-equiv="Refresh" content="3" />';

			$resultlist_fac->MoveNext();
		}
	}

	//===============================================================================

}

//envia documento





//verfica el tipo de documento
$busca_tipox = "select * from dns_compras where compra_id='" . $compra_id . "'";
$resultlist_butipox = $DB_gogess->executec($busca_tipox);
$tipdoc_id = $resultlist_butipox->fields["tipdoc_id"];
//verfica el tipo de documento

if ($tipdoc_id == '19') {
	$lista_documentos = "select * from beko_tipocomprobante where tipocmp_id=8";
}

//echo $lista_documentos;

$resultlist_ldocumentos = $DB_gogess->executec($lista_documentos);
if ($resultlist_ldocumentos) {

	while (!$resultlist_ldocumentos->EOF) {



		$tipocmp_tabla = $resultlist_ldocumentos->fields["tipocmp_tabla"];
		$tipocmp_campofirmado = $resultlist_ldocumentos->fields["tipocmp_campofirmado"];
		$tipocmp_campoxmlfirmado = $resultlist_ldocumentos->fields["tipocmp_campoxmlfirmado"];
		$tipocmp_campoid = $resultlist_ldocumentos->fields["tipocmp_campoid"];
		$tipocmp_sinfirma = $resultlist_ldocumentos->fields["tipocmp_sinfirma"];
		$tipocmp_estadosri = $resultlist_ldocumentos->fields["tipocmp_estadosri"];
		$tipocmp_motivodev = $resultlist_ldocumentos->fields["tipocmp_motivodev"];
		$tipocmp_codigo = $resultlist_ldocumentos->fields["tipocmp_codigo"];
		$tipocmp_campofecha = $resultlist_ldocumentos->fields["tipocmp_campofecha"];



		envia_documentos($tipocmp_tabla, $tipocmp_campofirmado, $tipocmp_sinfirma, $tipocmp_campoxmlfirmado, $tipocmp_campoid, $tipocmp_estadosri, $tipocmp_motivodev, $tipocmp_codigo, $link_envio, $debug, $valcentro, $tipocmp_campofecha, $compra_id, $DB_gogess);







		$resultlist_ldocumentos->MoveNext();
	}
}
