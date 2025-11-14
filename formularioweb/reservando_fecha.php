<?php
include('qr/vendor/autoload.php');//Llamare el autoload de la clase que genera el QR
use Endroid\QrCode\QrCode;
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","460000");
ini_set("session.gc_maxlifetime","460000");
session_start();
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");

require_once("libreria/dompdf/dompdf_config.inc.php");

require_once("../libreria/PHPMailer_v51/class.phpmailer.php");
require_once("../libreria/PHPMailer_v51/class.smtp.php");
include("../libreria/config_email_phpmailer.php");
include("lib.php");



if(@$_SESSION['formularioweb_asite_id'])
{

$lista_principal="select * from app_asisten where asite_id='".$_SESSION['formularioweb_asite_id']."'";
$rs_principal = $DB_gogess->executec($lista_principal);

$id_seleccionado=$_POST["id_seleccionado"];

//cfg correo
$buscadatosemail="select * from  app_correo where corre_id=1";
$rs_buscacorreo = $DB_gogess->executec($buscadatosemail,array()); 
//cfg correo	

  
  $evento_ingreso="select * from app_eventos inner join app_dias on app_eventos.dia_id=app_dias.dia_id inner join app_salas on app_eventos.sala_id=app_salas.sala_id where even_id='".$_POST["even_id"]."'";
  $rs_evento = $DB_gogess->executec($evento_ingreso);
  
  $sala_id_val=$rs_evento->fields["sala_id"];
  
  //asigna asientos
  //$busca_asientos="select *,CONCAT(letra_letra,asie_num) as asiento from app_asientos where sala_id='".$rs_evento->fields["sala_id"]."' and CONCAT(letra_letra,asie_num) not in (select reserv_asiento from app_reservas where reserv_fecha='".$_POST["fecha_rserva"]."' and even_id='".$_POST["even_id"]."') order by asie_id asc limit 1";  
  //$rs_asientos = $DB_gogess->executec($busca_asientos);
  //asigna asientos


  //$inserta_reserva="insert into app_reservas (asite_id,reserv_fecha,even_id,reserv_lugar,reserv_horario,reserv_dia,reserv_nevento,reserv_asiento ) values ('".$_POST["asite_id"]."','".$_POST["fecha_rserva"]."','".$_POST["even_id"]."','".$rs_evento->fields["sala_nombre"]."','".$rs_evento->fields["even_horario"]."','".$rs_evento->fields["dia_nombre"]."','".$rs_evento->fields["even_nombre"]."','".$rs_asientos->fields["asiento"]."')";
  
  //$asiento_principal='';
  //$asiento_principal=$rs_asientos->fields["asiento"];
  
  
  $array_asientos=array();
  
  //echo $inserta_reserva."<br>";
 // $rs_reserv = $DB_gogess->executec($inserta_reserva);
  
 // if($rs_reserv)
  //{
    //reserva para invitados
	  $lista_val=array();
	  $lista_val=explode(",",$id_seleccionado);
      for($iinv=0;$iinv<count($lista_val);$iinv++)
	  {
	     if($lista_val[$iinv])
		 {
		    $lista_binv="select * from app_invitados where inv_id='".$lista_val[$iinv]."'";
		    $rs_binv = $DB_gogess->executec($lista_binv);
		    if($rs_binv->fields["inv_nombre"])
		    {
			     //asigna asientos
				  $busca_asientosx="select *,CONCAT(letra_letra,asie_num) as asiento from app_asientos where asie_reservado=0 and sala_id='".$rs_evento->fields["sala_id"]."' and CONCAT(letra_letra,asie_num) not in (select reserv_asiento from app_reservas where reserv_fecha='".$_POST["fecha_rserva"]."' and even_id='".$_POST["even_id"]."') order by asie_id asc limit 1";  
				  $rs_asientosx = $DB_gogess->executec($busca_asientosx);
				  //asigna asientos
							   
			   $inserta_inv="insert into app_reservas (asite_id,reserv_fecha,even_id,reserv_lugar,reserv_horario,reserv_dia,reserv_nevento,inv_id,reserv_asiento) values ('".$_POST["asite_id"]."','".$_POST["fecha_rserva"]."','".$_POST["even_id"]."','".$rs_evento->fields["sala_nombre"]."','".$rs_evento->fields["even_horario"]."','".$rs_evento->fields["dia_nombre"]."','".$rs_evento->fields["even_nombre"]."','".$lista_val[$iinv]."','".$rs_asientosx->fields["asiento"]."')";
		       //echo $inserta_inv."<br>";
			   
			   $array_asientos[$lista_val[$iinv]]=$rs_asientosx->fields["asiento"];
			   
		       $rs_reinv = $DB_gogess->executec($inserta_inv);
			   
			   $array_reserv_id[$lista_val[$iinv]]=$DB_gogess->funciones_nuevoID(0);
			   
			 }
	     }
	  }
    //reserva para invitados
  //}
 
 //$lista_invidtados="<b>Asiento:</b> ".$asiento_principal." ".$rs_principal->fields["asite_nombre"]." ".$rs_principal->fields["asite_apellido"]."<br>"; 
 $lista_invidtados="";
 $lista_invidtadoscorreo="";
 for($iinv=0;$iinv<count($lista_val);$iinv++)
	  {
	    $lista_inv="select * from app_invitados where inv_id='".$lista_val[$iinv]."'";
		$rs_linv = $DB_gogess->executec($lista_inv);
		if($rs_linv->fields["inv_nombre"])
		{
		  if($rs_linv->fields["inv_parentesco"])
		  {
		    
			$codigo_valor=$array_reserv_id[$lista_val[$iinv]]."-".$lista_val[$iinv]."-".$array_asientos[$lista_val[$iinv]]."-".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"];
				  
				  $qrCode = new QrCode($codigo_valor);//Creo una nueva instancia de la clase
				  $qrCode->setSize("200");//Establece el tamaño del qr
				  //header('Content-Type: '.$qrCode->getContentType());
				  $image= $qrCode->writeString();//Salida en formato de texto 
				  $mombre_grafico='QR_'.$lista_val[$iinv].$array_asientos[$lista_val[$iinv]].$_SESSION['formularioweb_asite_id'].'_'.date("YmdHis").'.png';
				  $qrCode->writeFile('temporal/'.$mombre_grafico);
				  $imageData = base64_encode($image);//Codifico la imagen usando base64_encode 
			
			$lista_invidtados.="<b>Asiento:</b>".$array_asientos[$lista_val[$iinv]]." <b>".str_replace("/","&#47;",$rs_linv->fields["inv_parentesco"]).": </b>".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"]."<br><img src='data:image/png;base64,".$imageData."'><br><br>";
			
			//$datos_grafico='';
			//$datos_grafico=$imageData;
			//$archivo_grafico="temporal/QR_".$_SESSION['formularioweb_asite_id']."_".date("YmdHis").".jpg";
			//$id = fopen($archivo_grafico, 'w+');
			//$cadena = $dompdf->output();
			//fwrite($id, $datos_grafico);
			//fclose($id);
			
			$lista_invidtadoscorreo.="<b>Asiento:</b>".$array_asientos[$lista_val[$iinv]]." <b>".str_replace("/","&#47;",$rs_linv->fields["inv_parentesco"]).": </b>".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"]."<br><img src='temporal/".$mombre_grafico."' width='200' height='200' ><br><br><br><br>";
			
	      }
		  else
		  {
		    $codigo_valor=$array_reserv_id[$lista_val[$iinv]]."-".$lista_val[$iinv]."-".$array_asientos[$lista_val[$iinv]]."-".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"];
				  
				  $qrCode = new QrCode($codigo_valor);//Creo una nueva instancia de la clase
				  $qrCode->setSize("200");//Establece el tamaño del qr
				  //header('Content-Type: '.$qrCode->getContentType());
				  $image= $qrCode->writeString();//Salida en formato de texto 
				  $mombre_grafico='QR_'.$lista_val[$iinv].$array_asientos[$lista_val[$iinv]].$_SESSION['formularioweb_asite_id'].'_'.date("YmdHis").'.png';
				  $qrCode->writeFile('temporal/'.$mombre_grafico);
				  $imageData = base64_encode($image);//Codifico la imagen usando base64_encode 
		  
		  
		    $lista_invidtados.="<b>Asiento:</b>".$array_asientos[$lista_val[$iinv]]."  ".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"]."<br><img src='data:image/png;base64,".$imageData."'><br><br>";
			
			//$archivo_grafico="temporal/QR_".$_SESSION['formularioweb_asite_id']."_".date("YmdHis").".jpg";
			//$id = fopen($archivo, 'w+');
			//$cadena = $dompdf->output();
			//fwrite($id, "data:image/png;base64,".$imageData);
			//fclose($id);
			
			$lista_invidtadoscorreo.="<b>Asiento:</b>".$array_asientos[$lista_val[$iinv]]."  ".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"]."<br><img src='temporal/".$mombre_grafico."' width='200' height='200' ><br><br><br><br>";
			
		  } 
		}
	  }  

 $mapa_va='';
 $mapa_va=genera_mapa($sala_id_val,$_POST["fecha_rserva"],$_SESSION['formularioweb_asite_id'],$_POST["even_id"],$DB_gogess);
	  
 $contenido_val='';
 $contenido_val='
 <style>
  .txt_letra{
  font-family:Verdana, Arial, Helvetica, sans-serif;
  font-size:10px;
  }
 </style>
 <center>
 <b>PASE DE INGRESO</b> <br><br><table width="56%" border="1" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td height="70" bgcolor="#FFFFFF" class="txt_letra" ><br><div align="center"><b>RESERVADO PARA:</b> <BR> 
      <b>EVENTO:</b> '.$rs_evento->fields["even_nombre"].'<BR>
	  <b>LUGAR:</b> '.$rs_evento->fields["sala_nombre"].'<BR>	  
      <b>FECHA:</b> '.$_POST["fecha_rserva"].'<br>
      <b>HORA:</b> '.$rs_evento->fields["even_horario"].'<br>
      <b>D&Iacute;A:</b> '.$rs_evento->fields["dia_nombre"].' <br><br>
	  
    </div>
	</td>
  </tr>
</table>
'.$lista_invidtadoscorreo.'
<div style="page-break-after: always"></div>
'.$mapa_va.'
</center>
<br><center><b><br>&iexcl;Garanticemos un espacio sano y seguro para todos!</b></center><br>
';


$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'portrait');
$dompdf->load_html(utf8_decode($contenido_val), 'UTF-8');
$dompdf->render();
$font = Font_Metrics::get_font("helvetica", "bold");
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();

