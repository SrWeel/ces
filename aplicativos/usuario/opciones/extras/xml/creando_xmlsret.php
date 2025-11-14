<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
include("../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);

if($_SESSION['ces1313777_sessid_inicio'])
{
$formato_pdf=0;
 $subindice="_debito";

$director="../../../../../";
include ("../../../../../cfgclases/clases.php");
$carpetaxml="xmlretencion";
function agregar_dv($_rol) {
    /* Remuevo los ceros del comienzo. */
    while($_rol[0] == "0") {
        $_rol = substr($_rol, 1);
    }
    $factor = 2;
    $suma = 0;
    for($i = strlen($_rol) - 1; $i >= 0; $i--) {
        $suma += $factor * $_rol[$i];
        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
    }
    $dv = 11 - $suma % 11;
    /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
    $dv = $dv == 11 ? 0 : ($dv == 10 ? "1" : $dv);
    return $dv;
}

function randomString($length = 10, $letters = NULL){
    //Si no nos especifican lo contrario usaremos un conjunto de letras por defecto
    if(!isset($letters) || strlen($letters) == 0){
        $letters = "1234567890"; //Por defecto usaremos todas estas letras
    }
    
    $str = ''; //Cadena resultante
    $max = strlen($letters)-1;
    
    for($i=0; $i<$length; $i++){
        $str .= $letters[rand(0,$max)]; //Hasta que tengamos $length caracteres agregamos una letra al hazar del conjunto $letters
    }
    
    return $str;
}



$banderaencontro='';
$busca_facturaguardad="select * from comprobante_retencion_cab where compretcab_id='".$_POST["pcompretcab_id"]."'";

$rs_bfactura = $DB_gogess->Execute($busca_facturaguardad);
if($rs_bfactura)
{
   while (!$rs_bfactura->EOF) {
		
        $banderaencontro=$rs_bfactura->fields["compretcab_id"];
		$idempval=$rs_bfactura->fields["em_id"];
        $fechaemi=$rs_bfactura->fields["compretcab_fechaemision_cliente"];
		$tipocx=$rs_bfactura->fields["compretcab_tipocomprobante"];
		$compretcab_nretencion=$rs_bfactura->fields["compretcab_nretencion"];		
		$compretcab_clavedeaccesos=$rs_bfactura->fields["compretcab_clavedeaccesos"];
		$comprasid=$rs_bfactura->fields["id_compracab"];
		
		$emision_valorc=$rs_bfactura->fields["compretcab_emision"];
		$ambiente_valorc=$rs_bfactura->fields["compretcab_ambiente"];
		
        $rs_bfactura->MoveNext(); 
   }
}

if($comprasid)
{
$obtienetipodedoc="select * from factur_compras_cabecera where id_compracab='".$comprasid."'";
$rs_obtienecodesustento = $DB_gogess->Execute($obtienetipodedoc);
if($rs_obtienecodesustento)
{
	$codesus=$rs_obtienecodesustento->fields["comcab_tipocomprobante"];
}

}

if($banderaencontro)
{

//CREA CLAVE DE ACCESO

$fechahora_clv=explode(" ",$fechaemi);
$solofecha_clv=explode("-",$fechahora_clv[0]);
$objimpuestos->datos_cfg($idempval,$DB_gogess);
$rucempresa=$objformulario->replace_cmb("factur_empresa","em_id,em_ruc","where em_id=",$idempval,$DB_gogess);	
$claveacc=$solofecha_clv[2].$solofecha_clv[1].$solofecha_clv[0].$tipocx.$rucempresa.$ambiente_valorc.str_replace("-","",$compretcab_nretencion);	

//----codigo
//$numocho_dig=randomString(8);	
$numocho_dig= substr($banderaencontro, -8); 
//----codigo

$numerogenerado=$claveacc.$numocho_dig.$emision_valorc;
$numerovalidador=agregar_dv($numerogenerado);
$clavegenerada=$claveacc.$numocho_dig.$emision_valorc.$numerovalidador;

if(strlen($compretcab_clavedeaccesos)<49)
{
$actualizavalor="update comprobante_retencion_cab set compretcab_clavedeaccesos='".$clavegenerada."' where compretcab_id='".$_POST["pcompretcab_id"]."'";
$ok_generado=$DB_gogess->Execute($actualizavalor);
}
//CREA CLAVE DE ACCESO

$idnumerografico=$clavegenerada;
$idfac=$_POST["pcompretcab_id"];
$grafbarra="nsret";
include("codebarra/claveacceso.php");
 //echo "esiste";
 //creando xml
 
 
 $rs_buscaid = $DB_gogess->Execute($busca_facturaguardad); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					    
						   //saca datos empresa
						   
						   $objimpuestos->datos_cfg($rs_buscaid->fields["em_id"],$DB_gogess);
						   
						   
						   $datos_empresa="select * from factur_empresa where em_id=".$rs_buscaid->fields["em_id"];
						   $rs_empresa = $DB_gogess->Execute($datos_empresa);
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $em_nombre=$rs_empresa->fields["em_nombre"];
								  $em_ruc=$rs_empresa->fields["em_ruc"];
								  $em_direccion=$rs_empresa->fields["em_direccion"];
								  
								  
								
								 $rs_empresa->MoveNext();
								}	
						   }
						   //saca datos empresa
						   
						   //sacasecuencial
						   $boques_num=explode("-",$rs_buscaid->fields["compretcab_nretencion"]);
						   //sacasecuencial
						   
					 // echo $rs_buscaid->fields["compretcab_nfactura"];
					        $salida_xml='';
					   		$salida_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n"; 
							$salida_xml .= "<comprobanteRetencion id=\"comprobante\" version=\"1.0.0\" >\n";
							$salida_xml .= "<infoTributaria>\n";
							$salida_xml .= "<ambiente>".$ambiente_valorc."</ambiente>\n";
							$salida_xml .= "<tipoEmision>".$emision_valorc."</tipoEmision>\n";
							$salida_xml .= "<razonSocial>".$em_nombre."</razonSocial>\n";
							$salida_xml .= "<nombreComercial>".$em_nombre."</nombreComercial>\n";
							$salida_xml .= "<ruc>".$em_ruc."</ruc>\n";
							$salida_xml .= "<claveAcceso>".$rs_buscaid->fields["compretcab_clavedeaccesos"]."</claveAcceso>\n";
							$salida_xml .= "<codDoc>".$rs_buscaid->fields["compretcab_tipocomprobante"]."</codDoc>\n";
							$salida_xml .= "<estab>".$boques_num[0]."</estab>\n";
							$salida_xml .= "<ptoEmi>".$boques_num[1]."</ptoEmi>\n";
							$salida_xml .= "<secuencial>".$boques_num[2]."</secuencial>\n";
							$salida_xml .= "<dirMatriz>".$em_direccion."</dirMatriz>\n";
							$salida_xml .= "</infoTributaria>\n";							
							$salida_xml .= "<infoCompRetencion>\n";
							
							$fechaemision=explode(" ",$rs_buscaid->fields["compretcab_fechaemision_cliente"]);
							$separafecha=explode("-",$fechaemision[0]);
							$fechanuevaf=$separafecha[2]."/".$separafecha[1]."/".$separafecha[0];
							//
							$salida_xml .= "<fechaEmision>".$fechanuevaf."</fechaEmision>\n";
							$salida_xml .= "<dirEstablecimiento>".$em_direccion."</dirEstablecimiento>\n";
							
							if(trim($objimpuestos->cgfe_especial))
							{
							$salida_xml .= "<contribuyenteEspecial>".$objimpuestos->cgfe_especial."</contribuyenteEspecial>\n";
							
							}
							
							
							 $salida_xml .= "<obligadoContabilidad>".strtoupper($objimpuestos->cgfe_contabilidad)."</obligadoContabilidad>\n";
							 
							$salida_xml .= "<tipoIdentificacionSujetoRetenido>".$rs_buscaid->fields["tipodoc_codigo"]."</tipoIdentificacionSujetoRetenido>\n";
							 $salida_xml .= "<razonSocialSujetoRetenido>".$rs_buscaid->fields["compretcab_nombrerazon_cliente"]."</razonSocialSujetoRetenido>\n";
							 $salida_xml .= "<identificacionSujetoRetenido>".$rs_buscaid->fields["compretcab_rucci_cliente"]."</identificacionSujetoRetenido>\n";
                           
						     $salida_xml .= "<periodoFiscal>".$separafecha[1]."/".$separafecha[0]."</periodoFiscal>\n";
			 
						    $salida_xml .= "</infoCompRetencion>\n";								
					
							
                            $salida_xml .= "<impuestos>\n";		
							
							
													
												
						    $busca_detalle="select * from comprobante_retencion_detalle where compretcab_id='".$rs_buscaid->fields["compretcab_id"]."'";
							$rs_buscadetalle = $DB_gogess->Execute($busca_detalle); 
							if($rs_buscadetalle)
							{
								  while (!$rs_buscadetalle->EOF) {	
								  
								  $codeporcent=$objformulario->replace_cmb("kyradm_porcentajesrenta","porcentaje_id,porcentaje_codigo"," where porcentaje_id=",$rs_buscadetalle->fields["porcentaje_id"],$DB_gogess);
								  
								  $salida_xml .= "<impuesto>\n";
								  $salida_xml .= "<codigo>".$rs_buscadetalle->fields["impur_id"]."</codigo>\n";	
								  $salida_xml .= "<codigoRetencion>".$codeporcent."</codigoRetencion>\n";	
								  $salida_xml .= "<baseImponible>".number_format($rs_buscadetalle->fields["compretdet_baseimponible"], 2, '.', '')."</baseImponible>\n";	
								  $salida_xml .= "<porcentajeRetener>".$rs_buscadetalle->fields["compretdet_porcentaje"]."</porcentajeRetener>\n";	
								  $salida_xml .= "<valorRetenido>".number_format($rs_buscadetalle->fields["compretdet_valorretenido"], 2, '.', '')."</valorRetenido>\n";
								  
								  if($rs_buscaid->fields["compretcab_nfactura"])
								  {
									  if($codesus)
									  {
										 $csustento =$codesus;
									  }
									  else
									  {
										  $csustento ="01";
									  }
									  
								  $salida_xml .= "<codDocSustento>".$csustento."</codDocSustento>\n";	
								  $salida_xml .= "<numDocSustento>".str_replace("-","",$rs_buscaid->fields["compretcab_nfactura"])."</numDocSustento>\n";	
								  
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
	  
	  $salida_xmlad .= "<campoAdicional nombre=\"InformacionAdicional1".$iadval."\">".$rs_buscadetalle->fields["compretdet_adicional1"]."</campoAdicional>\n";
	  
	  }
	  
	  
	  
	
	     
		 }
		
		//adicionales
								  
								  
								  
								  
								  
								  $rs_buscadetalle->MoveNext();
								  }
								  
							}
					
														
							$salida_xml .= "</impuestos>\n";
							
   
    $salida_xml .= "<infoAdicional>\n";	
	$salida_xml .= $salida_xmlad;
    $salida_xml .= "<campoAdicional nombre=\"direccionSujetoRetenido\">".$rs_buscaid->fields["compretcab_direccion_cliente"]."</campoAdicional>\n";	
	
	if($rs_buscaid->fields["compretcab_telefono_cliente"])
	{
	
	$telfcli=str_replace("-","",$rs_buscaid->fields["compretcab_telefono_cliente"]);
	$telfcli=str_replace("(","",$telfcli);
	$telfcli=str_replace(")","",$telfcli);
	$telfcli=str_replace(" ","",$telfcli);
    $salida_xml .= "<campoAdicional nombre=\"telefonoSujetoRetenido\">".$telfcli."</campoAdicional>\n";	
    }
	if($rs_buscaid->fields["compretcab_email_cliente"])
	{
	$salida_xml .= "<campoAdicional nombre=\"CorreoSujetoRetenido\">".$rs_buscaid->fields["compretcab_email_cliente"]."</campoAdicional>\n";	
    }
	
	
	$salida_xml .= "</infoAdicional>\n";
												
							$salida_xml .= "</comprobanteRetencion>";	
				  
					        $rs_buscaid->MoveNext();
					  }
					}  
 
 


//$archivo = "../../../../../".$carpetaxml."/".$_POST["pcompretcab_id"].".xml";
//$id = fopen($archivo, 'w+');
//$cadena = $salida_xml;
//fwrite($id, $cadena);
//fclose($id);
 
  //--------//
 $xmlbtval=base64_encode($salida_xml);
 $xmlbase="update comprobante_retencion_cab set compretcab_xml='".$xmlbtval."' where compretcab_id='".$_POST["pcompretcab_id"]."'";
 $okxmldat=$DB_gogess->Execute($xmlbase);
 //--------//
 
 
 //crando xml
 
 
 
}
else
{

  echo "no existe";
}


}

?>