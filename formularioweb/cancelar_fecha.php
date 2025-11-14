<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","36000");
ini_set("session.gc_maxlifetime","36000");
session_start();

if(@$_SESSION['formularioweb_asite_id'])
{
   $director="../adm_alianzanorte/";
   include ("../adm_alianzanorte/cfgclases/clases.php");
   
   require_once("../libreria/PHPMailer_v51/class.phpmailer.php");
   require_once("../libreria/PHPMailer_v51/class.smtp.php");
   include("../libreria/config_email_phpmailer.php");
   
   $fecha_rserva=$_POST["fecha_rserva"];
   $even_id=$_POST["even_id"];
   $asite_id=$_POST["asite_id"];
   
   
   $lista_principal="select * from app_asisten where asite_id='".$_SESSION['formularioweb_asite_id']."'";
   $rs_principal = $DB_gogess->Execute($lista_principal);
   
   //cfg correo
   $buscadatosemail="select * from  app_correo where corre_id=1";
   $rs_buscacorreo = $DB_gogess->Execute($buscadatosemail,array()); 
   //cfg correo

 $evento_ingreso="select * from app_eventos inner join app_dias on app_eventos.dia_id=app_dias.dia_id inner join app_salas on app_eventos.sala_id=app_salas.sala_id where even_id='".$_POST["even_id"]."'";
 
 $rs_evento = $DB_gogess->Execute($evento_ingreso);
   
   
$contenido_val='';
$contenido_val='
 <style>
  .txt_letra{
  font-family:Verdana, Arial, Helvetica, sans-serif;
  font-size:10px;
  }
 </style>
 <center>
 <b>CANCELACI&Oacute;N</b> <br><br><table width="56%" border="1" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td height="70" bgcolor="#FFFFFF" class="txt_letra" ><br><div align="center"><b>SU RESERVA FUE CANCELADA</b> <BR> 
      <b>EVENTO:</b> '.$rs_evento->fields["even_nombre"].'<BR>
	  <b>LUGAR:</b> '.$rs_evento->fields["sala_nombre"].'<BR>	  
      <b>FECHA:</b> '.$_POST["fecha_rserva"].'<br>
      <b>HORA:</b> '.$rs_evento->fields["even_horario"].'<br>
      <b>D&Iacute;A:</b> '.$rs_evento->fields["dia_nombre"].' <br><br>
	  
    </div>
	</td>
  </tr>
</table>
</center>
<br><center><b><br>&iexcl;Garanticemos un espacio sano y seguro para todos!</b></center><br>
';

$autoriza_ingresox="select * from app_asisten where asite_id='".$_POST["asite_id"]."'";
$rs_gogessformx = $DB_gogess->Execute($autoriza_ingresox);
   

$borrar_reserva="delete from  app_reservas where asite_id='".$asite_id."' and reserv_fecha='".$fecha_rserva."' and even_id='".$even_id."'";
$rs_br = $DB_gogess->Execute($borrar_reserva);

//email
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
   
$correo=new cjEmail($Parametros);
$correo->mail->Host = $rs_buscacorreo->fields["corre_smtp"];
$correo->mail->Username = $rs_buscacorreo->fields["corre_email"];#"amceesystems@gmail.com";
$correo->mail->Password = $rs_buscacorreo->fields["corre_clave"];
   
   
//ENVIA CORREO
$empresa_data="select * from app_empresa where emp_id=1";
$rs_empdata = $DB_gogess->Execute($empresa_data);
$emp_emailreservas=$rs_empdata->fields["emp_emailreservas"];

$persona_iglesia=";gabomayorga@hotmail.com";
$emails_enviar=$rs_gogessformx->fields["asite_email"].";".$emp_emailreservas;
$formato_email="select email_titulo,email_texto from app_emailformato where email_id=19";
$reslt_formato= $DB_gogess->Execute($formato_email,array());

$formteado_val='';
$formteado_val=str_replace("-nombre-",@$us_nombre,$reslt_formato->fields["email_texto"]);
$formteado_val=str_replace("-contenido-",$contenido_val,$formteado_val);


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
		
		$correo->mail->AddEmbeddedImage('images/logo.png', 'logo_php', 'logo', 'base64', 'image/png');  
		
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

for($iat=0;$iat<count($archivos);$iat++)
		{
		  $correo->mail->AddAttachment($archivos[$iat]["path"],$archivos[$iat]["nombre"]);
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
   
   
   
   echo "<br><br><center><b>CANCELADO CON EXITO</b></center>";
  
}
?>