<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("lib.php");
include ("libreria/nusoap/lib/nusoap.php"); 
$fechahoy=date("Y-m-d");

$fechahoy=date("Y-m-d", strtotime("-30 day"));

//echo $buscafacturas="select * from comprobante_retencion_cab where  (compretcab_estadosri='DEVUELTA' and compretcab_motivodev='') or compretcab_estadosri IN ('RECIBIDA') or compretcab_motivodev like '%ERROR DE CONECCION%' or compretcab_motivodev like '%VALOR DEVUELTO POR EL PROCEDIMIENTO: SI%' and compretcab_fechaemision_cliente>='".$fechahoy."'";

//original
//echo $buscafacturas="select * from comprobante_retencion_cab where  ((compretcab_estadosri='DEVUELTA' and compretcab_motivodev='') or compretcab_estadosri ='RECIBIDA' or (compretcab_estadosri='DEVUELTA' and compretcab_motivodev!='')  ) and compretcab_fechaemision_cliente>='".$fechahoy."'";

//cambio
 $buscafacturas="select * from comprobante_retencion_cab where   compretcab_estadosri ='AUTORIZADO' and (compretcab_fechaemision_cliente>='2017-03-03' and 	compretcab_fechaemision_cliente<='2017-05-03')";


$rs_gogessform = $DB_gogess->Execute($buscafacturas);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		

		
		regresa_sap($DB_gogess,$rs_gogessform->fields["compretcab_tipocomprobante"],$rs_gogessform->fields["compretcab_id"]);
		
		
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>