<?php

function obtener_datosresultado($datos,$path_firmado,$sublote,$tipo,$idlote,$tpifin_id,$DB_gogess)
	{
		     //print_r($datos);
			 
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
								
								$motivo_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["mensajes"]["mensaje"][0]["mensaje"];
								
								$clvbusca=$datos["RespuestaAutorizacionComprobante"]["claveAccesoConsultada"];
								
								if($estado_aut=='AUTORIZADO')
									{
										$i=$ncomprobantes+5;
									}
  
								}
								
								
										  //mayor a uno
			               }
										
			  }
				
		$estadosri=$estado_aut;
	     $numautori=$num_aut;
		$fechaautori=$fecha_aut;
		$motivosri=$motivo_aut;	
		
		//echo $tipo."<br>".$estadosri."<br>".$numautori."<br>".$fechaautori."<br>".$motivosri."<br>";
			
	if($tipo=='01')
	 {
	 $actualizafactur="update comprobante_fac_cabecera set 	comcab_firmado='SI',comcab_estadosri='".$estadosri."',comcab_nautorizacion='".$numautori."',comcab_fechaaut='".$fechaautori."',comcab_motivodev='".$motivosri."' where comcab_clavedeaccesos='".$clvbusca."'";
	//echo $actualizafactur."<br>";
	 $okact=$DB_gogess->Execute($actualizafactur);
	 }
	 
	 if($tipo=='05')
	 {
	 $actualizafactur="update comprobante_retencion_cab set compretcab_firmado='SI',compretcab_estadosri='".$estadosri."',compretcab_nautorizacion='".$numautori."',compretcab_fechaaut='".$fechaautori."',compretcab_motivodev='".$motivosri."' where 	compretcab_clavedeaccesos='".$clvbusca."'";
	 //echo $actualizafactur."<br>";
	 $okact=$DB_gogess->Execute($actualizafactur);
	 }
	 
	
	 
	 if($tipo=='04' or $tipo=='05')
	 {
	 $actualizafactur="update comprobante_credito_cab set comcabcre_firmado='SI',comcabcre_estadosri='".$estadosri."',comcabcre_nautorizacion='".$numautori."',comcabcre_fechaaut='".$fechaautori."',comcabcre_motivodev='".$motivosri."' where comcabcre_clavedeaccesos='".$clvbusca."' and tipodoc_codigo='".$tipo."'";
	//echo $actualizafactur."<br>";
	 $okact=$DB_gogess->Execute($actualizafactur);
	 }
	 
	 if($tipo=='06')
	 {
	 $actualizafactur="update  comprobante_guia_cabecera set compguiacab_firmado='SI',compguiacab_estadosri='".$estadosri."',compguiacab_nautorizacion='".$numautori."',compguiacab_fechaaut='".$fechaautori."',compguiacab_motivodev='".$motivosri."' where 	compguiacab_clavedeaccesos='".$clvbusca."'";
	 //echo $actualizafactur."<br>";
	 $okact=$DB_gogess->Execute($actualizafactur);
	 }
	 
		 	   
			//verifica si hay autorizacion	
		
		
	     //$datosresultado["motivo_aut"]=$motivo_aut;
		// $datosresultado["estado_aut"]=$estado_aut;
		 //$datosresultado["num_aut"]=$num_aut;
		 //$datosresultado["fecha_aut"]=$fecha_aut;
		 
		 if($okact)
		 {
			// echo $estadosri;
			 
			 if(trim($estadosri)=='AUTORIZADO')
			 {
			 
			 
             $autorizoeldato=generar_datoautorizado($clvbusca,$path_firmado,$ambiente,$sublote,$tipo,$ivali,$idlote,$tpifin_id,$DB_gogess);
			
			 $cantidadautorizo=$cantidadautorizo+$autorizoeldato;
			 
			 }
		 }
		 
		return $cantidadautorizo; 
		
		
		
	}



