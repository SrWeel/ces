<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Genera</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>



</head>

<body>
<?php


if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
include ("lib/nusoap.php");
$link_envio="https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";
$debug=1;

$contador=0;
 $totalvalor=0;
 $colord_data='';
 $totalvalorxml=0;
 $suma_array=array();
 
 
 

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
						
						$comprobante_data=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["comprobante"];
						
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
								
								$comprobante_data=$rsultadosri["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["comprobante"];
								
								$clvbusca=$datos["RespuestaAutorizacionComprobante"]["claveAccesoConsultada"];
								
								if($estado_aut=='AUTORIZADO')
									{
										$i=$ncomprobantes+5;
									}
  
								}
								
								
										  //mayor a uno
			               }
					
					//================================================
					
					$estructura = new SimpleXMLElement(utf8_encode($comprobante_data));
					
					$numimpuesto=count($estructura->docsSustento->docSustento->retenciones->retencion);	
					$suma_valores=0;
					for($id=0;$id<$numimpuesto;$id++)
		            {
					
					  $valor_retenido=$estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
					  //echo $valor_retenido."<br>";
					  $suma_valores=$suma_valores+$valor_retenido;
					  
					}
									
					//================================================					
			  }
				
		$sridata["estado"]=@$estado_aut;
		$sridata["motivo"]=@$motivo_aut;
		$sridata["codigo"]=@$identificador;
		$sridata["numaut"]=@$num_aut;
		$sridata["fechaaut"]=@$fecha_aut;
		$sridata["comprobante"]=@$comp_data;
		$sridata["valorret"]=@$suma_valores;

  return $sridata;
 }



?>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#F0F0F0"><strong>No</strong></td>
	<td bgcolor="#F0F0F0"><strong>NUMERO RETENCION</strong></td>
	<td bgcolor="#F0F0F0"><strong>FECHA RETENCON</strong></td>
    <td bgcolor="#F0F0F0"><strong>NUMERO FACTURA</strong></td>
    <td bgcolor="#F0F0F0"><strong>FECHA FACTURA</strong></td>
	<td bgcolor="#F0F0F0"><strong>ANULADA</strong></td>
    <td bgcolor="#F0F0F0"><strong>ESTADO SRI LOCAL</strong></td>
	<td bgcolor="#F0F0F0"><strong>ESTADO SRI</strong></td>
	<td bgcolor="#F0F0F0"><strong>N AUTORIZACION</strong></td>
	<td bgcolor="#F0F0F0"><strong>FECHA SRI</strong></td>
	<td bgcolor="#F0F0F0"><strong>VALOR RETENCION SISTEMA</strong></td>
	<td bgcolor="#F0F0F0"><strong>VALOR RETENCION SRI</strong></td>
  </tr>
<?php

$busca_listatx="select * from comprobante_retencion_cab where compretcab_fechaemision_cliente>='2024-01-01' and compretcab_fechaemision_cliente<='2024-02-01'";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
	
	$contador++;
	$colord_data='';
		 
		$compretcab_anulado=$rs_listatx->fields["compretcab_anulado"];
		$estado_local='';
		if($compretcab_anulado==1)
		{
		   $estado_local='ANULADO'; 
		}
	
	$rete_acceso='';
	$rete_acceso=$rs_listatx->fields["compretcab_clavedeaccesos"];
		
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
	
	//VALOR retencion sistema
	
	$busca_valorret="select sum(compretdet_valorretenido) as valorsys from 	comprobante_retencion_detalle where compretcab_id='".$rs_listatx->fields["compretcab_id"]."'";
	$rs_valorretsys = $DB_gogess->executec($busca_valorret);
	
	$valorsys=$rs_valorretsys->fields["valorsys"];
	
	$color='';
	if(round($valorsys,2)!=round($resultados_sri["valorret"],2))
	{
	  $colord_data=' bgcolor="#ECCED9" ';
	}  
		
			?>
  <tr <?php echo $colord_data; ?> >
    <td><?php echo $contador; ?></td>
	<td><?php echo $rs_listatx->fields["compretcab_nretencion"]; ?></td>
	<td><?php echo $rs_listatx->fields["compretcab_fechaemision_cliente"]; ?></td>	
    <td><?php echo $rs_listatx->fields["compretcab_nfactura"]; ?></td>
    <td><?php echo $rs_listatx->fields["compretcab_nfacturafecha"]; ?></td>	
	<td><?php echo $estado_local; ?></td>
	<td><?php echo $rs_listatx->fields["compretcab_estadosri"]; ?></td>
	<td><?php echo $resultados_sri["estado"]; ?></td>
	<td><?php echo $resultados_sri["numaut"]; ?></td>
	<td><?php echo $resultados_sri["fechaaut"]; ?></td>
	
	<td><?php echo round($valorsys,2); ?></td>
	<td><?php echo round($resultados_sri["valorret"],2); ?></td>
  </tr>
			<?php
	
			
			$rs_listatx->MoveNext();
			}
	}		

?>

<tr >
    <td>&nbsp;</td>
	<td></td>
    <td></td>
	<td></td>
    <td></td>
	<td></td> 
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
  </tr>
  
</table>

<?php
print_r($suma_array);
}
?>



<script type="text/javascript">
<!--





//  End -->
</script>


</body>
</html>
