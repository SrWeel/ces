<?php
ini_set('display_errors',0);
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
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#F0F0F0"><strong>No</strong></td>
    <td bgcolor="#F0F0F0"><strong>NUMERO FACTURA</strong></td>
    <td bgcolor="#F0F0F0"><strong>FECHA FACTURA</strong></td>
	<td bgcolor="#F0F0F0"><strong>ANULADA</strong></td>
    <td bgcolor="#F0F0F0"><strong>ESTADO SRI</strong></td>
	<td bgcolor="#F0F0F0"><strong>N AUTORIZACION</strong></td>
	<td bgcolor="#F0F0F0"><strong>FECHA SRI</strong></td>
  </tr>
<?php

$busca_listatx="select * from beko_documentocabecera where doccab_fechaemision_cliente>='2024-05-01' and doccab_fechaemision_cliente<='2024-05-19'";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
	
	$contador++;
	$colord_data='';
		 
		$doccab_anulado=$rs_listatx->fields["doccab_anulado"];
		$estado_local='';
		if($doccab_anulado==1)
		{
		   $estado_local='ANULADO'; 
		}
	
	$rete_acceso='';
	$rete_acceso=$rs_listatx->fields["doccab_clavedeaccesos"];
		
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
	
		
			?>
  <tr <?php echo $colord_data; ?> >
    <td><?php echo $contador; ?></td>
    <td><?php echo $rs_listatx->fields["doccab_ndocumento"]; ?></td>
    <td><?php echo $rs_listatx->fields["doccab_fechaemision_cliente"]; ?></td>
	<td><?php echo $estado_local; ?></td>
	<td><?php echo $resultados_sri["estado"]; ?></td>
	<td><?php echo $resultados_sri["numaut"]; ?></td>
	<td><?php echo $resultados_sri["fechaaut"]; ?></td>
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
