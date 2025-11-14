<?php

class sri_facturas extends sri_funciones{

var $_doccab_id;

//codigo
public function getdoccab_id()
    {
        return $this->_doccab_id;
    }
 
public function setdoccab_id($doccab_id)
    {
        $this->_doccab_id = $doccab_id;
    }
//codigo


function genera_claveacceso_fac()
{
    
$busca_fac="select * from beko_documentocabecera where 	doccab_id='".$this->_doccab_id."'";
$rs_fac = $this->_DB_gogess->executec($busca_fac,array());

$fechaarreglo=explode("-",$rs_fac->fields["doccab_fechaemision_cliente"]);
$fechaclaveacceso=$fechaarreglo[2].$fechaarreglo[1].$fechaarreglo[0];
$tipocx=$rs_fac->fields["tipocmp_codigo"];


$busca_emp="select * from app_empresa where emp_id='".$rs_fac->fields["emp_id"]."'";
$rs_femp = $this->_DB_gogess->executec($busca_emp,array());
$rucempresa=$rs_femp->fields["emp_ruc"];

$emp_ambiente=$rs_fac->fields["ambi_valor"];
//emis_valor
$codigoclv8=trim(str_replace("-","",$rs_fac->fields["doccab_ndocumento"]));
$numocho_dig= substr($codigoclv8, -8); 

$claveacc=trim($fechaclaveacceso.$tipocx.$rucempresa.$emp_ambiente.str_replace("-","",$rs_fac->fields["doccab_ndocumento"]));	

$emin_valor=$rs_fac->fields["emis_valor"];
$numerogenerado=$claveacc.trim($numocho_dig.$emin_valor);
		
$numerovalidador=$this->agregar_dv($numerogenerado);
$clavegenerada=$claveacc.trim($numocho_dig.$emin_valor.$numerovalidador);	


$actualiza_doc="update beko_documentocabecera set doccab_nautorizacion='".trim($clavegenerada)."',doccab_clavedeaccesos='".trim($clavegenerada)."' where doccab_id='".$this->_doccab_id."'";
$rs_actualiza = $this->_DB_gogess->executec($actualiza_doc,array());

return trim($clavegenerada);

}




function xml_factura()
{
     $salida_xml='';
     $busca_facturaguardad="select * from beko_documentocabecera where doccab_id='".$this->_doccab_id."' and doccab_estadosri!='AUTORIZADO'";
     $rs_buscaid = $this->_DB_gogess->executec($busca_facturaguardad,array()); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  //----------------------------------------------------------------------------------------------
					  
					  
					     $datos_empresa="select * from app_empresa inner join  efacsistema_cfgempresa on app_empresa.emp_id=efacsistema_cfgempresa.emp_id where app_empresa.emp_id=".$rs_buscaid->fields["emp_id"];
						   $rs_empresa = $this->_DB_gogess->executec($datos_empresa,array());
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $emp_nombre=$rs_empresa->fields["emp_nombre"];
								  $emp_ruc=$rs_empresa->fields["emp_ruc"];
								  $emp_direccion=$rs_empresa->fields["emp_direccion"];
								  
								  $emp_ambiente=$rs_empresa->fields["ambi_valor"];
								  $emp_emision=$rs_empresa->fields["tipoemi_codigo"];
								  
								  $emp_contabilidad=$rs_empresa->fields["cgfe_contabilidad"];
								  $emp_especial=$rs_empresa->fields["cgfe_especial"];
								  
								  $cgfe_decimales=$rs_empresa->fields["cgfe_decimales"];
								  
								  
								  
								 $rs_empresa->MoveNext();
								}	
						   }
						   
						    $boques_num=explode("-",$rs_buscaid->fields["doccab_ndocumento"]);
						   
						    $salida_xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
						    $salida_xml .= "<factura version=\"1.1.0\" id=\"comprobante\" >\n";									
							$salida_xml .= "<infoTributaria>\n";
							$salida_xml .= "<ambiente>".$emp_ambiente."</ambiente>\n";
							$salida_xml .= "<tipoEmision>".$emp_emision."</tipoEmision>\n";
							$salida_xml .= "<razonSocial>".$emp_nombre."</razonSocial>\n";
							$salida_xml .= "<nombreComercial>".$emp_nombre."</nombreComercial>\n";
							$salida_xml .= "<ruc>".$emp_ruc."</ruc>\n";
							$salida_xml .= "<claveAcceso>".$rs_buscaid->fields["doccab_clavedeaccesos"]."</claveAcceso>\n";
							$salida_xml .= "<codDoc>".$rs_buscaid->fields["tipocmp_codigo"]."</codDoc>\n";
							$salida_xml .= "<estab>".$boques_num[0]."</estab>\n";
							$salida_xml .= "<ptoEmi>".$boques_num[1]."</ptoEmi>\n";
							$salida_xml .= "<secuencial>".trim($boques_num[2])."</secuencial>\n";
							$salida_xml .= "<dirMatriz>".$emp_direccion."</dirMatriz>\n";
							$salida_xml .= "</infoTributaria>\n";
						    $salida_xml .= "<infoFactura>\n";
							
							$fechaemision=explode(" ",$rs_buscaid->fields["doccab_fechaemision_cliente"]);
							$separafecha=explode("-",$fechaemision[0]);
							$fechanuevaf=$separafecha[2]."/".$separafecha[1]."/".$separafecha[0];
							//
							$salida_xml .= "<fechaEmision>".$fechanuevaf."</fechaEmision>\n";
                            $salida_xml .= "<dirEstablecimiento>".$emp_direccion."</dirEstablecimiento>\n";
							
							if(trim($emp_especial))
							{
                            $salida_xml .= "<contribuyenteEspecial>".$emp_especial."</contribuyenteEspecial>\n";						
							}
							
							if($emp_contabilidad==1)
							{
							$obligadoc='SI';
							}
							else
							{
							$obligadoc='NO';
							
							}
							
							$salida_xml .= "<obligadoContabilidad>".strtoupper($obligadoc)."</obligadoContabilidad>\n";					
                            $salida_xml .= "<tipoIdentificacionComprador>".$rs_buscaid->fields["tipoident_codigo"]."</tipoIdentificacionComprador>\n";						
							
							$salida_xml .= "<razonSocialComprador>".$rs_buscaid->fields["doccab_nombrerazon_cliente"]."</razonSocialComprador>\n";							
                            $salida_xml .= "<identificacionComprador>".$rs_buscaid->fields["doccab_rucci_cliente"]."</identificacionComprador>\n";
										
							$totlasinimp=$rs_buscaid->fields["doccab_subtotalsiniva"]+$rs_buscaid->fields["doccab_subtnoobjetoi"]+$rs_buscaid->fields["doccab_subtexentoiva"];							
                            $salida_xml .= "<totalSinImpuestos>".number_format($totlasinimp, $cgfe_decimales, '.', '')."</totalSinImpuestos>\n";							
							$salida_xml .= "<totalDescuento>".number_format($rs_buscaid->fields["doccab_descuento"], $cgfe_decimales, '.', '')."</totalDescuento>\n";								
                            $salida_xml .= "<totalConImpuestos>\n";	
							
							//totales
							$detallesgrupo="select docdet_valorimpuesto,impu_codigo,tari_codigo,sum(docdet_total) as tvalor from beko_documentodetalle where doccab_id='".$rs_buscaid->fields["doccab_id"]."' group by tari_codigo";
							$rs_grp = $this->_DB_gogess->executec($detallesgrupo,array());
							if($rs_grp)
						    {
								while (!$rs_grp->EOF) {
								
								      $valorxml=0;
									  $valorxml=(($rs_grp->fields["docdet_valorimpuesto"]*$rs_grp->fields["tvalor"])/100);
									  if($rs_grp->fields["tari_codigo"]==2)
									  {
										$ttotal=$rs_grp->fields["tvalor"];
										$valorxml=(($rs_grp->fields["docdet_valorimpuesto"]*$rs_grp->fields["tvalor"])/100);
									  }
									
									  if($rs_grp->fields["tari_codigo"]==3)
									  {
										$ttotal=$rs_grp->fields["tvalor"];
										$valorxml=(($rs_grp->fields["docdet_valorimpuesto"]*$rs_grp->fields["tvalor"])/100);
									  }
								
								
								      $salida_xml .= "<totalImpuesto>\n";									  									   
									  $salida_xml .= "<codigo>".$rs_grp->fields["impu_codigo"]."</codigo>\n";	  
									  $salida_xml .= "<codigoPorcentaje>".$rs_grp->fields["tari_codigo"]."</codigoPorcentaje>\n";
									  if($rs_grp->fields["tari_codigo"]==0)
									  {
									     $ttotalceroimp=$rs_grp->fields["tvalor"];
									  }
									  $salida_xml .= "<baseImponible>".number_format($rs_grp->fields["tvalor"], $cgfe_decimales, '.', '')."</baseImponible>\n"; 
									  $salida_xml .= "<valor>".number_format($valorxml, $cgfe_decimales, '.', '')."</valor>\n";
									  $salida_xml .= "</totalImpuesto>\n";
								
								
								$rs_grp->MoveNext();
								}
							}	
							$salida_xml .= "</totalConImpuestos>\n";
							//totales
							
							
							$salida_xml .= "<propina>".number_format($rs_buscaid->fields["doccab_propina"], $cgfe_decimales, '.', '')."</propina>\n";											
	                        $salida_xml .= "<importeTotal>".number_format($rs_buscaid->fields["doccab_total"], $cgfe_decimales, '.', '')."</importeTotal>\n";								
							$salida_xml .= "<moneda>DOLAR</moneda>\n";							
							
							//cambio	
							
							 $lista_formapago="select * from beko_documentoformapago inner join beko_formapago on beko_documentoformapago.frm_id=beko_formapago.frm_id where doccab_id='".$this->_doccab_id."'";
							 $rs_fpago = $this->_DB_gogess->executec($lista_formapago,array());
							 if($rs_fpago->fields["doccab_id"])
							 {
							   $salida_xml .= "<pagos>";
							   if($rs_fpago)
								  {
										while (!$rs_fpago->EOF) {
							   
											$salida_xml .= "<pago>";
											$salida_xml .= "<formaPago>".$rs_fpago->fields["frm_codigo"]."</formaPago>";
											$salida_xml .= "<total>".$rs_fpago->fields["docfpag_valor"]."</total>";
											$salida_xml .= "</pago>";
											
											
							              $rs_fpago->MoveNext();
							            }
								  } 
							   $salida_xml .= "</pagos>";
							 }
							 
							 //cambio
							
							 $salida_xml .= "</infoFactura>\n";	
					  
							  $salida_xml .= "<detalles>\n";	
							  $busca_detalle="select * from beko_documentodetalle where doccab_id='".$rs_buscaid->fields["doccab_id"]."'";
							  $rs_buscadetalle = $this->_DB_gogess->executec($busca_detalle,array()); 
							  if($rs_buscadetalle)
							  {
								  while (!$rs_buscadetalle->EOF) {	
							  
									 
										if(!($rs_buscadetalle->fields["docdet_codaux"]))
										{
										   $aux_valor=$rs_buscadetalle->fields["docdet_codprincipal"];
										}
										else
										{
										  $aux_valor=$rs_buscadetalle->fields["docdet_codaux"];								
										}
										
										 $salida_xml .= "<detalle>\n";	
	   
	   
										 $salida_xml .= "<codigoPrincipal>".$rs_buscadetalle->fields["docdet_codprincipal"]."</codigoPrincipal>\n";	   
										 $salida_xml .= "<codigoAuxiliar>".$aux_valor."</codigoAuxiliar>\n";		   
										 $salida_xml .= "<descripcion>".$rs_buscadetalle->fields["docdet_descripcion"]."</descripcion>\n";   	
										 $salida_xml .= "<cantidad>".number_format($rs_buscadetalle->fields["docdet_cantidad"],$cgfe_decimales, '.', '')."</cantidad>\n";	   
										 $salida_xml .= "<precioUnitario>".number_format($rs_buscadetalle->fields["docdet_preciou"], $cgfe_decimales, '.', '')."</precioUnitario>\n";	   
										 $salida_xml .= "<descuento>".number_format($rs_buscadetalle->fields["docdet_descuento"], $cgfe_decimales, '.', '')."</descuento>\n";   
										 $salida_xml .= "<precioTotalSinImpuesto>".number_format($rs_buscadetalle->fields["docdet_total"], $cgfe_decimales, '.', '')."</precioTotalSinImpuesto>\n";	
	                                     
										 $impvalordata=$rs_buscadetalle->fields["tari_codigo"];										 
										 $contenatododetadi=trim($rs_buscadetalle->fields["docdet_detallea"].$rs_buscadetalle->fields["docdet_detalleb"].$rs_buscadetalle->fields["docdet_detallec"]);
	  
                                         if($contenatododetadi)
											{		
											
										        $comilladoble='"';
										        $salida_xml .= "<detallesAdicionales>\n";
											    if($rs_buscadetalle->fields["comcabdet_detallea"])
											    {
											      $salida_xml .= "<detAdicional nombre=".$comilladoble."InformacionAdicional1".$comilladoble." valor=".$comilladoble.$rs_buscadetalle->fields["docdet_detallea"].$comilladoble." />\n";										  
											    }
										  
											    if($rs_buscadetalle->fields["comcabdet_detalleb"])
											    {
											      $salida_xml .= "<detAdicional nombre=".$comilladoble."InformacionAdicional2".$comilladoble." valor=".$comilladoble.$rs_buscadetalle->fields["docdet_detalleb"].$comilladoble." />\n";											 
											    }
									
										        if($rs_buscadetalle->fields["comcabdet_detallec"])
										        {
										         $salida_xml .= "<detAdicional nombre=".$comilladoble."InformacionAdicional3".$comilladoble." valor=".$comilladoble.$rs_buscadetalle->fields["docdet_detallec"].$comilladoble." />\n";										  
										        }
										  
										        $salida_xml .= " </detallesAdicionales>\n";
										  
											 }
									   
									   
									         $salida_xml .= "<impuestos>\n";	  
                                             $salida_xml .= "<impuesto>\n";	  
                                             $salida_xml .= "<codigo>".$rs_buscadetalle->fields["impu_codigo"]."</codigo>\n";	  
                                             $salida_xml .= "<codigoPorcentaje>".$rs_buscadetalle->fields["tari_codigo"]."</codigoPorcentaje>\n";										 
                                             $salida_xml .= "<tarifa>".$rs_buscadetalle->fields["docdet_porcentaje"]."</tarifa>\n";											 
											 $baseimponivdetalle=0.00;
                                             $baseimponivdetalle=$rs_buscadetalle->fields["docdet_total"];
                                             $salida_xml .= "<baseImponible>".number_format($baseimponivdetalle, $cgfe_decimales, '.', '')."</baseImponible>\n";											 											
											 $salida_xml .= "<valor>".number_format($rs_buscadetalle->fields["docdet_valorimpuesto"], $cgfe_decimales, '.', '')."</valor>\n";	  
                                             $salida_xml .= "</impuesto>\n";	 	  
                                             $salida_xml .= "</impuestos>\n";   
                                             $salida_xml .= "</detalle>\n";	
								  
								  
									$rs_buscadetalle->MoveNext();
								  }
							  } 
					 
					    $salida_xml .= "</detalles>\n";
	                    $salida_xml .= "<infoAdicional>\n";	
					    if($rs_buscaid->fields["doccab_direccion_cliente"])
						{
						$salida_xml .= "<campoAdicional nombre=\"direccionComprador\">".$rs_buscaid->fields["doccab_direccion_cliente"]."</campoAdicional>\n";	
						}
						if($rs_buscaid->fields["doccab_telefono_cliente"])
						{						
						$telfcli=str_replace("-","",$rs_buscaid->fields["doccab_telefono_cliente"]);
						$telfcli=str_replace("(","",$telfcli);
						$telfcli=str_replace(")","",$telfcli);
						$telfcli=str_replace(" ","",$telfcli);						
						$salida_xml .= "<campoAdicional nombre=\"telefonoComprador\">".$telfcli."</campoAdicional>\n";							
						}
						if($rs_buscaid->fields["doccab_email_cliente"])
						{
						$salida_xml .= "<campoAdicional nombre=\"CorreoCliente\">".$rs_buscaid->fields["doccab_email_cliente"]."</campoAdicional>\n";	
						
						}
						$salida_xml .= "</infoAdicional>\n";
						$salida_xml .= "</factura>";
						
						//echo $salida_xml;
						$xmlbtval=$salida_xml;
						$xmlbase="update beko_documentocabecera set doccab_xml='".base64_encode($xmlbtval)."' where doccab_id='".$rs_buscaid->fields["doccab_id"]."'";
						$okxmldat=$this->_DB_gogess->executec($xmlbase,array());
					  //----------------------------------------------------------------------------------------------
					    
					  $rs_buscaid->MoveNext();
					  }
					} 

   
}


}


?>