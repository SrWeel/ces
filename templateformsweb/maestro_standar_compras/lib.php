<?php


function leer_xmlpj_v2_emv($xml)
{
 
 $datosrr=array();
 
	try {  
		
 $struct_detail = new SimpleXMLElement($xml);
//print_r($struct_detail);
 
 if($struct_detail)
 {
 //---------------------------------
 
		if($struct_detail->autorizaciones->autorizacion->estado)
		{
		$estadoautoriacion=$struct_detail->autorizaciones->autorizacion->estado->__toString();
		}
		if($struct_detail->autorizaciones->autorizacion->numeroAutorizacion)
		{
		$nautorizacion=$struct_detail->autorizaciones->autorizacion->numeroAutorizacion->__toString();
		}
		if($struct_detail->autorizaciones->autorizacion->fechaAutorizacion)
		{
		$fechaautorizacion=$struct_detail->autorizaciones->autorizacion->fechaAutorizacion->__toString();
		}
		if($struct_detail->autorizaciones->autorizacion->ambiente)
		{
		$ambienteautorizacion=$struct_detail->autorizaciones->autorizacion->ambiente->__toString();
		}
		if($struct_detail->autorizaciones->autorizacion->comprobante)
		{
		$comprobante=$struct_detail->autorizaciones->autorizacion->comprobante->__toString();
		$comprobante=str_replace("<![CDATA[","",$comprobante);
		$comprobante=str_replace("]]>","",$comprobante);
		$comprobante=str_replace("&lt;","<",$comprobante);
		$comprobante=str_replace("&gt;",">",$comprobante);
		
		$datosrr=leercampos_xml_t($comprobante);
		}

}

return $datosrr;

} catch (Exception $e) { 
	

	
	}

	
}


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



function leer_xml_env_sincab($xml)
{
 
	

$datosrr=leercampos_xml_t($xml);



	   return $datosrr;
	   

	
}



function leercampos_xml_t($xml)
	{
	  
	  $struct_detail = new SimpleXMLElement($xml); 
	  
	  //print_r($struct_detail);
	  
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
	  
	  
	  if($datosrr["codDoc"]=='04')
	   {
	      $datosrr["identificacionComprador"] = $struct_detail->infoNotaCredito->identificacionComprador->__toString();
	      $datosrr["razonSocialComprador"] = $struct_detail->infoNotaCredito->razonSocialComprador->__toString();
	      $datosrr["fechaemision"] = $struct_detail->infoNotaCredito->fechaEmision->__toString();	   
	      $datosrr["totalsinimpuestos"] = $struct_detail->infoNotaCredito->totalSinImpuestos->__toString();
	      $datosrr["importetotal"] = @$struct_detail->infoNotaCredito->valorModificacion->__toString(); 
		  
		  
		  $datosrr["codDocModificado"] = @$struct_detail->infoNotaCredito->codDocModificado->__toString(); 
		  $datosrr["numDocModificado"] = @$struct_detail->infoNotaCredito->numDocModificado->__toString(); 
		  $datosrr["importetotal"] = @$struct_detail->infoNotaCredito->valorModificacion->__toString(); 
		  
	   $decimales=2;
	   $contador_det=0;
	   $numdetalle=count($struct_detail->detalles->detalle);
	   for($id=0;$id<$numdetalle;$id++)
		  {
		     $descriptxt=stripslashes(htmlentities($struct_detail->detalles->detalle[$id]->descripcion));
			 
			 $datosrr["detalles"][$contador_det]["codigo"]=$struct_detail->detalles->detalle[$id]->codigoPrincipal->__toString();
			 $datosrr["detalles"][$contador_det]["cantidad"]=number_format($struct_detail->detalles->detalle[$id]->cantidad->__toString(), $decimales, ".", "");
			 $datosrr["detalles"][$contador_det]["descripcion"]=$descriptxt;
			 $datosrr["detalles"][$contador_det]["preciounitario"]=number_format($struct_detail->detalles->detalle[$id]->precioUnitario->__toString(), 4, ".", ",");
			 $datosrr["detalles"][$contador_det]["descuento"]=number_format($struct_detail->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",");
			 $datosrr["detalles"][$contador_det]["iva"]=$struct_detail->detalles->detalle[$id]->impuestos->impuesto->codigoPorcentaje->__toString();
			 $datosrr["detalles"][$contador_det]["total"]=number_format($struct_detail->detalles->detalle[$id]->precioTotalSinImpuesto->__toString(), $decimales, ".", ",");
		    
		     $contador_det++;
		  }
	   
		  
	   
	   } 
	  
	  
	  if($datosrr["codDoc"]=='01')
	   {
	
	   $datosrr["identificacionComprador"] = $struct_detail->infoFactura->identificacionComprador->__toString();
	   $datosrr["razonSocialComprador"] = $struct_detail->infoFactura->razonSocialComprador->__toString();
	   $datosrr["fechaemision"] = $struct_detail->infoFactura->fechaEmision->__toString();	   
	   $datosrr["totalsinimpuestos"] = $struct_detail->infoFactura->totalSinImpuestos->__toString();
	   $datosrr["importetotal"] = @$struct_detail->infoFactura->importeTotal->__toString();
	   $decimales=2;
	   $contador_det=0;
	   $numdetalle=count($struct_detail->detalles->detalle);
	   for($id=0;$id<$numdetalle;$id++)
		  {
		     $descriptxt=stripslashes(htmlentities($struct_detail->detalles->detalle[$id]->descripcion));
			 
			 $datosrr["detalles"][$contador_det]["codigo"]=$struct_detail->detalles->detalle[$id]->codigoPrincipal->__toString();
			 $datosrr["detalles"][$contador_det]["cantidad"]=number_format($struct_detail->detalles->detalle[$id]->cantidad->__toString(), $decimales, ".", "");
			 $datosrr["detalles"][$contador_det]["descripcion"]=$descriptxt;
			 $datosrr["detalles"][$contador_det]["preciounitario"]=number_format($struct_detail->detalles->detalle[$id]->precioUnitario->__toString(), 4, ".", ",");
			 $datosrr["detalles"][$contador_det]["descuento"]=number_format($struct_detail->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",");
			 $datosrr["detalles"][$contador_det]["iva"]=$struct_detail->detalles->detalle[$id]->impuestos->impuesto->codigoPorcentaje->__toString();
			 $datosrr["detalles"][$contador_det]["total"]=number_format($struct_detail->detalles->detalle[$id]->precioTotalSinImpuesto->__toString(), $decimales, ".", ",");
		    
		     $contador_det++;
		  }
	   
	   
	   //
	   
       }
	   
	   $numfpago=array();
	   $numfpago=$struct_detail->infoFactura->pagos;	   
	   $datosrr["formapago"]=$numfpago->pago->formaPago;
	   $datosrr["formapagototal"]=$numfpago->pago->total;
		//print_r($numfpago);
		
	   
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