<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_POST["usua_usuario"])
{

function decrypt($encrypted_text){
  
	$decrypted = base64_decode($encrypted_text);
	
	return $decrypted;
}

function sacaaleat()
{
                    $max_chars = round(rand(3,3));  // tendrá entre 7 y 10 caracteres
					$chars = array();
					for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras
					$chars[] = "z";
					for ($i=0; $i<$max_chars; $i++) {
						@$clave .= round(rand(0, 9));
					}
                            
	 			   return  $clave; 
}

function variables_segura($linksvar)
{
     $valorext=sacaaleat();
	 $valoresencriptados=encrypt($linksvar);																						
	 $linksvarencri=base64_encode($valoresencriptados).trim($valorext);
     return $linksvarencri;
}


function encrypt($text) {
           
			return base64_encode($text);
   }

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

require_once("../../../../libreria/PHPMailer_v51/class.phpmailer.php");
require_once("../../../../libreria/PHPMailer_v51/class.smtp.php");
include("../../../../libreria/config_email_phpmailer.php");

$obj_cmb=new FormularioCmb();
$objtableform= new templateform();
$objformulario= new  ValidacionesFormulario();

#Configuracion
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
#Instanciamiento
$correo=new cjEmail($Parametros);


$usua_email=$obj_cmb->replace_cmb("media_usuario","usua_usuario,usua_email","where usua_usuario like ",$_POST["usua_usuario"],$DB_gogess);
$usua_nombre=$obj_cmb->replace_cmb("media_usuario","usua_usuario,usua_nombre","where usua_usuario like ",$_POST["usua_usuario"],$DB_gogess);
$usua_id=$obj_cmb->replace_cmb("media_usuario","usua_usuario,usua_id","where usua_usuario like ",$_POST["usua_usuario"],$DB_gogess);

//inserta_perfil
$datehoy=date("Y-m-d H:i:s");
$insert_per="INSERT INTO `media_usuariosperfil` (`usua_id`, `per_codobj`, `per_activo`, `per_fechamod`) VALUES
( ".$usua_id.", 13, '1', '".$datehoy."'),
( ".$usua_id.", 43, '1', '".$datehoy."'),
( ".$usua_id.", 45, '1', '".$datehoy."'),
( ".$usua_id.", 46, '1', '".$datehoy."');";
$opk_perf=$DB_gogess->executec($insert_per,array());
//inserta perfil

$cde=sacaaleat().date("Ymdhis");
$gen_code="update media_usuario set usua_code='".$cde."' where usua_id=?";
@$ok_actualiza = $DB_gogess->executec($gen_code,array($usua_id));

$email_correo=$usua_email;
$nombre_correo=$usua_nombre;
//---------------------------------------------------
$linksvar="apl=6&secc=7&idactv=".@$usua_id."&cj=".$cde;
$linksvarencri=variables_segura($linksvar);	
$armadolinkx='index.php?snp='.$linksvarencri;


try {
$correo->mail->From = "franklin.aguas@gmail.com";
$correo->mail->FromName = "CONSEJO DE LA JUDICATURA ";
$correo->mail->Timeout=120;

$contEnvio=1;


        $mail_asunto="REGISTRO USUARIO";

        $textHTML="
        <table border=\"0\">
            <tr><td align=\"center\"><b>USUARIO REGISTRADO</b></td></tr>
           ";

        
        $textHTML.="
            <tr>
                <td align=\"justify\">
                    <p>
                        Estimada/o: ".$nombre_correo."
                    </p>
                    <p>
                        Su registro se ha procesado con &eacute;xito.			
						
                    </p>
                    ";

        
        $textHTML.="
        <tr>
            <td align=\"justify\">
                <p>
                    De clic en el siguiente link para activar su cuenta: .....
					
					<a href='".$correo->mail->link_activar.@$armadolinkx."'>Activar cuenta</a> si no funciona copie este link en la barra del navegador <br>".$correo->mail->link_activar.@$armadolinkx." 
					
                </p>                
            </td>
        </tr>";

        $textHTML.="
        <tr><td align=\"center\">&nbsp;</td></tr>
        <tr><td align=\"center\">&nbsp;</td></tr>
        <tr>
            <td align=\"center\">
                <b>Dirección: 12 de Octubre N24-563 y Francisco Salazar 	<br> 

Copyright © 2011 Consejo de la Judicatura</b><br>
            </td>
        </tr>
        </table>";

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
				
				echo '<div align="center"><img src="images/resgitro_exito.png" /></div>';
				
            } else {
                echo $correo->mail->ErrorInfo;
                echo '<div align="center"><img src="images/resgitro_error.png" width="700" height="400" /></div>';
            }
        
        #*/
        
        $correo->mail->ClearAddresses();
        @$correo->mail->ClearAddresses();
   
}catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}

//---------------------------------------------------
}


?>