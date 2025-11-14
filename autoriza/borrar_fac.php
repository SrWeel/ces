<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("lib.php");
include ("libreria/nusoap/lib/nusoap.php"); 
$fechahoy=date("Y-m-d");
$fechahoy=date("Y-m-d", strtotime("-40 day"));

$buscafacturas="select * from comprobante_fac_cabecera where (comcab_estadosri ='NO AUTORIZADO')";

//echo $buscafacturas;
$rs_gogessform = $DB_gogess->Execute($buscafacturas);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		

		
		$borrra_data="delete from comprobante_fac_cabecera where comcab_id='".$rs_gogessform->fields["comcab_id"]."'";
		$borrra_datadet="delete from comprobante_fac_detalle where comcab_id='".$rs_gogessform->fields["comcab_id"]."'";
		$okb=$DB_gogess->Execute($borrra_data);
		$okb=$DB_gogess->Execute($borrra_datadet);
		
		
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>