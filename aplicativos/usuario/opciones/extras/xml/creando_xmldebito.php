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
$carpetaxml="xmldebito";
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
$busca_facturaguardad="select * from comprobante_credito_cab where comcabcre_id='".$_POST["pcomcabcre_id"]."'";

$rs_bfactura = $DB_gogess->Execute($busca_facturaguardad);
if($rs_bfactura)
{
   while (!$rs_bfactura->EOF) {
		
        $banderaencontro=$rs_bfactura->fields["comcabcre_id"];
		$idempval=$rs_bfactura->fields["em_id"];
        $fechaemi=$rs_bfactura->fields["comcabcre_fechaemision_cliente"];
		$tipocx=$rs_bfactura->fields["comcabcre_tipocomprobante"];
		$comcabcre_ncredito=$rs_bfactura->fields["comcabcre_ncredito"];
		$comcabcre_clavedeaccesos=$rs_bfactura->fields["comcabcre_clavedeaccesos"];
		
		$emision_valorc=$rs_bfactura->fields["comcabcre_emision"];
		$ambiente_valorc=$rs_bfactura->fields["comcabcre_ambiente"];
		
        $rs_bfactura->MoveNext(); 
   }
}





if($banderaencontro)
{

//CREA CLAVE DE ACCESO

$fechahora_clv=explode(" ",$fechaemi);
$solofecha_clv=explode("-",$fechahora_clv[0]);
$objimpuestos->datos_cfg($idempval,$DB_gogess);
$rucempresa=$objformulario->replace_cmb("factur_empresa","em_id,em_ruc","where em_id=",$idempval,$DB_gogess);	
$claveacc=$solofecha_clv[2].$solofecha_clv[1].$solofecha_clv[0].$tipocx.$rucempresa.$ambiente_valorc.str_replace("-","",$comcabcre_ncredito);	

//---codigo
//$numocho_dig=randomString(8);	
$numocho_dig= substr($banderaencontro, -8); 
//---codigo


$numerogenerado=$claveacc.$numocho_dig.$emision_valorc;
$numerovalidador=agregar_dv($numerogenerado);
$clavegenerada=$claveacc.$numocho_dig.$emision_valorc.$numerovalidador;

if(strlen($comcabcre_clavedeaccesos)<49)
{
$actualizavalor="update comprobante_credito_cab set comcabcre_clavedeaccesos='".$clavegenerada."' where comcabcre_id='".$_POST["pcomcabcre_id"]."'";
$ok_generado=$DB_gogess->Execute($actualizavalor);
}
//CREA CLAVE DE ACCESO


$idnumerografico=$clavegenerada;
$idfac=$_POST["pcomcabcre_id"];
$grafbarra="ndeb";
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
						   $boques_num=explode("-",$rs_buscaid->fields["comcabcre_ncredito"]);
						   //sacasecuencial
						   
					 // echo $rs_buscaid->fields["comcabcre_nfactura"];
					        $salida_xml='';
					   		$salida_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n"; 
							$salida_xml .= "<notaDebito id=\"comprobante\" version=\"1.0.0\" >\n";
							$salida_xml .= "<infoTributaria>\n";
							$salida_xml .= "<ambiente>".$ambiente_valorc."</ambiente>\n";
							$salida_xml .= "<tipoEmision>".$emision_valorc."</tipoEmision>\n";
							$salida_xml .= "<razonSocial>".$em_nombre."</razonSocial>\n";
							$salida_xml .= "<nombreComercial>".$em_nombre."</nombreComercial>\n";
							$salida_xml .= "<ruc>".$em_ruc."</ruc>\n";
							$salida_xml .= "<claveAcceso>".$rs_buscaid->fields["comcabcre_clavedeaccesos"]."</claveAcceso>\n";
							$salida_xml .= "<codDoc>".$rs_buscaid->fields["comcabcre_tipocomprobante"]."</codDoc>\n";
							$salida_xml .= "<estab>".$boques_num[0]."</estab>\n";
							$salida_xml .= "<ptoEmi>".$boques_num[1]."</ptoEmi>\n";
							$salida_xml .= "<secuencial>".$boques_num[2]."</secuencial>\n";
							$salida_xml .= "<dirMatriz>".$em_direccion."</dirMatriz>\n";
							$salida_xml .= "</infoTributaria>\n";						
							$idbuscarenvio=$rs_buscaid->fields["comcabcre_clavedeaccesos"];
							$salida_xml .= "<infoNotaDebito>\n";
							
							$fechaemision=explode(" ",$rs_buscaid->fields["comcabcre_fechaemision_cliente"]);
							$separafecha=explode("-",$fechaemision[0]);
							$fechanuevaf=$separafecha[2]."/".$separafecha[1]."/".$separafecha[0];
							//
							$salida_xml .= "<fechaEmision>".$fechanuevaf."</fechaEmision>\n";
							$salida_xml .= "<dirEstablecimiento>".$em_direccion."</dirEstablecimiento>\n";
							 $salida_xml .= "<tipoIdentificacionComprador>".$rs_buscaid->fields["tipodoc_codigo"]."</tipoIdentificacionComprador>\n";
							 $salida_xml .= "<razonSocialComprador>".$rs_buscaid->fields["comcabcre_nombrerazon_cliente"]."</razonSocialComprador>\n";
							 $salida_xml .= "<identificacionComprador>".$rs_buscaid->fields["comcabcre_rucci_cliente"]."</identificacionComprador>\n";
							 
							if(trim($objimpuestos->cgfe_especial))
							{ 
                            $salida_xml .= "<contribuyenteEspecial>".$objimpuestos->cgfe_especial."</contribuyenteEspecial>\n";
							}
							
							
                            $salida_xml .= "<obligadoContabilidad>".strtoupper($objimpuestos->cgfe_contabilidad)."</obligadoContabilidad>\n";
                           $salida_xml .= "<codDocModificado>".$rs_buscaid->fields["comcabcre_tipodocmod"]."</codDocModificado>\n";
						   $salida_xml .= "<numDocModificado>".$rs_buscaid->fields["comcabcre_nfactura"]."</numDocModificado>\n";
						   	
						   $fechaemisionmod=explode(" ",$rs_buscaid->fields["comcabcre_fechaemimod"]);
							$separafechamod=explode("-",$fechaemisionmod[0]);
							$fechanuevafmod=$separafechamod[2]."/".$separafechamod[1]."/".$separafechamod[0];
						   
							$salida_xml .= "<fechaEmisionDocSustento>".$fechanuevafmod."</fechaEmisionDocSustento>\n";
							
			
                          
						    $totlasinimp=$rs_buscaid->fields["comcabcre_subtnoobjetoi"]+$rs_buscaid->fields["comcabcre_subtotal"]+$rs_buscaid->fields["comcabcre_subtotalsiniva"];
						  
                            $salida_xml .= "<totalSinImpuestos>".number_format($totlasinimp, 2, '.', '')."</totalSinImpuestos>\n";
								
							
							
							
                            $salida_xml .= "<impuestos>\n";		
												
							//---------------------------------------------------------------
							//sumatotales por impuesto
							$detallesgrupo="select comcabcredet_ivasino,sum(comcabcredet_total) as tvalor from comprobante_credito_detalle where comcabcre_id='".$rs_buscaid->fields["comcabcre_id"]."' group by comcabcredet_ivasino";
							
							 $rs_grp = $DB_gogess->Execute($detallesgrupo);
						   if($rs_grp)
						   {
								while (!$rs_grp->EOF) {
								
								     $valorxml=0;
									if($rs_grp->fields["comcabcredet_ivasino"]==2)
									{
									   $valorxml=(($objimpuestos->cgfe_iva*$rs_grp->fields["tvalor"])/100);		
									    $valorivadata=number_format($objimpuestos->cgfe_iva, 2, '.', '');							  
									}
									else
									{
									  
									  $valorxml='0.00';		
									  $valorivadata='0.00';							
									}								
									
									  $salida_xml .= "<impuesto>\n";
									  $salida_xml .= "<codigo>2</codigo>\n";
									  $salida_xml .= "<codigoPorcentaje>".$rs_grp->fields["comcabcredet_ivasino"]."</codigoPorcentaje>\n";
									  $salida_xml .= "<tarifa>".$valorivadata."</tarifa>\n";									  
									  $salida_xml .= "<baseImponible>".number_format($rs_grp->fields["tvalor"], 2, '.', '')."</baseImponible>\n";
									  $salida_xml .= "<valor>".number_format($valorxml, 2, '.', '')."</valor>\n";
									  $salida_xml .= "</impuesto>\n";
									
								
								 $rs_grp->MoveNext();
								}
							}	
							
							//---------------------------------------------------------------
														
							$salida_xml .= "</impuestos>\n";							
							$salida_xml .= "<valorTotal>".number_format($rs_buscaid->fields["comcabcre_total"], 2, '.', '')."</valorTotal>\n";							
							                          
							$salida_xml .= "</infoNotaDebito>\n";	
							
	 	$salida_xml .= "<motivos>\n";	
		
		//Saca detalles
		$busca_detalle="select * from comprobante_credito_detalle where comcabcre_id='".$rs_buscaid->fields["comcabcre_id"]."'";
			$rs_buscadetalle = $DB_gogess->Execute($busca_detalle); 
				  if($rs_buscadetalle)
				  {
				      while (!$rs_buscadetalle->EOF) {					
				
				if(!($rs_buscadetalle->fields["comcabcredet_codaux"]))
				{
				   $aux_valor=$rs_buscadetalle->fields["comcabcredet_codprincipal"];
				}
				else
				{
				  $aux_valor=$rs_buscadetalle->fields["comcabcredet_codaux"];
				
				}
				
				    $salida_xml .= "<motivo>\n";	
      
       $salida_xml .= "<razon>".$rs_buscadetalle->fields["comcabcredet_descripcion"]."</razon>\n";	
      
       $salida_xml .= "<valor>".number_format($rs_buscadetalle->fields["comcabcredet_total"], 2, '.', '')."</valor>\n";	
	   
	 
	  $conosiniva=$objformulario->replace_cmb("factur_producto","prod_codigo,prod_ivasino","where em_id=".$rs_buscaid->fields["em_id"]." and prod_codigo like ",$rs_buscadetalle->fields["comcabcredet_codprincipal"],$DB_gogess);
	  
	  
	   
     $salida_xml .= "</motivo>\n";	
	 
		
		
		//adicionales
		
		$iadval++;
	$contenatododetadi=trim($rs_buscadetalle->fields["comcabcredet_detallea"].$rs_buscadetalle->fields["comcabcredet_detalleb"].$rs_buscadetalle->fields["comcabcredet_detallec"]);
	  
		if($contenatododetadi)
		{		
		
		$comilladoble='"';
	 
	  
	  if($rs_buscadetalle->fields["comcabcredet_detallea"])
	  {
	  
	  $salida_xmlad .= "<campoAdicional nombre=\"InformacionAdicional1".$iadval."\">".$rs_buscadetalle->fields["comcabcredet_detallea"]."</campoAdicional>\n";
	  
	  }
	  
	  if($rs_buscadetalle->fields["comcabcredet_detalleb"])
	  {
	  
	   $salida_xmlad .= "<campoAdicional nombre=\"InformacionAdicional2".$iadval."\">".$rs_buscadetalle->fields["comcabcredet_detalleb"]."</campoAdicional>\n";
	  
	  }

	  if($rs_buscadetalle->fields["comcabcredet_detallec"])
	  {
	 
	  $salida_xmlad .= "<campoAdicional nombre=\"InformacionAdicional3".$iadval."\">".$rs_buscadetalle->fields["comcabcredet_detallec"]."</campoAdicional>\n";
	  
	  }
	  
	
	     
		 }
		
		//adicionales
	 
	 $nautoriza=$rs_buscaid->fields["comcabcre_autorizacion"];
	 
	                        $rs_buscadetalle->MoveNext();
							
	                     }
				}		 
							
							
		//Saca detalles
		

	
	$salida_xml .= "</motivos>\n";
    
    $salida_xml .= "<infoAdicional>\n";	
    $salida_xml .= "<campoAdicional nombre=\"direccionComprador\">".$rs_buscaid->fields["comcabcre_direccion_cliente"]."</campoAdicional>\n";	
	
	$salida_xml .= $salida_xmlad;
	
	if($rs_buscaid->fields["comcabcre_telefono_cliente"])
	{
	
	$telfcli=str_replace("-","",$rs_buscaid->fields["comcabcre_telefono_cliente"]);
	$telfcli=str_replace("(","",$telfcli);
	$telfcli=str_replace(")","",$telfcli);
	$telfcli=str_replace(" ","",$telfcli);
	
    $salida_xml .= "<campoAdicional nombre=\"telefonoComprador\">".$telfcli."</campoAdicional>\n";	
    }
	if($rs_buscaid->fields["comcabcre_email_cliente"])
	{
	$salida_xml .= "<campoAdicional nombre=\"CorreoCliente\">".$rs_buscaid->fields["comcabcre_email_cliente"]."</campoAdicional>\n";	
    }
	$salida_xml .= "</infoAdicional>\n";
												
							$salida_xml .= "</notaDebito>";	
											  
							
						
					  
					        $rs_buscaid->MoveNext();
					  }
					}  
 
 



//$archivo = "../../../../../".$carpetaxml."/".$_POST["pcomcabcre_id"].".xml";
//$id = fopen($archivo, 'w+');
//$cadena = $salida_xml;
//fwrite($id, $cadena);
//fclose($id);
 
 //--------//
 $xmlbtval=base64_encode($salida_xml);
 $xmlbase="update comprobante_credito_cab set comcabcre_xml='".$xmlbtval."' where comcabcre_id='".$_POST["pcomcabcre_id"]."'";
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