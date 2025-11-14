<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("lib.php");
include ("libreria/nusoap/lib/nusoap.php"); 
$fechahoy=date("Y-m-d");
$fechahoy=date("Y-m-d", strtotime("-30 day"));
//$fechahoy='2014-12-26';

//$buscafacturas="select * from comprobante_credito_cab where  (comcabcre_estadosri='DEVUELTA' and comcabcre_motivodev='') or comcabcre_estadosri IN ('RECIBIDA') or comcabcre_motivodev like '%ERROR DE CONECCION%' or comcabcre_motivodev  like '%VALOR DEVUELTO POR EL PROCEDIMIENTO: SI%' and comcabcre_fechaemision_cliente>='".$fechahoy."'";
//ORIGINAL
//$buscafacturas="select * from comprobante_credito_cab where  ((comcabcre_estadosri='DEVUELTA' and comcabcre_motivodev='') or comcabcre_estadosri ='RECIBIDA' or (comcabcre_estadosri='DEVUELTA' and comcabcre_motivodev!='')) and comcabcre_fechaemision_cliente>='".$fechahoy."'";

//CAMBIO
 $buscafacturas="select * from comprobante_credito_cab where   comcabcre_estadosri ='AUTORIZADO'  and (comcabcre_fechaemision_cliente>='2017-03-03' and comcabcre_fechaemision_cliente<='2017-05-03')"; 
//comcabcre_fechaemision_cliente>='".$fechahoy."'";
$rs_gogessform = $DB_gogess->Execute($buscafacturas);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		

		
		regresa_sap($DB_gogess,$rs_gogessform->fields["comcabcre_tipocomprobante"],$rs_gogessform->fields["comcabcre_id"]);
		
		
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>