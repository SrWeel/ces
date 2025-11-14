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
?>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#F0F0F0"><strong>No</strong></td>
	<td bgcolor="#F0F0F0"><strong>FACTURA</strong></td>
    <td bgcolor="#F0F0F0"><strong>CLAVE DE ACCESO</strong></td>
    <td bgcolor="#F0F0F0"><strong>FECHA</strong></td>
    <td bgcolor="#F0F0F0"><strong>ESTADO</strong></td>
    <td bgcolor="#F0F0F0"><strong>TOTAL</strong></td>
	<td bgcolor="#F0F0F0"><strong>IVA</strong></td>
	<td bgcolor="#F0F0F0"><strong>SIN IVA</strong></td>
	<td bgcolor="#F0F0F0"><strong>SUMA</strong></td>
  </tr>
<?php

$busca_listatx="select * from beko_documentocabecera ";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
	$contador++;	

	
	$busca_detalle="select round(sum(docdet_total),2) as total from beko_documentodetalle_factur where doccab_id='".$rs_listatx->fields["doccab_id"]."'";
	$rs_buscadetalle = $DB_gogess->executec($busca_detalle,array()); 
		
	if($rs_buscadetalle->fields["total"]>0)
	{	
	
	$totalv=0;
	$totalv=$rs_listatx->fields["doccab_subtotaliva"]+$rs_listatx->fields["doccab_subtotalsiniva"];
	
	$colord_data='';
	if($totalv!=$rs_buscadetalle->fields["total"])
	{
	  $colord_data=' bgcolor="#F7C8DC" ';
	}
			?>
  <tr <?php echo $colord_data; ?> >
    <td><?php echo $contador; ?></td>
	<td><?php echo $rs_listatx->fields["doccab_ndocumento"]; ?></td>
    <td><?php echo $rs_listatx->fields["doccab_clavedeaccesos"]; ?></td>
    <td><?php echo $rs_listatx->fields["doccab_fechaemision_cliente"]; ?></td>
    <td><?php echo $rs_listatx->fields["doccab_estadosri"]; ?></td>
    <td><?php echo $rs_buscadetalle->fields["total"]; ?></td>
	<td><?php echo $rs_listatx->fields["doccab_subtotaliva"]; ?></td>
	<td><?php echo $rs_listatx->fields["doccab_subtotalsiniva"]; ?></td>
	<td><?php echo $rs_listatx->fields["doccab_subtotaliva"]+$rs_listatx->fields["doccab_subtotalsiniva"]; ?></td>
  </tr>
			<?php
	}		
			
			$rs_listatx->MoveNext();
			}
	}		

?>
</table>

<?php
}
?>



<script type="text/javascript">
<!--





//  End -->
</script>


</body>
</html>
