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
$path_firmadoindividual="../../../../../xmlfacturas/";
function generar_datoautorizado($comcab_id,$patch,$ambiente,$DB_gogess)
{

$buscaarchivo="select * from comprobante_fac_cabecera where comcab_id='".$comcab_id."'";

$rs_buscaid = $DB_gogess->Execute($buscaarchivo); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $narchivo=$rs_buscaid->fields["comcab_id"];
					  $estadoarch=$rs_buscaid->fields["comcab_estadosri"];
					  
					  $comcab_fechaaut=$rs_buscaid->fields["comcab_fechaaut"];
					  $comcab_nautorizacion=$rs_buscaid->fields["comcab_nautorizacion"];
					  $comcab_sello=$rs_buscaid->fields["comcab_sello"];
					 					
					  $rs_buscaid->MoveNext();
					  }
				}	  
				
			
	
	if($comcab_sello!='SI')
	{
$archivostring=leer_contenido_completo($patch.$narchivo.".xml");	
				
$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
<autorizacion>
<estado>'.$estadoarch.'</estado>
<numeroAutorizacion>'.$comcab_nautorizacion.'</numeroAutorizacion>
<fechaAutorizacion>'.$comcab_fechaaut.'</fechaAutorizacion>
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

       
        $actualizafactur="update comprobante_fac_cabecera set comcab_sello='SI' where comcab_id='".$comcab_id."'";
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

$busca_factura="select * from comprobante_fac_cabecera where comcab_id='".$_POST["pcomcab_id"]."'"; 
$rs_buscaid = $DB_gogess->Execute($busca_factura); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $idbuscarenvio=$rs_buscaid->fields["comcab_clavedeaccesos"];
					  
					 $em_nombreva=$rs_buscaid->fields["comcab_nombrerazon_cliente"];
					
					 
					 $email_cliente=$rs_buscaid->fields["comcab_email_cliente"];
					 
					 $enviado=trim($rs_buscaid->fields["comcab_enviomail"]);
					 $comcab_estadosri=trim($rs_buscaid->fields["comcab_estadosri"]);
					 
					  $em_id=$rs_buscaid->fields["em_id"];
					  
					  $rs_buscaid->MoveNext();
					  }
				}
				
				
 $objimpuestos->datos_cfg($em_id,$DB_gogess);		
 
 $permiteenvio=generar_datoautorizado($_POST["pcomcab_id"],$path_firmadoindividual,$objimpuestos->ambi_valor,$DB_gogess);
 	
if($permiteenvio)
{			  
echo $enviado;
if($comcab_estadosri=='AUTORIZADO')
{
//--------------------------------------------------------------------------


try {
$correo->mail->From = "sistemas-ec@schryver.com";
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
		$correo->mail->AddCC("sistemas-ec@schryver.com");
				
        $correo->mail->IsHTML(true);



        #/*
            $archivo = '../../../../../xmlfacturas/'.$_POST["pcomcab_id"].'.xml';			
			
			$archivopdf = '../../../../../pdffacturas/'.$_POST["pcomcab_id"].'.pdf';
			
			$archivon = $idbuscarenvio.'.xml';
			$archivonpdf = $_POST["pcomcab_id"].'.pdf';
			
            $correo->mail->AddAttachment($archivo,$archivon);
			$correo->mail->AddAttachment($archivopdf,$archivonpdf);
			
            $result = $correo->mail->Send();
            if(isset($result)) {
                echo "<b>$contEnvio) Correo: Enviado satisfactoriamente...</b><br>";
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