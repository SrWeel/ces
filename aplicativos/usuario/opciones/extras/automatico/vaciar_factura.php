<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
include("../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);

if($_SESSION['ces1313777_sessid_inicio'])
{
$formato_pdf=0;
$subindice="_facturas";


$director="../../../../../";
include ("../../../../../cfgclases/clases.php");


 $buscaopcion="select tipocmp_codigo from kyradm_automatico where auto_id=".$_POST["auto_id"]." and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
 $resultado_opcion = $DB_gogess->Execute($buscaopcion);




$banderaencontro='';
//guiass

if($resultado_opcion->fields["tipocmp_codigo"]=='06')
	{
	
		$busca_factura="select * from comprobante_guia_cabecera where compguiacab_id='".$_POST["idfactura"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
		
		//echo $busca_factura;
		
		$rs_buscafactura = $DB_gogess->Execute($busca_factura);
		  if($rs_buscafactura)
				  {
				      while (!$rs_buscafactura->EOF) {
					  
					  if(!(trim($rs_buscafactura->fields["compguiacab_estadosri"])=='AUTORIZADO'))
	                       {
						    $borra_facturaguardad="delete from comprobante_guia_cabecera where compguiacab_id='".$rs_buscafactura->fields["compguiacab_id"]."'";
							$rs_bfactura = $DB_gogess->Execute($borra_facturaguardad);
	
							$borra_facturaguardad="delete from  comprobante_guia_detalle where compguiacab_id='".$rs_buscafactura->fields["compguiacab_id"]."'";
							$rs_bfactura = $DB_gogess->Execute($borra_facturaguardad);
						   }
						   
					  
					  
					   $rs_buscafactura->MoveNext();
					  }
					  
				}	  
	
	
	}


//guiass
if($resultado_opcion->fields["tipocmp_codigo"]=='04' or $resultado_opcion->fields["tipocmp_codigo"]=='05' )
	{
	
		$busca_factura="select * from comprobante_credito_cab where comcabcre_tipocomprobante='".$resultado_opcion->fields["tipocmp_codigo"]."' and comcabcre_id='".$_POST["idfactura"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
		echo $busca_factura;
		$rs_buscafactura = $DB_gogess->Execute($busca_factura);
		  if($rs_buscafactura)
				  {
				      while (!$rs_buscafactura->EOF) {
					  
					  if(!(trim($rs_buscafactura->fields["comcabcre_estadosri"])=='AUTORIZADO'))
	                       {
						    $borra_facturaguardad="delete from comprobante_credito_cab where comcabcre_id='".$rs_buscafactura->fields["comcabcre_id"]."'";
							$rs_bfactura = $DB_gogess->Execute($borra_facturaguardad);
	
							$borra_facturaguardad="delete from  comprobante_credito_detalle where comcabcre_id='".$rs_buscafactura->fields["comcabcre_id"]."'";
							$rs_bfactura = $DB_gogess->Execute($borra_facturaguardad);
						   }
						   
					  
					  
					   $rs_buscafactura->MoveNext();
					  }
					  
				}	  
	

	}



if($resultado_opcion->fields["tipocmp_codigo"]=='01')
	{
		
		$busca_factura="select * from comprobante_fac_cabecera where comcab_id='".$_POST["idfactura"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
		
		$rs_buscafactura = $DB_gogess->Execute($busca_factura);
		  if($rs_buscafactura)
				  {
				      while (!$rs_buscafactura->EOF) {
					  
					  if(!(trim($rs_buscafactura->fields["comcab_estadosri"])=='AUTORIZADO'))
	                       {
						    $borra_facturaguardad="delete from comprobante_fac_cabecera where comcab_id='".$rs_buscafactura->fields["comcab_id"]."'";
							$rs_bfactura = $DB_gogess->Execute($borra_facturaguardad);
	
							$borra_facturaguardad="delete from  comprobante_fac_detalle where comcab_id='".$rs_buscafactura->fields["comcab_id"]."'";
							$rs_bfactura = $DB_gogess->Execute($borra_facturaguardad);
						   }
						   
					  
					  
					   $rs_buscafactura->MoveNext();
					  }
					  
				}	  
	
	
	
       ///
	}
	
	echo "Opcion:".$resultado_opcion->fields["tipocmp_codigo"];
	
if($resultado_opcion->fields["tipocmp_codigo"]=='07' )
	{
	
	
	$busca_factura="select * from  comprobante_retencion_cab where compretcab_id='".$_POST["idfactura"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
		$rs_buscafactura = $DB_gogess->Execute($busca_factura);
		  if($rs_buscafactura)
				  {
				      while (!$rs_buscafactura->EOF) {
					  
					  if(!(trim($rs_buscafactura->fields["compretcab_estadosri"])=='AUTORIZADO'))
	                       {
						    $borra_facturaguardad="delete from  comprobante_retencion_cab where compretcab_id='".$rs_buscafactura->fields["compretcab_id"]."'";
							$rs_bfactura = $DB_gogess->Execute($borra_facturaguardad);
	
							$borra_facturaguardad="delete from  comprobante_retencion_detalle where compretcab_id='".$rs_buscafactura->fields["compretcab_id"]."'";
							$rs_bfactura = $DB_gogess->Execute($borra_facturaguardad);
						   }
						   
					  
					  
					   $rs_buscafactura->MoveNext();
					  }
					  
				}	
		
		

	
		
	}
	
	


}
else
{

 echo '<div style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
}

?>

	 