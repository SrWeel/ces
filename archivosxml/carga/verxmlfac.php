<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
//header('Content-Type: text/html; charset=UTF-8'); 
$fechahoy=date("Y-m-d");
$tiempossss='541460000';
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='xml')
	{
	///
	    $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			//$$tags[$i]=0;
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();


if($_GET["tipo"]=='07')
{
 $buscalistaarch="select * from comprobante_retencion_cab where compretcab_id='".$xml."'";
$resultadoarch = $DB_gogess->executec($buscalistaarch,array());	
$titulo="RETENCION";
if($resultadoarch->fields["compretcab_xmlfirmado"])
{
$xmldoc=$resultadoarch->fields["compretcab_xmlfirmado"];
}
else
{
$xmldoc=$resultadoarch->fields["compretcab_xml"];

}
$estado=$resultadoarch->fields["compretcab_estadosri"];
$nautorizacion=$resultadoarch->fields["compretcab_nautorizacion"];
$fechaaut=$resultadoarch->fields["compretcab_fechaaut"];


 }

if($_GET["tipo"]=='06')
{
 $buscalistaarch="select * from comprobante_guia_cabecera where compguiacab_id='".$xml."'";
$resultadoarch = $DB_gogess->Execute($buscalistaarch);	
$titulo="GUIA";
if($resultadoarch->fields["compguiacab_xmlfirmado"])
{
$xmldoc=$resultadoarch->fields["compguiacab_xmlfirmado"];
}
else
{
$xmldoc=$resultadoarch->fields["compguiacab_xml"];
}
$estado=$resultadoarch->fields["compguiacab_estadosri"];
$nautorizacion=$resultadoarch->fields["compguiacab_nautorizacion"];
$fechaaut=$resultadoarch->fields["compguiacab_fechaaut"];

 }

if($_GET["tipo"]=='01')
{
 $buscalistaarch="select * from comprobante_fac_cabecera where comcab_id='".$xml."'";
$resultadoarch = $DB_gogess->Execute($buscalistaarch);	
$titulo="FACTURA";
if($resultadoarch->fields["comcab_xmlfirmado"])
{
$xmldoc=$resultadoarch->fields["comcab_xmlfirmado"];
}
else
{
$xmldoc=$resultadoarch->fields["comcab_xml"];
}
$estado=$resultadoarch->fields["comcab_estadosri"];
$nautorizacion=$resultadoarch->fields["comcab_nautorizacion"];
$fechaaut=$resultadoarch->fields["comcab_fechaaut"];

 }
 
 
 
if($_GET["tipo"]=='03')
{
    $buscalistaarch="select * from comprobante_liq_cabecera where comcab_id='".$xml."'";
	$resultadoarch = $DB_gogess->Execute($buscalistaarch);	
	$titulo="LIQUIDACION_".$resultadoarch->fields["comcab_nfactura"];
	if($resultadoarch->fields["comcab_xmlfirmado"])
	{
	$xmldoc=$resultadoarch->fields["comcab_xmlfirmado"];
	}
	else
	{
	$xmldoc=$resultadoarch->fields["comcab_xml"];
	}
	$estado=$resultadoarch->fields["comcab_estadosri"];
	$nautorizacion=$resultadoarch->fields["comcab_nautorizacion"];
	$fechaaut=$resultadoarch->fields["comcab_fechaaut"];

 }
  
 
 
if($_GET["tipo"]=='04' or $_GET["tipo"]=='05')
{
 $buscalistaarch="select * from comprobante_credito_cab where comcabcre_id='".$xml."'";
$resultadoarch = $DB_gogess->Execute($buscalistaarch);	
if($_GET["tipo"]=='04')
{
$titulo="CREDITO";
}
if($_GET["tipo"]=='05')
{
$titulo="DEBITO";
}


if($resultadoarch->fields["comcabcre_xmlfirmado"])
{
$xmldoc=$resultadoarch->fields["comcabcre_xmlfirmado"];
}
else
{
$xmldoc=$resultadoarch->fields["comcabcre_xml"];
}
$estado=$resultadoarch->fields["comcabcre_estadosri"];
$nautorizacion=$resultadoarch->fields["comcabcre_nautorizacion"];
$fechaaut=$resultadoarch->fields["comcabcre_fechaaut"];

 }
 
header("Content-type: application/xml; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$titulo.".xml");

 if($estado=='AUTORIZADO')
 {
$archivostring=base64_decode($compretcab_xmlfirmado);
$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
<autorizacion>
<estado>'.$estado.'</estado>
<numeroAutorizacion>'.$nautorizacion.'</numeroAutorizacion>
<fechaAutorizacion>'.$fechaaut.'</fechaAutorizacion>
<ambiente>PRODUCCION</ambiente>
<comprobante><![CDATA[';

$comprovante_autpie=']]></comprobante>
</autorizacion>';
 }
 echo $comprovante_aut.base64_decode($xmldoc).$comprovante_autpie;


}
?>