function generar_datoautorizado($clv_acceso,$patch,$ambiente,$sublote,$tipo,$ivali,$idlote,$tpifin_id,$DB_gogess)
{
	
	 $autorizovalor=0;
	 
        if($tipo=='01')
		{
          $subindiceval='_ECRE';
		  $tipocomprobante='01';
		  $codigopais="EC";
			$idnegocio="04";	
			$codpdf="0014";
			$codxml="0015";
		  //-------------------------------
		  $barrag='fac';
		  $buscaarchivo="select * from comprobante_fac_cabecera where comcab_clavedeaccesos='".$clv_acceso."'";

$rs_buscaid = $DB_gogess->Execute($buscaarchivo); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $narchivo=$rs_buscaid->fields["comcab_id"];
					  $estadoarch=$rs_buscaid->fields["comcab_estadosri"];
					  
					  $comcab_fechaaut=$rs_buscaid->fields["comcab_fechaaut"];
					  $comcab_nautorizacion=$rs_buscaid->fields["comcab_nautorizacion"];
					  $comcab_sello=$rs_buscaid->fields["comcab_sello"];
					  $comcab_xml=$rs_buscaid->fields["comcab_xml"];
					  $comcab_xmlfirmado=$rs_buscaid->fields["comcab_xmlfirmado"];
					   $comcab_rucci_cliente=$rs_buscaid->fields["comcab_rucci_cliente"];
					   $comcab_adicional1=$rs_buscaid->fields["comcab_adicional1"];
					   $comcab_adicional3=$rs_buscaid->fields["comcab_adicional3"];
					  	
					  
					  $emp_id=$rs_buscaid->fields["emp_id"];
					  
					 					
					  $rs_buscaid->MoveNext();
					  }
				}	
		  
		  
		  //-------------------------------
		  
		  
		 }
		 
		if($tipo=='07')
		{
        $subindiceval='_CSID';
		$barrag='nsret';
		$tipocomprobante='07';
		$codigopais="EC";
		$idnegocio="04";	
			
		//-------------------------------
		  
		  $buscaarchivo="select * from comprobante_retencion_cab where compretcab_clavedeaccesos='".$clv_acceso."'";

$rs_buscaid = $DB_gogess->Execute($buscaarchivo); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $narchivo=$rs_buscaid->fields["compretcab_id"];
					  $estadoarch=$rs_buscaid->fields["compretcab_estadosri"];
					  
					  $comcab_fechaaut=$rs_buscaid->fields["compretcab_fechaaut"];
					  $comcab_nautorizacion=$rs_buscaid->fields["compretcab_nautorizacion"];
					  $comcab_sello=$rs_buscaid->fields["compretcab_sello"];
					  $comcab_xml=$rs_buscaid->fields["compretcab_xml"];
					  $comcab_xmlfirmado=$rs_buscaid->fields["compretcab_xmlfirmado"];
					   $comcab_rucci_cliente=$rs_buscaid->fields["compretcab_rucci_cliente"];
					   $comcab_adicional1=$rs_buscaid->fields["compretcab_adicional1"];
					   $comcab_adicional3=$rs_buscaid->fields["compretcab_adicional3"];
					  	
					  
					  $emp_id=$rs_buscaid->fields["emp_id"];
					  
					 					
					  $rs_buscaid->MoveNext();
					  }
				}	
		  
		  
		  //-------------------------------
		
		
		
		 }
		
		
	 
	 
	 
	 
	 if($tipo=='04' or $tipo=='05' )
		{
      
		  $tipocomprobante='01';
		  $codigopais="EC";
			$idnegocio="04";	
			$codpdf="0014";
			$codxml="0015";
		  //-------------------------------
		  $barrag='fac';
		  $buscaarchivo="select * from comprobante_credito_cab where tipodoc_codigo='".$tipo."' and comcabcre_clavedeaccesos='".$clv_acceso."'";

$rs_buscaid = $DB_gogess->Execute($buscaarchivo); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $narchivo=$rs_buscaid->fields["comcab_id"];
					  $estadoarch=$rs_buscaid->fields["comcabcre_estadosri"];
					  
					  $comcab_fechaaut=$rs_buscaid->fields["comcabcre_fechaaut"];
					  $comcab_nautorizacion=$rs_buscaid->fields["comcabcre_nautorizacion"];
					  $comcab_sello=$rs_buscaid->fields["comcabcre_sello"];
					  $comcab_xml=$rs_buscaid->fields["comcabcre_xml"];
					  $comcab_xmlfirmado=$rs_buscaid->fields["comcabcre_xmlfirmado"];
					   $comcab_rucci_cliente=$rs_buscaid->fields["comcabcre_rucci_cliente"];
					   $comcab_adicional1=$rs_buscaid->fields["comcabcre_adicional1"];
					   $comcab_adicional3=$rs_buscaid->fields["comcabcre_adicional3"];
					  	
					  
					  $emp_id=$rs_buscaid->fields["emp_id"];
					  
					 					
					  $rs_buscaid->MoveNext();
					  }
				}	
		  
		  
		  //-------------------------------
		  
		  
		 }
	 
	
	 
	 if($tipo=='06')
		{

		$barrag='gui';
		$tipocomprobante='07';
		$codigopais="EC";
		$idnegocio="04";	
			$codpdf="0016";
			$codxml="0017";
		//-------------------------------
		  
		  $buscaarchivo="select * from comprobante_guia_cabecera where compguiacab_clavedeaccesos='".$clv_acceso."'";
		  

$rs_buscaid = $DB_gogess->Execute($buscaarchivo); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $narchivo=$rs_buscaid->fields["compguiacab_id"];
					  $estadoarch=$rs_buscaid->fields["compguiacab_estadosri"];
					  
					  $comcab_fechaaut=$rs_buscaid->fields["compguiacab_fechaaut"];
					  $comcab_nautorizacion=$rs_buscaid->fields["compguiacab_nautorizacion"];
					  $comcab_sello=$rs_buscaid->fields["compguiacab_sello"];
					  $comcab_xml=$rs_buscaid->fields["compguiacab_xml"];
					  $comcab_xmlfirmado=$rs_buscaid->fields["compguiacab_xmlfirmado"];
					   $comcab_rucci_cliente=$rs_buscaid->fields["compguiacab_rucci_cliente"];
					   $comcab_adicional1=$rs_buscaid->fields["compguiacab_adicional1"];
					   $comcab_adicional3=$rs_buscaid->fields["compguiacab_adicional3"];
					  	
					  
					  $emp_id=$rs_buscaid->fields["emp_id"];
					  
					 					
					  $rs_buscaid->MoveNext();
					  }
				}	
		  
		  
		  //-------------------------------
		
		
		
		 }
	
	

  //logo de la empresa
				

