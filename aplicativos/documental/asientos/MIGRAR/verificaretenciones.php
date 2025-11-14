<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$acfi_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

include("lib.php");
include ("lib/nusoap.php");

$link_envio="https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";
$debug=1;


$target_path="1792935261001_RETENCIONES.txt";
$url = $target_path;
$aux=array();
$archivo = fopen($url,'r');
$numlinea=0;
while ($linea = fgets($archivo)) {
   //echo $linea.'<br/>';
   
    $aux=array();
    $aux = explode(" ",$linea); 
	//echo $aux[0]."<br>";
	if($aux[0]=='Comprobante')
	{	
	  $separa_retenciones=array();
	  $separa_retenciones=explode("	",$aux[2]);
	  print_r($separa_retenciones);
	  
	  $rete_numerodoc=$separa_retenciones[1];
	  $rete_ruc=$separa_retenciones[2];
	  $rete_acceso=$separa_retenciones[3];
	  
	  $fecha_data=array();
	  $fecha_data=explode("/",$separa_retenciones[5]);	  
	  $rete_fecha=$fecha_data[2]."-".$fecha_data[1]."-".$fecha_data[0];
	  
	  
	  $rete_xml=$separa_retenciones[1];
	  $rete_xml='';
	  
	  //busca registro local
	  $busca_data="select * from comprobante_retencion_cab where compretcab_nretencion='".$rete_numerodoc."'";
	  $rs_bdata = $DB_gogess->executec($busca_data);
	  
	  $compretcab_id=$rs_bdata->fields["compretcab_id"];
	  $rete_estado=$rs_bdata->fields["compretcab_estadosri"];	 
	   
	  //busca registro local
	  
	  
	  //==============================================
	  
	    $cliente = new nusoap_client($link_envio, true);
		$resultado = $cliente->call(
				 "autorizacionComprobante", 
					array(
							'claveAccesoComprobante' => $rete_acceso
						)
			);
	
	$error = $cliente->getError();
	if($debug==1)
	{
	  print_r($error); 
     // print_r($resultado);
    }
	$resultados_sri=obtener_resultado($resultado);
	
	//print_r($resultados_sri);
	
	$rete_xml=base64_encode($resultados_sri["comprobante"]);
	  
	  //==============================================
	  
	  
	  $inserta_data="INSERT INTO rete_data (rete_numerodoc, rete_ruc, rete_acceso, rete_fecha, rete_xml,rete_baselocal,rete_estado) VALUES ('".$rete_numerodoc."','".$rete_ruc."','".$rete_acceso."','".$rete_fecha."','".$rete_xml."','".$compretcab_id."','".$rete_estado."');";
	  $rs_ok = $DB_gogess->executec($inserta_data);
	  
	  
	}
	   
    $numlinea++;
}

fclose($archivo);


}



function obtener_resultado($datos)
 {
              $rsultadosri=$datos;
			  $autorizoeldato=0;
			  $comp_data='';
			  @$ncomprobantes=$rsultadosri["RespuestaAutorizacionComprobante"]["numeroComprobantes"];
			  
			 // echo "xxx".$ncomprobantes;
			  //echo $rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["estado"];
			  if($ncomprobantes>=1)
			  {
				  //verifica si hay autorizacion	
				
				      if($ncomprobantes==1)
						{
								
						//igual a uno 
						$estado_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["estado"];
						$comp_data=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["comprobante"];
						$num_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["numeroAutorizacion"];
						$fecha_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["fechaAutorizacion"];
						$ambiente_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["ambiente"];  
						
					    $clvbusca=$datos["RespuestaAutorizacionComprobante"]["claveAccesoConsultada"];
						
						
						@$motivo_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["mensaje"];
						@$identificador=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["identificador"];
						
						//igual a uno  
						
						}
						else
						{
										  //mayor a uno
				            for($i=0;$i<$ncomprobantes;$i++)
								{
										  
								$estado_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["estado"];
								$comp_data=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["comprobante"];
								$num_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["numeroAutorizacion"];
								$fecha_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["fechaAutorizacion"];
								$ambiente_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["ambiente"];
								
								 $motivo_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["mensajes"]["mensaje"]["mensaje"];
								$identificador=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["mensajes"]["mensaje"]["identificador"];
								
								$clvbusca=$datos["RespuestaAutorizacionComprobante"]["claveAccesoConsultada"];
								
								if($estado_aut=='AUTORIZADO')
									{
										$i=$ncomprobantes+5;
									}
  
								}
								
								
										  //mayor a uno
			               }
										
			  }
				
		$sridata["estado"]=@$estado_aut;
		$sridata["motivo"]=@$motivo_aut;
		$sridata["codigo"]=@$identificador;
		$sridata["numaut"]=@$num_aut;
		$sridata["fechaaut"]=@$fecha_aut;
		$sridata["comprobante"]=@$comp_data;

  return $sridata;
 }


?>