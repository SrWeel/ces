<?php


function numero_secuencialretenciones($DB_gogess)
{
     
	 $busca_usuario="select * from app_usuario where usua_id='".$_SESSION['ces1313777_sessid_inicio']."'";
     $rs_usuariodata = $DB_gogess->executec($busca_usuario,array());
     $estabr_id=$rs_usuariodata->fields["estabr_id"];
     $pemisionr_id=$rs_usuariodata->fields["pemisionr_id"];
     
	 
	 $obtiene_estb_punto="select estab_codigo,pemision_num,pemision_inicia from efacsistema_genpuntoemision inner join  efacsistema_genestablecimiento on efacsistema_genpuntoemision.estab_id=efacsistema_genestablecimiento.estab_id where pemision_id='".$pemisionr_id."'";
	 $rs_estbpunto= $DB_gogess->executec($obtiene_estb_punto,array());
	 $banderaexistelote=1;
     $loteinicial=$rs_estbpunto->fields["pemision_inicia"];
 	 $lotefinal= 1000000000000000;	
	 $idlotex= 1;
		
	 if($banderaexistelote==1)
	 {
	   $buscaultimonum="select 	compretcab_nretencion from comprobante_retencion_cab where compretcab_nretencion like '".$rs_estbpunto->fields["estab_codigo"]."-".$rs_estbpunto->fields["pemision_num"]."-%' order by compretcab_nretencion desc limit 1";	   
/*$file = fopen("archivo_factura.txt", "w");
fwrite($file, $buscaultimonum . PHP_EOL);
fclose($file);*/
	   $rs_disponible= $DB_gogess->executec($buscaultimonum,array());
	   $banderanumeroinicial=0;
				 if($rs_disponible)
				 {
					  while (!$rs_disponible->EOF) {
					  $gastadofac=$rs_disponible->fields["compretcab_nretencion"];
  			          $banderanumeroinicial=1;
					  $rs_disponible->MoveNext();
					  }
				}
				   if($banderanumeroinicial==1)
				   {
				   			  //verifica si esta en rango
						$numerodesarmado=explode("-",$gastadofac);
						$mumeroactual=($numerodesarmado[2]*1)+1;
							   //verifica si esta en rango
						$nuevonumero_sig=$rs_estbpunto->fields["estab_codigo"]."-".$numerodesarmado[1]."-".str_pad($mumeroactual,9, "0", STR_PAD_LEFT);

				   }
				   else
				   {

					$nuevonumero_sig=$rs_estbpunto->fields["estab_codigo"]."-".$rs_estbpunto->fields["pemision_num"]."-".str_pad($loteinicial,9, "0", STR_PAD_LEFT);

				   }
	 }
	 else
	 {	
	 	  // echo "Alerta Lote no asignado al sistema...";
		  	   $nuevonumero_sig=2;
	 } 
   return $nuevonumero_sig;
  // echo $lista_datoslote;
}

function insertadatos_retencion($empresaruc,$ifactura,$cabecera,$detalle,$DB_gogess)
{
	global $empresa_idval,$rucempresvalor,$cajacode,$LOTE_idvalor;
     $okinsertado=formulario_guardar('comprobante_retencion_cab',$cabecera,'','','','','',$DB_gogess);
	 if($okinsertado)
	 {
		 for($i=0;$i<count($detalle);$i++)
			{				
				//$okinsertadetalle=formulario_guardar('comprobante_retencion_detalle',$detalle[$i],'','','','','',$DB_gogess);			
			}		 
	 }
	unset($cabecera);
	unset($detalle);
  return $okinsertado;
	  
}

                         

function actualizar_retencion($nretencion,$empresaruc,$ifactura,$cabecera,$detalle,$DB_gogess)
{
	 global $empresa_idval,$rucempresvalor,$cajacode,$LOTE_idvalor;
	 
	 $ids=" compretcab_id='".$nretencion."' ";
	                              
     $okinsertado=formulario_update('comprobante_retencion_cab',$cabecera,'',$ids,'','','','',$DB_gogess);

	 if($okinsertado)
	 {
		 for($i=0;$i<count($detalle);$i++)
			{				
				//$okinsertadetalle=formulario_guardar('comprobante_retencion_detalle',$detalle[$i],'','','','','',$DB_gogess);				
			}		 
	 }
	unset($cabecera);
	unset($detalle);
	
  return $okinsertado;
	  
}

