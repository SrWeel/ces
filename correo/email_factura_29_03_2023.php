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

$datos_inserta=array();

$datos_mail=array();

if($_SESSION['ces1313777_sessid_inicio'])
{
  $doccab_id='';
  $doccab_id=@$_POST["doccab_id"];  
  
  
  
  $datos_empresa="select * from app_empresa where emp_id='".$_SESSION['ces1313777_sessid_emp_id']."'";
						   $rs_empresa = $DB_gogess->executec($datos_empresa,array());
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $emp_nombre=$rs_empresa->fields["emp_nombre"];
								  $emp_ruc=$rs_empresa->fields["emp_ruc"];
								  $emp_direccion=$rs_empresa->fields["emp_direccion"];
								  $emp_logo=$rs_empresa->fields["emp_logo"];
								
								
								
								if($emp_logo)
								{
								$logotipo_imd= '<div id=div_logo ><img src="../archivo/'.$emp_logo.'"  width="180"  /></div>';
								}
								
								 $rs_empresa->MoveNext();
								}	
						   }
  
  if($doccab_id)
  {
  $buscafacsinxml="select * from beko_documentocabecera where doccab_estadosri='AUTORIZADO' and doccab_id='".$doccab_id."' and emp_id='".$_SESSION['ces1313777_sessid_emp_id']."' limit 1";    
 // $buscafacsinxml="select * from beko_documentocabecera where  doccab_id='".$doccab_id."' and emp_id='".$_SESSION['ces1313777_sessid_emp_id']."' limit 1";   
  }
  else
  {
  //$buscafacsinxml="select * from beko_documentocabecera where doccab_estadosri='AUTORIZADO' and doccab_enviomail='0' and doccab_email_cliente!='' and emp_id='".$_SESSION['ces1313777_sessid_emp_id']."' limit 20";
  $buscafacsinxml="select * from beko_documentocabecera where doccab_estadosri='AUTORIZADO' and doccab_enviomail='0' and doccab_email_cliente!='' and doccab_origen='' and emp_id='".$_SESSION['ces1313777_sessid_emp_id']."' limit 1";
  }
  $bandera_valor='0';
  $rs_lista = $DB_gogess->executec($buscafacsinxml,array());
				if($rs_lista)
				{   
				   while (!$rs_lista->EOF) {
    
                           $bandera_valor='1';
                           $id_comprobante=$rs_lista->fields["doccab_id"];
                           $xml=$rs_lista->fields["doccab_id"];
                           
				           $idbuscarenvio=$rs_lista->fields["doccab_clavedeaccesos"];
						   
						   $comcab_fechaemision_cliente=$rs_lista->fields["doccab_fechaemision_cliente"];
						   $comcab_nfactura=trim($rs_lista->fields["doccab_ndocumento"]);
						   
				           $doccab_clavedeaccesos=$rs_lista->fields["doccab_clavedeaccesos"];
					       $doccab_nombrerazon_cliente=$rs_lista->fields["doccab_nombrerazon_cliente"];
					       $email_cliente=$rs_lista->fields["doccab_email_cliente"];
                           $doccab_ndocumento=trim($rs_lista->fields["doccab_ndocumento"]);
                           $tipo_comp=$rs_lista->fields["tipocmp_codigo"];
                           $doccab_xmlfirmado=$rs_lista->fields["doccab_xmlfirmado"];
                           $estadoarch=$rs_lista->fields["doccab_estadosri"];
                           $doccab_nautorizacion=$rs_lista->fields["doccab_nautorizacion"];
                           $doccab_fechaaut=$rs_lista->fields["doccab_fechaaut"];
                           $tipocmp_codigo=$rs_lista->fields["tipocmp_codigo"];
						   
						    $fechaaut=$rs_lista->fields["doccab_fechaaut"];
                           
                           
						   //$email_cliente="falider@hotmail.com";
                           
                           //$ambi_valor=$objformulario->replace_cmb("beko_empdocumento","emp_id,ambi_valor","where tipocmp_codigo='".$tipocmp_codigo."' and emp_id=",@$_SESSION['ces1313777_sessid_emp_id'],$DB_gogess);
						   
						   $ambi_valor=$rs_lista->fields["ambi_valor"];
						   
                           //$emis_valor=$objformulario->replace_cmb("beko_empdocumento","emp_id,tipoemi_codigo","where tipocmp_codigo='".$tipocmp_codigo."' and emp_id=",@$_SESSION['ces1313777_sessid_emp_id'],$DB_gogess);
						   
						   $emis_valor=$rs_lista->fields["emis_valor"];

                           
                           if($ambi_valor==1)
						   {
							 $datos_nombre='PRUEBAS';
						   }
						   if($ambi_valor==2)
						   {
							 $datos_nombre='PRODUCCION';
						   }
                           
                           $data_xml=trim($rs_lista->fields["doccab_xml"]);
                           $xml_rest=base64_decode($data_xml);
                           $offline_valor=1;
                           
                           $path_barracode="../codigodebarra/";
                           generacodebarra($path_barracode,$doccab_clavedeaccesos,$xml,$tipo_comp);
                           
                           $code_barra='<img src="'.$path_barracode.$tipo_comp.$xml.'.gif'.'" width="300" height="60" >';
                           $comprobantepdf=leer_xml(0,$xml_rest,'01',@$nauto,@$fechaaut,@$logotipo_imd,@$code_barra,@$griddata,@$valor_total,@$valorsiniva_total,@$valornograbado,@$pathextrap,@$offline_valor);
						   
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

                            $archivo = "temporal/FAC_".$emp_ruc."_".$doccab_ndocumento.".pdf";
        					$patharchpdf=$archivo;
        					$nombrearchpdf="FAC_".$emp_ruc."_".$doccab_ndocumento.".pdf";
        					
        	                $id = fopen($archivo, 'w+');
        					$cadena = $dompdf->output();
        					fwrite($id, $cadena);
        					fclose($id);
        					
        					
        					$archivostring=base64_decode($doccab_xmlfirmado);
        					$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
        					<autorizacion>
        					<estado>'.$estadoarch.'</estado>
        					<numeroAutorizacion>'.$doccab_nautorizacion.'</numeroAutorizacion>
        					<fechaAutorizacion>'.$doccab_fechaaut.'</fechaAutorizacion>
        					<ambiente>'.$datos_nombre.'</ambiente>
        					<comprobante><![CDATA[';
        					
        					$comprovante_autpie=']]></comprobante>
        					</autorizacion>';
        					$archivoaut=$comprovante_aut.$archivostring.$comprovante_autpie;
        					
        					
        					$archivo = "temporal/FAC_".$emp_ruc."_".$doccab_ndocumento.".xml";
        					$patharchxml=$archivo;
        					$nombrearchxml="FAC_".$emp_ruc."_".$doccab_ndocumento.".xml";
        					
        					$id = fopen($archivo, 'w+');
        					$cadena = $archivoaut;
        					fwrite($id, $cadena);
        					fclose($id);
                           
                            $archivos[0]["path"]=$patharchpdf;
					        $archivos[0]["nombre"]=$nombrearchpdf;
					
					        $archivos[1]["path"]=$patharchxml;
					        $archivos[1]["nombre"]=$nombrearchxml;
					        
					        //quitar
					       // $email_cliente.=";facturacion1@gradavsoftware.com";
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
						  $datos_mail["documento"]='FACTURA';
						  $datos_mail["fecha"]=$comcab_fechaemision_cliente;
						  $datos_mail["ndocumento"]=$comcab_nfactura;
						  $datos_mail["claveacceso"]=$idbuscarenvio;
						  $datos_mail["cliente"]=$comcab_nombrerazon_cliente;
					        
					        //print_r($email_valido);
					        $texto_valor='';
					        $estado_correo=enviar_correo("COMPROBANTES ELECTRONICO",$archivos,$email_valido,$doccab_nombrerazon_cliente,"","COMPROBANTE ELECTRONICO",$texto_valor,'',$datos_mail,$DB_gogess);
                            if($estado_correo==1)
						    {
						       echo 'ENVIADO SATISFACTORIAMENTE...<br>';  
						       $fechahoy=date("Y-m-d H:i:s");
						       $actualizaemail="update beko_documentocabecera set doccab_enviomail='1',doccab_enviomailfecha='".$fechahoy."' where doccab_id='".$id_comprobante."'";
                               $okv=$DB_gogess->executec($actualizaemail,array());
							   unlink($patharchpdf);
							   unlink($patharchxml);
							   
							   echo '<meta http-equiv="refresh" content="7">';
							    $file = fopen("mailseviados".date("Y-m-d").".txt", "a+");
								fwrite($file, $comcab_nfactura."-->".date("Y-m-d H:i:s"). PHP_EOL);
								fclose($file);
							   
						    }
                            if($estado_correo==0)
						    {
						       echo 'ERROR AL ENVIAR CORREO CONEXION NO VALIDAD...<br>';
						       unlink($patharchpdf);
	                           unlink($patharchxml);
							   
							    $file = fopen("mails".date("Y-m-d").".txt", "a+");
								fwrite($file, $comcab_nfactura."-->".date("Y-m-d H:i:s"). PHP_EOL);
								fclose($file);	

						    }
						}	
						else
						{
						        $file = fopen("mails".date("Y-m-d").".txt", "a+");
								fwrite($file, $comcab_nfactura."-->".date("Y-m-d H:i:s"). PHP_EOL);
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