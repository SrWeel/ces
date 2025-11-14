<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("lib.php");
include ("libreria/nusoap/lib/nusoap.php"); 
$fechahoy=date("Y-m-d");
$fechahoy='2014-12-26';
$fechahoy=date("Y-m-d", strtotime("-30 day"));
echo $buscafacturas="select * from comprobante_retencion_cab where compretcab_estadosri != 'AUTORIZADO' and compretcab_fechaemision_cliente>='".$fechahoy."'";


$rs_gogessform = $DB_gogess->Execute($buscafacturas);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		
//echo $rs_gogessform->fields["compretcab_tipocomprobante"];
		$auto_offline=0;
		$auto_offline=$rs_gogessform->fields["compretcab_offline"];
		//envia_sri($DB_gogess,$rs_gogessform->fields["compretcab_tipocomprobante"],$rs_gogessform->fields["compretcab_id"]);
		
		if($auto_offline==1)
		{
		
		envia_srioffline($DB_gogess,$rs_gogessform->fields["compretcab_tipocomprobante"],$rs_gogessform->fields["compretcab_id"]);
		}
		else
		{
		envia_sri($DB_gogess,$rs_gogessform->fields["compretcab_tipocomprobante"],$rs_gogessform->fields["compretcab_id"]);
		}
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>