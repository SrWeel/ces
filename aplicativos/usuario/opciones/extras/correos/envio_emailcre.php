<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director="../../../../../";
 include ("../../../../../cfgclases/clases.php"); 
 
 function leer_contenido_completo($url){
 if (file_exists($url))
						{
   //abrimos el fichero, puede ser de texto o una URL
   $fichero_url = fopen ($url, "r");
   $texto = "";
   //bucle para ir recibiendo todo el contenido del fichero en bloques de 1024 bytes
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   return $texto;
   }
} 

function generar_datoautorizado($comcabcre_id,$patch,$ambiente,$DB_gogess)
{

$buscaarchivo="select * from comprobante_credito_cab where comcabcre_id='".$comcabcre_id."'";

$rs_buscaid = $DB_gogess->Execute($buscaarchivo); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $narchivo=$rs_buscaid->fields["comcabcre_id"];
					  $estadoarch=$rs_buscaid->fields["comcabcre_estadosri"];
					  
					  $comcabcre_fechaaut=$rs_buscaid->fields["comcabcre_fechaaut"];
					  $comcabcre_nautorizacion=$rs_buscaid->fields["comcabcre_nautorizacion"];
					  $comcabcre_sello=$rs_buscaid->fields["comcabcre_sello"];
					  $comcabcre_tipocomprobante=$rs_buscaid->fields["comcabcre_tipocomprobante"];
					  
					 					
					  $rs_buscaid->MoveNext();
					  }
				}	  
				
		
	
	if($comcabcre_sello!='SI')
	{
$archivostring=leer_contenido_completo($patch.$narchivo.".xml");	
				
$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
<autorizacion>
<estado>'.$estadoarch.'</estado>
<numeroAutorizacion>'.$comcabcre_nautorizacion.'</numeroAutorizacion>
<fechaAutorizacion>'.$comcabcre_fechaaut.'</fechaAutorizacion>
<ambiente>'.$ambiente.'</ambiente>
<comprobante><![CDATA[';



$comprovante_autpie=']]></comprobante>
<mensajes/>
</autorizacion>';
$archivoaut=$comprovante_aut.$archivostring.$comprovante_autpie;


$archivo=$patch.$narchivo.".xml";
$id = fopen($archivo, 'w+');

fwrite($id,$archivoaut);
fclose($id);

       
        $actualizafactur="update comprobante_credito_cab set comcabcre_sello='SI' where comcabcre_id='".$comcabcre_id."'";
		 //echo $actualizafactur."<br>";
		 $okact=$DB_gogess->Execute($actualizafactur);
		
		 if($okact)
		 {
		 return 1;
		 }
		 else
		 {
		  return 0;
		 }
		
	 
	 }
	 else
	 {
	 return 1;
	 
	 }
	

}



if(isset($_SESSION['ces1313777_sessid_inicio']))
{

 
require_once("../../../../../PHPMailer_v51/class.phpmailer.php");
require_once("../../../../../PHPMailer_v51/class.smtp.php");
include("../../../../../config_email_phpmailer.php");

#Configuracion
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
#Instanciamiento
$correo=new cjEmail($Parametros);


//----------------------------------------------------------------------------
//Creando xml

$busca_factura="select * from comprobante_credito_cab where comcabcre_id='".$_POST["pcomcabcre_id"]."'"; 
$rs_buscaid = $DB_gogess->Execute($busca_factura); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $idbuscarenvio=$rs_buscaid->fields["comcabcre_clavedeaccesos"];
					  
					 $em_nombreva=$rs_buscaid->fields["comcabcre_nombrerazon_cliente"];
					
					 
					 $email_cliente=$rs_buscaid->fields["comcabcre_email_cliente"];
					 
					 $enviado=trim($rs_buscaid->fields["comcabcre_enviomail"]);
					 $comcabcre_estadosri=trim($rs_buscaid->fields["comcabcre_estadosri"]);
					 
					  $em_id=$rs_buscaid->fields["em_id"];
					  $comcabcre_tipocomprobante=$rs_buscaid->fields["comcabcre_tipocomprobante"];
					  
					  $rs_buscaid->MoveNext();
					  }
				}
	
