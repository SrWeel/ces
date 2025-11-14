<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director="../../../../../";
include ("../../../../../cfgclases/clases.php");
require_once("../../../../../PHPMailer_v51/class.phpmailer.php");
require_once("../../../../../PHPMailer_v51/class.smtp.php");
include("../../../../../config_email_phpmailer.php");
 
if(isset($_SESSION['ces1313777_sessid_inicio']))
{
	
	
	$buscaarchivo="select * from factur_sretencion_cab where id_sretcab='".$_POST["pid_sretcab"]."'";
    $rs_buscaid = $DB_gogess->Execute($buscaarchivo); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $narchivo=$rs_buscaid->fields["id_sretcab"];
					  $estadoarch=$rs_buscaid->fields["srete_estadosri"];
					  
					  $srete_fechaaut=$rs_buscaid->fields["srete_fechaaut"];
					  $srete_nautorizacion=$rs_buscaid->fields["srete_nautorizacion"];
					  $srete_sello=$rs_buscaid->fields["srete_sello"];
					  
					  $srete_nombrerazon_cliente=$rs_buscaid->fields["srete_nombrerazon_cliente"];
					  $email_cliente=$rs_buscaid->fields["srete_email_cliente"];
					  
					  
					  //email extra cliente
					$buscaclienteemail="select prov_emailextra from factur_proveedor where prov_ciruc='".$rs_buscaid->fields["srete_rucci_cliente"]."'";
					$ruclienteval=$DB_gogess->Execute($buscaclienteemail); 
					$email_extra=$_POST["email_extra"];
					 //email extra cliente
					  
					  
					  $enviado=trim($rs_buscaid->fields["srete_enviomail"]);
					  $id_empresa=$rs_buscaid->fields["id_empresa"];
					  $srete_xmlfirmado=trim($rs_buscaid->fields["srete_xmlfirmado"]);
					   $srete_tipocomprobante=$rs_buscaid->fields["srete_tipocomprobante"];
					 					
					  $rs_buscaid->MoveNext();
					  }
				}	  
				
		//datos de la empresa
	$datos_empresa="select * from factur_empresa where id_empresa=".$id_empresa;
						   $rs_empresa = $DB_gogess->Execute($datos_empresa);
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $dat_razon_social=$rs_empresa->fields["dat_razon_social"];
								  $dat_ruc=$rs_empresa->fields["dat_ruc"];
								  $dat_direccion=$rs_empresa->fields["dat_direccion"];
								  $dat_logo=$rs_empresa->fields["dat_logo"];
								
								
								
								if($dat_logo)
								{
								$logotipo_imd= '<div id=div_logo ><img src="../../../../../archivo/'.$dat_logo.'"  width="180"  /></div>';
								}
								
								 $rs_empresa->MoveNext();
								}	
						   }
	//datos de la empresa	
			
			
			$texto_valor="Le enviamos su retenci&oacute;n electr&oacute;nica.";
	$SUBINDICE="RET";
	$TITULOEMAIL="RETENCION";
	$code_barra= '<img src="../../../../../imgbarra/nsret'.$_POST["pid_sretcab"].".gif".'"   />';
	
	
	$xml_rest=base64_decode($srete_xmlfirmado);
	$datosxml=leercampos_xml($srete_xmlfirmado);
	

	$pathextrap="../../../../";
	//echo  $srete_tipocomprobante;
	$comprobantepdf=leer_xml(0,$xml_rest,$srete_tipocomprobante,$srete_nautorizacion,$srete_fechaaut,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total,$valornograbado,$pathextrap);
  


$dompdf = new DOMPDF();
//$dompdf->load_html(utf8_encode($condatos));
$dompdf->load_html($comprobantepdf);
$dompdf->render();
//crea archivo
$archivo = "../../../../../tmpmail/".$SUBINDICE.$_POST["pid_sretcab"].".pdf";
$patharchpdf=$archivo;
$nombrearchpdf=$SUBINDICE.$_POST["pid_sretcab"].".pdf";


$id = fopen($archivo, 'w+');
$cadena = $dompdf->output();
fwrite($id, $cadena);
fclose($id);


//CREA XML
$archivostring=base64_decode($srete_xmlfirmado);
$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
<autorizacion>
<estado>'.$estadoarch.'</estado>
<numeroAutorizacion>'.$srete_nautorizacion.'</numeroAutorizacion>
<fechaAutorizacion>'.$srete_fechaaut.'</fechaAutorizacion>
<ambiente>'.$datosxml["ambiente"].'</ambiente>
<comprobante><![CDATA[';

$comprovante_autpie=']]></comprobante>
<mensajes/>
</autorizacion>';
$archivoaut=$comprovante_aut.$archivostring.$comprovante_autpie;


$archivo = "../../../../../tmpmail/".$SUBINDICE.$_POST["pid_sretcab"].".xml";
$patharchxml=$archivo;
$nombrearchxml=$SUBINDICE.$_POST["pid_sretcab"].".xml";

$id = fopen($archivo, 'w+');
$cadena = $archivoaut;
fwrite($id, $cadena);
fclose($id);
	
	
	//enviando email
$archivos[0]["path"]=$patharchpdf;
$archivos[0]["nombre"]=$nombrearchpdf;

$archivos[1]["path"]=$patharchxml;
$archivos[1]["nombre"]=$nombrearchxml;


$estado_correo=enviar_correo($TITULOEMAIL,$archivos,$email_cliente,$srete_nombrerazon_cliente,"facturar@excelenteweb.com","COMPROBANTE ELECTRONICO",$texto_valor,$email_extra,$DB_gogess);
	
	
if($estado_correo==1)
{
	$actualizafactur="update factur_sretencion_cab set srete_sello='SI' where id_sretcab='".$_POST["pid_sretcab"]."'";
	$okact=$DB_gogess->Execute($actualizafactur);
	
	
	echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000'>Correo: Enviado satisfactoriamente...</div>";
	
	            $fechahoy=date("Y-m-d H:i:s"); 
				if($enviado=='ENVIADO')
				{
				$actualizaemail="update factur_sretencion_cab set srete_enviomail='REENVIADO',srete_enviomailfecha='".$fechahoy."' where id_sretcab='".$_POST["pid_sretcab"]."'";
				}
				else
				{
				$actualizaemail="update factur_sretencion_cab set srete_enviomail='ENVIADO',srete_enviomailfecha='".$fechahoy."' where id_sretcab='".$_POST["pid_sretcab"]."'";
				} 
				$okv=$DB_gogess->Execute($actualizaemail); 
	
	  unlink($patharchpdf);
	  unlink($patharchxml);
	
}
if($estado_correo==0)
{
	  echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'>Correo:NO Enviado </div>";
	  
	  unlink($patharchpdf);
	  unlink($patharchxml);
}
	
	
	
	

}
else
{
	
	echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>A caducado la sesi&oacute;n vuelva a ingresar al sistema presione F5</b></div>";
}
?>