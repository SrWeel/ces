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
//genera archivos para envio
$busca_factura="select * from comprobante_fac_cabecera where comcab_id='".$_POST["pcomcab_id"]."'"; 
$rs_buscaid = $DB_gogess->Execute($busca_factura); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $idbuscarenvio=$rs_buscaid->fields["comcab_clavedeaccesos"];
					  
					 $comcab_nombrerazon_cliente=$rs_buscaid->fields["comcab_nombrerazon_cliente"];
					
					 
					 $email_cliente=$rs_buscaid->fields["comcab_email_cliente"];
					 
					 //email extra cliente
					// $buscaclienteemail="select client_emailextra from factur_cliente where client_ciruc='".$rs_buscaid->fields["comcab_rucci_cliente"]."'";
					// $ruclienteval=$DB_gogess->Execute($buscaclienteemail); 
					 $email_extra=$_POST["email_extra"];
					 //email extra cliente
					 
					 $enviado=trim($rs_buscaid->fields["comcab_enviomail"]);
					 $comcab_estadosri=trim($rs_buscaid->fields["comcab_estadosri"]);
					 $comcab_xmlfirmado=trim($rs_buscaid->fields["comcab_xmlfirmado"]);
					 $emp_id=$rs_buscaid->fields["emp_id"];
					 $comcab_nautorizacion=trim($rs_buscaid->fields["comcab_nautorizacion"]);
					 $comcab_fechaaut=trim($rs_buscaid->fields["comcab_fechaaut"]);
					 $estadoarch=$rs_buscaid->fields["comcab_estadosri"];
					  
					  $rs_buscaid->MoveNext();
					  }
				}
echo $estadoarch;
if($estadoarch=='AUTORIZADO')
{
//-----------------------------------------------------


 $datos_empresa="select * from factura_empresa where emp_id=".$emp_id;
						   $rs_empresa = $DB_gogess->Execute($datos_empresa);
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $emp_nombre=$rs_empresa->fields["emp_nombre"];
								  $emp_ruc=$rs_empresa->fields["emp_ruc"];
								  $emp_direccion=$rs_empresa->fields["emp_direccion"];
								  $emp_logo=$rs_empresa->fields["emp_logo"];
								
								
								
								if($emp_logo)
								{
								$logotipo_imd= '<div id=div_logo ><img src="../../../../../archivo/'.$emp_logo.'"  width="180"  /></div>';
								}
								
								 $rs_empresa->MoveNext();
								}	
						   }
				
//genera archivo para enviar

$code_barra= '<img src="../../../../../codigodebarra/fac'.$_POST["pcomcab_id"].".gif".'"   />';
$xml_rest=base64_decode($comcab_xmlfirmado);
$datosxml=leercampos_xml($comcab_xmlfirmado);
$pathextrap="../../../../";
$comprobantepdf=leer_xml(0,$xml_rest,'01',$comcab_nautorizacion,$comcab_fechaaut,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total,$valornograbado,$pathextrap);


$dompdf = new DOMPDF();
//$dompdf->load_html(utf8_encode($condatos));
$dompdf->load_html($comprobantepdf);
$dompdf->render();
//crea archivo
$archivo = "../../../../../temporalfactura/FAC".$_POST["pcomcab_id"].".pdf";
$patharchpdf=$archivo;
$nombrearchpdf="FAC".$_POST["pcomcab_id"].".pdf";

$id = fopen($archivo, 'w+');
$cadena = $dompdf->output();
fwrite($id, $cadena);
fclose($id);


//CREA XML
$archivostring=base64_decode($comcab_xmlfirmado);
$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
<autorizacion>
<estado>'.$estadoarch.'</estado>
<numeroAutorizacion>'.$comcab_nautorizacion.'</numeroAutorizacion>
<fechaAutorizacion>'.$comcab_fechaaut.'</fechaAutorizacion>
<ambiente>'.$datosxml["ambiente"].'</ambiente>
<comprobante><![CDATA[';

$comprovante_autpie=']]></comprobante>
<mensajes/>
</autorizacion>';
$archivoaut=$comprovante_aut.$archivostring.$comprovante_autpie;


$archivo = "../../../../../temporalfactura/FAC".$_POST["pcomcab_id"].".xml";
$patharchxml=$archivo;
$nombrearchxml="FAC".$_POST["pcomcab_id"].".xml";

$id = fopen($archivo, 'w+');
$cadena = $archivoaut;
fwrite($id, $cadena);
fclose($id);

//genera archivos para envio	
	
//enviando email
$archivos[0]["path"]=$patharchpdf;
$archivos[0]["nombre"]=$nombrearchpdf;

$archivos[1]["path"]=$patharchxml;
$archivos[1]["nombre"]=$nombrearchxml;

$texto_valor="Le enviamos su factura electr&oacute;nica.";

echo $email_cliente;
$estado_correo=enviar_correo("SCHRYVER FACTURA ELECTRONICA",$archivos,$email_cliente,$comcab_nombrerazon_cliente,"facturar@excelenteweb.com","SCHRYVER COMPROBANTE ELECTRONICO",$texto_valor,$email_extra,$DB_gogess);

if(!($email_cliente))
{
	echo "El cliente no tiene registrado un correo electr&oacute;nico...";	
}
	
if($estado_correo==1)
{
	$actualizafactur="update comprobante_fac_cabecera set comcab_sello='SI' where comcab_id='".$_POST["pcomcab_id"]."'";
	$okact=$DB_gogess->Execute($actualizafactur);
	
	
	echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000'>Correo: Enviado satisfactoriamente...</div>";
	
	            $fechahoy=date("Y-m-d H:i:s"); 
				if($enviado=='ENVIADO')
				{
				$actualizaemail="update comprobante_fac_cabecera set comcab_enviomail='REENVIADO',comcab_enviomailfecha='".$fechahoy."' where comcab_id='".$_POST["pcomcab_id"]."'";
				}
				else
				{
				$actualizaemail="update comprobante_fac_cabecera set comcab_enviomail='ENVIADO',comcab_enviomailfecha='".$fechahoy."' where comcab_id='".$_POST["pcomcab_id"]."'";
				} 
				$okv=$DB_gogess->Execute($actualizaemail); 
	
	  unlink($patharchpdf);
	  unlink($patharchxml);
	
}
else
{

$actualizaemail="update comprobante_fac_cabecera set comcab_enviomail='NO ENVIADO',comcab_enviomailfecha='".$fechahoy."' where comcab_id='".$_POST["pcomcab_id"]."'";
$okv=$DB_gogess->Execute($actualizaemail); 
}

if($estado_correo==0)
{
	  echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'>Correo:NO Enviado </div>";
	  
	  unlink($patharchpdf);
	  unlink($patharchxml);
}

//-----------------------------------------------------	
}
else
{
echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>Factura no se envio ya que aun no esta autorizada...</b></div>";
}	
	
}
else
{
	
	echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>A caducado la sesi&oacute;n vuelva a ingresar al sistema presione F5</b></div>";
}



?>