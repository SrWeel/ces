<?php
//---------------------------
function enviar_correo($mail_asunto,$archivos,$lista_email,$nombredestinatario,$correode,$nombrede,$texto_valor,$email_extra,$datos_mail,$DB_gogess)
{
$buscadatosemail="select * from  app_correo where corre_id=2";
$rs_buscacorreo = $DB_gogess->executec($buscadatosemail,array()); 
//print_r($rs_buscacorreo->fields);
//print_r($archivos);

$corre_mensaje=$rs_buscacorreo->fields["corre_mensaje"];
$corre_mensaje=str_replace('-cliente-',$datos_mail["cliente"],$corre_mensaje);
$corre_mensaje=str_replace('-documento-',$datos_mail["documento"],$corre_mensaje);
$corre_mensaje=str_replace('-fecha-',$datos_mail["fecha"],$corre_mensaje);
$corre_mensaje=str_replace('-ndocumento-',$datos_mail["ndocumento"],$corre_mensaje);
$corre_mensaje=str_replace('-claveacceso-',$datos_mail["claveacceso"],$corre_mensaje);

#Configuracion
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
#Instanciamiento
$correo=new cjEmail($Parametros);

$correo->mail->Host = $rs_buscacorreo->fields["corre_smtp"];
$correo->mail->Username = $rs_buscacorreo->fields["corre_email"];#"amceesystems@gmail.com";
$correo->mail->Password = $rs_buscacorreo->fields["corre_clave"];	
	
try {
$correo->mail->From = $rs_buscacorreo->fields["corre_email"];
$correo->mail->FromName = $rs_buscacorreo->fields["corre_titulo"];
$correo->mail->Timeout=120;



$contEnvio=1;


         $textHTML=$corre_mensaje;

       
		
		$destinatario=$lista_email[0];
		echo "Destinatario:".$destinatario."<br>";



        $correo->mail->CharSet = 'UTF-8';
        $correo->mail->Subject=$mail_asunto;
        $correo->mail->MsgHTML($textHTML);
        $correo->mail->AddAddress($destinatario,$nombredestinatario);	
		
		
		for($iem=1;$iem<count($lista_email);$iem++)
		{
			if($lista_email[$iem])
			{
			$correo->mail->AddCC($lista_email[$iem]);
			}
			echo $lista_email[$iem]."<br>";
		}
			
		
				
        $correo->mail->IsHTML(true);	
		
		for($iat=0;$iat<count($archivos);$iat++)
		{
		  $correo->mail->AddAttachment($archivos[$iat]["path"],$archivos[$iat]["nombre"]);
		}
		
		$result = $correo->mail->Send();
		 if(isset($result)) {
			   $msgresultado=1;
		 }
		 else
		 {
			  $msgresultado=0;
			 
		 }
	
	
	    $correo->mail->ClearAddresses();
        @$correo->mail->ClearAddresses();
		   
		}catch (phpmailerException $e) {
			echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			echo $e->getMessage(); //Boring error messages from anything else!
		}
		 
	return $msgresultado;
}


function enviar_correoproforma($mail_asunto,$archivos,$lista_email,$nombredestinatario,$correode,$nombrede,$texto_valor,$email_extra,$datos_mail,$DB_gogess)
{
$buscadatosemail="select * from  app_correo where corre_id=4";
$rs_buscacorreo = $DB_gogess->executec($buscadatosemail,array()); 
//print_r($rs_buscacorreo->fields);
//print_r($archivos);

$corre_mensaje=$rs_buscacorreo->fields["corre_mensaje"];
$corre_mensaje=str_replace('-cliente-',$datos_mail["cliente"],$corre_mensaje);
$corre_mensaje=str_replace('-documento-',$datos_mail["documento"],$corre_mensaje);
$corre_mensaje=str_replace('-fecha-',$datos_mail["fecha"],$corre_mensaje);
$corre_mensaje=str_replace('-ndocumento-',$datos_mail["ndocumento"],$corre_mensaje);
$corre_mensaje=str_replace('-claveacceso-',$datos_mail["claveacceso"],$corre_mensaje);

#Configuracion
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
#Instanciamiento
$correo=new cjEmail($Parametros);

$correo->mail->Host = $rs_buscacorreo->fields["corre_smtp"];
$correo->mail->Username = $rs_buscacorreo->fields["corre_email"];#"amceesystems@gmail.com";
$correo->mail->Password = $rs_buscacorreo->fields["corre_clave"];	
	
try {
$correo->mail->From = $rs_buscacorreo->fields["corre_email"];
$correo->mail->FromName = $rs_buscacorreo->fields["corre_titulo"];
$correo->mail->Timeout=120;



$contEnvio=1;


         $textHTML=$corre_mensaje;

       
		
		$destinatario=$lista_email[0];
		echo "Destinatario:".$destinatario."<br>";



        $correo->mail->CharSet = 'UTF-8';
        $correo->mail->Subject=$mail_asunto;
        $correo->mail->MsgHTML($textHTML);
        $correo->mail->AddAddress($destinatario,$nombredestinatario);	
		
		
		for($iem=1;$iem<count($lista_email);$iem++)
		{
			if($lista_email[$iem])
			{
			$correo->mail->AddCC($lista_email[$iem]);
			}
			echo $lista_email[$iem]."<br>";
		}
			
		
				
        $correo->mail->IsHTML(true);	
		
		for($iat=0;$iat<count($archivos);$iat++)
		{
		  $correo->mail->AddAttachment($archivos[$iat]["path"],$archivos[$iat]["nombre"]);
		}
		
		$result = $correo->mail->Send();
		 if(isset($result)) {
			   $msgresultado=1;
		 }
		 else
		 {
			  $msgresultado=0;
			 
		 }
	
	
	    $correo->mail->ClearAddresses();
        @$correo->mail->ClearAddresses();
		   
		}catch (phpmailerException $e) {
			echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			echo $e->getMessage(); //Boring error messages from anything else!
		}
		 
	return $msgresultado;
}
?>