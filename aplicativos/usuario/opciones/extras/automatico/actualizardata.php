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

	$director="../../../../../";
include ("../../../../../cfgclases/clases.php"); 
    $buscalotes="select * from factura_listacargados where  listcg_archivo='".$_POST["parchivo"]."'";
	$resultadolktr = $DB_gogess->Execute($buscalotes);
 //echo $resultadolktr->fields["listcg_registrados"]."<BR>";	
    
	//$actualizalotev="update factura_listacargados set listcg_estado='AUTORIZADO' where listcg_archivo='".$_POST["parchivo"]."'";
	//$okv=$DB_gogess->Execute($actualizalotev);
	if( $_POST["opcion"]=='06')
	{
	  $selectarchivos="select distinct count(compguiacab_estado) as totalaut from comprobante_guia_cabecera where compguiacab_archivo='".$_POST["parchivo"]."' and compguiacab_estadosri='AUTORIZADO'";
	 //echo $selectarchivos."<br>";
	 $resultadoUT = $DB_gogess->Execute($selectarchivos);
	}
	
	
	if( $_POST["opcion"]=='04' or $_POST["opcion"]=='05')
	{
	
	 $selectarchivos="select distinct count(comcabcre_estado) as totalaut from comprobante_credito_cab where comcabcre_archivo='".$_POST["parchivo"]."' and comcabcre_estadosri='AUTORIZADO' and comcabcre_tipocomprobante='".$_POST["opcion"]."'";
	 //echo $selectarchivos."<br>";
	 $resultadoUT = $DB_gogess->Execute($selectarchivos);
	 
	}
	
	if( $_POST["opcion"]=='01')
	{
	
	 $selectarchivos="select distinct count(comcab_estado) as totalaut from comprobante_fac_cabecera where comcab_archivo='".$_POST["parchivo"]."' and comcab_estadosri='AUTORIZADO'";
	 //echo $selectarchivos."<br>";
	 $resultadoUT = $DB_gogess->Execute($selectarchivos);
	 
	}
	
	
	if($_POST["opcion"]=='07' )
	{
		
	$selectarchivos="select distinct count(compretcab_estado) as totalaut from comprobante_retencion_cab where compretcab_archivo='".$_POST["parchivo"]."' and compretcab_estadosri='AUTORIZADO'";
	 $resultadoUT = $DB_gogess->Execute($selectarchivos);
		
	}
	  
	 //echo $resultadoUT->fields["totalaut"]."<BR>";	
	 
	 
	 //echo $_POST["opcion"];
	 echo $resultadolktr->fields["listcg_registrados"]."<br>";
	 echo $resultadoUT->fields["totalaut"]."<br>";
	 if($resultadolktr->fields["listcg_registrados"]==$resultadoUT->fields["totalaut"])
	 {
		 
		   $actualizdata="update  factura_listacargados  set listcg_estado='AUTORIZADO' where listcg_archivo='".$_POST["parchivo"]."'";
		   $okactualizo=$DB_gogess->Execute($actualizdata);
		 
	 }

}

?>