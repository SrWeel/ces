<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include ("../../../../../libreria/nusoap/lib/nusoap.php"); 

function obtener_resultado($datos)
 {
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
						
						
						$motivo_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"];
						print_r($motivo_aut);
						//$identificador=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["identificador"];
						
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
								
								$motivo_aut=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["mensajes"]["mensaje"];
								print_r($motivo_aut);
								$identificador=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["mensajes"]["mensaje"][0]["identificador"];
								
								$clvbusca=$datos["RespuestaAutorizacionComprobante"]["claveAccesoConsultada"];
								
								if($estado_aut=='AUTORIZADO')
									{
										$i=$ncomprobantes+5;
									}
  
								}
								
								
										  //mayor a uno
			               }
										
			  }
				
		$sridata["estado"]=$estado_aut;
		$sridata["motivo"]=$motivo_aut;
		$sridata["codigo"]=$identificador;
		$sridata["numaut"]=$num_aut;
		$sridata["fechaaut"]=$fecha_aut;

  return $sridata;
 }
 
 
 $listcg_claveAcceso=$_POST["pVar1"];
// echo $listcg_claveAcceso;
 $cliente = new nusoap_client("https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl", true);
		$resultado = $cliente->call(
				 "autorizacionComprobante", 
					array(
							'claveAccesoComprobante' => $listcg_claveAcceso
						)
			);
	
	$error = $cliente->getError();
	//print_r($error); 
	$resultados_sri=obtener_resultado($resultado);
	//print_r($resultados_sri);
	$arreglolista=$resultado;
?>