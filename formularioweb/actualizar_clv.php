<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","460000");
ini_set("session.gc_maxlifetime","460000");
session_start();

if(@$_SESSION['formularioweb_asite_id'])
{

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
require_once("../libreria/PHPMailer_v51/class.phpmailer.php");
require_once("../libreria/PHPMailer_v51/class.smtp.php");
include("../libreria/config_email_phpmailer.php");


$asite_id=$_POST['asite_id'];
$clave_anterior=$_POST['clave_anterior'];
$clave_nueva=$_POST['clave_nueva'];
$clave_nueva1=$_POST['clave_nueva1'];

//cfg correo
$buscadatosemail="select * from  app_correo where corre_id=1";
$rs_buscacorreo = $DB_gogess->executec($buscadatosemail,array()); 
//cfg correo	
$email_recuperar=$_POST["email_recuperar"];	  
	  
$autoriza_ingresox="select * from app_asisten where asite_id='".trim($asite_id)."' and asite_clave='".md5($clave_anterior)."'";
$rs_gogessformx = $DB_gogess->executec($autoriza_ingresox);

$us_nombre=$rs_gogessformx->fields["asite_nombre"]." ".$rs_gogessformx->fields["asite_apellido"];
$asite_rucci=$rs_gogessformx->fields["asite_rucci"];

$valoralet=$clave_nueva;

if($rs_gogessformx->fields["asite_id"]>0)
{
//actualiza
$actualiza_clave="update app_asisten set asite_clave='".md5($valoralet)."' where asite_id='".$rs_gogessformx->fields["asite_id"]."'";
$rs_rclave= $DB_gogess->executec($actualiza_clave);

echo "<center><br><br><br><b>Su nueva clave: </b>".$valoralet."</center>";
//actualiza


$url_data='https://alianzanorte.org/alianzanorte/discipulado/';

//email
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
   
$correo=new cjEmail($Parametros);
$correo->mail->Host = $rs_buscacorreo->fields["corre_smtp"];
$correo->mail->Username = $rs_buscacorreo->fields["corre_email"];#"amceesystems@gmail.com";
$correo->mail->Password = $rs_buscacorreo->fields["corre_clave"];

$envioc=1;
if($envioc==1)
{

//ENVIA CORREO
$emails_enviar=$rs_gogessformx->fields["asite_email"].";gabomayorga@hotmail.com";
$formato_email="select email_titulo,email_texto from app_emailformato where email_id=18";
$reslt_formato= $DB_gogess->executec($formato_email,array());

$formteado_val='';
$formteado_val=str_replace("-nombre-",@$us_nombre,$reslt_formato->fields["email_texto"]);
$formteado_val=str_replace("-clave-",$valoralet,$formteado_val);
$formteado_val=str_replace("-envio-",$url_data,$formteado_val);
//$formteado_val=str_replace("-contenido-",$contenido_val,$formteado_val);


try {
$mail_asunto='ACTUALIZACION DE CLAVE - ALIANZA NORTE';
$correo->mail->From = $rs_buscacorreo->fields["corre_email"];
$correo->mail->FromName = $rs_buscacorreo->fields["corre_titulo"]."_".$mail_asunto;
$correo->mail->Timeout=120;
$contEnvio=1;



$textHTML=$formteado_val;
$Nombre_Postulante="IGLESIA ALIANZA NORTE";

$emails_enviar=str_replace(",",";",$emails_enviar);
$listaextras=explode(";",$emails_enviar);
$destinatario=$listaextras[0];

        $correo->mail->Subject=$mail_asunto;
        $correo->mail->MsgHTML($textHTML);
        $correo->mail->AddAddress($destinatario,$Nombre_Postulante);
        $correo->mail->IsHTML(true);

if(count($listaextras)>1)
{
	
for($iem=1;$iem<count($listaextras);$iem++)
		{
			if($listaextras[$iem])
			{
			$correo->mail->AddCC($listaextras[$iem]);
			}
			//echo $listaextras[$iem]."<br>";
		}
		
}

        #/* 
            $result = $correo->mail->Send();
            if($result) {
              //  echo "<b>$contEnvio) Correo: $mailDest enviado satisfactoriamente</b><br>";
				echo '<div align="center"><b>..</b></div>';
            } else {
                echo $correo->mail->ErrorInfo;
                echo '<div align="center"><b>...</b></div>';
            }       

        #*/       

        $correo->mail->ClearAddresses();
        @$correo->mail->ClearAddresses();   

}catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}
   
//ENVIA CORREO

}


  
  
}
else
{
      echo "<center><br><br><br><b>La clave anterior no es la correcta</center>";

}


}
?>