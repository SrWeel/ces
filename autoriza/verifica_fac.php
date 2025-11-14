<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("adodb/adodb.inc.php");
include("cfgclases/config.php");
include("lib.php");
include ("libreria/nusoap/lib/nusoap.php"); 
$fechahoy=date("Y-m-d");
$fechahoy=date("Y-m-d", strtotime("-25 day"));
//$fechahoy="2015-02-01";
$buscafacturas="select comcab_nfactura,comcab_xmlfirmado from comprobante_fac_cabecera";

//echo $buscafacturas;
$rs_gogessform = $DB_gogess->Execute($buscafacturas);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		

		
		
		$struct_detail = new SimpleXMLElement(base64_decode($rs_gogessform->fields["comcab_xmlfirmado"]));
		$ndocumento=$struct_detail->infoTributaria->estab->__toString()."-".$struct_detail->infoTributaria->ptoEmi->__toString()."-".$struct_detail->infoTributaria->secuencial->__toString();

		if(trim($rs_gogessform->fields["comcab_nfactura"])!=trim($ndocumento))
		{
      	    echo $ndocumento."<br>";
		}
		else
		{
			//echo $rs_gogessform->fields["comcab_nfactura"]."=".$ndocumento."<br>";
			
		}
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>