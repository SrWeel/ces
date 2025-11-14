<?php
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");

require_once("../libreria/PHPMailer_v51/class.phpmailer.php");
require_once("../libreria/PHPMailer_v51/class.smtp.php");
include("../libreria/config_email_phpmailer.php");

$us_cedula=$_POST["us_cedula"];
$us_nombre=$_POST["us_nombre"];
$us_apellido=$_POST["us_apellido"];
$us_email=$_POST["us_email"];
$us_telefono=$_POST["us_telefono"];
$us_clave=$_POST["us_clave"];
$us_fechanac=$_POST["us_fechanac"];
$us_permiso=$_POST["us_permiso"];

if($us_permiso=='')
{
  $us_permiso=0;
}

$mensaje_val=0;

$empresa_data="select * from app_empresa where emp_id=1";
$rs_empdata = $DB_gogess->executec($empresa_data);
$email_encargado=$rs_empdata->fields["emp_emailnuevo"];

//cfg correo
$buscadatosemail="select * from  app_correo where corre_id=1";
$rs_buscacorreo = $DB_gogess->executec($buscadatosemail,array()); 
//cfg correo	

$busca_usuario="select * from app_asisten where us_cedula='".$us_cedula."'";
$rs_busca_usuario = $DB_gogess->executec($busca_usuario,array()); 	

if($rs_busca_usuario->fields["asite_id"]>0)
{
   echo "Usuario ya existe en el sistema...Por favor cont&aacute;ctese con el administrador";
   $mensaje_val=1;
}
else
{
   
   $Parametros["plugin"]="PHPMailer";
   #$Parametros["Servidor_Correo"]="gmail";
   $Parametros["Servidor_Correo"]="gmail";
   
   $correo=new cjEmail($Parametros);
   $correo->mail->Host = $rs_buscacorreo->fields["corre_smtp"];
   $correo->mail->Username = $rs_buscacorreo->fields["corre_email"];#"amceesystems@gmail.com";
   $correo->mail->Password = $rs_buscacorreo->fields["corre_clave"];

   
   $asite_rucci=$us_cedula;
   $asite_clave=md5($us_clave);
   $asite_nombre=$us_nombre;
   $asite_apellido=$us_apellido;
   $asite_email=$us_email;
   $asite_telefono=$us_telefono;
   $asite_fecharegistro=date("Y-m-d");
   
$inserta_usuario="insert into app_asisten (emp_id,asite_rucci,asite_clave,asite_nombre,asite_apellido,asite_email,asite_telefono,asite_fecharegistro,asite_fechanacimiento,asite_permiso) values (1,'".$asite_rucci."','".$asite_clave."','".$asite_nombre."','".$asite_apellido."','".$asite_email."','".$asite_telefono."','".$asite_fecharegistro."','".$us_fechanac."','".$us_permiso."')";
$rs_reg = $DB_gogess->executec($inserta_usuario,array());   
   
if($rs_reg)
{   
   //ENVIA CORREO
$emails_enviar=$us_email.";".$email_encargado;
$formato_email="select email_titulo,email_texto from app_emailformato where email_id=7";
$reslt_formato= $DB_gogess->executec($formato_email,array());

$formteado_val='';
$formteado_val=str_replace("-nombre-",@$us_nombre,$reslt_formato->fields["email_texto"]);
$formteado_val=str_replace("-usuario-",@$us_cedula,$formteado_val);
$formteado_val=str_replace("-clave-",@$us_clave,$formteado_val);


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
 else
 {
    $mensaje_val=2; 
 
 }  
   
   
   
}
?>
<input name="mensaje_val" type="hidden" id="mensaje_val" value="<?php echo $mensaje_val; ?>" />
<input name="usuario_val" type="hidden" id="usuario_val" value="<?php echo $asite_rucci; ?>" />
<input name="clave_val" type="hidden" id="clave_val" value="<?php echo $us_clave; ?>" />