function lista_retencion($compretcab_id,$auto_id,$datosfirma,$DB_gogess)
{
    $ambiente_valor=0;

			
			$emp_id_valor=1;
			$ambiente_valor=1;
			$emp_emision=1;

		
		$datos_empresasql="select * from app_empresa left join efacsistema_cfgempresa on app_empresa.emp_id=efacsistema_cfgempresa.emp_id where app_empresa.emp_id=".$emp_id_valor;
						   $rs_empresa = $DB_gogess->executec($datos_empresasql,array());
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $emp_nombre=$rs_empresa->fields["emp_nombre"];
								  $datos_empresadata["emp_nombre"]=$rs_empresa->fields["emp_nombre"];
								  $emp_ruc=$rs_empresa->fields["emp_ruc"];
								  $datos_empresadata["emp_ruc"]=$rs_empresa->fields["emp_ruc"];
								  $emp_direccion=$rs_empresa->fields["emp_direccion"];
								  $datos_empresadata["emp_direccion"]=$rs_empresa->fields["emp_direccion"];
								  						  
								  
								  $emp_ambiente=$ambiente_valor;
								  $datos_empresadata["emp_ambiente"]=$rs_empresa->fields["ambi_valor"];								  
								  $datos_empresadata["emp_emision"]=$rs_empresa->fields["tipoemi_codigo"];
								  
								  $emp_especial=$rs_empresa->fields["cgfe_especial"];
								  $datos_empresadata["emp_especial"]=$rs_empresa->fields["cgfe_especial"];
								  
								  if($rs_empresa->fields["cgfe_contabilidad"]=='SI')
								  {
								  $emp_contabilidad='SI';
								  }
								  else
								  {
								  $emp_contabilidad='NO';
								  }
								  
								  $datos_empresadata["emp_contabilidad"]=$emp_contabilidad;
								 
								 $rs_empresa->MoveNext();
								}	
						   }	
  		
	
  $buscafacsinxml="select * from comprobante_retencion_cab where not(compretcab_firmado='SI') and not(compretcab_estadosri='AUTORIZADO') and emp_id=".$emp_id_valor." and compretcab_id='".$compretcab_id."'";
  $rs_lista = $DB_gogess->executec($buscafacsinxml,array());
				if($rs_lista)
				{   
				   while (!$rs_lista->EOF) {	
				   
				   xml_retencion($rs_lista->fields["compretcab_id"],$datos_empresadata,$DB_gogess);
				   //print_r($datosfirma);
				   
				  // firmando($datosfirma,$emp_id_valor,$rs_lista->fields["compretcab_tipocomprobante"],$rs_lista->fields["compretcab_id"],$DB_gogess);
				 
				   
				    $rs_lista->MoveNext();
				   }
				}   
  
  

}


