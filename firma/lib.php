<?php

function firmando($datos_firma,$emp_id,$tipo_doc,$iddoc,$DB_gogess)
{
   //print_r($datos_firma);
   $firmaElectronica = new Java("FirmaDocPhp.firmaPhp");
   if($tipo_doc=='01')
   {
     $buscadocumento="select * from beko_documentocabecera where doccab_id='".$iddoc."' and emp_id=".$emp_id;
	 
	 $rs_xmlafirmar = $DB_gogess->Execute($buscadocumento); 
	$xmlparafirma=$rs_xmlafirmar->fields["doccab_xml"];
 
   }
   if($tipo_doc=='04')
   {
     $buscadocumento="select * from comprobante_credito_cab where  	comcabcre_tipocomprobante='".$tipo_doc."' and comcabcre_id='".$iddoc."' and emp_id=".$emp_id;
	
	
	 $rs_xmlafirmar = $DB_gogess->Execute($buscadocumento); 
	 $xmlparafirma=$rs_xmlafirmar->fields["comcabcre_xml"];
 
   }
   if($tipo_doc=='05')
   {
     $buscadocumento="select * from comprobante_credito_cab where comcabcre_tipocomprobante='".$tipo_doc."' and comcabcre_id'".$iddoc."' and emp_id=".$emp_id;
	
	 $rs_xmlafirmar = $DB_gogess->Execute($buscadocumento); 
	 $xmlparafirma=$rs_xmlafirmar->fields["comcabcre_xml"];
 
   }
   
   if($tipo_doc=='06')
   {
     $buscadocumento="select * from comprobante_guia_cabecera where compguiacab_tipocomprobante='".$tipo_doc."' and compguiacab_id='".$iddoc."' and emp_id=".$emp_id;
	
	 $rs_xmlafirmar = $DB_gogess->Execute($buscadocumento); 
	 $xmlparafirma=$rs_xmlafirmar->fields["compguiacab_xml"];
 
   }
   
   
    if($tipo_doc=='07')
   {
     $buscadocumento="select * from comprobante_retencion_cab where compretcab_tipocomprobante='".$tipo_doc."' and compretcab_id='".$iddoc."' and emp_id=".$emp_id;
	
	 $rs_xmlafirmar = $DB_gogess->Execute($buscadocumento); 
	 $xmlparafirma=$rs_xmlafirmar->fields["compretcab_xml"];
 
   }
   
  //print_r($datos_firma);
    $salida_xml='';
   $salida_xml=$firmaElectronica->firmando($xmlparafirma,$datos_firma["path"].$datos_firma["Nombre"],$datos_firma["clv"],"comprobante");
   
  // echo $salida_xm;
   if(trim($salida_xml)=='1')
		{
		  echo "Archivo a firmar no existe...";
		  
		}
		else
		{
		  if(trim($salida_xml)=='2')
			{
			  echo "Certificado no existe...";
			  
			}
		   else
		   {
		   
			 if(trim($salida_xml)=='3')
				{
				
				  echo 'Clave del certificado incorrecto...';
				  
				}
				else
				{
				
				//--------------------------------------------------
				
				
				
				if($tipo_doc=='01')
						{
						$actualizafacturaf="update beko_documentocabecera set doccab_firmado='SI',doccab_xmlfirmado='".base64_encode($salida_xml)."' where doccab_id='".$iddoc."'";
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						// echo $actualizafacturaf;
					    $salida_xml='';
						}
						
						
						if($tipo_doc=='04')
						{
						$actualizafacturaf="update comprobante_credito_cab set comcabcre_firmado='SI',comcabcre_xmlfirmado='".base64_encode($salida_xml)."' where comcabcre_tipocomprobante ='".$tipo_doc."' and comcabcre_id='".$iddoc."'";
						//echo $actualizafacturaf;
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						 $salida_xml='';
						}
						
						if($tipo_doc=='05')
						{
						$actualizafacturaf="update comprobante_credito_cab set comcabcre_firmado='SI',comcabcre_xmlfirmado='".base64_encode($salida_xml)."' where comcabcre_tipocomprobante ='".$tipo_doc."' and  comcabcre_id='".$iddoc."'";
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						 $salida_xml='';
						}
						
						
						
						if($tipo_doc=='06')
						{
						$actualizafacturaf="update comprobante_guia_cabecera set compguiacab_firmado='SI',compguiacab_xmlfirmado='".base64_encode($salida_xml)."' where compguiacab_tipocomprobante ='".$tipo_doc."' and  compguiacab_id='".$iddoc."'";
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						 $salida_xml='';
						}
						
						
			
			           if($tipo_doc=='07')
						{
					
						 
						 $actualizafacturaf="update comprobante_retencion_cab set compretcab_firmado='SI',compretcab_xmlfirmado='".base64_encode($salida_xml)."' where compretcab_id='".$iddoc."'";
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						$salida_xml='';
						 
						 
						}
				
				
				//--------------------------------------------------
				
				}
			}
			
		}		
   


}


function datos_firmar($cedula,$DB_gogess)
{

 //busca certificado
	$buscacertificado="select * from factura_cerficado where usua_ciruc='".$cedula."' and cert_activo=1";
	$rs_cert = $DB_gogess->Execute($buscacertificado); 
					  if($rs_cert)
					  {
						  while (!$rs_cert->EOF) {
						  
							$dato["Nombre"]=$rs_cert->fields["cert_nombre"];
							$dato["clv"]=$rs_cert->fields["cert_clv"];
						    $dato["path"]=$rs_cert->fields["cert_path"];
							 $rs_cert->MoveNext();
						  }
					  
					  }
	
	
	
	return $dato;		  
	//busca certificado
}

?>