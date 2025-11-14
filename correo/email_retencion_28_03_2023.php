<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include("libreria/envio.php");

include("codebarra/Barcode.php");
require_once("../libreria/dompdf/dompdf_config.inc.php");

require_once("PHPMailer_v51/class.phpmailer.php");
require_once("PHPMailer_v51/class.smtp.php");
include("config_email_phpmailer.php");

$objformulario= new  ValidacionesFormulario();

$nauto='';
$fechaaut='';
$logotipo_imd='';
$code_barra='';
$griddata='';
$valor_total='';
$valorsiniva_total='';
$valornograbado='';
$pathextrap='';
$offline_valor='';
$datos_ad=array();

$datos_inserta=array();

if($_SESSION['ces1313777_sessid_inicio'])
{
  $compretcab_id='';
  $compretcab_id=@$_POST["compretcab_id"];  
  
  
  
  $datos_empresa="select * from app_empresa where emp_id='".$_SESSION['ces1313777_sessid_emp_id']."'";
						   $rs_empresa = $DB_gogess->executec($datos_empresa,array());
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $emp_nombre=$rs_empresa->fields["emp_nombre"];
								  $emp_ruc=$rs_empresa->fields["emp_ruc"];
								  $emp_direccion=$rs_empresa->fields["emp_direccion"];
								  $emp_logo=$rs_empresa->fields["emp_logo"];
								  
								  $datos_ad["telefono"]=$rs_empresa->fields["emp_telefono"];
								  $datos_ad["email"]=$rs_empresa->fields["emp_email"];
								
								
								if($emp_logo)
								{
								$logotipo_imd= '<div id=div_logo ><img src="../archivo/'.$emp_logo.'"  width="180"  /></div>';
								}
								
								 $rs_empresa->MoveNext();
								}	
						   }
  
  if($compretcab_id)
  {
  $buscafacsinxml="select * from comprobante_retencion_cab where compretcab_estadosri='AUTORIZADO' and compretcab_id='".$compretcab_id."' and emp_id='".$_SESSION['ces1313777_sessid_emp_id']."' limit 1";    
  $buscafacsinxml="select * from comprobante_retencion_cab where compretcab_estadosri='AUTORIZADO' and  compretcab_id='".$compretcab_id."' and emp_id='".$_SESSION['ces1313777_sessid_emp_id']."' limit 1";   
  }
  else
  {
  $buscafacsinxml="select * from comprobante_retencion_cab where compretcab_estadosri='AUTORIZADO' and compretcab_enviomail='0' and compretcab_email_cliente!='' and emp_id='".$_SESSION['ces1313777_sessid_emp_id']."' limit 20";
  
  $buscafacsinxml="select * from comprobante_retencion_cab where (compretcab_anulado='' or  compretcab_anulado='0') and compretcab_estadosri='AUTORIZADO' and compretcab_enviomail!='1' and compretcab_email_cliente!='' and emp_id='".$_SESSION['ces1313777_sessid_emp_id']."' limit 1";
  }
  
  echo $buscafacsinxml."<br>";
  
  $bandera_valor='0';
  $rs_lista = $DB_gogess->executec($buscafacsinxml,array());
				if($rs_lista)
				{   
				   while (!$rs_lista->EOF) {
    
                           $bandera_valor='1';
                           $id_comprobante=$rs_lista->fields["compretcab_id"];
                           $xml=$rs_lista->fields["compretcab_id"];
                           
				           $compretcab_clavedeaccesos=$rs_lista->fields["compretcab_clavedeaccesos"];
				           $compretcab_clavedeaccesos=$rs_lista->fields["compretcab_clavedeaccesos"];
					       $compretcab_nombrerazon_cliente=$rs_lista->fields["compretcab_nombrerazon_cliente"];
					       $email_cliente=str_replace(",",";",$rs_lista->fields["compretcab_email_cliente"])."";
                           $compretcab_nretencion=trim($rs_lista->fields["compretcab_nretencion"]);
                           $tipo_comp=$rs_lista->fields["compretcab_tipocomprobante"];
                           $compretcab_xmlfirmado=$rs_lista->fields["compretcab_xmlfirmado"];
                           $estadoarch=$rs_lista->fields["compretcab_estadosri"];
                           $compretcab_nautorizacion=$rs_lista->fields["compretcab_nautorizacion"];
                           $compretcab_fechaaut=$rs_lista->fields["compretcab_fechaaut"];
                           $compretcab_tipocomprobante=$rs_lista->fields["compretcab_tipocomprobante"];
						   
						   $compretcab_fechaemision_cliente=$rs_lista->fields["compretcab_fechaemision_cliente"];
						   
						   $fechaaut=$rs_lista->fields["compretcab_fechaaut"];
                           
                           
						   //$email_cliente="franklin.aguas@gmail.com";
                           
                           //$compretcab_ambiente=$objformulario->replace_cmb("beko_empdocumento","emp_id,compretcab_ambiente","where tipocmp_codigo='".$tipocmp_codigo."' and emp_id=",@$_SESSION['ces1313777_sessid_emp_id'],$DB_gogess);
						   
						   $compretcab_ambiente=2;
						   
                           //$compretcab_emision=$objformulario->replace_cmb("beko_empdocumento","emp_id,tipoemi_codigo","where compretcab_tipocomprobante='".$compretcab_tipocomprobante."' and emp_id=",@$_SESSION['ces1313777_sessid_emp_id'],$DB_gogess);
						   
						   $compretcab_emision=1;

                           
                           if($compretcab_ambiente==1)
						   {
							 $datos_nombre='PRUEBAS';
						   }
						   if($compretcab_ambiente==2)
						   {
							 $datos_nombre='PRODUCCION';
						   }
                           
                           $data_xml=trim($rs_lista->fields["compretcab_xml"]);
                           $xml_rest=base64_decode($data_xml);
                           $offline_valor=1;
                           
                           $path_barracode="../codigodebarra/";
                           generacodebarra($path_barracode,$compretcab_clavedeaccesos,$xml,$tipo_comp);
                           
                           $code_barra='<img src="'.$path_barracode.$tipo_comp.$xml.'.gif'.'" width="300" height="60" >';
                           $comprobantepdf=leer_xml(0,$xml_rest,'07',@$nauto,@$fechaaut,@$logotipo_imd,@$code_barra,@$griddata,@$valor_total,@$valorsiniva_total,@$valornograbado,@$pathextrap,@$offline_valor);
						   
                           //echo $comprobantepdf;

                           
                            $dompdf = new DOMPDF();
							$dompdf->set_paper('A4', 'portrait');
        					$dompdf->load_html($comprobantepdf, 'UTF-8');
        					$dompdf->render();
							$font = Font_Metrics::get_font("helvetica", "bold");
							$canvas = $dompdf->get_canvas();
							$footer = $canvas->open_object();
							$canvas->page_text(530, 833, "{PAGE_NUM} de {PAGE_COUNT}",$font, 10, array(0,0,0));
							$canvas->close_object();
							$canvas->add_object($footer, "all");

                            $archivo = "temporal/RET_".$emp_ruc."_".$compretcab_nretencion.".pdf";
        					$patharchpdf=$archivo;
        					$nombrearchpdf="RET_".$emp_ruc."_".$compretcab_nretencion.".pdf";
        					
        	                $id = fopen($archivo, 'w+');
        					$cadena = $dompdf->output();
        					fwrite($id, $cadena);
        					fclose($id);
        					
        					
        					$archivostring=base64_decode($compretcab_xmlfirmado);
        					$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
        					<autorizacion>
        					<estado>'.$estadoarch.'</estado>
        					<numeroAutorizacion>'.$compretcab_nautorizacion.'</numeroAutorizacion>
        					<fechaAutorizacion>'.$compretcab_fechaaut.'</fechaAutorizacion>
        					<ambiente>'.$datos_nombre.'</ambiente>
        					<comprobante><![CDATA[';
        					
        					$comprovante_autpie=']]></comprobante>
        					</autorizacion>';
        					$archivoaut=$comprovante_aut.$archivostring.$comprovante_autpie;
        					
        					
        					$archivo = "temporal/RET_".$emp_ruc."_".$compretcab_nretencion.".xml";
        					$patharchxml=$archivo;
        					$nombrearchxml="RET_".$emp_ruc."_".$compretcab_nretencion.".xml";
        					
        					$id = fopen($archivo, 'w+');
        					$cadena = $archivoaut;
        					fwrite($id, $cadena);
        					fclose($id);
                           
                            $archivos[0]["path"]=$patharchpdf;
					        $archivos[0]["nombre"]=$nombrearchpdf;
					
					        $archivos[1]["path"]=$patharchxml;
					        $archivos[1]["nombre"]=$nombrearchxml;
					        
					        //quitar
					        //$email_cliente.=";franklin.aguas@gmail.com";
							//$email_cliente.=";franklin.aguas@gmail.com";
					        //quitar
					        
					        unset($lista_emails);
        					$lista_emails=explode(";",$email_cliente);
        					$emvalido=0;
        					$noemvalido=0;
        					for($iem=0;$iem<count($lista_emails);$iem++)
        					{
        					
        					  if (filter_var($lista_emails[$iem], FILTER_VALIDATE_EMAIL)) {
        					       
        					       $email_valido[$emvalido]=$lista_emails[$iem];
        						   $datos_inserta["repem_email"]=$datos_inserta["repem_email"].";".$email_valido[$emvalido];
        					       $emvalido++;
        						   
        					  }
        					  else
        					  {
        					       $email_novalido[$noemvalido]=$lista_emails[$iem];
        						   $datos_inserta["repem_emailnovalido"]=$datos_inserta["repem_emailnovalido"].";".$email_novalido[$noemvalido];
        					       $noemvalido++;
        					  
        					  }
        					
        					}
					        
							
						if(count($email_valido)>0)
						{
						
						    $datos_mail["documento"]='RETENCION';
						    $datos_mail["fecha"]=$compretcab_fechaemision_cliente;
						    $datos_mail["ndocumento"]=$compretcab_nretencion;
						    $datos_mail["claveacceso"]=$compretcab_clavedeaccesos;
						    $datos_mail["cliente"]=$compretcab_nombrerazon_cliente;
							
					        //print_r($email_valido);
					        $texto_valor='';
					        $estado_correo=enviar_correo("RET_".$compretcab_nretencion."_COMPROBANTES ELECTRONICO",$archivos,$email_valido,$compretcab_nombrerazon_cliente,$emp_nombre,"COMPROBANTE ELECTRONICO",$texto_valor,'',$datos_mail,$DB_gogess);
							
							
							
                            if($estado_correo==1)
						    {
						       echo 'ENVIADO SATISFACTORIAMENTE...<br>'.$compretcab_nretencion."<br>";  
						       
						       $actualizaemail="update comprobante_retencion_cab set compretcab_enviomail='1',compretcab_enviomailfecha='".$fechahoy."' where compretcab_id='".$id_comprobante."'";
                               $okv=$DB_gogess->executec($actualizaemail,array());
							   unlink($patharchpdf);
							   unlink($patharchxml);
							   
							     echo '<meta http-equiv="refresh" content="15">';
							    $file = fopen("mailseviadosret".date("Y-m-d").".txt", "a+");
								fwrite($file, $compretcab_nretencion."-->".date("Y-m-d H:i:s"). PHP_EOL);
								fclose($file);
							   
						    }
                            if($estado_correo==0)
						    {
						       echo 'ERROR AL ENVIAR CORREO CONEXION NO VALIDAD...<br>';
						       unlink($patharchpdf);
	                           unlink($patharchxml);
							   
							   $file = fopen("mailsret".date("Y-m-d").".txt", "a+");
								fwrite($file, $compretcab_nretencion."-->".date("Y-m-d H:i:s"). PHP_EOL);
								fclose($file);	
						    }
                      
					  }
					  else
					  {
					  
					            $file = fopen("mailsret".date("Y-m-d").".txt", "a+");
								fwrite($file, $compretcab_nretencion."-->".date("Y-m-d H:i:s"). PHP_EOL);
								fclose($file);
					  
					  
					  }
					        
                      $rs_lista->MoveNext();
				   }
				}   
    
    if($bandera_valor==0)
    {
        echo "<b>DOCUMENTO AUN NO ESTA AUTORIZASO O NO EXISTEN DOCUMENTOS PARA ENVIAR...</b>";
        
    }
    
    
}    

			
?>