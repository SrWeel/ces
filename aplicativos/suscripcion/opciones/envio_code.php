<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
$director="../../../";
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");

require_once("../../../libreria/PHPMailer_v51/class.phpmailer.php");
require_once("../../../libreria/PHPMailer_v51/class.smtp.php");
include("../../../libreria/config_email_phpmailer.php");



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

$buscaemail="select * from app_usuario where usua_usuario='".$_POST["usua_usuario"]."'";
//$buscaemail="select * from app_usuario where usua_usuario='juan'";
/*$fp = fopen("fichero.txt", "w");
fputs($fp, $buscaemail);
fclose($fp);*/

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



$linksvar="";
$linksvarencri="";
$linksvar="apl=6&secc=7&idactv=".$usua_id;	
$linksvarencri=$objmenuweb->variables_segura($linksvar);
$url_envio=$rs_buscacorreo->fields["corre_dominio"]."index.php?snp=".$linksvarencri;


$formato_email="select email_titulo,email_texto from app_emailformato where email_id=1 and email_activo=1";
$reslt_formato= $DB_gogess->executec($formato_email,array());

$logo_archivo='http://www.domohs.com/domohs/images/logo_email.png';
$formteado_val='';
$formteado_val=str_replace("-nombre-",$nombre_correo,$reslt_formato->fields["email_texto"]);
$formteado_val=str_replace("-envio-",$url_envio,$formteado_val);
$formteado_val=str_replace("-logo-",$logo_archivo,$formteado_val);
$formteado_val=str_replace("-foto-",$logo_archivo,$formteado_val);


?>
<?php
  
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
				
				echo '<div align="center"><b>Se ha registrado con &eacute;xito<br>Revise su cuenta de email para activar su ingreso...</b></div>
<script type="text/javascript">
<!--
window.setTimeout("ir_pagina()",3000);

function ir_pagina()
{
window.location.assign("index.php")
}
//  End -->
</script>
				';
				
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
   

?>