if($comcabcre_tipocomprobante=='04')
{
$path_firmadoindividual="../../../../../xmlcredito/";
$path_pdfindividual="../../../../../pdfcredito/";
}
if($comcabcre_tipocomprobante=='05')
{
$path_firmadoindividual="../../../../../xmldebito/";
$path_pdfindividual="../../../../../pdfdebito/";
}				
				
 $objimpuestos->datos_cfg($em_id,$DB_gogess);		
 
 $permiteenvio=generar_datoautorizado($_POST["pcomcabcre_id"],$path_firmadoindividual,$objimpuestos->ambi_valor,$DB_gogess);
 	
if($permiteenvio)
{			  
echo $enviado;
if($comcabcre_estadosri=='AUTORIZADO')
{
//--------------------------------------------------------------------------


try {
$correo->mail->From = "facturar@excelenteweb.com";
$correo->mail->FromName = "FACTURAR";
$correo->mail->Timeout=120;

$contEnvio=1;


        $mail_asunto="FACTURAR";

        $textHTML="
        <table border=\"0\">
            <tr><td align=\"center\"><b>ENVIO DE FACTURACION ELECTRONICA</b></td></tr>
           ";

        
        $textHTML.="
            <tr>
                <td align=\"justify\">
                    <p>
                        Estimada/o:
                    </p>
                    <p>
                        Le enviamos su factura electronica.			
						
                    </p>
                    ";

        
        $textHTML.="
        <tr>
            <td align=\"justify\">
                <p>
                    
					Empresa:".$em_nombreva."<br>
				
				
					
                </p>                
            </td>
        </tr>";

        $textHTML.="
        <tr><td align=\"center\">&nbsp;</td></tr>
        <tr><td align=\"center\">&nbsp;</td></tr>
        <tr>
            <td align=\"center\">
                <b>...</b><br>
            </td>
        </tr>
        </table>";
//$email_cliente='franklin.aguas@gmail.com';
$mailDest=$email_cliente;
$Nombre_Postulante= $em_nombreva;

        $correo->mail->Subject=$mail_asunto;
        $correo->mail->MsgHTML($textHTML);
        $correo->mail->AddAddress($mailDest,$Nombre_Postulante);		
		$correo->mail->AddCC("franklin.aguas@gmail.com");
				
        $correo->mail->IsHTML(true);


        #/*
            $archivo = $path_firmadoindividual.$_POST["pcomcabcre_id"].'.xml';			
			
			$archivopdf = $path_pdfindividual.$_POST["pcomcabcre_id"].'.pdf';
			
			$archivon = $idbuscarenvio.'.xml';
			$archivonpdf = $_POST["pcomcabcre_id"].'.pdf';
			
            $correo->mail->AddAttachment($archivo,$archivon);
			$correo->mail->AddAttachment($archivopdf,$archivonpdf);
			
            $result = $correo->mail->Send();
            if(isset($result)) {
                echo "<b>$contEnvio) Correo: Enviado satisfactoriamente...</b><br>";
				$fechahoy=date("Y-m-d H:i:s"); 
				if($enviado=='ENVIADO')
				{
				$actualizaemail="update comprobante_credito_cab set comcabcre_enviomail='REENVIADO',comcabcre_enviomailfecha='".$fechahoy."' where comcabcre_id='".$_POST["pcomcabcre_id"]."'";
				}
				else
				{
				$actualizaemail="update comprobante_credito_cab set comcabcre_enviomail='ENVIADO',comcabcre_enviomailfecha='".$fechahoy."' where comcabcre_id='".$_POST["pcomcabcre_id"]."'";
				} 
				$okv=$DB_gogess->Execute($actualizaemail); 
				
            } else {
                echo $correo->mail->ErrorInfo;
                echo "<br><b>$contEnvio) Correo: $mailDest NO Enviado satisfactoriamente</b><br>";
            }
        
        #*/
        
        $correo->mail->ClearAddresses();
        @$correo->mail->ClearAddresses();
   
}catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}
   
   }
   else
   {
     echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>Problemas de conecci&oacute;n vuelva a intentar</b></div>";
   
   }
   
   
}
else
{
echo  "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>La factura debe estar autorizada no se enviar&aacute; el correo</b></div>";

}

//----------------------------------------------------------------------------

}
else
{
echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>A caducado la sesi&oacute;n vuelva a ingresar al sistema presione F5</b></div>";
}
?>