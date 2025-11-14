<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

function busca_conarbol($cuenta,$DB_gogess)
{
    $busca_detalles="select count(*) as total from lpin_plancuentas_vista where  planc_codigocp like '".$cuenta.".%'";
	
	$rs_stotales = $DB_gogess->executec($busca_detalles,array());
   
    return $rs_stotales->fields["total"]-1;

}

?>
<table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
<?php
$busca_listatx="SELECT distinct detcc_cuentacontable FROM `lpin_detallecomprobantecontable` WHERE 1 ORDER BY `lpin_detallecomprobantecontable`.`detcc_cuentacontable` ASC";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
			  $toma_cuentas=$rs_listatx->fields["detcc_cuentacontable"];
			  $toma_lista=array();
			  $toma_lista=explode(".",$toma_cuentas);
			  //print_r($toma_lista);
			  $toma_listanum=0;
			  $toma_listanum=count($toma_lista)-1;
			  $cuenta_data='';
			  for($i=0;$i<$toma_listanum;$i++)
			  {
			      $cuenta_data=$cuenta_data.$toma_lista[$i]."."; 
			  
			  }
		
		$cantidad_val=0;	   
	    $cantidad_val=busca_conarbol($toma_cuentas,$DB_gogess);
			   ?>
			    <tr>
					<td><?php echo $toma_cuentas; ?></td>
					<td> - > Cuenta Anterior -> </td>
					<td><?php echo $cuenta_data; ?></td>
					<td><?php echo $cantidad_val; ?></td>
				  </tr> 
			   
			   <?php
			   
			
			  $rs_listatx->MoveNext();			
			}
	}		
			
?>
</table>
<?php

}
?>

