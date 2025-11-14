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


 $buscaopcion="select tipocmp_codigo from kyradm_automatico where auto_id=".$_POST["pauto_id"]." and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
 $resultado_opcion = $DB_gogess->Execute($buscaopcion);


$buscarlote="select * from factura_listacargados where listcg_archivo='".$_POST["parchivo"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
$rs_loteb = $DB_gogess->Execute($buscarlote);
if($rs_loteb->fields["listcg_sriautorizado"]=='SI')
{

 echo '<div style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Lote no puede ser borrado este ya fue autorizado...</div>';
 
}
else
{




function agregar_dv($_rol) {
    /* Remuevo los ceros del comienzo. */
    while($_rol[0] == "0") {
        $_rol = substr($_rol, 1);
    }
    $factor = 2;
    $suma = 0;
    for($i = strlen($_rol) - 1; $i >= 0; $i--) {
        $suma += $factor * $_rol[$i];
        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
    }
    $dv = 11 - $suma % 11;
    /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
    $dv = $dv == 11 ? 0 : ($dv == 10 ? "1" : $dv);
    return $dv;
}

function randomString($length = 10, $letters = NULL){
    //Si no nos especifican lo contrario usaremos un conjunto de letras por defecto
    if(!isset($letters) || strlen($letters) == 0){
        $letters = "1234567890"; //Por defecto usaremos todas estas letras
    }
    
    $str = ''; //Cadena resultante
    $max = strlen($letters)-1;
    
    for($i=0; $i<$length; $i++){
        $str .= $letters[rand(0,$max)]; //Hasta que tengamos $length caracteres agregamos una letra al hazar del conjunto $letters
    }
    
    return $str;
}



$banderaencontro='';
//guiass

if($resultado_opcion->fields["tipocmp_codigo"]=='06')
	{
		///
	if($_POST["parchivo"])
	{
		$busca_factura="select * from comprobante_guia_cabecera where compguiacab_archivo='".$_POST["parchivo"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
		
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
	
	
	
	$borralotereg="delete from factura_listacargados where listcg_archivo='".$_POST["parchivo"]."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
	$rs_blotereg = $DB_gogess->Execute($borralotereg);
	
	$borralotereg="delete from factura_detallista where listcgd_archivobase='".$_POST["parchivo"]."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
	$rs_blotereg = $DB_gogess->Execute($borralotereg);
	}
       ///
	}


//guiass
if($resultado_opcion->fields["tipocmp_codigo"]=='04' or $resultado_opcion->fields["tipocmp_codigo"]=='05' )
	{
		///
	if($_POST["parchivo"])
	{
		$busca_factura="select * from comprobante_credito_cab where comcabcre_tipocomprobante='".$resultado_opcion->fields["tipocmp_codigo"]."' and comcabcre_archivo='".$_POST["parchivo"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
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
	
	
	
	$borralotereg="delete from factura_listacargados where listcg_archivo='".$_POST["parchivo"]."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
	$rs_blotereg = $DB_gogess->Execute($borralotereg);
	
	$borralotereg="delete from factura_detallista where listcgd_archivobase='".$_POST["parchivo"]."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
	$rs_blotereg = $DB_gogess->Execute($borralotereg);
	}
       ///
	}



if($resultado_opcion->fields["tipocmp_codigo"]=='01')
	{
		echo $_POST["parchivo"];
		///
	if($_POST["parchivo"])
	{
		$busca_factura="select * from comprobante_fac_cabecera where comcab_archivo='".$_POST["parchivo"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
		//echo $busca_factura;
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
	
	
	
	$borralotereg="delete from factura_listacargados where listcg_archivo='".$_POST["parchivo"]."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
	$rs_blotereg = $DB_gogess->Execute($borralotereg);
	
	$borralotereg="delete from factura_detallista where listcgd_archivobase='".$_POST["parchivo"]."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
	$rs_blotereg = $DB_gogess->Execute($borralotereg);
	}
       ///
	}
	
	echo "Opcion:".$resultado_opcion->fields["tipocmp_codigo"];
	
if($resultado_opcion->fields["tipocmp_codigo"]=='07' )
	{
	if($_POST["parchivo"])
	{
	
	
	$busca_factura="select * from  comprobante_retencion_cab where compretcab_archivo='".$_POST["parchivo"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
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
		
		
		
		
	$borralotereg="delete from factura_listacargados where listcg_archivo='".$_POST["parchivo"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
	$rs_blotereg = $DB_gogess->Execute($borralotereg);
	
	$borralotereg="delete from factura_detallista where listcgd_archivobase='".$_POST["parchivo"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
	$rs_blotereg = $DB_gogess->Execute($borralotereg);
	}

	
		
	}
	
	
	

}

}
else
{

 echo '<div style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
}

?>

	 