$canvas->page_text(530, 833, "{PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0,0,0));
$canvas->close_object();
$canvas->add_object($footer, "all");

$archivo = "temporal/PASE_DE_INGRESO_".$_SESSION['formularioweb_asite_id']."_".date("YmdHis").".pdf";
$patharchpdf=$archivo;
$nombrearchpdf="PASE_DE_INGRESO_".$_SESSION['formularioweb_asite_id']."_".date("YmdHis").".pdf";
					
$id = fopen($archivo, 'w+');
$cadena = $dompdf->output();
fwrite($id, $cadena);
fclose($id);


$archivos[0]["path"]=$patharchpdf;
$archivos[0]["nombre"]=$nombrearchpdf;

$contenido_val='<center><table width="56%" border="1" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td height="70" bgcolor="#FFFFFF"><br><div align="center"><b>RESERVADO PARA:</b> <BR> 
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


$contenido_valmostrar='';
$contenido_valmostrar='<table width="56%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td height="70" bgcolor="#FFFFFF"><br><div align="center"><b>RESERVADO PARA:</b> <BR> 
      <b>EVENTO:</b> '.$rs_evento->fields["even_nombre"].'<BR>
	  <b>LUGAR:</b> '.$rs_evento->fields["sala_nombre"].'<BR>	  
      <b>FECHA:</b> '.$_POST["fecha_rserva"].'<br>
      <b>HORA:</b> '.$rs_evento->fields["even_horario"].'<br>
      <b>D&Iacute;A:</b> '.$rs_evento->fields["dia_nombre"].' <br><br>
	  
	  <button class="ui-btn" onClick="ver_mapa('.$sala_id_val.',\''.$_POST["fecha_rserva"].'\','.$_POST['even_id'].',\''.$_SESSION['formularioweb_asite_id'].'\')" style="background-color:#FFC63F; color:#FFFFFF;font-size:13px; width:300px">VER MAPA</button>
	  
    </div>
	</td>
  </tr>
  <tr>
    <td><center>
	   '.$lista_invidtados.'
	</center></td>
  </tr>
</table>
<br><center><b><br>Lleve el d&iacute;a del culto la reserva impresa o digital para el ingreso. Esta reserva tambi&eacute;n le llegar&aacute; al mail de registro.<br>&iexcl;Garanticemos un espacio sano y seguro para todos!</b></center><br>
';

echo  $contenido_valmostrar;


//echo '<button class="ui-btn" onClick="reserva_cancelar()" style="background-color:#3364AA; color:#FFFFFF">CANCELAR</button>';
echo '<button class="ui-btn" onClick="reserva_cancelar()" style="background-color:#002C46; color:#FFFFFF;font-size:13px; width:300px">CANCELAR RESERVA</button><br>';

$autoriza_ingresox="select * from app_asisten where asite_id='".$_POST["asite_id"]."'";
$rs_gogessformx = $DB_gogess->executec($autoriza_ingresox);

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
$empresa_data="select * from app_empresa where emp_id=1";
$rs_empdata = $DB_gogess->executec($empresa_data);
$emp_emailreservas=$rs_empdata->fields["emp_emailreservas"];

$persona_iglesia=";gabomayorga@hotmail.com";
$emails_enviar=$rs_gogessformx->fields["asite_email"].";".$emp_emailreservas;
$formato_email="select email_titulo,email_texto from app_emailformato where email_id=15";
$reslt_formato= $DB_gogess->executec($formato_email,array());

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

}


  
  
}
?>
<script type="text/javascript">
<!--

function ver_mapa(sala_id,fecha_busca,even_id,asite_id)
{
   var url = 'sala/asientos.php?sala_id='+sala_id+'&fecha_busca='+fecha_busca+'&even_id='+even_id+'&reserv_id='+asite_id;
   window.open(url , '_blank');

}
//  End -->
</script>