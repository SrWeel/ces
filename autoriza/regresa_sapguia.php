<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("lib.php");
include ("libreria/nusoap/lib/nusoap.php"); 
$fechahoy=date("Y-m-d");
$fechahoy=date("Y-m-d", strtotime("-121 day"));


//$buscafacturas="select * from comprobante_guia_cabecera where (compguiacab_estadosri='DEVUELTA' and compguiacab_motivodev='') or compguiacab_estadosri IN ('RECIBIDA') or compguiacab_motivodev like '%ERROR DE CONECCION%' or compguiacab_motivodev  like '%VALOR DEVUELTO POR EL PROCEDIMIENTO: SI%' and compguiacab_fechaemision_cliente>='".$fechahoy."'";

//ORIGINAL
//$buscafacturas="select * from comprobante_guia_cabecera where ((compguiacab_estadosri='DEVUELTA' and compguiacab_motivodev='') or compguiacab_estadosri ='RECIBIDA' or (compguiacab_estadosri='DEVUELTA' and  compguiacab_motivodev !='') ) and compguiacab_fechaemision_cliente>='".$fechahoy."'";

//CAMBIO
$buscafacturas="select * from comprobante_guia_cabecera where compguiacab_estadosri ='AUTORIZADO' and(compguiacab_fechaemision_cliente>='2017-03-03' and compguiacab_fechaemision_cliente<='2017-05-03')";


$rs_gogessform = $DB_gogess->Execute($buscafacturas);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		

		
		regresa_sap($DB_gogess,$rs_gogessform->fields["compguiacab_tipocomprobante"],$rs_gogessform->fields["compguiacab_id"]);
		
		
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>