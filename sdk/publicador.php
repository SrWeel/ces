<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include ("lib/nusoap.php");
$fechahoy=date("Y-m-d");

//phpinfo();

function leer_xmlpj_v2($xml)
{
   //$struct = new SimpleXMLElement($xml);
        //Extraer xml embebido
		//print_r($struct->soap:Envelope);
 $struct_detail = new SimpleXMLElement($xml);
//print_r($struct_detail);
 
 


$estadoautoriacion=$struct_detail->estado->__toString();
$nautorizacion=$struct_detail->numeroAutorizacion->__toString();
$fechaautorizacion=$struct_detail->fechaAutorizacion->__toString();
$ambienteautorizacion=$struct_detail->ambiente->__toString();
$comprobante=$struct_detail->comprobante->__toString();

$datosrr=leercampos_xmlx($comprobante);


$clavedeacceso=$datosrr["claveAcceso"];

$valores_generados=$clavedeacceso."|".$estadoautoriacion."|".$nautorizacion."|".$fechaautorizacion."|".$ambienteautorizacion;

//echo $valores_generados;
       //$xmlstr_detail=$struct->comprobante;	
	$res_lectura[0]= $valores_generados; 
	$res_lectura[1]=$struct_detail->comprobante->__toString();
	$res_lectura[2]=$clavedeacceso;
	if($ambienteautorizacion=='PRUEBAS')
	{
		$res_lectura[3]=1;
	}
	else
	{
		
		$res_lectura[3]=2;
	}
	
	   return $res_lectura;

	
}


function leercampos_xmlx($xml)
	{
	  //echo $xml;
	  $struct_detail = new SimpleXMLElement($xml);

       $datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente->__toString();
	   $datosrr["claveAcceso"] = $struct_detail->infoTributaria->claveAcceso->__toString();
	    $datosrr["ruc"] = $struct_detail->infoTributaria->ruc->__toString();
	   $datosrr["tipoEmision"] = $struct_detail->infoTributaria->tipoEmision->__toString();
	   $datosrr["codDoc"] =$struct_detail->infoTributaria->codDoc->__toString();
	   
	   
	   
	   
	  if($datosrr["codDoc"]=='01')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoFactura->razonSocialComprador->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoFactura->identificacionComprador->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoFactura->dirEstablecimiento->__toString();	 
      }
	  
	   
	  if($datosrr["codDoc"]=='03')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoLiquidacionCompra->razonSocialProveedor->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoLiquidacionCompra->identificacionProveedor->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoLiquidacionCompra->direccionProveedor->__toString();
	 
      }
	  
	   if($datosrr["codDoc"]=='04')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoNotaCredito->razonSocialComprador->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoNotaCredito->identificacionComprador->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoNotaCredito->dirEstablecimiento->__toString();
	
      }
	 
	  
	  
	  if($datosrr["codDoc"]=='05')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoNotaDebito->razonSocialComprador->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoNotaDebito->identificacionComprador->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoNotaDebito->dirEstablecimiento->__toString();

      }
	  
	  
	  if($datosrr["codDoc"]=='07')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoCompRetencion->razonSocialSujetoRetenido->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoCompRetencion->identificacionSujetoRetenido->__toString();
	 // $datosrr["comcab_direccion_cliente"] = $struct_detail->infoCompRetencion->dirEstablecimiento->__toString();
	
      }
	   
	   if($datosrr["codDoc"]=='06')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->destinatarios->destinatario->razonSocialDestinatario__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->destinatarios->destinatario->identificacionDestinatario->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoGuiaRemision->dirEstablecimiento->__toString();

      }
	  
	   
	  
	   return $datosrr;
}



$factura=array();
//PUBLICA FACTURA
$buscafacturas="select * from beko_documentocabecera where doccab_estadosri IN ('AUTORIZADO') and doccab_publicado not in ('1') limit 1";
//echo $buscafacturas;
$rs_gogessform = $DB_gogess->executec($buscafacturas,array());
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		


$datosrr=leercampos_xmlx(base64_decode($rs_gogessform->fields["doccab_xmlfirmado"]));

//print_r($datosrr);
$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
<autorizacion>
<estado>'.$rs_gogessform->fields["doccab_estadosri"].'</estado>
<numeroAutorizacion>'.$rs_gogessform->fields["doccab_nautorizacion"].'</numeroAutorizacion>
<fechaAutorizacion>'.$rs_gogessform->fields["doccab_fechaaut"].'</fechaAutorizacion>
<ambiente>'.$datosrr["ambiente"].'</ambiente>
<comprobante><![CDATA[';

$comprovante_autpie=']]></comprobante>
<mensajes/>
</autorizacion>';

$completo=$comprovante_aut.base64_decode($rs_gogessform->fields["doccab_xmlfirmado"]).$comprovante_autpie;
		
$res_lectura=leer_xmlpj_v2($completo);	

//print_r($res_lectura);  
$factura['xml']=base64_encode ($res_lectura[1]);
$factura['coop']=$datosrr["ruc"];
$factura['acceso']=$res_lectura[2];;
$factura['ruccli']="";
$factura['amb_val']=$res_lectura[3];
$factura['path_firma']="";
$factura['clave_firma']="";
$factura['quiere_firma']="";
$factura['txt_linea']='';
$factura['solo_publicar']='1';
$factura['data_publicar']=$res_lectura[0];
		
		
		print_r($factura);

    $cliente = new nusoap_client('http://181.112.155.5/publicador/gogess/wspublicar/server.php?wsdl');
    $resultado = $cliente->call('ValidarSri', array('factura' =>$factura));
	
	$error = $cliente->getError();
	print_r($error); 
	
	echo "Resultado".$resultado["estado"]."<br>";
	if ($resultado["estado"]=='FACTURA YA ESTA PUBLICADA' or   $resultado["estado"]=='FACTURA PUBLICADA')
	{
	    $actualizacomp="update beko_documentocabecera set  doccab_publicado=1 where doccab_id='".$rs_gogessform->fields["doccab_id"]."'";
	    // $okv=$DB_gogess->Execute($actualizacomp);
	}
     
		
		
		$rs_gogessform->MoveNext();	
		}
}
	


?>