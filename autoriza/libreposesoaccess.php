<?php

function obtener_resultado($datos)
 {
              $rsultadosri=$datos;
			  $autorizoeldato=0;
			  $ncomprobantes=$rsultadosri["RespuestaAutorizacionComprobante"]["numeroComprobantes"];
			  
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
						
						
						$motivo_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["mensaje"];
						$identificador=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["identificador"];
						
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
								
								if($estado_aut=='AUTORIZADO')
									{
										$i=$ncomprobantes+5;
									}
  
								}
								
								
										  //mayor a uno
			               }
										
			  }
				
		$sridata["estado"]=$estado_aut;
		$sridata["motivo"]=$motivo_aut;
		$sridata["codigo"]=$identificador;
		$sridata["numaut"]=$num_aut;
		$sridata["fechaaut"]=$fecha_aut;

  return $sridata;
 }

function envia_sri($DB_gogess,$documento,$id_documento)
{
  
if($documento=='01')
{
 $tabla='comprobante_fac_cabecera';
 $campo_autoriza='comcab_nautorizacion';
 $campo_fechaaut='comcab_fechaaut';
 $campo_estadosri='comcab_estadosri';
 $campo_motivo='comcab_motivodev';
 $campo_id='comcab_id';
 $campo_xml='comcab_xmlfirmado';
 $tipocomp='comcab_tipocomprobante';
  $ndocumento='comcab_nfactura';
}
if($documento=='04')
{
 $tabla='comprobante_credito_cab';
 $campo_autoriza='comcabcre_nautorizacion';
 $campo_fechaaut='comcabcre_fechaaut';
 $campo_estadosri='comcabcre_estadosri';
 $campo_motivo='comcabcre_motivodev';
 $campo_id='comcabcre_id';
 $campo_xml='comcabcre_xmlfirmado';
 $tipocomp='comcabcre_tipocomprobante';
 $ndocumento='comcabcre_ncredito';
}

if($documento=='05')
{
 $tabla='comprobante_credito_cab';
 $campo_autoriza='comcabcre_nautorizacion';
 $campo_fechaaut='comcabcre_fechaaut';
 $campo_estadosri='comcabcre_estadosri';
 $campo_motivo='comcabcre_motivodev';
 $campo_id='comcabcre_id';
 $campo_xml='comcabcre_xmlfirmado';
 $tipocomp='comcabcre_tipocomprobante';
 $ndocumento='comcabcre_ncredito';
}

if($documento=='06')
{
 $tabla='comprobante_guia_cabecera';
 $campo_autoriza='compguiacab_nautorizacion';
 $campo_fechaaut='compguiacab_fechaaut';
 $campo_estadosri='compguiacab_estadosri';
 $campo_motivo='compguiacab_motivodev';
 $campo_id='compguiacab_id';
 $campo_xml='compguiacab_xmlfirmado';
 $tipocomp='compguiacab_tipocomprobante';
 $ndocumento='compguiacab_nguia';
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
 

 $ok_bu=$DB_gogess->Execute($busca_xml);
 $salida_xml=$ok_bu->fields[$campo_xml];
 $num_dpcumento=$ok_bu->fields[$ndocumento];

 $client = new nusoap_client("https://cel.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl", true);
								$resultado = $client->call(
									 "validarComprobante", 
									  array(
											'xml' =>  $salida_xml
											)
								);	
	$error = $client->getError();
	print_r($error); 
	//print_r($resultado);
	$arreglolista=$resultado;
	
	if($error)
    {
	echo "ERROR DE CONEXION<br>";
	   $actualiza="update ".$tabla." set ".$campo_autoriza."='',".$campo_fechaaut."='',".$campo_estadosri."='DEVUELTA',".$campo_motivo."='ERROR DE CONEXION' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
	 //  $okv=$DB_gogess->Execute($actualiza);
	   $ready_estado='ERROR DE CONEXION';
	  guarda_base($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
	
	}	
	else
	{
	
	    $ready_estado=$arreglolista["RespuestaRecepcionComprobante"]["estado"];
		echo $ready_estado."<br>";
		if($ready_estado=='DEVUELTA')
		{
	
			
			$motivo=str_replace("'"," ",$arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["informacionAdicional"]).str_replace("'"," ",$arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["motivo"]);
			
			$actualiza="update ".$tabla." set ".$campo_autoriza."='',".$campo_fechaaut."='',".$campo_estadosri."='".$ready_estado."',".$campo_motivo."='".$motivo."' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
			//$okv=$DB_gogess->Execute($actualiza);
			
			
				 if($documento=='01')
				{   
			   guarda_base($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			 
			 
			if($documento=='07')
				{   
			    guarda_base_ret($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
					
					if($documento=='04' or $documento=='05')
				{   
			    guarda_base_nc($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			
			
	
		}
		else
		{
		    
			$actualiza="update ".$tabla." set ".$campo_autoriza."='',".$campo_fechaaut."='',".$campo_estadosri."='".$ready_estado."',".$campo_motivo."='".$motivo."' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
		  //  $okv=$DB_gogess->Execute($actualiza);
			
			
				 if($documento=='01')
				{   
			   guarda_base($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			 
			 
			if($documento=='07')
				{   
			    guarda_base_ret($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
					
					if($documento=='04' or $documento=='05')
				{   
			    guarda_base_nc($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			
		}

	
	}
	
	

}

function autoriza_sri($DB_gogess,$documento,$id_documento)
{

if($documento=='01')
{
 $tabla='comprobante_fac_cabecera';
 $campo_autoriza='comcab_nautorizacion';
 $campo_fechaaut='comcab_fechaaut';
 $campo_estadosri='comcab_estadosri';
 $campo_motivo='comcab_motivodev';
 $campo_id='comcab_id';
 $campo_xml='comcab_xmlfirmado';
 $clave_acceo='comcab_clavedeaccesos';
 $tipocomp='comcab_tipocomprobante';
 $ndocumento='comcab_nfactura';
}

if($documento=='04')
{
 $tabla='comprobante_credito_cab';
 $campo_autoriza='comcabcre_nautorizacion';
 $campo_fechaaut='comcabcre_fechaaut';
 $campo_estadosri='comcabcre_estadosri';
 $campo_motivo='comcabcre_motivodev';
 $campo_id='comcabcre_id';
 $campo_xml='comcabcre_xmlfirmado';
 $clave_acceo='comcabcre_clavedeaccesos';
 $tipocomp='comcabcre_tipocomprobante';
 $ndocumento='comcabcre_ncredito';
}

if($documento=='05')
{
 $tabla='comprobante_credito_cab';
 $campo_autoriza='comcabcre_nautorizacion';
 $campo_fechaaut='comcabcre_fechaaut';
 $campo_estadosri='comcabcre_estadosri';
 $campo_motivo='comcabcre_motivodev';
 $campo_id='comcabcre_id';
 $campo_xml='comcabcre_xmlfirmado';
 $clave_acceo='comcabcre_clavedeaccesos';
 $tipocomp='comcabcre_tipocomprobante';
  $ndocumento='comcabcre_ncredito';
}

if($documento=='06')
{
 $tabla='comprobante_guia_cabecera';
 $campo_autoriza='compguiacab_nautorizacion';
 $campo_fechaaut='compguiacab_fechaaut';
 $campo_estadosri='compguiacab_estadosri';
 $campo_motivo='compguiacab_motivodev';
 $campo_id='compguiacab_id';
 $campo_xml='compguiacab_xmlfirmado';
 $clave_acceo='compguiacab_clavedeaccesos';
 $tipocomp='compguiacab_tipocomprobante';
  $ndocumento='compguiacab_nguia';
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

 $ok_bu=$DB_gogess->Execute($busca_xml);
 $listcg_claveAcceso=$ok_bu->fields[$clave_acceo];
 
 $acceso_clv=$listcg_claveAcceso;
 $num_dpcumento=$ok_bu->fields[$ndocumento];
 
 $cliente = new nusoap_client("https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl", true);
		$resultado = $cliente->call(
				 "autorizacionComprobante", 
					array(
							'claveAccesoComprobante' => $listcg_claveAcceso
						)
			);
	
	$error = $cliente->getError();
	print_r($error); 
//print_r($resultado);
	$resultados_sri=obtener_resultado($resultado);
	
	$arreglolista=$resultado;
	echo $resultados_sri["estado"]."<br>";
	if($error)
    {
	   $actualiza="update ".$tabla." set ".$campo_autoriza."='',".$campo_fechaaut."='',".$campo_estadosri."='DEVUELTA',".$campo_motivo."='ERROR DE CONEXION SRI' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
	 //  $okv=$DB_gogess->Execute($actualiza);
	
	}	
	else
	{
	   
	    $ready_estado=$resultados_sri["estado"];
		
		$motivo=str_replace("'"," ",$resultados_sri["codigo"]." ".$resultados_sri["motivo"]);
		
		if($ready_estado=='DEVUELTA')
		{
		
			
			$actualiza="update ".$tabla." set ".$campo_autoriza."='',".$campo_fechaaut."='',".$campo_estadosri."='".$ready_estado."',".$campo_motivo."='".$motivo."' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
		///	$okv=$DB_gogess->Execute($actualiza);
			
				 if($documento=='01')
				{   
			   guarda_base($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			 
			 
			if($documento=='07')
				{   
			    guarda_base_ret($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
					
					if($documento=='04' or $documento=='05')
				{   
			    guarda_base_nc($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			
		
		}
		else
		{
		
		
		
		   $actualiza="update ".$tabla." set ".$campo_autoriza."='".$resultados_sri["numaut"]."',".$campo_fechaaut."='".$resultados_sri["fechaaut"]."',".$campo_estadosri."='".$ready_estado."',".$campo_motivo."='".$motivo."' where ".$campo_id."='".$id_documento."' and ".$tipocomp."='".$documento."'";
		   
		  ///  $okv=$DB_gogess->Execute($actualiza);
			if($ready_estado=='AUTORIZADO')
			{
			   $date=date("Y-m-d");
			   ////////////
			
				 if($documento=='01')
				{   
			   guarda_base($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			 
			 
			if($documento=='07')
				{   
			    guarda_base_ret($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
					
					if($documento=='04' or $documento=='05')
				{   
			    guarda_base_nc($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			
			   
			   
			   
			}
			else
			{
			
				 if($documento=='01')
				{   
			   guarda_base($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			 
			 
			if($documento=='07')
				{   
			    guarda_base_ret($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
					
					if($documento=='04' or $documento=='05')
				{   
			    guarda_base_nc($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv);
			   
					}
			
			}
			
		
		}
	   
	
	}	
			


}




function guarda_base_ret($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv)
{
$dsn="retencion_data";
$conn = odbc_connect( $dsn, '', '' );

$num_dpcumento=trim($num_dpcumento);
$num_ret=explode("-",$num_dpcumento);
							      $num_secuencial=$num_ret[2];
								  $num_puntoemi=$num_ret[1];
								  $num_establecimiento=$num_ret[0];


$actualiza_dada="update Retenciones set clave_acceso='".$acceso_clv."',numero_autorizacion='".$resultados_sri["numaut"]."',fecha_autorizacion='".$resultados_sri["fechaaut"]."',estado_autorizacion='".$ready_estado."',motivo_autorizacion='".$motivo."' where   estab='".$num_establecimiento."' and ptoEmi='".$num_puntoemi."' and secuencial='".$num_secuencial."'";
//echo $actualiza_dada;
$rs = odbc_exec( $conn, $actualiza_dada );	
}

function guarda_base($documento,$num_dpcumento,$ready_estado,$resultados_sri,$motivo,$acceso_clv)
{
$dsn="access_data";
$conn = odbc_connect( $dsn, '', '' );

$actualiza_dada="update InvFacturas set clave_acceso='".$acceso_clv."',numero_autorizacion='".$resultados_sri["numaut"]."',fecha_autorizacion='".$resultados_sri["fechaaut"]."',estado_autorizacion='".$ready_estado."',motivo_autorizacion='".$motivo."' where   FacturaNumero='".trim($num_dpcumento)."'";
//echo $actualiza_dada;
$rs = odbc_exec( $conn, $actualiza_dada );	

}

?>