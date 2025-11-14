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

$contador=0;
 $totalvalor=0;
 $colord_data='';
 $totalvalorxml=0;
 
$suma_array=array();
?>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#F0F0F0"><strong>No</strong></td>
	<td bgcolor="#F0F0F0"><strong>FACTURA COMPRA</strong></td>
	<td bgcolor="#F0F0F0"><strong>ESTADO COMPRA</strong></td>
    <td bgcolor="#F0F0F0"><strong>FECHA</strong></td>
    <td bgcolor="#F0F0F0"><strong>FACTURA RETENCION</strong></td>
	<td bgcolor="#F0F0F0"><strong>ESTADO RETENCION SRI</strong></td>
	<td bgcolor="#F0F0F0"><strong>ESTADO RETENCION</strong></td>
    <td bgcolor="#F0F0F0"><strong>N RETENCION</strong></td>
	<td bgcolor="#F0F0F0"><strong>FECHA RETENCION</strong></td>
    <td bgcolor="#F0F0F0"><strong>VALOR RETENIDO</strong></td>
	<td bgcolor="#F0F0F0"><strong>XML VALOR</strong></td>
	<td bgcolor="#F0F0F0"><strong>data</strong></td>
  </tr>
<?php

$busca_listatx="select * from dns_compras where compra_fecha>='2023-07-01' and compra_fecha<='2023-07-31' ";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
	
	
	//compretcab_anulado=0 and
	
	$busca_retencion="select sum(compretdet_valorretenido) as vretenido from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where  compretcab_nfactura='".str_replace("-","",$rs_listatx->fields["compra_nfactura"])."' and compra_id='".$rs_listatx->fields["compra_id"]."'  and `compretcab_anulado`=0 ";
	//and `compretcab_anulado`=0
	// and porcentaje_id='303'
	
	$rs_bretencion = $DB_gogess->executec($busca_retencion,array()); 
	
	$valor_retenidox=0;
		
	if($rs_bretencion->fields["vretenido"]>0)
	{	
	$contador++;
	//compretcab_anulado=0 and
	$busca_retencion2="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where  compretcab_nfactura='".str_replace("-","",$rs_listatx->fields["compra_nfactura"])."' and compra_id='".$rs_listatx->fields["compra_id"]."'   and `compretcab_anulado`=0 ";
	//and `compretcab_anulado`=0
	//and porcentaje_id='303' 
	
	$rs_bretencion2 = $DB_gogess->executec($busca_retencion2,array()); 
	
	$compretcab_xml=$rs_bretencion2->fields["compretcab_xml"];
	$xmlstr_detail=base64_decode($compretcab_xml);
	$estructura=array();
	$estructura = new SimpleXMLElement($xmlstr_detail); 
	$datas_cuenta='';
	$numimpuesto=count($estructura->docsSustento->docSustento->retenciones->retencion);	
	$valor_retenidox=0;
	$ix=1;
		
	    for($id=0;$id<$numimpuesto;$id++)
		  {
		   
		   $descripcioncodret='';		
		   @$codigoRetencion=$estructura->docsSustento->docSustento->retenciones->retencion[$id]->codigoRetencion->__toString();
		  // if(@$codigoRetencion=='303')
		  // {
		   $valor_retenidox=$valor_retenidox+$estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
		   
		   $datas_cuenta=$datas_cuenta.' - > '.@$codigoRetencion.' : '.$estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
		   
		   $suma_array[@$codigoRetencion]=$suma_array[@$codigoRetencion]+$estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
		  // }
		 
		 }
		 
		 $colord_data='';
		 
	if(trim(round($rs_bretencion->fields["vretenido"],2))!=trim($valor_retenidox))
	{
	  $colord_data=' bgcolor="#F7C8DC" ';
	}
	
			?>
  <tr <?php echo $colord_data; ?> >
    <td><?php echo $contador; ?></td>
	<td><?php echo $rs_listatx->fields["compra_nfactura"]; ?></td>
	<td><?php echo $rs_listatx->fields["compra_anulado"]; ?></td>	
    <td><?php echo $rs_listatx->fields["compra_fecha"]; ?></td>
    <td><?php echo $rs_bretencion2->fields["compretcab_nfactura"]; ?></td>
	<td><?php echo $rs_bretencion2->fields["compretcab_estadosri"]; ?></td>
	<td><?php echo $rs_bretencion2->fields["compretcab_anulado"]; ?></td>
    <td><?php echo $rs_bretencion2->fields["compretcab_nretencion"]; ?></td>
	<td><?php echo $rs_bretencion2->fields["compretcab_fechaemision_cliente"]; ?></td>
    <td><?php echo round($rs_bretencion->fields["vretenido"],2); ?></td>
	<td><?php echo $valor_retenidox; ?></td>
	<td><?php echo $datas_cuenta; ?></td>
  </tr>
			<?php
			 
			 $totalvalor= $totalvalor+$rs_bretencion->fields["vretenido"];
			 $totalvalorxml= $totalvalorxml+$valor_retenidox;
			
	}		
			
			$rs_listatx->MoveNext();
			}
	}		

?>

<tr >
    <td></td>
	<td></td>
    <td></td>
	<td></td>
    <td></td>
	<td></td>
    <td><?php echo $totalvalor; ?></td>
	<td><?php echo $totalvalorxml; ?></td>
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
