<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{ 

 $director="../../../../";
 include ("../../../../cfgclases/clases.php");
  //creandoclavealetoria
 // echo $_SESSION['iduser'];
  $valoralet=mt_rand(1,5000);
  $aletorioid=$valoralet.$_SESSION['iduser']; 
  
  $obteneremail="select * from factur_usuarios where usr_cedula='".$_POST["usr_cedulax"]."'";
  $rs_buscaemail = $DB_gogess->Execute($obteneremail); 
				  if($rs_buscaemail)
				  {
				      while (!$rs_buscaemail->EOF) {
					  
					   $emailpersona=$rs_buscaemail->fields["usr_email"];
					   $nombrepersona=$rs_buscaemail->fields["usr_nombre"];
					  
					  $rs_buscaemail->MoveNext();
					  }
				}  
  
  
  $actualiza_usuario="update factur_usuarios set usr_fecha_cambioclv='',usr_clave='".md5($aletorioid)."' where usr_cedula='".$_POST["usr_cedulax"]."'";
  $ok3=$DB_gogess->Execute($actualiza_usuario);
  if($ok3)
  {
    echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#003333; font-size:11px" >Clave generada:'.$aletorioid.'<br></div>';
  }
  else
  {
    echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000; font-size:11px" >Error de conecci&oacute;n intente nuevamente por favor...<br></div>';
  }



 
  ///enviando email
if($emailpersona)
{  
require_once("../../../../PHPMailer_v51/class.phpmailer.php");
require_once("../../../../PHPMailer_v51/class.smtp.php");
include("../../../../config_email_phpmailer.php");

#Configuracion
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
#Instanciamiento
$correo=new cjEmail($Parametros);
?>
<?php
  
try {
$correo->mail->From = "franklin.aguas@gmail.com";
$correo->mail->FromName = "CITI";
$correo->mail->Timeout=120;

$contEnvio=1;


        $mail_asunto="CITI";

        $textHTML="
        <table border=\"0\">
            <tr><td align=\"center\"><b>CLAVE GENERADA</b></td></tr>
           ";

        
        $textHTML.="
            <tr>
                <td align=\"justify\">
                    <p>
                        Estimada/o: ".$nombrepersona."
                    </p>
                    <p>
                        Clave temporal:".$aletorioid."<br>
						Le informamos que esta esta clave es temporal la debe cambiar para poder ingresar al sistema.
						
					
						
                    </p>
                    ";

        
        $textHTML.="       
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

$mailDest=$emailpersona;
$Nombre_Postulante="Citi ".$nombrepersona;

        $correo->mail->Subject=$mail_asunto;
        $correo->mail->MsgHTML($textHTML);
        $correo->mail->AddAddress($mailDest,$Nombre_Postulante);
        $correo->mail->IsHTML(true);

        #/*
        
            $result = $correo->mail->Send();
            if($result) {
                echo "<b>$contEnvio) Correo: $mailDest enviado satisfactoriamente</b><br>";
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
   

  
  ///enviaando email
  }
  else
  {
    echo "Usuario no tiene registrado su cuenta de email...";
  }
  


}


?>