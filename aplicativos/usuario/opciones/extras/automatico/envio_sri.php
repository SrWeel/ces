<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(isset($_SESSION['ces1313777_sessid_inicio']))
{
$director="../../../../../";
include ("../../../../../cfgclases/clases.php");
include ("../../../../../libreria/nusoap/lib/nusoap.php"); 
include ("liblectura.php"); 



$siguiente=$_POST["idp_valor"]+1;

//cvlacceso
//archivobase

$selecTabla="select * from kyradm_automatico where auto_id=".$_POST['auto_id'];   

 
		  $rs_gogessform = $DB_gogess->Execute($selecTabla);
		  if($rs_gogessform)
		  {
				while (!$rs_gogessform->EOF) {	
				
				$path_firmadoindividual["pdf"]=$rs_gogessform->fields["auto_destinopdf"];
				$path_firmadoindividual["xml"]=$rs_gogessform->fields["auto_destinoxml"];
				
				$path_firmadoindividual["tipocmp_codigo"]=$rs_gogessform->fields["tipocmp_codigo"];
				
				$auto_lote=$rs_gogessform->fields["auto_lote"];
				
				$tpifin_id=$rs_gogessform->fields["tpifin_id"];
				
					
				
				$rs_gogessform->MoveNext();	   
				}
		  }		

function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
//cvlacceso
//archivobase
//auto_id

//busca si ya fue validado
$listavalidar="select * from factura_detallista where  listcgd_archivo='".$_POST["archivov"]."'";

$rs_validado = $DB_gogess->Execute($listavalidar);
				if($rs_validado)
				{   
				   while (!$rs_validado->EOF) {	
				   
				   $listcgd_validado=$rs_validado->fields["listcgd_validado"];
				   $listcg_claveAcceso=$rs_validado->fields["listcgd_claveacceso"];
				   $listcgd_xmlfirmado=$rs_validado->fields["listcgd_xmlfirmado"];
				   
				   $listcgd_archivobase=$rs_validado->fields["listcgd_archivobase"];

				   
				   $rs_validado->MoveNext();
				   }
				}   
				
//echo base64_decode($listcgd_xmlfirmado);
if($_POST["ndoc"]==$_POST["naut"])
{
	  $ready_estado='';
	  $mensajeerror="Autorizando y creando archivos:".$_POST["ndoc"];	
	  $actualizados_valor=$_POST["ndoc"];
	  
	  
}
else
{
	//-------------------------------------------------

if($listcgd_validado=='RECIBIDA')
	{
	sleep(1);
	
	$actualizalotev="update factura_listacargados set listcg_sriautorizado='SI' where listcg_archivo='".$listcgd_archivobase."'";
	$okv=$DB_gogess->Execute($actualizalotev);
	
	if($okv)
	{
	//----------------------------------------------------------------------------------------
	
	if($auto_lote==1)
   {
	$cliente = new nusoap_client("https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl", true);
	$resultado = $cliente->call(
		 "autorizacionComprobanteLoteMasivo", 
		  array(
				'claveAccesoLote' => $listcg_claveAcceso
				)
	);
	
   }
   else
   {
	    $cliente = new nusoap_client("https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl", true);
		$resultado = $cliente->call(
				 "autorizacionComprobante", 
					array(
							'claveAccesoComprobante' => $listcg_claveAcceso
						)
			);
	   
   }
	
	
	$error = $cliente->getError();
	//print_r($error); 
	//print_r($resultado);
	if($error)
	{
	$mensajeerror="SRI SIN CONEXION";	
	
	            $comprovante_autx1='<?xml version="1.0" encoding="UTF-8"?>
				<autorizacion>
				<estado>NO AUTORIZADO</estado>
				<numeroAutorizacion>0</numeroAutorizacion>
				<fechaAutorizacion>0</fechaAutorizacion>
				<ambiente>0</ambiente>
				<comprobante>';
				$archivofirmado1=$mensajeerror;
				$comprovante_autpiex1='</comprobante></autorizacion>';
				$archivoautx1=$comprovante_autx1.$archivofirmado1.$comprovante_autpiex1;
				
				$comcab_archivo1=$listcgd_archivobase;
				$nombrearchivo1=str_replace(".txt","",$comcab_archivo1);
				$nombrearchivo1=str_replace(".TXT","",$nombrearchivo1);
				
				$archivo =$path_firmadoindividual["xml"].$nombrearchivo1.".xml";
				$id = fopen($archivo, 'w+');
				fwrite($id,$archivoautx1);
				fclose($id);
				$archivoautx='';
	
	
	}
    else
	{

	
	
	$cantidadautorizado=obtener_datosresultado($resultado,$path_firmadoindividual,$_POST["archivov"],$path_firmadoindividual["tipocmp_codigo"],$_POST["idp_valor"],$tpifin_id,$DB_gogess);
	

 
    //actualiza cargados
	$actualdata="update factura_detallista set listcgd_autorizados=".$cantidadautorizado." where listcgd_archivo='".$_POST["archivov"]."'";

	$okactual=$DB_gogess->Execute($actualdata);
	if($okactual)
	{
		
		$actualizados_valor=$cantidadautorizado;
	}
	//actualiza cargados
	if($cantidadautorizado==0)
	{
	  $mensajeerror="No se autorizo ningun documento...";	
	}
	else
	{
	   $mensajeerror="Autorizando y creando archivos:".$cantidadautorizado;	
	}
	
	
	
	}
	
	//-----------------------------------------------------------------------------------------
	}
	
	
	
	
	}
	else
	{
		
		
	//------------------------------------------------------------------------------------------
	
	
	$salida_xml=$listcgd_xmlfirmado;

if($auto_lote==1)
{
  $client = new nusoap_client("https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionLoteMasivo?wsdl", true);
								$resultado = $client->call(
									 "validarLoteMasivo", 
									  array(
											'archivo' =>  $salida_xml
											)
								);
}
else
{
  $client = new nusoap_client("https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl", true);
								$resultado = $client->call(
									 "validarComprobante", 
									  array(
											'xml' =>  $salida_xml
											)
								);	
	
}
$error = $client->getError(); 

//print_r($error);
if($error)
{
$mensajeerror="SRI SIN CONEXION";	

                $comprovante_autx1='<?xml version="1.0" encoding="UTF-8"?>
				<autorizacion>
				<estado>NO AUTORIZADO</estado>
				<numeroAutorizacion>0</numeroAutorizacion>
				<fechaAutorizacion>0</fechaAutorizacion>
				<ambiente>0</ambiente>
				<comprobante>';
				$archivofirmado1=$mensajeerror;
				$comprovante_autpiex1='</comprobante></autorizacion>';
				$archivoautx1=$comprovante_autx1.$archivofirmado1.$comprovante_autpiex1;
				
				$comcab_archivo1=$listcgd_archivobase;
				$nombrearchivo1=str_replace(".txt","",$comcab_archivo1);
				$nombrearchivo1=str_replace(".TXT","",$nombrearchivo1);
				
				$archivo =$path_firmadoindividual["xml"].$nombrearchivo1.".xml";
				$id = fopen($archivo, 'w+');
				fwrite($id,$archivoautx1);
				fclose($id);
				$archivoautx='';


}
//print_r($resultado);

$arreglolista=$resultado;


if($auto_lote==1)
{
//--------------------------------------------------------------------------------
$ready_estado=$arreglolista["RespuestaRecepcionLoteMasivo"]["estado"];
if($ready_estado=='DEVUELTA')
{

$motivo=str_replace("'"," ",$arreglolista["RespuestaRecepcionLoteMasivo"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["informacionAdicional"]);
$actualizacrg="update factura_detallista set listcgd_validado='".$ready_estado."',listcgd_motivo='".$motivo."' where listcgd_archivo='".$_POST["archivov"]."'";
$okv=$DB_gogess->Execute($actualizacrg); 

                $comprovante_autx1='<?xml version="1.0" encoding="UTF-8"?>
				<autorizacion>
				<estado>NO AUTORIZADO</estado>
				<numeroAutorizacion>0</numeroAutorizacion>
				<fechaAutorizacion>0</fechaAutorizacion>
				<ambiente>0</ambiente>
				<comprobante>';
				$archivofirmado1=$ready_estado."-".$motivo;
				$comprovante_autpiex1='</comprobante></autorizacion>';
				$archivoautx1=$comprovante_autx1.$archivofirmado1.$comprovante_autpiex1;
				
				$comcab_archivo1=$listcgd_archivobase;
				$nombrearchivo1=str_replace(".txt","",$comcab_archivo1);
				$nombrearchivo1=str_replace(".TXT","",$nombrearchivo1);
				
				$archivo =$path_firmadoindividual["xml"].$nombrearchivo1.".xml";
				$id = fopen($archivo, 'w+');
				fwrite($id,$archivoautx1);
				fclose($id);
				$archivoautx='';



}
else
{

$actualizacrg="update factura_detallista set listcgd_validado='".$ready_estado."',listcgd_motivo='' where listcgd_archivo='".$_POST["archivov"]."'";
$okv=$DB_gogess->Execute($actualizacrg);

}

//---------------------------------------------------------------------------------
}
else
{
	
//----------------------------------------------------------------------------------
$ready_estado=$arreglolista["RespuestaRecepcionComprobante"]["estado"];

if($ready_estado=='DEVUELTA')
{


//$mensajev=$arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["mensaje"];
$motivo=str_replace("'"," ",$arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["informacionAdicional"]);

$actualizacrg="update factura_detallista set listcgd_validado='".$ready_estado."',listcgd_motivo='".$motivo."' where listcgd_archivo='".$_POST["archivov"]."'";
$okv=$DB_gogess->Execute($actualizacrg); 

 				$comprovante_autx1='<?xml version="1.0" encoding="UTF-8"?>
				<autorizacion>
				<estado>NO AUTORIZADO</estado>
				<numeroAutorizacion>0</numeroAutorizacion>
				<fechaAutorizacion>0</fechaAutorizacion>
				<ambiente>0</ambiente>
				<comprobante>';
				$archivofirmado1=$ready_estado."-".$motivo;
				$comprovante_autpiex1='</comprobante></autorizacion>';
				$archivoautx1=$comprovante_autx1.$archivofirmado1.$comprovante_autpiex1;
				
				$comcab_archivo1=$listcgd_archivobase;
				$nombrearchivo1=str_replace(".txt","",$comcab_archivo1);
				$nombrearchivo1=str_replace(".TXT","",$nombrearchivo1);
				
				$archivo =$path_firmadoindividual["xml"].$nombrearchivo1.".xml";
				$id = fopen($archivo, 'w+');
				fwrite($id,$archivoautx1);
				fclose($id);
				$archivoautx='';


}
else
{

$actualizacrg="update factura_detallista set listcgd_validado='".$ready_estado."',listcgd_motivo='' where listcgd_archivo='".$_POST["archivov"]."'";
$okv=$DB_gogess->Execute($actualizacrg);

}

//----------------------------------------------------------------------------------


}


	
	
	
	//-------------------------------------------------------------------------------------------	
		
		
		
		
		
	}
	
	//-------------------------------------------------

}



if($_POST["total_lotes"]<$siguiente)
{
	 echo " var result_siguiente = 'x'; ";
	 echo " var result_acceso = '".$ready_estado."'; ";
	 echo " var result_sriacceso = '".$mensajeerror."'; ";
	 echo " var result_seactualizo = '".$actualizados_valor."'; ";	 
}
else
{
    echo " var result_siguiente = '".$siguiente."'; ";
	echo " var result_acceso = '".$ready_estado."'; ";
	echo " var result_sriacceso = '".$mensajeerror."'; ";
	echo " var result_seactualizo = '".$actualizados_valor."'; ";	
}




}
?>