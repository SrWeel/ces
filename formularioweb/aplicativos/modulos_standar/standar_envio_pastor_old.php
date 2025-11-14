<?php

ini_set('display_errors',0);

error_reporting(E_ALL);

$director="../../../";
include("../../../cfg/clases.php");
require_once("../../libreria/PHPMailer_v51/class.phpmailer.php");
require_once("../../libreria/PHPMailer_v51/class.smtp.php");
include("../../libreria/config_email_phpmailer.php");


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

/*busca datos para enviar*/

$busca_datostabla="select * from  gogess_sistable where tab_name='".$_POST["formu_id"]."'";
$resul_tabla = $DB_gogess->executec($busca_datostabla,array());

$busca_datosenviar="select * from ".$_POST["formu_id"]." where ".$resul_tabla->fields["tab_campoprimario"]."='".$_POST["idinsertado"]."'";
$resul_datosenvia = $DB_gogess->executec($busca_datosenviar,array());

//print_r($resul_datosenvia->fields);


$busca_datoscampos="select * from gogess_sisfield where tab_name='".$_POST["formu_id"]."' and fie_guarda=1";
$concatena_contenido=' ';
$resul_campos = $DB_gogess->executec($busca_datoscampos,array());
if ($resul_campos)
        {
			 while (!$resul_campos->EOF) {	
			 
			 if($resul_campos->fields["fie_name"]=='clie_nombre' or $resul_campos->fields["fie_name"]=='clie_apellido' or $resul_campos->fields["fie_name"]=='clie_genero' or $resul_campos->fields["fie_name"]=='clie_direccion' or $resul_campos->fields["fie_name"]=='clie_celular'  or $resul_campos->fields["fie_name"]=='clie_telefono' or $resul_campos->fields["fie_name"]=='clie_email')
			 {
			 $concatena_contenido.=' '.$resul_campos->fields["fie_title"]." ".$resul_datosenvia->fields[$resul_campos->fields["fie_name"]]."<br>";
			 }
			 
			 $resul_campos->MoveNext();
			 }
		}

//$concatena_contenido;

$emails_enviar="pablimonc@hotmail.com,franklin.aguas@gmail.com";

$formato_email="select email_titulo,email_texto from app_emailformato where email_id=3 and email_activo=1";
$reslt_formato= $DB_gogess->executec($formato_email,array());


$formteado_val='';
$formteado_val=str_replace("-nombre-",@$nombre_correo,$reslt_formato->fields["email_texto"]);
$formteado_val=str_replace("-envio-",@$url_envio,$formteado_val);
$formteado_val=str_replace("-logo-",@$logo_archivo,$formteado_val);
$formteado_val=str_replace("-foto-",@$logo_archivo,$formteado_val);
$formteado_val=str_replace("-contenido-",$concatena_contenido,$formteado_val);



try {
$mail_asunto=$reslt_formato->fields["email_titulo"];
$correo->mail->From = $rs_buscacorreo->fields["corre_email"];
$correo->mail->FromName = $rs_buscacorreo->fields["corre_titulo"]."_".$mail_asunto;
$correo->mail->Timeout=120;
$contEnvio=1;



$textHTML=$formteado_val;
$Nombre_Postulante="LA VINA";

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

?>