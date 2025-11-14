<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("lib.php");
include ("libreria/nusoap/lib/nusoap.php"); 
$fechahoy=date("Y-m-d");
$fechahoy='2014-12-26';

$buscafacturas="select * from comprobante_guia_cabecera where compguiacab_estadosri NOT IN ('AUTORIZADO') and compguiacab_fechaemision_cliente>='".$fechahoy."'";


$rs_gogessform = $DB_gogess->Execute($buscafacturas);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		

		
		autoriza_sri($DB_gogess,$rs_gogessform->fields["compguiacab_tipocomprobante"],$rs_gogessform->fields["compguiacab_id"]);
		
		
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>