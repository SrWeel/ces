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


if($_SESSION['ces1313777_sessid_inicio'])
{
$formato_pdf=0;
 $subindice="_facturas";

$director="../../../../../";
include ("../../../../../cfgclases/clases.php");

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
$busca_facturaguardad="select * from ca_factura_cabecera where comcab_id='".$_POST["pcomcab_id"]."'";

$rs_bfactura = $DB_gogess->Execute($busca_facturaguardad);
if($rs_bfactura)
{
   while (!$rs_bfactura->EOF) {
		
        $banderaencontro=$rs_bfactura->fields["comcab_id"];
		$idempval=$rs_bfactura->fields["em_id"];
        $fechaemi=$rs_bfactura->fields["comcab_fechaemision_cliente"];
		$tipocx=$rs_bfactura->fields["comcab_tipocomprobante"];
		$comcab_nfactura=$rs_bfactura->fields["comcab_nfactura"];
		
		$comcab_clavedeaccesos=$rs_bfactura->fields["comcab_clavedeaccesos"];
		
		$emision_valorc=$rs_bfactura->fields["comcab_emision"];
		$ambiente_valorc=$rs_bfactura->fields["comcab_ambiente"];
		
        $rs_bfactura->MoveNext(); 
   }
}





if($banderaencontro)
{

//CREA CLAVE DE ACCESO

$fechahora_clv=explode(" ",$fechaemi);
$solofecha_clv=explode("-",$fechahora_clv[0]);
$objimpuestos->datos_cfg($idempval,$DB_gogess);
$rucempresa=$objformulario->replace_cmb("ca_empresa","em_id,em_ruc","where em_id=",$idempval,$DB_gogess);	
$claveacc=$solofecha_clv[2].$solofecha_clv[1].$solofecha_clv[0].$tipocx.$rucempresa.$ambiente_valorc.str_replace("-","",$comcab_nfactura);	

//$numocho_dig=randomString(8);	

//---codigo
			//$codigoclv8=$sacacamposc[12]*1;
			$numocho_dig= substr($banderaencontro, -8); 
	
//---codigo

$numerogenerado=$claveacc.$numocho_dig.$emision_valorc;
$numerovalidador=agregar_dv($numerogenerado);
$clavegenerada=$claveacc.$numocho_dig.$emision_valorc.$numerovalidador;

if(strlen($comcab_clavedeaccesos)<49)
{
$actualizavalor="update ca_factura_cabecera set comcab_clavedeaccesos='".$clavegenerada."' where comcab_id='".$_POST["pcomcab_id"]."'";
$ok_generado=$DB_gogess->Execute($actualizavalor);
}
//CREA CLAVE DE ACCESO

$idnumerografico=$clavegenerada;
$idfac=$_POST["pcomcab_id"];
$grafbarra="fac";
include("codebarra/claveacceso.php");

 //echo "esiste";
 //creando xml
 
 
 $rs_buscaid = $DB_gogess->Execute($busca_facturaguardad); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					    
						   //saca datos empresa
						   
						   $objimpuestos->datos_cfg($rs_buscaid->fields["em_id"],$DB_gogess);
						   
						   
						   $datos_empresa="select * from ca_empresa where em_id=".$rs_buscaid->fields["em_id"];
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
						   $boques_num=explode("-",$rs_buscaid->fields["comcab_nfactura"]);
						   //sacasecuencial
						   
					 // echo $rs_buscaid->fields["comcab_nfactura"];
					        $salida_xml='';
					   		$salida_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n"; 
							$salida_xml .= "<factura version=\"1.0.0\" id=\"comprobante\" >\n";
							$salida_xml .= "<infoTributaria>\n";
							$salida_xml .= "<ambiente>".$ambiente_valorc."</ambiente>\n";
							$salida_xml .= "<tipoEmision>".$emision_valorc."</tipoEmision>\n";
							$salida_xml .= "<razonSocial>".$em_nombre."</razonSocial>\n";
							$salida_xml .= "<nombreComercial>".$em_nombre."</nombreComercial>\n";
							$salida_xml .= "<ruc>".$em_ruc."</ruc>\n";
							$salida_xml .= "<claveAcceso>".$rs_buscaid->fields["comcab_clavedeaccesos"]."</claveAcceso>\n";
							$salida_xml .= "<codDoc>".$rs_buscaid->fields["comcab_tipocomprobante"]."</codDoc>\n";
							$salida_xml .= "<estab>".$boques_num[0]."</estab>\n";
							$salida_xml .= "<ptoEmi>".$boques_num[1]."</ptoEmi>\n";
							$salida_xml .= "<secuencial>".$boques_num[2]."</secuencial>\n";
							$salida_xml .= "<dirMatriz>".$em_direccion."</dirMatriz>\n";
							$salida_xml .= "</infoTributaria>\n";						
							$idbuscarenvio=$rs_buscaid->fields["comcab_clavedeaccesos"];
							$salida_xml .= "<infoFactura>\n";
							
							$fechaemision=explode(" ",$rs_buscaid->fields["comcab_fechaemision_cliente"]);
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
							$detallesgrupo="select  comcabdet_valorimpuesto,comcabdet_impuesto,comcabdet_ivasino,sum(comcabdet_total) as tvalor from ca_factura_detalle where comcab_id='".$rs_buscaid->fields["comcab_id"]."' group by comcabdet_ivasino";
							
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
                            $salida_xml .= "<moneda>DOLAR</moneda>\n";
							$salida_xml .= "</infoFactura>\n";	
							
							
							
	 	$salida_xml .= "<detalles>\n";	
		
		//Saca detalles
		$busca_detalle="select * from ca_factura_detalle where comcab_id='".$rs_buscaid->fields["comcab_id"]."'";
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
	  
  
	  $salida_xml .= "<impuestos>\n";
      $salida_xml .= "<impuesto>\n";
      $salida_xml .= "<codigo>".$rs_buscadetalle->fields["comcabdet_impuesto"]."</codigo>\n";
      $salida_xml .= "<codigoPorcentaje>".$rs_buscadetalle->fields["comcabdet_ivasino"]."</codigoPorcentaje>\n";
	  
	 
	    // $valorivadata=number_format($objimpuestos->cgfe_iva, 2, '.', '');
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
											  
							
						
					  
					        $rs_buscaid->MoveNext();
					  }
					}  
 
 



//$archivo = "../../../../../xmlfacturas/".$_POST["pcomcab_id"].".xml";
//$id = fopen($archivo, 'w+');
//$cadena = $salida_xml;
//fwrite($id, $cadena);
//fclose($id);
 
 //guarda en base xml
 
 $xmlbtval=base64_encode($salida_xml);
 $xmlbase="update ca_factura_cabecera set comcab_xml='".$xmlbtval."' where comcab_id='".$_POST["pcomcab_id"]."'";
 //echo $xmlbase;
  $okxmldat=$DB_gogess->Execute($xmlbase);
 //guarda en base xml
 //crando xml
 
 
 
}
else
{

  echo "no existe";
}


}

?>