function xml_retencion($compretcab_id,$datos_empresadata,$DB_gogess)
{
	
$emp_nombre=$datos_empresadata["emp_nombre"];
$emp_ruc=$datos_empresadata["emp_ruc"];
$emp_direccion=$datos_empresadata["emp_direccion"];
$emp_direccion2=$datos_empresadata["emp_direccion2"];
$emp_direccion3=$datos_empresadata["emp_direccion3"];
$emp_ambiente=$datos_empresadata["emp_ambiente"];							 
$emp_emision=$datos_empresadata["emp_emision"];
$emp_especial=$datos_empresadata["emp_especial"];
$emp_contabilidad=$datos_empresadata["emp_contabilidad"];

$banderaencontro='';
$busca_facturaguardad="select * from comprobante_retencion_cab where not(compretcab_estadosri='AUTORIZADO') and compretcab_id='".$compretcab_id."'";

//echo $busca_facturaguardad;

 
 
 $rs_buscaid = $DB_gogess->executec($busca_facturaguardad,array()); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					    
						 //saca datos empresa
						   $ilote++;
						
						    //sacasecuencial
						    $boques_num=explode("-",$rs_buscaid->fields["compretcab_nretencion"]);
						   //sacasecuencial
						
						   
					 // echo $rs_buscaid->fields["comcab_nfactura"];
					        //$salida_xml='';
							$salida_xml1="";
							$ilote++;	
							
							////xml--------------------------------------------------
						   $codedocumentosnum=$codedocumentosnum.$rs_buscaid->fields["compretcab_nretencion"].",";
						 $salida_xml='';
						 $numeroaccesocond=$rs_buscaid->fields["compretcab_clavedeaccesos"];

						 
						  
						    $salida_xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
							$salida_xml .= "<comprobanteRetencion id=\"comprobante\" version=\"2.0.0\" >\n";
                            $salida_xml .= "<infoTributaria>\n";
                            $salida_xml .= "<ambiente>".$emp_ambiente."</ambiente>\n";							
							$salida_xml .= "<tipoEmision>".$emp_emision."</tipoEmision>\n";							
							$salida_xml .= "<razonSocial>".$emp_nombre."</razonSocial>\n";							
							$salida_xml .= "<nombreComercial>".$emp_nombre."</nombreComercial>\n";							
							$salida_xml .= "<ruc>".$emp_ruc."</ruc>\n";							
							$salida_xml .= "<claveAcceso>".$rs_buscaid->fields["compretcab_clavedeaccesos"]."</claveAcceso>\n";							
							$idnumerografico=$rs_buscaid->fields["compretcab_clavedeaccesos"];
							$idfac=$rs_buscaid->fields["compretcab_id"];
							$grafbarra="nsret";
							//generacodebarra2($idnumerografico,$idfac,$grafbarra);							
							$salida_xml .= "<codDoc>".$rs_buscaid->fields["compretcab_tipocomprobante"]."</codDoc>\n";							
							$salida_xml .= "<estab>".$boques_num[0]."</estab>\n";							
							$salida_xml .= "<ptoEmi>".$boques_num[1]."</ptoEmi>\n";
							$salida_xml .= "<secuencial>".$boques_num[2]."</secuencial>\n";							
							$salida_xml .= "<dirMatriz>".$emp_direccion."</dirMatriz>\n";
							$salida_xml .= "<agenteRetencion>1</agenteRetencion>\n";							
							$salida_xml .= "</infoTributaria>\n";
							
							
							$idbuscarenvio=$rs_buscaid->fields["compretcab_clavedeaccesos"];							
							$salida_xml .= "<infoCompRetencion>\n";							
							$fechaemision=explode(" ",$rs_buscaid->fields["compretcab_fechaemision_cliente"]);
							$separafecha=explode("-",$fechaemision[0]);
							$fechanuevaf=$separafecha[2]."/".$separafecha[1]."/".$separafecha[0];							//
							$salida_xml .= "<fechaEmision>".$fechanuevaf."</fechaEmision>\n";							
							if(trim($boques_num[0])=='002')
							{								
								if(trim($emp_direccion2))
									{
								$emp_direccion=$emp_direccion2;
									}
							}
							if(trim($boques_num[0])=='003')
							{
								if(trim($emp_direccion3))
									{
								$emp_direccion=$emp_direccion3;
									}
							}							
							$salida_xml .= "<dirEstablecimiento>".$emp_direccion."</dirEstablecimiento>\n";			
							if(trim($emp_especial))
							{
							$salida_xml .= "<contribuyenteEspecial>".$emp_especial."</contribuyenteEspecial>\n";							
							}							
							$salida_xml .= "<obligadoContabilidad>".strtoupper($emp_contabilidad)."</obligadoContabilidad>\n";							 
							$salida_xml .= "<tipoIdentificacionSujetoRetenido>".$rs_buscaid->fields["tipodoc_codigo"]."</tipoIdentificacionSujetoRetenido>\n";
							$salida_xml .= "<parteRel>NO</parteRel>\n";							
							$salida_xml .= "<razonSocialSujetoRetenido>".utf8_encode($rs_buscaid->fields["compretcab_nombrerazon_cliente"])."</razonSocialSujetoRetenido>\n"; 
							$salida_xml .= "<identificacionSujetoRetenido>".$rs_buscaid->fields["compretcab_rucci_cliente"]."</identificacionSujetoRetenido>\n";
							$salida_xml .= "<periodoFiscal>".$separafecha[1]."/".$separafecha[0]."</periodoFiscal>\n";			 
						    $salida_xml .= "</infoCompRetencion>\n";

                            $salida_xml .= "<docsSustento>\n";
                            $salida_xml .= "<docSustento>\n";
							
							$fechaemisionds=explode(" ",$rs_buscaid->fields["compretcab_nfacturafecha"]);
							$separafechads=explode("-",$fechaemisionds[0]);
							$fechanuevafds=$separafechads[2]."/".$separafechads[1]."/".$separafechads[0];

							$salida_xml .= "<codSustento>".$rs_buscaid->fields["compretcab_codsustento"]."</codSustento>\n";
							$salida_xml .= "<codDocSustento>".$rs_buscaid->fields["compretcab_coddocsustento"]."</codDocSustento>\n";
							$salida_xml .= "<numDocSustento>".$rs_buscaid->fields["compretcab_numsustento"]."</numDocSustento>\n";
							$salida_xml .= "<fechaEmisionDocSustento>".$fechanuevafds."</fechaEmisionDocSustento>\n";
							$salida_xml .= "<fechaRegistroContable>".$fechanuevafds."</fechaRegistroContable>\n";
							//$salida_xml .= "<numAutDocSustento>1111111111</numAutDocSustento>\n";
							if($rs_buscaid->fields["compretcab_codsustento"]==15)
							{
							$salida_xml .= "<pagoLocExt>02</pagoLocExt>\n";
							}
							else
							{
							$salida_xml .= "<pagoLocExt>01</pagoLocExt>\n";
							}
							$salida_xml .= "<totalSinImpuestos>".$rs_buscaid->fields["compretcab_totalsinimpuesto"]."</totalSinImpuestos>\n";
							$salida_xml .= "<importeTotal>".$rs_buscaid->fields["compretcab_importetotal"]."</importeTotal>\n";			

                            $salida_xml .= "<impuestosDocSustento>\n";							
							$lista_imp=array();						
							$lista_imp=explode("-",$rs_buscaid->fields["compretcab_listaimpuestos"]);
							
							for($it=0;$it<count($lista_imp);$it++)
							{
								if($lista_imp[$it])
								{
									$lista_valores=array();
                                    $lista_valores=explode("|",$lista_imp[$it]);
									
									$impuestov=$lista_valores[0];
									$porcentajev=$lista_valores[1];
									$baseimponiblev=$lista_valores[2];
									$valorimpuestov=$lista_valores[3];
									$codeorcentaje='';
									
									if($porcentajev==15)
									{
									  $codeorcentaje=4;	
									}
									
									if($porcentajev==12)
									{
									  $codeorcentaje=2;	
									}
									
									if($porcentajev==0)
									{
									  $codeorcentaje=0;	
									}

                                  if($impuestov>0)
								  {
                                    $salida_xml .= "<impuestoDocSustento>\n";
								    $salida_xml .= "<codImpuestoDocSustento>".$impuestov."</codImpuestoDocSustento>\n";
								    $salida_xml .= "<codigoPorcentaje>".$codeorcentaje."</codigoPorcentaje>\n";
								    $salida_xml .= "<baseImponible>".$baseimponiblev."</baseImponible>\n";
								    $salida_xml .= "<tarifa>".$porcentajev."</tarifa>\n";
									
									$valorimpuestov = preg_replace("[\n|\r|\n\r]", "",$valorimpuestov);
									
								    $salida_xml .= "<valorImpuesto>".$valorimpuestov."</valorImpuesto>\n";
							        $salida_xml .= "</impuestoDocSustento>\n";									
								  }
								  
								}
								
							}								
							$salida_xml .= "</impuestosDocSustento>\n";
							
							$salida_xml .= "<retenciones>";
							$total_paga=0;
							
							$busca_detalle="select * from comprobante_retencion_detalle where compretcab_id='".$rs_buscaid->fields["compretcab_id"]."'";
							$rs_buscadetalle = $DB_gogess->executec($busca_detalle,array()); 
							if($rs_buscadetalle)
							{
								  while (!$rs_buscadetalle->EOF) {	
								  
									  $salida_xml .= "<retencion>\n";					   
									  $salida_xml .= "<codigo>".$rs_buscadetalle->fields["impur_id"]."</codigo>\n";		
									  $obtiene_code=array();
									  $obtiene_code=explode(" ",$rs_buscadetalle->fields["porcentaje_id"]);
									  if($obtiene_code[0]=='344')
									  {
										   $obtiene_code[0]='3440';
									  }
								      $salida_xml .= "<codigoRetencion>".$obtiene_code[0]."</codigoRetencion>\n";								  
									  $salida_xml .= "<baseImponible>".number_format($rs_buscadetalle->fields["compretdet_baseimponible"], 2, '.', '')."</baseImponible>\n";	  
								      $salida_xml .= "<porcentajeRetener>".$rs_buscadetalle->fields["compretdet_porcentaje"]."</porcentajeRetener>\n";							  
								      $salida_xml .= "<valorRetenido>".number_format($rs_buscadetalle->fields["compretdet_valorretenido"], 2, '.', '')."</valorRetenido>\n";		
									  $salida_xml .= "</retencion>\n";
									  
									  $total_paga=$total_paga+number_format($rs_buscadetalle->fields["compretdet_valorretenido"], 2, '.', '');
							  
							        $rs_buscadetalle->MoveNext();
								  }								  
							} 							  
							$salida_xml .= "</retenciones>\n";
					        
							$salida_xml .= "<pagos>\n";
							$salida_xml .= "<pago>\n";
							$salida_xml .= "<formaPago>20</formaPago>\n";
							$salida_xml .= "<total>".$total_paga."</total>\n";
							$salida_xml .= "</pago>\n";
							$salida_xml .= "</pagos>\n";
                            
			$salida_xml .= "</docSustento>\n";
			$salida_xml .= "</docsSustento>\n";	
							
   
    $salida_xml .= "<infoAdicional>\n";	
	$salida_xml1 .= "<infoAdicional>\n";	
	
	$salida_xml .= $salida_xmlad;
	$salida_xml1 .= $salida_xmlad;
	
	//$salida_xml .= "<campoAdicional nombre=\"Agente de Retención\">RESOLUCION: NAC-DNCRASC20-00000001</campoAdicional>\n";
	//$salida_xml1 .= "<campoAdicional nombre=\"Agente de Retención\">RESOLUCION: NAC-DNCRASC20-00000001</campoAdicional>\n";
	
	if (trim((utf8_encode($rs_buscaid->fields["compretcab_direccion_cliente"]))))
		{
    $salida_xml .= "<campoAdicional nombre=\"direccionComprador\">".utf8_encode($rs_buscaid->fields["compretcab_direccion_cliente"])."</campoAdicional>\n";	
	
	}
	
	if($rs_buscaid->fields["compretcab_email_cliente"])
	{
	$salida_xml .= "<campoAdicional nombre=\"CorreoSujetoRetenido\">".utf8_encode($rs_buscaid->fields["compretcab_email_cliente"])."</campoAdicional>\n";	
	
    }
	
	 if(trim($rs_buscaid->fields["compretcab_moneda"]))
							 {
                            $salida_xml .= "<campoAdicional nombre=\"moneda\" >".$rs_buscaid->fields["compretcab_moneda"]."</campoAdicional>\n";
							
							 }
							 else
							 {
							  $salida_xml .= "<campoAdicional nombre=\"moneda\" >DOLAR</campoAdicional>\n";
							
							 }
	
	$salida_xml .= "</infoAdicional>\n";
											
				
							 $salida_xml .= "</comprobanteRetencion>";
								
					
						  
						  
						 
						 
						 ////xml-----------------------------------------------------
						 
						 
						//echo $salida_xml;
						
						$documentosnum=1;
						if($salida_xml)
						{
						///guarda xml
						
						
						$xmlbtval=base64_encode(utf8_decode($salida_xml));
						$xmlbase="update comprobante_retencion_cab set compretcab_xml='".$xmlbtval."' where compretcab_id='".$rs_buscaid->fields["compretcab_id"]."'";
						 $okxmldat=$DB_gogess->executec($xmlbase,array());
						
						///guarda xml
						   	
							
						}
						
						
					        
						////xml--------------------------------------------------
					  
					        $rs_buscaid->MoveNext();
					  }
					}  
 
 


 
 //crando xml
	
}

?>