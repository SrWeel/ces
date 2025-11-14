<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

require_once("../../libreria/PHPMailer_v51/class.phpmailer.php");
require_once("../../libreria/PHPMailer_v51/class.smtp.php");
include("../../libreria/config_email_phpmailer.php");

$busca_usuario="select * from app_usuario where usua_email=?";

$rs_generafrm = $DB_gogess->executec($busca_usuario,array($_POST["email_pc"]));

if($rs_generafrm->fields["usua_id"])
{
  
  
$buscadatosemail="select * from  app_correo where corre_id=1";
$rs_buscacorreo = $DB_gogess->executec($buscadatosemail,array()); 	
#Configuracion
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
#Instanciamiento
$correo=new cjEmail($Parametros);
	
$correo->mail->Host = $rs_buscacorreo->fields["corre_smtp"];
$correo->mail->Username = $rs_buscacorreo->fields["corre_email"];#"amceesystems@gmail.com";
$correo->mail->Password = $rs_buscacorreo->fields["corre_clave"];

 $nombre_correo='';
  $email_correo='';

$buscaemail="select * from app_usuario where usua_id='".$rs_generafrm->fields["usua_id"]."'";
$resultadolktr = $DB_gogess->executec($buscaemail,array());
	
	if($resultadolktr)
	{
  
      while (!$resultadolktr->EOF) {
	
	  $email_correo=$resultadolktr->fields["usua_email"];
	  $nombre_correo=$resultadolktr->fields["usua_nombre"];
	  $usua_id=$resultadolktr->fields["usua_id"];
	  
	  $resultadolktr->MoveNext();
	}
	
	}


function generateRandomString($length = 7) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
} 

$clave_aleatoria=generateRandomString(7);

$url_envio=$rs_buscacorreo->fields["corre_dominio"]."index.php?snp=WVhCc1BURTNKbk5sWTJNOU55WjBhWEJ2UFRFPQ==825";
$formato_email="select email_titulo,email_texto from app_emailformato where email_id=2 and email_activo=1";
$reslt_formato= $DB_gogess->executec($formato_email,array());

$logo_archivo='http://www.domohs.com/domohs/images/logo_email.png';
$formteado_val='';
$formteado_val=str_replace("-nombre-",$nombre_correo,$reslt_formato->fields["email_texto"]);
$formteado_val=str_replace("-envio-",$url_envio,$formteado_val);
$formteado_val=str_replace("-logo-",$logo_archivo,$formteado_val);
$formteado_val=str_replace("-foto-",$logo_archivo,$formteado_val);
$formteado_val=str_replace("-clave-",$clave_aleatoria,$formteado_val);


  
try {
$correo->mail->From = "franklin.aguas@gmail.com";
$correo->mail->FromName = "DOMOHS.COM";
$correo->mail->Timeout=120;

$contEnvio=1;

$mail_asunto="BIENVENIDO ".$nombre_correo;
$textHTML=$formteado_val;
	

$mailDest=$email_correo;
$Nombre_Postulante=$nombre_correo;

        $correo->mail->Subject=$mail_asunto;
        $correo->mail->MsgHTML($textHTML);
        $correo->mail->AddAddress($mailDest,$Nombre_Postulante);
        $correo->mail->IsHTML(true);

        #/*
        
            $result = $correo->mail->Send();
            if($result) {
              //  echo "<b>$contEnvio) Correo: $mailDest enviado satisfactoriamente</b><br>";
				
				echo '<div align="center"><b>Ingrese a su cuenta de email para obtener su clave temporal</b></div>
<script type="text/javascript">
<!--
window.setTimeout("ir_pagina()",3000);

function ir_pagina()
{
window.location.assign("index.php?snp=WVhCc1BURTNKbk5sWTJNOU55WjBhWEJ2UFRFPQ==825")
}
//  End -->
</script>
				';
				
				
				$actualiza_clave="update app_usuario set usua_clave='".md5($clave_aleatoria)."' where usua_id='".$rs_generafrm->fields["usua_id"]."'";
                $resul_ok = $DB_gogess->executec($actualiza_clave,array());
				
            } else {
                echo $correo->mail->ErrorInfo;
                echo '<div align="center"><b>Error de conecci&oacute;n, revise su conecci&oacute;n a internet <br>y vuelva a intentar</b></div>';
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
echo '<div class="alert alert-warning">Usuario no existe porfavor verifique su cuenta de correo y vuelva a ingresarla</div>

<script type="text/javascript">
<!--
window.setTimeout("ir_pagina()",3000);

function ir_pagina()
{
window.location.assign("index.php?snp=WVhCc1BURTNKbk5sWTJNOU55WjBhWEJ2UFRFPQ==825")
}
//  End -->
</script>
';
}



?>