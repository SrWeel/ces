<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","36000");
ini_set("session.gc_maxlifetime","36000");
session_start();
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
require_once("../libreria/PHPMailer_v51/class.phpmailer.php");
require_once("../libreria/PHPMailer_v51/class.smtp.php");
include("../libreria/config_email_phpmailer.php");



if(@$_SESSION['formularioweb_asite_id'])
{
//cfg correo
$buscadatosemail="select * from  app_correo where corre_id=1";
$rs_buscacorreo = $DB_gogess->executec($buscadatosemail,array()); 
//cfg correo	

  
$fecha_rserva=$_POST["fecha_rserva"];
$asite_id=$_POST["asite_id"];
$contac_contacto=$_POST["contac_contacto"];
$contac_telefono=$_POST["contac_telefono"];
$contac_email=$_POST["contac_email"];
$emp_id=$_POST["emp_id"];


$empresa_data="select * from app_empresa where emp_id='".$emp_id."'";
$rs_empdata = $DB_gogess->executec($empresa_data);
  
$email_encargado=$rs_empdata->fields["emp_emailnuevo"];

$inserta_reserva="insert into app_contactanos (emp_id,asite_id,contac_pedido,contac_fecha,contac_telefono,contac_email) values ('".$emp_id."','".$asite_id."','".utf8_decode($contac_contacto)."','".$fecha_rserva."','".$contac_telefono."','".$contac_email."')";  
$rs_reserv = $DB_gogess->executec($inserta_reserva);
  

$autoriza_ingresox="select * from app_asisten where asite_id='".$asite_id."'";
$rs_gogessformx = $DB_gogess->executec($autoriza_ingresox);
  
$contenido_val='';
$contenido_val='<table width="26%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td height="70" bgcolor="#FFFFFF"><br><div align="center"><b>CONTACTANOS</b> <BR> 
      <b>NOMBRE:</b> '.$rs_gogessformx->fields["asite_nombre"]." ".$rs_gogessformx->fields["asite_apellido"].'<BR> 
      <b>FECHA:</b> '.$fecha_rserva.'<br>
      <b>CONTACTANOS:</b> '.$contac_contacto.'<br>
	  <b>CELULAR:</b> '.$contac_telefono.'<br>
	  <b>EMAIL:</b> '.$contac_email.'<br>
    </div></td>
  </tr>
</table>';

echo "<br><br><center><b>SU PEDIDO FUE ENVIADO...</b></center>";


//email
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
   
$correo=new cjEmail($Parametros);
$correo->mail->Host = $rs_buscacorreo->fields["corre_smtp"];
$correo->mail->Username = $rs_buscacorreo->fields["corre_email"];#"amceesystems@gmail.com";
$correo->mail->Password = $rs_buscacorreo->fields["corre_clave"];

//ENVIA CORREO
$emails_enviar=$email_encargado;
$formato_email="select email_titulo,email_texto from app_emailformato where email_id=17";
$reslt_formato= $DB_gogess->executec($formato_email,array());

$formteado_val='';
$formteado_val=str_replace("-nombre-",@$us_nombre,$reslt_formato->fields["email_texto"]);
 $formteado_val=str_replace("-contenido-",$contenido_val,$formteado_val);
 $formteado_val=str_replace("-telefono-",$contac_telefono,$formteado_val);
 $formteado_val=str_replace("-email-",$contac_email,$formteado_val);


try {
$mail_asunto=$reslt_formato->fields["email_titulo"];
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
?>