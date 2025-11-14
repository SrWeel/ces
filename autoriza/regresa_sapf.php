<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("lib.php");
include ("libreria/nusoap/lib/nusoap.php"); 
//$fechahoy=date("Y-m-d");
$fechahoy=date("Y-m-d", strtotime("-10 day"));

//$buscafacturas="select * from comprobante_fac_cabecera where (comcab_estadosri='DEVUELTA' and comcab_motivodev='') or comcab_estadosri IN ('RECIBIDA') or comcab_motivodev like '%ERROR DE CONECCION%' or comcab_motivodev like '%VALOR DEVUELTO POR EL PROCEDIMIENTO: SI%'  and comcab_fechaemision_cliente>='".$fechahoy."'";

//orgiginal
//echo $buscafacturas="select * from comprobante_fac_cabecera where ((comcab_estadosri='DEVUELTA' and comcab_motivodev='') or comcab_estadosri='RECIBIDA' or (comcab_estadosri='DEVUELTA' and  comcab_motivodev !=''))  and comcab_fechaemision_cliente>='".$fechahoy."'";

//Cambio 
//echo $buscafacturas="select * from comprobante_fac_cabecera where comcab_estadosri='RECIBIDA'  and comcab_fechaemision_cliente>='".$fechahoy."'";
 $buscafacturas="select * from comprobante_fac_cabecera where comcab_estadosri='AUTORIZADO'  and (comcab_fechaemision_cliente>='2017-03-03' and comcab_fechaemision_cliente<='2017-05-03')";


//echo $buscafacturas;
$rs_gogessform = $DB_gogess->Execute($buscafacturas);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		

		
		regresa_sap($DB_gogess,'01',$rs_gogessform->fields["comcab_id"]);
		
		
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>