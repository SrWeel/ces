<?php


function xml_retencion($compretcab_id,$datos_empresadata,$decimales,$DB_gogess)
{


$emp_nombre=$datos_empresadata["emp_nombre"];
$emp_ruc=$datos_empresadata["emp_ruc"];
$emp_direccion=$datos_empresadata["emp_direccion"];
$emp_ambiente=$datos_empresadata["emp_ambiente"];							 
$emp_emision=$datos_empresadata["emp_emision"];
$emp_especial=$datos_empresadata["emp_especial"];

$emp_contabilidad=$datos_empresadata["emp_contabilidad"];

//---------------------------

$banderaencontro='';
$busca_facturaguardad="select * from comprobante_retencion_cab where not(compretcab_estadosri='AUTORIZADO') and compretcab_id=".$compretcab_id;

$rs_buscaid = $DB_gogess->Execute($busca_facturaguardad); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					    
						   $ilote++;	
							
							////xml--------------------------------------------------
						   $codedocumentosnum=$codedocumentosnum.$rs_buscaid->fields["compretcab_nfactura"].",";
						
						  $numeroaccesocond=$rs_buscaid->fields["compretcab_clavedeaccesos"];
//sacasecuencial
						   $boques_num=explode("-",$rs_buscaid->fields["compretcab_nfactura"]);
						   
						   $codedocumentosnum=$codedocumentosnum.$rs_buscaid->fields["compretcab_nfactura"].",";
						  
						   //sacasecuencial
								  
								   	
									///------------------
									
									$salida_xml="";
							$ilote++;	
							
							$salida_xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
							$salida_xml .= "<comprobanteRetencion id=\"comprobante\" version=\"1.0.0\" >\n";
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
							//generacodebarra($idnumerografico,$idfac,$grafbarra);
							
							
							$salida_xml .= "<codDoc>".$rs_buscaid->fields["compretcab_tipocomprobante"]."</codDoc>\n";
							$salida_xml .= "<estab>".$boques_num[0]."</estab>\n";
							$salida_xml .= "<ptoEmi>".$boques_num[1]."</ptoEmi>\n";
							$salida_xml .= "<secuencial>".trim($boques_num[2])."</secuencial>\n";
							$salida_xml .= "<dirMatriz>".$emp_direccion."</dirMatriz>\n";
							$salida_xml .= "</infoTributaria>\n";
							
							$idbuscarenvio=$rs_buscaid->fields["compretcab_clavedeaccesos"];
							$salida_xml .= "<infoCompRetencion>\n";
							
							$fechaemision=explode(" ",$rs_buscaid->fields["compretcab_fechaemision_cliente"]);
							$separafecha=explode("-",$fechaemision[0]);
							$fechanuevaf=$separafecha[2]."/".$separafecha[1]."/".$separafecha[0];
							//
							$salida_xml .= "<fechaEmision>".$fechanuevaf."</fechaEmision>\n";
                            $salida_xml .= "<dirEstablecimiento>".$emp_direccion."</dirEstablecimiento>\n";

							
							if(trim($emp_especial))
							{
                            $salida_xml .= "<contribuyenteEspecial>".$emp_especial."</contribuyenteEspecial>\n";
							
							}
							
                            $salida_xml .= "<obligadoContabilidad>".strtoupper($emp_contabilidad)."</obligadoContabilidad>\n";
							 $salida_xml .= "<tipoIdentificacionSujetoRetenido>".$rs_buscaid->fields["tipodoc_codigo"]."</tipoIdentificacionSujetoRetenido>\n";
							
													 
                            $salida_xml .= "<razonSocialSujetoRetenido>".$rs_buscaid->fields["compretcab_nombrerazon_cliente"]."</razonSocialSujetoRetenido>\n";
							
							
                            $salida_xml .= "<identificacionSujetoRetenido>".$rs_buscaid->fields["compretcab_rucci_cliente"]."</identificacionSujetoRetenido>\n";
							
							
							 $fechaemisionds=explode(" ",$rs_buscaid->fields["compretcab_nfacturafecha"]);
							      $separafechads=explode("-",$fechaemisionds[0]);
							      $fechanuevafds=$separafechads[2]."/".$separafechads[1]."/".$separafechads[0];
								  
						     $salida_xml .= "<periodoFiscal>".$separafechads[1]."/".$separafechads[0]."</periodoFiscal>\n";
							 
			 
						    $salida_xml .= "</infoCompRetencion>\n";								
					        
							
                            $salida_xml .= "<impuestos>\n";		
						
								
												
							//sumatotales por impuesto
							$detallesgrupo="select * from comprobante_retencion_detalle where compretcab_id='".$rs_buscaid->fields["compretcab_id"]."' group by compretdet_ivasino";
							
							 $rs_grp = $DB_gogess->Execute($detallesgrupo);
						   if($rs_grp)
						   {
								while (!$rs_grp->EOF) {
								
								   
									
									$valorxml=0;
									 $valorxml=$rs_grp->fields["compretdet_valorimpuesto"];																
									
										$salida_xml .= "<impuesto>\n";
								  
									   
								  $salida_xml .= "<codigo>".$rs_buscadetalle->fields["impur_id"]."</codigo>\n";	
								 
								  
								  $salida_xml .= "<codigoRetencion>".$rs_buscadetalle->fields["porcentaje_id"]."</codigoRetencion>\n";
								  
								  	
								  $salida_xml .= "<baseImponible>".number_format($rs_buscadetalle->fields["compretdet_baseimponible"], 2, '.', '')."</baseImponible>\n";	
								  
								  
								  $salida_xml .= "<porcentajeRetener>".$rs_buscadetalle->fields["compretdet_porcentaje"]."</porcentajeRetener>\n";	
								  
								  
								  $salida_xml .= "<valorRetenido>".number_format($rs_buscadetalle->fields["compretdet_valorretenido"], 2, '.', '')."</valorRetenido>\n";
								 
								  
								  if($rs_buscaid->fields["compretcab_nfactura"])
								  {
								  $salida_xml .= "<codDocSustento>01</codDocSustento>\n";	
								  
								  
								  $salida_xml .= "<numDocSustento>".$rs_buscaid->fields["compretcab_nfactura"]."</numDocSustento>\n";
								
								  
								  
								  $fechaemisionds=explode(" ",$rs_buscaid->fields["compretcab_nfacturafecha"]);
							      $separafechads=explode("-",$fechaemisionds[0]);
							      $fechanuevafds=$separafechads[2]."/".$separafechads[1]."/".$separafechads[0];
								  
								  
								  $salida_xml .= "<fechaEmisionDocSustento>".$fechanuevafds."</fechaEmisionDocSustento>\n";
								 
								  

								  
								  }
								  else
								  {	
								  $salida_xml .= "<codDocSustento>12</codDocSustento>\n";	
								  
								  
								  $salida_xml .= "<numDocSustento>999999999999999</numDocSustento>\n";	
								  
								  
								  $salida_xml .= "<fechaEmisionDocSustento>".$fechanuevaf."</fechaEmisionDocSustento>\n";
								  
								  }
								  
								  
								  
								  $salida_xml .= "</impuesto>\n";	
								  
								  
								  
								  
								  //adicionales
		
									$iadval++;
								$contenatododetadi=trim($rs_buscadetalle->fields["compretdet_adicional1"]);
								
								  
									if($contenatododetadi)
									{		
									
									$comilladoble='"';
								 
								  
								  if($rs_buscadetalle->fields["compretdet_adicional1"])
								  {
								  
								  $salida_xmlad.= "<campoAdicional nombre=\"InformacionAdicional1".$iadval."\">".$rs_buscadetalle->fields["compretdet_adicional1"]."</campoAdicional>\n";
								  
								  }
									  }
										
								 $rs_grp->MoveNext();
								}
							}	
							
											
							$salida_xml .= "</impuestos>\n";
							
							  $salida_xml .= "<infoAdicional>\n";	
	$salida_xml1 .= "<infoAdicional>\n";	
	
	$salida_xml .= $salida_xmlad;
	$salida_xml1 .= $salida_xmlad;
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
						 
						$documentosnum=1;
						if($salida_xml)
						{
                        ///guarda xml
						 $xmlbtval=base64_encode($salida_xml);
						 $xmlbase="update comprobante_retencion_cab set compretcab_xml='".$xmlbtval."' where compretcab_id='".$rs_buscaid->fields["compretcab_id"]."'";
						 $okxmldat=$DB_gogess->Execute($xmlbase);
						
						///guarda xml
					     }
						 
						////xml--------------------------------------------------
					  
							
		
	
					        $rs_buscaid->MoveNext();
					  }
					}  
 
 

 //crando xml
	
}

?>