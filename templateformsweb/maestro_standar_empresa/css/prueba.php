
function xml_factura($archivo_val,$opcg_id,$auto_id,$DB_gogess)
{
	$buscanlotes="select * from kyradm_automatico where auto_id=".$auto_id;
	$rs_opciones = $DB_gogess->Execute($buscanlotes);
	if($rs_opciones)
		{ 
			$opcg_cantidadporlote=$rs_opciones->fields["auto_nlote"];
			$opcg_silote=$rs_opciones->fields["auto_lote"];
			$emp_id_valor=$rs_opciones->fields["emp_id"];
	    }
	

	
	$buscaestad="select * from factura_listacargados where listcg_archivo='".$archivo_val."' and emp_id=".$emp_id_valor;
	
	$rs_estadol = $DB_gogess->Execute($buscaestad);
				if($rs_estadol)
				{   
				   while (!$rs_estadol->EOF) {	
				   
				   
				   $banderaexiste=1;
				   
				   $listcg_firma=$rs_estadol->fields["listcg_firma"];
				   $listcg_id=$rs_estadol->fields["listcg_id"];
				   
				   $listcg_srirecibido=$rs_estadol->fields["listcg_srirecibido"];
				   $listcg_sriautorizado=$rs_estadol->fields["listcg_sriautorizado"];
				   $listcg_numerofacturas=$rs_estadol->fields["listcg_numerofacturas"];
				   
				   $listcg_claveAcceso=$rs_estadol->fields["listcg_claveAcceso"];
				   
				   $grupos=$listcg_numerofacturas/$opcg_cantidadporlote;
				   $cortanum=explode(".",$grupos);
				   if($cortanum[1]>0)
				   {
				   $grupos=$cortanum[0]+1;
				   }
				   else
				   {
				   $grupos=$cortanum[0];
				   }
				   $cantidadporgrupo=$opcg_cantidadporlote;
				   
				   $rs_estadol->MoveNext();
				   }
				
				}
	//verifica lotes cargados cantidad
	
	 //crando xml

$formato_pdf=0;
$subindice="_facturas";

//---------------------------
//Lote masivo clave de acceso


//---------------------------

$banderaencontro='';
$busca_facturaguardad="select * from comprobante_fac_cabecera where not(comcab_estadosri='AUTORIZADO') and comcab_archivo='".$archivo_val."' and emp_id=".$emp_id_valor." order by comcab_ncredito asc";



 //echo "esiste";
 //creando xml
 
 
 $rs_buscaid = $DB_gogess->Execute($busca_facturaguardad); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					    
						 //saca datos empresa
						   
						  
						   
						     $datos_empresa="select * from factura_empresa where emp_id=".$rs_buscaid->fields["emp_id"];
						   $rs_empresa = $DB_gogess->Execute($datos_empresa);
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $emp_nombre=$rs_empresa->fields["emp_nombre"];
								  $emp_ruc=$rs_empresa->fields["emp_ruc"];
								  $emp_direccion=$rs_empresa->fields["emp_direccion"];
								    $emp_ambiente=$rs_empresa->fields["emp_ambiente"];
								  $emp_emision=$rs_empresa->fields["emp_emision"];
								
								 $rs_empresa->MoveNext();
								}	
						   }
						   //saca datos empresa
						   
						   //sacasecuencial
						   $boques_num=explode("-",$rs_buscaid->fields["comcab_nfactura"]);
						   
						   $codedocumentosnum=$codedocumentosnum.$rs_buscaid->fields["comcab_nfactura"].",";
						   						   
						   $accesoclavelote=$rs_buscaid->fields["comcab_accesolote"];
						   //sacasecuencial
								  
								   	
									///------------------
									
									$salida_xml="";
							$ilote++;	
							
							$salida_xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
						    $salida_xml .= "<factura version=\"1.0.0\" id=\"comprobante\" >\n";		
							
							
							
							
							
							
							
							
							
							$salida_xml .= "<infoTributaria>\n";
							$salida_xml .= "<ambiente>".$emp_ambiente."</ambiente>\n";
							$salida_xml .= "<tipoEmision>".$emp_emision."</tipoEmision>\n";
							$salida_xml .= "<razonSocial>".$emp_nombre."</razonSocial>\n";
							$salida_xml .= "<nombreComercial>".$emp_nombre."</nombreComercial>\n";
							$salida_xml .= "<ruc>".$emp_ruc."</ruc>\n";
							$salida_xml .= "<claveAcceso>".$rs_buscaid->fields["comcab_clavedeaccesos"]."</claveAcceso>\n";
							
							
							$idnumerografico=$rs_buscaid->fields["comcab_clavedeaccesos"];
							$idfac=$rs_buscaid->fields["comcab_id"];
							$grafbarra="fac";
							generacodebarra($idnumerografico,$idfac,$grafbarra);
							
							
							$salida_xml .= "<codDoc>".$rs_buscaid->fields["comcab_tipocomprobante"]."</codDoc>\n";
							$salida_xml .= "<estab>".$boques_num[0]."</estab>\n";
							$salida_xml .= "<ptoEmi>".$boques_num[1]."</ptoEmi>\n";
							$salida_xml .= "<secuencial>".trim($boques_num[2])."</secuencial>\n";
							$salida_xml .= "<dirMatriz>".$emp_direccion."</dirMatriz>\n";
							$salida_xml .= "</infoTributaria>\n";
							
							$idbuscarenvio=$rs_buscaid->fields["comcab_clavedeaccesos"];
							$salida_xml .= "<infoFactura>\n";
							
							$fechaemision=explode(" ",$rs_buscaid->fields["comcab_fechaemision_cliente"]);
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
							
							
                            $salida_xml .= "<tipoIdentificacionComprador>".$rs_buscaid->fields["tipodoc_codigo"]."</tipoIdentificacionComprador>\n";
							
							
							if($rs_buscaid->fields["comcab_guiaremision"])
							{							
							$salida_xml .= "<guiaRemision>".$rs_buscaid->fields["comcab_guiaremision"]."</guiaRemision>\n";
							
							}
							 
                            $salida_xml .= "<razonSocialComprador>".$rs_buscaid->fields["comcab_nombrerazon_cliente"]."</razonSocialComprador>\n";
							
							
                            $salida_xml .= "<identificacionComprador>".$rs_buscaid->fields["comcab_rucci_cliente"]."</identificacionComprador>\n";
							
							
							$totlasinimp=$rs_buscaid->fields["comcab_subtnoobjetoi"]+$rs_buscaid->fields["comcab_subtotal"]+$rs_buscaid->fields["comcab_subtotalsiniva"];
							
                            $salida_xml .= "<totalSinImpuestos>".number_format($totlasinimp, 2, '.', '')."</totalSinImpuestos>\n";
							
							
							$salida_xml .= "<totalDescuento>".number_format($rs_buscaid->fields["comcab_descuento"], 2, '.', '')."</totalDescuento>\n";
							
														
                            $salida_xml .= "<totalConImpuestos>\n";		
							
												
							//sumatotales por impuesto
							$detallesgrupo="select comcabdet_valorimpuesto,comcabdet_impuesto,comcabdet_ivasino,sum(comcabdet_total) as tvalor from comprobante_fac_detalle where comcab_id='".$rs_buscaid->fields["comcab_id"]."' group by comcabdet_ivasino";
							
							 $rs_grp = $DB_gogess->Execute($detallesgrupo);
						   if($rs_grp)
						   {
								while (!$rs_grp->EOF) {
								
								   
									
									$valorxml=0;
									 $valorxml=(($rs_grp->fields["comcabdet_valorimpuesto"]*$rs_grp->fields["tvalor"])/100);																
									
									  $salida_xml .= "<totalImpuesto>\n";
									  
									   
									  $salida_xml .= "<codigo>".$rs_grp->fields["comcabdet_impuesto"]."</codigo>\n";
									 
									  
									  $salida_xml .= "<codigoPorcentaje>".$rs_grp->fields["comcabdet_ivasino"]."</codigoPorcentaje>\n";
									 
									  
									  $salida_xml .= "<baseImponible>".number_format($rs_grp->fields["tvalor"], 2, '.', '')."</baseImponible>\n";
									  
									  
									  $salida_xml .= "<valor>".number_format($valorxml, 2, '.', '')."</valor>\n";
									  
									  
									  $salida_xml .= "</totalImpuesto>\n";
									 
									
								
								 $rs_grp->MoveNext();
								}
							}	
							
											
							$salida_xml .= "</totalConImpuestos>\n";
							
							
						   	$salida_xml .= "<propina>".number_format($rs_buscaid->fields["comcab_propina"], 2, '.', '')."</propina>\n";	
										
	                        $salida_xml .= "<importeTotal>".number_format($rs_buscaid->fields["comcab_total"], 2, '.', '')."</importeTotal>\n";		
							
							 
							 if(trim($rs_buscaid->fields["comcab_moneda"]))
							 {
                            $salida_xml .= "<moneda>".$rs_buscaid->fields["comcab_moneda"]."</moneda>\n";
							
							 }
							 else
							 {
							  $salida_xml .= "<moneda>DOLAR</moneda>\n";
							
							 }
							$salida_xml .= "</infoFactura>\n";	
							
							
							
	 	$salida_xml .= "<detalles>\n";	
		
		
		//Saca detalles
		$busca_detalle="select * from comprobante_fac_detalle where comcab_id='".$rs_buscaid->fields["comcab_id"]."'";
			$rs_buscadetalle = $DB_gogess->Execute($busca_detalle); 
				  if($rs_buscadetalle)
				  {
				      while (!$rs_buscadetalle->EOF) {					
				
				if(!($rs_buscadetalle->fields["comcabdet_codaux"]))
				{
				   $aux_valor=$rs_buscadetalle->fields["comcabdet_codprincipal"];
				}
				else
				{
				  $aux_valor=$rs_buscadetalle->fields["comcabdet_codaux"];
				
				}
				
	   $salida_xml .= "<detalle>\n";	
	   
	   
       $salida_xml .= "<codigoPrincipal>".$rs_buscadetalle->fields["comcabdet_codprincipal"]."</codigoPrincipal>\n";
	  
	   
       $salida_xml .= "<codigoAuxiliar>".$aux_valor."</codigoAuxiliar>\n";	
	   
	   
       $salida_xml .= "<descripcion>".$rs_buscadetalle->fields["comcabdet_descripcion"]."</descripcion>\n";
	   
	   	
       $salida_xml .= "<cantidad>".number_format($rs_buscadetalle->fields["comcabdet_cantidad"],2, '.', '')."</cantidad>\n";	
	
	   
	   $salida_xml .= "<precioUnitario>".number_format($rs_buscadetalle->fields["comcabdet_preciou"], 2, '.', '')."</precioUnitario>\n";	
	  
	   
       $salida_xml .= "<descuento>".number_format($rs_buscadetalle->fields["comcabdet_descuento"], 2, '.', '')."</descuento>\n";
	  
	   
	   $salida_xml .= "<precioTotalSinImpuesto>".number_format($rs_buscadetalle->fields["comcabdet_total"], 2, '.', '')."</precioTotalSinImpuesto>\n";	
	   

	 
	  
	  $impvalordata=$rs_buscadetalle->fields["comcabdet_ivasino"];
	  
	  //------------------------------------------
	  
	   $contenatododetadi=trim($rs_buscadetalle->fields["comcabdet_detallea"].$rs_buscadetalle->fields["comcabdet_detalleb"].$rs_buscadetalle->fields["comcabdet_detallec"]);
	  
		if($contenatododetadi)
		{		
		
		$comilladoble='"';
	  $salida_xml .= "<detallesAdicionales>\n";
	 
	  
	  if($rs_buscadetalle->fields["comcabdet_detallea"])
	  {
	  $salida_xml .= "<detAdicional nombre=".$comilladoble."InformacionAdicional1".$comilladoble." valor=".$comilladoble.$rs_buscadetalle->fields["comcabdet_detallea"].$comilladoble." />\n";
	  
	  }
	  
	  if($rs_buscadetalle->fields["comcabdet_detalleb"])
	  {
	  $salida_xml .= "<detAdicional nombre=".$comilladoble."InformacionAdicional2".$comilladoble." valor=".$comilladoble.$rs_buscadetalle->fields["comcabdet_detalleb"].$comilladoble." />\n";
	 
	  }

	  if($rs_buscadetalle->fields["comcabdet_detallec"])
	  {
	  $salida_xml .= "<detAdicional nombre=".$comilladoble."InformacionAdicional3".$comilladoble." valor=".$comilladoble.$rs_buscadetalle->fields["comcabdet_detallec"].$comilladoble." />\n";
	  
	  }
	  
	  $salida_xml .= " </detallesAdicionales>\n";
	  
		 }
	  
	  //------------------------------------------
	  
  
	  $salida_xml .= "<impuestos>\n";

	  
      $salida_xml .= "<impuesto>\n";
	
	  
      $salida_xml .= "<codigo>".$rs_buscadetalle->fields["comcabdet_impuesto"]."</codigo>\n";
	
	  
      $salida_xml .= "<codigoPorcentaje>".$rs_buscadetalle->fields["comcabdet_ivasino"]."</codigoPorcentaje>\n";
	  
	  
	 
	  $valorivadata=number_format($rs_buscadetalle->fields["comcabdet_valorimpuesto"], 2, '.', '');
	  
      $salida_xml .= "<tarifa>".$valorivadata."</tarifa>\n";
	  
	  
       $baseimponivdetalle=0.00;
       $baseimponivdetalle=$rs_buscadetalle->fields["comcabdet_total"];
       $salida_xml .= "<baseImponible>".number_format($baseimponivdetalle, 2, '.', '')."</baseImponible>\n";
	  
	  
	  $valorivat="0.00";
	  
	  $valorivat=($rs_buscadetalle->fields["comcabdet_valorimpuesto"]*$rs_buscadetalle->fields["comcabdet_total"])/100;
	  $valorivat=number_format($valorivat, 2, '.', '');
	  
	  
      $salida_xml .= "<valor>".$valorivat."</valor>\n";
	  
	  
      $salida_xml .= "</impuesto>\n";
	 
	  
      $salida_xml .= "</impuestos>\n";
	 
	   
     $salida_xml .= "</detalle>\n";	
	
		
	 
	 $nautoriza=$rs_buscaid->fields["comcab_autorizacion"];
	 
	                        $rs_buscadetalle->MoveNext();
							
	                     }
				}		 
							
							
		//Saca detalles
		

	
	$salida_xml .= "</detalles>\n";
	$salida_xml .= "<infoAdicional>\n";	
    $salida_xml .= "<campoAdicional nombre=\"direccionComprador\">".$rs_buscaid->fields["comcab_direccion_cliente"]."</campoAdicional>\n";	
	
	if($rs_buscaid->fields["comcab_telefono_cliente"])
	{
	
	$telfcli=str_replace("-","",$rs_buscaid->fields["comcab_telefono_cliente"]);
	$telfcli=str_replace("(","",$telfcli);
	$telfcli=str_replace(")","",$telfcli);
	$telfcli=str_replace(" ","",$telfcli);
	
    $salida_xml .= "<campoAdicional nombre=\"telefonoComprador\">".$telfcli."</campoAdicional>\n";	

	
    }
	if($rs_buscaid->fields["comcab_email_cliente"])
	{
	$salida_xml .= "<campoAdicional nombre=\"CorreoCliente\">".$rs_buscaid->fields["comcab_email_cliente"]."</campoAdicional>\n";	
	
    }
	$salida_xml .= "</infoAdicional>\n";

						
							$salida_xml .= "</factura>";	
								

							
						   
						
						    //sacasecuencial
						    $boques_num=explode("-",$rs_buscaid->fields["compguiacab_nguia"]);
						   //sacasecuencial
						
						   
					 // echo $rs_buscaid->fields["comcab_nfactura"];
					        //$salida_xml='';
							$salida_xml1="";
							$ilote++;	
							
							////xml--------------------------------------------------
						   $codedocumentosnum=$codedocumentosnum.$rs_buscaid->fields["compguiacab_nguia"].",";
						 $salida_xml='';
						 $numeroaccesocond=$rs_buscaid->fields["comcab_clavedeaccesos"];

						 
						 
						 
						 
						 
						 ////xml-----------------------------------------------------
						 
						 
						
						
						$documentosnum=1;
						if($salida_xml)
						{
						$numdocval++;
						$narchivoac=str_replace(".txt","",$archivo_val)."-".$numdocval.".xml";
							
						$insertadetall="insert into factura_detallista (listcg_claveAcceso,listcgd_archivo,listcgd_validado,listcgd_motivo,listcgd_archivobase,listcgd_xml,listcgd_numdoc,listcgd_documentos,emp_id) value ('".$numeroaccesocond."','".$narchivoac."','','','".$archivo_val."','".base64_encode($salida_xml)."','".$documentosnum."','".$codedocumentosnum."','".$rs_buscaid->fields["emp_id"]."')";						   					   
						   $result_instlotdet=$DB_gogess->Execute($insertadetall);
						   	
							
						}
						
						///guarda xml
						
						
						$xmlbtval=base64_encode($salida_xml);
						 $xmlbase="update comprobante_fac_cabecera set comcab_xml='".$xmlbtval."' where compguiacab_id='".$rs_buscaid->fields["compguiacab_id"]."'";
						 $okxmldat=$DB_gogess->Execute($xmlbase);
						
						///guarda xml
					        
						////xml--------------------------------------------------
					  
					        $rs_buscaid->MoveNext();
					  }
					}  
 
 
 

 logcarga($archivo_val,$lineaval,"Procese xml terminado","",$DB_gogess);

 
 //crando xml
	
}
