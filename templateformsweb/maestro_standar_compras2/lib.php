<?php


function leer_xml_env($xml)
{
 
	try {  
		
 $struct_detail = new SimpleXMLElement($xml);
//print_r($struct_detail);
 
 if($struct_detail)
 {

 //--------------------------------- 
if($struct_detail->estado)
{
$estadoautoriacion=$struct_detail->estado->__toString();
}
if($struct_detail->numeroAutorizacion)
{
$nautorizacion=$struct_detail->numeroAutorizacion->__toString();
}
if($struct_detail->fechaAutorizacion)
{
$fechaautorizacion=$struct_detail->fechaAutorizacion->__toString();
}
if($struct_detail->ambiente)
{
$ambienteautorizacion=$struct_detail->ambiente->__toString();
}
if($struct_detail->comprobante)
{
$comprobante=trim($struct_detail->comprobante);
$comprobante=str_replace("<![CDATA[","",$comprobante);
$comprobante=str_replace("]]>","",$comprobante);
$comprobante=str_replace("&lt;","<",$comprobante);
$comprobante=str_replace("&gt;",">",$comprobante);

$datosrr=leercampos_xml_t($comprobante);
}


	   return $datosrr;
	   
	  //---------------------------------
	  } 
	   

	} catch (Exception $e) { 
	

	
	}
	
}




function leercampos_xml_t($xml)
	{
	  
	  $struct_detail = new SimpleXMLElement($xml); 
	  
	  if($struct_detail->infoTributaria->claveAcceso)
	   {
	   $datosrr["claveAcceso"] = $struct_detail->infoTributaria->claveAcceso->__toString();
	   }
	 
	  $datosrr["ruc"] = $struct_detail->infoTributaria->ruc->__toString();
	  $datosrr["codDoc"] = $struct_detail->infoTributaria->codDoc->__toString();
	  $datosrr["estab"] = $struct_detail->infoTributaria->estab->__toString();
	  $datosrr["ptoEmi"] = $struct_detail->infoTributaria->ptoEmi->__toString();
	  $datosrr["secuencial"] = $struct_detail->infoTributaria->secuencial->__toString(); 	  
	  
	  $datosrr["razonSocial"] = $struct_detail->infoTributaria->razonSocial->__toString(); 
	  $datosrr["ruc"] = $struct_detail->infoTributaria->ruc->__toString(); 
	  $datosrr["dirMatriz"] = $struct_detail->infoTributaria->dirMatriz->__toString(); 
	  $datosrr["nombreComercial"] = $struct_detail->infoTributaria->nombreComercial->__toString(); 
	  
	  
	  
	  
	  
	  if($datosrr["codDoc"]=='01')
	   {
	
	   $datosrr["identificacionComprador"] = $struct_detail->infoFactura->identificacionComprador->__toString();
	   $datosrr["razonSocialComprador"] = $struct_detail->infoFactura->razonSocialComprador->__toString();
	   $datosrr["fechaemision"] = $struct_detail->infoFactura->fechaEmision->__toString();	   
	   $datosrr["totalsinimpuestos"] = $struct_detail->infoFactura->totalSinImpuestos->__toString();
	   $datosrr["importetotal"] = @$struct_detail->infoFactura->importeTotal->__toString();
       }
	   
	   return $datosrr;
	}


function formato_fecha($fecha)
{ 
  
  $separa=array();
  $separa=explode("/",$fecha);  
  $nueva_fecha='';  
  $nueva_fecha=$separa[2]."-".$separa[1]."-".$separa[0];

   return $nueva_fecha;
}	
?>