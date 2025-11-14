<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("libreposesoaccess.php");
include ("libreria/nusoap/lib/nusoap.php"); 
$fechahoy=date("Y-m-d");
$fechahoy=date("Y-m-d", strtotime("-6 day"));

//AQUI LA FECHA ///
$fechahoy="2017-01-01";

$buscafacturas="select * from comprobante_fac_cabecera where  comcab_estadosri = 'AUTORIZADO'  and comcab_fechaemision_cliente>='".$fechahoy."'";

//POR DOCUMENTO
//$buscafacturas="select * from comprobante_fac_cabecera where  comcab_estadosri = 'AUTORIZADO'  and comcab_nfactura='005-003-000101539'";

//echo $buscafacturas;
$rs_gogessform = $DB_gogess->Execute($buscafacturas);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		

	echo "aqui";
		autoriza_sri($DB_gogess,'01',$rs_gogessform->fields["comcab_id"]);
		
		
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>