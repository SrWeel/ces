<?php
function busca_cuenta($codigo,$DB_gogess)
{

$busca_cuenta="select * from lpin_plancuentas where planc_codigoc='".$codigo."'";
$okv_cuenta=$DB_gogess->executec($busca_cuenta,array());

return $okv_cuenta->fields["planc_id"];

}

function leercampos_xml_t($xml)
	{
	   $decimales=2;
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
	  
	  
	  
	  
	  
	  if($datosrr["codDoc"]=='01')
	   {
	
	   $datosrr["identificacionComprador"] = $struct_detail->infoFactura->identificacionComprador->__toString();
	   $datosrr["tipoIdentificacionComprador"] = $struct_detail->infoFactura->tipoIdentificacionComprador->__toString();
	   $datosrr["razonSocialComprador"] = $struct_detail->infoFactura->razonSocialComprador->__toString();
	   $datosrr["direccionComprador"] = $struct_detail->infoFactura->direccionComprador->__toString();
	   $datosrr["fechaemision"] = $struct_detail->infoFactura->fechaEmision->__toString();
	   $datosrr["dirEstablecimiento"] = $struct_detail->infoFactura->dirEstablecimiento->__toString();	   
	   $datosrr["totalsinimpuestos"] = $struct_detail->infoFactura->totalSinImpuestos->__toString();
	   $datosrr["importetotal"] = @$struct_detail->infoFactura->importeTotal->__toString();
	   $datosrr["moneda"] = @$struct_detail->infoFactura->moneda->__toString();
	   $decimales=2;
	   $contador_det=0;
	   $numdetalle=count($struct_detail->detalles->detalle);
	   for($id=0;$id<$numdetalle;$id++)
		  {
		     $descriptxt=stripslashes(htmlentities($struct_detail->detalles->detalle[$id]->descripcion));
			 
			 $datosrr["detalles"][$contador_det]["codigo"]=$struct_detail->detalles->detalle[$id]->codigoPrincipal->__toString(); 
			 $datosrr["detalles"][$contador_det]["descripcion"]=$descriptxt;
			 $datosrr["detalles"][$contador_det]["cantidad"]=number_format($struct_detail->detalles->detalle[$id]->cantidad->__toString(), $decimales, ".", "");
			 $datosrr["detalles"][$contador_det]["preciounitario"]=number_format($struct_detail->detalles->detalle[$id]->precioUnitario->__toString(), 4, ".", ",");
			 $datosrr["detalles"][$contador_det]["descuento"]=number_format($struct_detail->detalles->detalle[$id]->descuento->__toString(), $decimales, ".", ",");
			  $datosrr["detalles"][$contador_det]["impuestocode"]=$struct_detail->detalles->detalle[$id]->impuestos->impuesto->codigo->__toString();
			  $datosrr["detalles"][$contador_det]["tarifacode"]=$struct_detail->detalles->detalle[$id]->impuestos->impuesto->codigoPorcentaje->__toString();
			 $datosrr["detalles"][$contador_det]["baseimponible"]=$struct_detail->detalles->detalle[$id]->impuestos->impuesto->baseImponible->__toString();
			 $datosrr["detalles"][$contador_det]["valorimpuesto"]=$struct_detail->detalles->detalle[$id]->impuestos->impuesto->valor->__toString();
			 
			 $datosrr["detalles"][$contador_det]["total"]=number_format($struct_detail->detalles->detalle[$id]->precioTotalSinImpuesto->__toString(), $decimales, ".", ",");
		    
		     $contador_det++;
		  }
		  
		   
			 
		$datosrr["formaPago"]=$struct_detail->infoFactura->pagos->pago->formaPago->__toString();
		$datosrr["total"]=number_format($struct_detail->infoFactura->pagos->pago->total->__toString(), $decimales, ".", "");
		$datosrr["plazo"]=$struct_detail->infoFactura->pagos->pago->plazo->__toString();
		$datosrr["unidadTiempo"]=$struct_detail->infoFactura->pagos->pago->unidadTiempo->__toString();;
			 
		
	   $contador_det=0;
	   $numimp=count($struct_detail->infoFactura->totalConImpuestos->totalImpuesto);
	   for($id=0;$id<$numimp;$id++)
		  {
		 
			 $datosrr["impuesto"][$contador_det]["codigo"]=$struct_detail->infoFactura->totalConImpuestos->totalImpuesto[$id]->codigo->__toString(); 
			 $datosrr["impuesto"][$contador_det]["codigoPorcentaje"]=$struct_detail->infoFactura->totalConImpuestos->totalImpuesto[$id]->codigoPorcentaje->__toString(); 
			 $datosrr["impuesto"][$contador_det]["descuentoAdicional"]=$struct_detail->infoFactura->totalConImpuestos->totalImpuesto[$id]->descuentoAdicional->__toString(); 
			 $datosrr["impuesto"][$contador_det]["baseImponible"]=$struct_detail->infoFactura->totalConImpuestos->totalImpuesto[$id]->baseImponible->__toString(); 
			 $datosrr["impuesto"][$contador_det]["valor"]=$struct_detail->infoFactura->totalConImpuestos->totalImpuesto[$id]->valor->__toString(); 
		    
		     $contador_det++;
		  }
		 
	   
	   
	   //
	   
       }
	   
	   return $datosrr;
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


function obtiene_sri($DB_gogess,$documento,$listcg_claveAcceso,$link_envio,$debug)
{

   $cliente = new nusoap_client($link_envio, true);
		$resultado = $cliente->call(
				 "autorizacionComprobante", 
					array(
							'claveAccesoComprobante' => $listcg_claveAcceso
						)
			);
	
	$error = $cliente->getError();
	if($debug==1)
	{
	  print_r($error); 
      print_r($resultado);
    }
	
	//print_r($resultado);
	//$resultados_sri=leer_xml_env($resultado); 	

    return @$resultado;
}

function obtener_resultado($datos)
 {
             //print_r($datos);
              $rsultadosri=$datos;
			  $autorizoeldato=0;
			  @$ncomprobantes=$rsultadosri["RespuestaAutorizacionComprobante"]["numeroComprobantes"];
			  
			 // echo "xxx".$ncomprobantes;
			  //echo $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["estado"];
			  if($ncomprobantes>=1)
			  {
				  //verifica si hay autorizacion	
				
				      if($ncomprobantes==1)
						{
								
						//igual a uno 
						$estado_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["estado"];
						$num_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["numeroAutorizacion"];
						$fecha_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["fechaAutorizacion"];
						$ambiente_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["ambiente"];						
					    $clvbusca=$datos["RespuestaAutorizacionComprobante"]["claveAccesoConsultada"];						
						@$motivo_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["mensaje"];
						@$identificador=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["identificador"];
					    @$documento=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["comprobante"];
						//igual a uno  
						
						}
						else
						{
										  //mayor a uno
				            for($i=0;$i<$ncomprobantes;$i++)
								{
										  
								$estado_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["estado"];
								$num_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["numeroAutorizacion"];
								$fecha_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["fechaAutorizacion"];
								$ambiente_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["ambiente"];								
								 $motivo_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["mensajes"]["mensaje"]["mensaje"];
								$identificador=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["mensajes"]["mensaje"]["identificador"];								
								$clvbusca=$datos["RespuestaAutorizacionComprobante"]["claveAccesoConsultada"];	
								 @$documento=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["comprobante"];
															
								if($estado_aut=='AUTORIZADO')
									{
										$i=$ncomprobantes+5;
									}
  
								}
								
								
										  //mayor a uno
			               }
										
			  }
				
		$sridata["estado"]=@$estado_aut;
		$sridata["motivo"]=@$motivo_aut;
		$sridata["codigo"]=@$identificador;
		$sridata["numaut"]=@$num_aut;
		$sridata["fechaaut"]=@$fecha_aut;
		$sridata["doc"]=@$documento;
		

  return $sridata;
 }

function envia_sri($DB_gogess,$documento,$id_documento,$link_envio,$debug)
{
  
if($documento=='01')
{
 $tabla='beko_documentocabecera';
 $campo_autoriza='doccab_nautorizacion';
 $campo_fechaaut='doccab_fechaaut';
 $campo_estadosri='doccab_estadosri';
 $campo_motivo='doccab_motivodev';
 $campo_id='doccab_id';
 $campo_xml='doccab_xmlfirmado';
 $tipocomp='tipocmp_codigo';
  $ndocumento='doccab_ndocumento';
}

if($documento=='03')
{
 $tabla='factur_lqcompra_cabecera';
 $campo_autoriza='doccab_nautorizacion';
 $campo_fechaaut='doccab_fechaaut';
 $campo_estadosri='doccab_estadosri';
 $campo_motivo='doccab_motivodev';
 $campo_id='doccab_id';
 $campo_xml='doccab_xmlfirmado';
 $tipocomp='tipocmp_codigo';
  $ndocumento='doccab_ndocumento';
}

if($documento=='04')
{
 $tabla='factur_credito_cab';
 $campo_autoriza='cre_nautorizacion';
 $campo_fechaaut='cre_fechaaut';
 $campo_estadosri='cre_estadosri';
 $campo_motivo='cre_motivodev';
 $campo_id='id_crecab';
 $campo_xml='cre_xmlfirmado';
 $tipocomp='cre_tipocomprobante';
 $ndocumento='cre_ncredito';
}

if($documento=='05')
{
 $tabla='factur_credito_cab';
 $campo_autoriza='cre_nautorizacion';
 $campo_fechaaut='cre_fechaaut';
 $campo_estadosri='cre_estadosri';
 $campo_motivo='cre_motivodev';
 $campo_id='id_crecab';
 $campo_xml='cre_xmlfirmado';
 $tipocomp='cre_tipocomprobante';
 $ndocumento='cre_ncredito';
}

if($documento=='06')
{
 $tabla='factur_guia_cabecera';
 $campo_autoriza='guiacab_nautorizacion';
 $campo_fechaaut='guiacab_fechaaut';
 $campo_estadosri='guiacab_estadosri';
 $campo_motivo='guiacab_motivodev';
 $campo_id='id_guiacab';
 $campo_xml='guiacab_xmlfirmado';
 $tipocomp='guiacab_tipocomprobante';
 $ndocumento='guiacab_nguia';
}

if($documento=='07')
{
 $tabla='comprobante_retencion_cab';
 $campo_autoriza='compretcab_nautorizacion';
 $campo_fechaaut='compretcab_fechaaut';
 $campo_estadosri='compretcab_estadosri';
 $campo_motivo='compretcab_motivodev';
 $campo_id='compretcab_id';
 $campo_xml='compretcab_xmlfirmado';
 $tipocomp='compretcab_tipocomprobante';
 $ndocumento='compretcab_nretencion';
}

 $busca_xml="select ".$campo_xml.",".$ndocumento." from ".$tabla." where ".$tipocomp."='".$documento."' and ".$campo_id."='".$id_documento."'";
 if($debug==1)
 {
  echo $busca_xml."<br>";
  echo $link_envio."<br>";  
 }
 $error=array();
 $resultado=array();
 $ok_bu=$DB_gogess->executec($busca_xml,array());
 $salida_xml=$ok_bu->fields[$campo_xml];
 $num_dpcumento=$ok_bu->fields[$ndocumento];
 
    $client = new nusoap_client($link_envio, true);
								$resultado = $client->call(
									 "validarComprobante", 
									  array(
											'xml' =>  $salida_xml
											)
								);	
								
	$error = $client->getError();
	if($debug==1)
	{
	  print_r($error); 
      print_r($resultado);
	}
	
	$arreglolista=$resultado;
	
	if($error)
    {
	   echo "ERROR DE CONEXION (".$id_documento.")<br>";
	   $actualiza="update ".$tabla." set ".$campo_autoriza."='',".$campo_fechaaut."='',".$campo_estadosri."='DEVUELTA',".$campo_motivo."='ERROR DE CONEXION' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
	   $okv=$DB_gogess->executec($actualiza,array());
	   $ready_estado='ERROR DE CONEXION';

	
	}	
	else
	{
	
	    $ready_estado=$arreglolista["RespuestaRecepcionComprobante"]["estado"];
		echo $ready_estado."<br>";
		if( $ready_estado=='DEVUELTA' or $ready_estado=='RECHAZADA' )
		{
	        echo $ready_estado." (".$id_documento.")<br>";
			$motivo='';
			$motivo=str_replace("'"," ",$arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["informacionAdicional"]).str_replace("'"," ",$arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["motivo"]);
			
		    $actualiza="update ".$tabla." set ".$campo_autoriza."='',".$campo_fechaaut."='',".$campo_estadosri."='".$ready_estado."',".$campo_motivo."='".$motivo."' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
			$okv=$DB_gogess->executec($actualiza,array());
			
	
		}
		else
		{
		    echo $ready_estado." (".$id_documento.")<br>";
			$actualiza="update ".@$tabla." set ".@$campo_autoriza."='',".@$campo_fechaaut."='',".@$campo_estadosri."='".@$ready_estado."',".@$campo_motivo."='".@$motivo."' where ".@$campo_id."='".@$id_documento."' and ".@$tipocomp."='".@$documento."'";
		    $okv=$DB_gogess->executec($actualiza,array());
			
		}

	
	}
	
	

}

function autoriza_sri($DB_gogess,$documento,$id_documento,$link_envio,$debug)
{

if($documento=='01')
{
 $tabla='beko_documentocabecera';
 $campo_autoriza='doccab_nautorizacion';
 $campo_fechaaut='doccab_fechaaut';
 $campo_estadosri='doccab_estadosri';
 $campo_motivo='doccab_motivodev';
 $campo_id='doccab_id';
 $campo_xml='doccab_xmlfirmado';
 $clave_acceo='doccab_clavedeaccesos';
 $tipocomp='tipocmp_codigo';
 $ndocumento='doccab_ndocumento';
}

if($documento=='03')
{
 $tabla='factur_lqcompra_cabecera';
 $campo_autoriza='doccab_nautorizacion';
 $campo_fechaaut='doccab_fechaaut';
 $campo_estadosri='doccab_estadosri';
 $campo_motivo='doccab_motivodev';
 $campo_id='doccab_id';
 $campo_xml='doccab_xmlfirmado';
 $clave_acceo='doccab_clavedeaccesos';
 $tipocomp='tipocmp_codigo';
 $ndocumento='doccab_ndocumento';
}

if($documento=='04')
{
 $tabla='factur_credito_cab';
 $campo_autoriza='cre_nautorizacion';
 $campo_fechaaut='cre_fechaaut';
 $campo_estadosri='cre_estadosri';
 $campo_motivo='cre_motivodev';
 $campo_id='id_crecab';
 $campo_xml='cre_xmlfirmado';
 $clave_acceo='cre_clavedeaccesos';
 $tipocomp='cre_tipocomprobante';
 $ndocumento='cre_ncredito';
}

if($documento=='05')
{
 $tabla='factur_credito_cab';
 $campo_autoriza='cre_nautorizacion';
 $campo_fechaaut='cre_fechaaut';
 $campo_estadosri='cre_estadosri';
 $campo_motivo='cre_motivodev';
 $campo_id='id_crecab';
 $campo_xml='cre_xmlfirmado';
 $clave_acceo='cre_clavedeaccesos';
 $tipocomp='cre_tipocomprobante';
  $ndocumento='cre_ncredito';
}

if($documento=='06')
{
 $tabla='factur_guia_cabecera';
 $campo_autoriza='guiacab_nautorizacion';
 $campo_fechaaut='guiacab_fechaaut';
 $campo_estadosri='guiacab_estadosri';
 $campo_motivo='guiacab_motivodev';
 $campo_id='id_guiacab';
 $campo_xml='guiacab_xmlfirmado';
 $clave_acceo='guiacab_clavedeaccesos';
 $tipocomp='guiacab_tipocomprobante';
  $ndocumento='guiacab_nguia';
}

if($documento=='07')
{
 $tabla='comprobante_retencion_cab';
 $campo_autoriza='compretcab_nautorizacion';
 $campo_fechaaut='compretcab_fechaaut';
 $campo_estadosri='compretcab_estadosri';
 $campo_motivo='compretcab_motivodev';
 $campo_id='compretcab_id';
 $campo_xml='compretcab_xmlfirmado';
 $clave_acceo='compretcab_clavedeaccesos';
 $tipocomp='compretcab_tipocomprobante';
 $ndocumento='compretcab_nretencion';
}

  $busca_xml="select ".$clave_acceo.",".$ndocumento." from ".$tabla." where ".$tipocomp."='".$documento."' and ".$campo_id."='".$id_documento."'";
 if($debug==1)
 {
  echo $busca_xml."<br>";
  echo $link_envio."<br>";  
 }
 $ok_bu=$DB_gogess->executec($busca_xml,array());
 $listcg_claveAcceso=$ok_bu->fields[$clave_acceo];
 
 $acceso_clv=$listcg_claveAcceso;
 $num_dpcumento=$ok_bu->fields[$ndocumento];
 
 //echo "....";
 
   $cliente = new nusoap_client($link_envio, true);
		$resultado = $cliente->call(
				 "autorizacionComprobante", 
					array(
							'claveAccesoComprobante' => $listcg_claveAcceso
						)
			);
	
	$error = $cliente->getError();
	if($debug==1)
	{
	  print_r($error); 
      print_r($resultado);
    }
	$resultados_sri=obtener_resultado($resultado);
	
	$arreglolista=$resultado;
	$resultados_sri["estado"]."<br>";
	if($error)
    {
	   
	   echo $resultados_sri["estado"]."(".$id_documento.")<br>";
	   $actualiza="update ".$tabla." set ".$campo_autoriza."='',".$campo_fechaaut."='',".$campo_estadosri."='DEVUELTA',".$campo_motivo."='ERROR DE CONEXION SRI' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
	   $okv=$DB_gogess->executec($actualiza,array());
	
	}	
	else
	{
	   
	    $ready_estado=$resultados_sri["estado"];		
		$motivo=str_replace("'"," ",$resultados_sri["codigo"]." ".$resultados_sri["motivo"]);		
		if($ready_estado=='DEVUELTA' or $ready_estado=='RECHAZADA' )
		{		
		   echo $ready_estado."(".$id_documento.") ".$motivo."<br>";
		   $actualiza="update ".$tabla." set ".$campo_autoriza."='',".$campo_fechaaut."='',".$campo_estadosri."='".$ready_estado."',".$campo_motivo."='".$motivo."' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
			$okv=$DB_gogess->executec($actualiza,array());
					
		
		}
		else
		{	
		
		   echo $actualiza="update ".$tabla." set ".$campo_autoriza."='".$resultados_sri["numaut"]."',".$campo_fechaaut."='".$resultados_sri["fechaaut"]."',".$campo_estadosri."='".$ready_estado."',".$campo_motivo."='".$motivo."' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
		   
		    $okv=$DB_gogess->executec($actualiza,array());
			if($ready_estado=='AUTORIZADO')
			{
			   echo $ready_estado."(".$id_documento.") <br>";
			   $date=date("Y-m-d");
			   ////////////			   
			}
			else
			{
			
			
			}
			
		
		}
	   
	
	}	
			


}



?>