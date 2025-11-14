<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."precuentasinfactura_".$fechahoy.".xls");


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
$conta_caso1=0;
$conta_caso2=0;
$conta_caso3=0;
?>
PRECUENTAS SIN FACTURA
<table border="1" align="center" cellpadding="4" cellspacing="3">
  <tr>
    <td bgcolor="#F0F0F0"><strong>No</strong></td>
	<td bgcolor="#F0F0F0"><strong>CI</strong></td>
    <td bgcolor="#F0F0F0"><strong>CODIGO</strong></td>
    <td bgcolor="#F0F0F0"><strong>PACIENTE</strong></td>
    <td bgcolor="#F0F0F0"><strong>OBSERVACION</strong></td>
	<td bgcolor="#F0F0F0"><strong>FECHA INICIO</strong></td>
	<td bgcolor="#F0F0F0"><strong>FECHA FIN</strong></td>
	<td bgcolor="#F0F0F0"><strong>FECHA REGISTRO</strong></td>
	<td bgcolor="#F0F0F0"><strong>ESTADO</strong></td>
	<td bgcolor="#F0F0F0"><strong>USADO 1</strong></td>
	<td bgcolor="#F0F0F0"><strong>USADO 2</strong></td>
	<td bgcolor="#F0F0F0"><strong>FACTURAS</strong></td>
	<td bgcolor="#F0F0F0"><strong>FACTURAS</strong></td>
  </tr>
<?php

$mes=$_GET["mes"];

//app_cliente
//dns_atencion
//dns_precuenta

$precuentas_sinfac=0;

$busca_listatx="select * from app_cliente inner join dns_atencion on app_cliente.clie_id=dns_atencion.clie_id inner join dns_precuenta on dns_atencion.atenc_enlace=dns_precuenta.atenc_enlace where 	year(precu_fecharegistro)>=2023 order by precu_fechainicio asc";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
	$contador++;
	
    $busca_detalle1c="select count(*) as totalfac from beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id where beko_documentodetalle.precu_id='".$rs_listatx->fields["precu_id"]."'";
	$rs_detalle1c = $DB_gogess->executec($busca_detalle1c);
	
	$busca_detalle2c="select count(*) as totalfac1 from beko_documentocabecera inner join beko_mhdetallefactura on beko_documentocabecera.doccab_id=beko_mhdetallefactura.doccab_id where beko_mhdetallefactura.precu_id='".$rs_listatx->fields["precu_id"]."'";
	$rs_detalle2c = $DB_gogess->executec($busca_detalle2c);
	
	
	$busca_detae="select * from dns_estadoprecuenta where estap_id='".$rs_listatx->fields["precu_activo"]."'";
	$rs_detalet = $DB_gogess->executec($busca_detae);
	
	$totalfac=$rs_detalle1c->fields["totalfac"];
	$totalfac1=$rs_detalle2c->fields["totalfac1"];
	
	
	$facturas_asignadas='';
	$busca_detalle1cfac="select distinct doccab_ndocumento from beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id where beko_documentodetalle.precu_id='".$rs_listatx->fields["precu_id"]."'";
	$rs_detalle1cfac = $DB_gogess->executec($busca_detalle1cfac);
	if($rs_detalle1cfac)
		{
		   while (!$rs_detalle1cfac->EOF) 
				{
				
				  $facturas_asignadas.=''.$rs_detalle1cfac->fields["doccab_ndocumento"]."<br>";
				
				  $rs_detalle1cfac->MoveNext();
	   			}
		}	
		
		
   	
	$facturas_asignadas2='';
	$busca_detalle1cfac2="select distinct doccab_ndocumento from beko_documentocabecera inner join beko_mhdetallefactura on beko_documentocabecera.doccab_id=beko_mhdetallefactura.doccab_id where beko_mhdetallefactura.precu_id='".$rs_listatx->fields["precu_id"]."'";
	$rs_detalle1cfac2 = $DB_gogess->executec($busca_detalle1cfac2);
	if($rs_detalle1cfac2)
		{
		   while (!$rs_detalle1cfac2->EOF) 
				{
				
				  $facturas_asignadas2.=''.$rs_detalle1cfac2->fields["doccab_ndocumento"]."<br>";
				
				  $rs_detalle1cfac2->MoveNext();
	   			}
		}	
		
				
if($totalfac==0 and $totalfac1==0)
{

  $precuentas_sinfac++;
  
}

			?>
  <tr>
    <td><?php echo $contador; ?></td>
	<td nowrap="nowrap" style=mso-number-format:"@" ><?php echo $rs_listatx->fields["clie_rucci"]; ?></td>
    <td><?php echo $rs_listatx->fields["precu_id"]; ?></td>
    <td nowrap="nowrap"><?php echo $rs_listatx->fields["clie_nombre"].' '.$rs_listatx->fields["clie_apellido"]; ?></td>
    <td><?php echo $rs_listatx->fields["precu_observacion"]; ?></td>
	<td><?php echo $rs_listatx->fields["precu_fechainicio"]; ?></td>
	<td><?php echo $rs_listatx->fields["precu_fechafinal"]; ?></td>
	<td nowrap="nowrap"><?php echo $rs_listatx->fields["precu_fecharegistro"]; ?></td>
	<td><?php echo $rs_detalet->fields["estap_nombre"]; ?></td>
	<td><?php echo $totalfac; ?></td>
	<td nowrap="nowrap"><?php echo $totalfac1; ?></td>
	<td nowrap="nowrap"><?php echo $facturas_asignadas; ?></td>
	<td nowrap="nowrap"><?php echo $facturas_asignadas2; ?></td>
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
<br /><br />
PRECUENTAS SIN FACTURAS: <?php echo $precuentas_sinfac; ?>
<br /><br />


</body>
</html>