$datos_empresa="select * from factur_empresa where emp_id=".$emp_id;
						   $rs_empresa = $DB_gogess->Execute($datos_empresa);
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {

								  $emp_logo=$rs_empresa->fields["emp_logo"];
							
								if($emp_logo)
								{
								$logotipo_imd= '<div id=div_logo ><img src="../../../../../archivo/'.$emp_logo.'"  width="180"  /></div>';
								}
								
								 $rs_empresa->MoveNext();
								}	
						   }
			
 //logo de la empresa
if($comcab_sello!='SI')
	{
		
		  

$cuentacli=$comcab_adicional1;

$ivalicompleto=str_pad($ivali,2, "0", STR_PAD_LEFT);
$idlotecompleto=str_pad($idlote,2, "0", STR_PAD_LEFT);


//$horafecha=date("YmdH").$idlotecompleto.$ivalicompleto;
$horafecha=date("YmdHis");

$code_barra= '<img src="../../../../../imgbarra/'.$barrag.$narchivo.".gif".'"   />';

$archivostring=base64_decode($comcab_xml);
$archivofirmado=base64_decode($comcab_xmlfirmado);

$pathextrap="../../../../";
//$comprobantepdf=leer_xml(0,$archivostring,$tipocomprobante,$comcab_nautorizacion,$comcab_fechaaut,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total,$valornograbado,$pathextrap);
//echo $comprobantepdf;
$impval=date("YmdHis");
$dompdf = new DOMPDF();
//$dompdf->load_html(utf8_encode($condatos));
//$dompdf->load_html($comprobantepdf);
//$dompdf->render();
//$dompdf->stream("factura".$banderaencontro.".pdf");


//crea archivo
//$archivo = $patch["pdf"].$codigopais.$idnegocio.$codpdf.$cuentacli.$horafecha.".pdf";
if($tpifin_id==1 or $tpifin_id==3)
{
	//-----------------------------------------------------
if($patch["pdf"])
{
$archivo = $patch["pdf"].$codigopais.$idnegocio.$codpdf.$comcab_adicional3.$horafecha.$subindiceval.".pdf";
$id = fopen($archivo, 'w+');
$cadena = $dompdf->output();
fwrite($id, $cadena);
fclose($id);
}
    //------------------------------------------------------
}



//crea xml

//$datosrrlee=leercampos_xml($comcab_xml);

$comprovante_autx='<?xml version="1.0" encoding="UTF-8"?>
<autorizacion>
<estado>'.$estadoarch.'</estado>
<numeroAutorizacion>'.$comcab_nautorizacion.'</numeroAutorizacion>
<fechaAutorizacion>'.$comcab_fechaaut.'</fechaAutorizacion>
<ambiente>'.$datosrrlee["ambiente"].'</ambiente>
<comprobante><![CDATA[';

$comprovante_autpiex=']]></comprobante><mensajes/></autorizacion>';
$archivoautx=$comprovante_autx.$archivofirmado.$comprovante_autpiex;



//$archivo=$patch["xml"].$codigopais.$idnegocio.$codxml.$cuentacli.$horafecha.".xml";
if($tpifin_id==1 or $tpifin_id==3)
{
	//---------------------------------------------
if($patch["xml"])
{
$archivo=$patch["xml"].$codigopais.$idnegocio.$codxml.$comcab_adicional3.$horafecha.$subindiceval.".xml";
$id = fopen($archivo, 'w+');
fwrite($id,$archivoautx);
fclose($id);
}
    //---------------------------------------------
}
		
		
		
        
		$archivostring=base64_decode($comcab_xmlfirmado);
	    $archivoaut=$comprovante_aut.$archivostring.$comprovante_autpie;

 if($tipo=='06')
		{
        $actualizafactur="update comprobante_guia_cabecera set compguiacab_archivosublote='".$sublote."',compguiacab_sello='SI' where compguiacab_clavedeaccesos='".$clv_acceso."'";
		 //echo $actualizafactur."<br>";
		 $okact=$DB_gogess->Execute($actualizafactur);
			 if($okact)
			 {
			 $autorizovalor=1;
			 }
		 
		 }


        if($tipo=='01')
		{
        $actualizafactur="update comprobante_fac_cabecera set comcab_archivosublote='".$sublote."',comcab_sello='SI' where comcab_clavedeaccesos='".$clv_acceso."'";
		 //echo $actualizafactur."<br>";
		 $okact=$DB_gogess->Execute($actualizafactur);
			 if($okact)
			 {
			 $autorizovalor=1;
			 }
		 
		 }
		 
		  if($tipo=='04' or $tipo=='05')
		{
        $actualizafactur="update comprobante_credito_cab set comcabcre_archivosublote='".$sublote."',comcabcre_sello='SI' where comcabcre_clavedeaccesos='".$clv_acceso."' and  comcabcre_tipocomprobante='".$tipo."'";
		 //echo $actualizafactur."<br>";
		 $okact=$DB_gogess->Execute($actualizafactur);
			 if($okact)
			 {
			 $autorizovalor=1;
			 }
		 
		 }
		 
		if($tipo=='07')
		{
        $actualizafactur="update comprobante_retencion_cab set compretcab_archivosublote='".$sublote."',compretcab_sello='SI' where compretcab_clavedeaccesos='".$clv_acceso."'";
		 //echo $actualizafactur."<br>";
		 $okact=$DB_gogess->Execute($actualizafactur);
		 	 if($okact)
			 {
			 $autorizovalor=1;
			 }

		 
		 
		 }
		 
	
		 
	
	 
	}
else
{
	$autorizovalor=1;
}
	 
	return $autorizovalor; 


}

?>