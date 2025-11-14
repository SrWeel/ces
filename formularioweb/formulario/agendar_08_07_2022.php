<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=544000000;

ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


//print_r($_REQUEST);

$director="../../director/";
include ("../../director/cfgclases/clases.php");

require_once("../../libreria/PHPMailer_v51/class.phpmailer.php");
require_once("../../libreria/PHPMailer_v51/class.smtp.php");
include("../../libreria/config_email_phpmailer.php");

$fechaReg = date("Y-m-d");
$fechaAgenda = date("Y-m-d", strtotime(str_replace("/","-",$_REQUEST["pDate"])));  
    
$sql = <<<SQL
    INSERT INTO faesa_terapiasregistro (especi_id, usua_id, clie_id, terap_fecha, terap_hora, centro_id, usuar_id, terap_fecharegistro, prof_id)
    VALUES ('{$_REQUEST["pEspID"]}','{$_REQUEST["pProfID"]}','{$_REQUEST["pClieID"]}','{$fechaAgenda}','{$_REQUEST["pHour"]}','{$_REQUEST["pCentroID"]}', 1, '{$fechaReg}', '{$_REQUEST["pEspID"]}')
SQL;
$rs = $DB_gogess->Execute($sql);

#Configuracion
/*
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
//$Parametros["Servidor_Correo"]="gmail";
#Instanciamiento
$correo=new cjEmail($Parametros);

$email_correo = "sack3000@hotmail.com";
$nombre_correo = $email_correo;

try {
$correo->mail->From = "pichinchahumana_sistemas2@pichincha.gob.ec";
$correo->mail->FromName = "Pichincha Humana";
$correo->mail->Timeout=120;

$mail_asunto="AGENDAMIENTO DE CITA M&Eacute;DICA - PICHINCHA HUMANA";

$textHTML=<<<SCRIPT
    <div style="text-align: center;">
        <b style="color:green;">¡Su agendamiento se ha realizado satisfactoriamente!</b>
        <table>
            <tr>
                <td><b>Datos de Agendamiento</b></td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>Fecha de la cita:</td>
                            <td>{$_REQUEST["pDate"]}</td>
                        </tr>
                        <tr>
                            <td>Hora de la cita:</td>
                            <td>{$_REQUEST["pHour"]}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
SCRIPT;
        
$mailDest=$email_correo;
$Nombre_Postulante=$nombre_correo;

$correo->mail->Subject=$mail_asunto;
$correo->mail->MsgHTML($textHTML);
$correo->mail->AddAddress($mailDest,$Nombre_Postulante);
$correo->mail->IsHTML(true);

$result = $correo->mail->Send();
$envioExito = false;
if($result) {
    $envioExito = true;
} else {
    //echo $correo->mail->ErrorInfo;
    $envioExito = false;
}
$correo->mail->ClearAddresses();
@$correo->mail->ClearAddresses();
   
}catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}
*/
?>
<div style="text-align: center;">
    <b style="color:green;">¡Su agendamiento se ha realizado satisfactoriamente!</b>
    <p>&nbsp;</p>
    <table style="margin: 0 auto;">
        <tr>
            <td><b>Datos de Agendamiento</b></td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Fecha de la cita:</td>
                        <td><?php echo $_REQUEST["pDate"]; ?></td>
                    </tr>
                    <tr>
                        <td>Hora de la cita:</td>
                        <td><?php echo $_REQUEST["pHour"]; ?></td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</div>