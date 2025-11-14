<?php
ini_set('display_errors',0);
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


?>
<table border="1" align="center" cellpadding="0" cellspacing="0">
<?php
$cuenta=0;
$lista_data="select * from rete_data";
$rs_enlace = $DB_gogess->executec($lista_data);
$cuenta_real=0;

if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
	  
	  $busca_data="select * from comprobante_retencion_cab where compretcab_nretencion='".$rs_enlace->fields["rete_numerodoc"]."'";
	  $rs_bdata = $DB_gogess->executec($busca_data);
	  
	  $compretcab_id=$rs_bdata->fields["compretcab_id"];
	  $rete_estado=$rs_bdata->fields["compretcab_estadosri"];
	  
	  $compra_id=$rs_bdata->fields["compra_id"];
	  $compretcab_anulado=$rs_bdata->fields["compretcab_anulado"];
	  $cuenta++;
	  
	  
	  //======================================================
	  
	$compretcab_xml=$rs_enlace->fields["rete_xml"];
	if($compretcab_xml)
	{
	$cuenta_real++;
	$xmlstr_detail=base64_decode($compretcab_xml);
	$estructura=array();
	$estructura = new SimpleXMLElement(utf8_decode($xmlstr_detail)); 
	$datas_cuenta='';
	$numimpuesto=count($estructura->docsSustento->docSustento->retenciones->retencion);	
	$valor_retenidox=0;
	$ix=1;
	
	$total_ret=0;
		
	    for($id=0;$id<$numimpuesto;$id++)
		  {
		   
		   $descripcioncodret='';		
		   @$codigoRetencion=$estructura->docsSustento->docSustento->retenciones->retencion[$id]->codigoRetencion->__toString();
		  // if(@$codigoRetencion=='303')
		  // {
		   $valor_retenidox=$valor_retenidox+$estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
		   
		   $datas_cuenta=$datas_cuenta.' - > '.@$codigoRetencion.' : '.$estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
		    $suma_array[@$codigoRetencion]=$suma_array[@$codigoRetencion]+$estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
			
			 $total_ret=$total_ret+$estructura->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
		  // }
		 
		 }
	 
	 } 
	  //======================================================
	  
	  
			?>
			  
  <tr>
    <td><?php echo $cuenta; ?></td>
	<td><?php echo $rs_enlace->fields["rete_numerodoc"]; ?></td>
    <td><?php echo $rs_enlace->fields["rete_acceso"]; ?></td>
    <td>AUTORIZADO</td>
	<td><?php echo $rete_estado; ?></td>
	<td><?php echo $compra_id; ?></td>
	<td><?php echo $compretcab_anulado; ?></td>
	<td><?php echo $total_ret; ?></td>
  </tr>
  
  
			<?php
			  $rs_enlace->MoveNext();
			}
    }		

?>
</table>
<?php

print_r($suma_array);
echo $cuenta_real;

}

?>