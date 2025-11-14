<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."sinprecuenta_".$fechahoy.".xls");


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
FACTURAS SIN PRECUENTA
<table border="1" align="center" cellpadding="4" cellspacing="3">
  <tr>
    <td bgcolor="#F0F0F0"><strong>No</strong></td>
	<td bgcolor="#F0F0F0"><strong>TIPO</strong></td>
    <td bgcolor="#F0F0F0"><strong>NDOC</strong></td>
    <td bgcolor="#F0F0F0"><strong>RUC</strong></td>
    <td bgcolor="#F0F0F0"><strong>NOMBRE</strong></td>
	<td bgcolor="#F0F0F0"><strong>APELLIDO</strong></td>
	<td bgcolor="#F0F0F0"><strong>ID CLIENTE</strong></td>
	<td bgcolor="#F0F0F0"><strong>TOTAL</strong></td>
    <td bgcolor="#F0F0F0"><strong>CANT PRECUENTA</strong></td>
	<td bgcolor="#F0F0F0"><strong>CANT PRECUENTA</strong></td>
	<td bgcolor="#F0F0F0"><strong>CASO1 ( varios items en grid producto sin precuenta)</strong></td>
	<td bgcolor="#F0F0F0"><strong>CASO2 ( varios items en grid varios sin precuenta)</strong></td>
	<td bgcolor="#F0F0F0"><strong>CASO3 ( varios items en grid cuentas)</strong></td>
  </tr>
<?php

$mes=$_GET["mes"];

$busca_listatx="select doccab_id,tipocmp_codigo,doccab_ndocumento,doccab_rucci_cliente,doccab_nombrerazon_cliente,doccab_apellidorazon_cliente,doccab_identificacionpaciente,doccab_total,
(select count(*) producto_precuenta from beko_documentodetalle where beko_documentodetalle.doccab_id=beko_documentocabecera.doccab_id and precu_id>0) as cprecuenta1,
(select count(*) producto_precuenta from beko_mhdetallefactura where beko_mhdetallefactura.doccab_id=beko_documentocabecera.doccab_id and precu_id>0) as cprecuenta2
from beko_documentocabecera where tipocmp_codigo!='04' and doccab_anulado=0 and doccab_ndocumento like '001-002-%' order by doccab_ndocumento asc";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
	$contador++;
	
	$estado_factu='';
	
	$bandera=0;
	if($rs_listatx->fields["cprecuenta1"]=='0' and $rs_listatx->fields["cprecuenta2"]=='0')
	{
	$bandera=1;	
	}
	
	
	$busca_detalle1c="select count(*) as totalfac from beko_documentodetalle where beko_documentodetalle.doccab_id='".$rs_listatx->fields["doccab_id"]."'";
	$rs_detalle1c = $DB_gogess->executec($busca_detalle1c);
	
	$busca_detalle2c="select count(*) as totalfac1 from beko_mhdetallefactura where beko_mhdetallefactura.doccab_id='".$rs_listatx->fields["doccab_id"]."'";
	$rs_detalle2c = $DB_gogess->executec($busca_detalle2c);
	
	
	$busca_detalle3c="select count(*) as totalfac3 from lpin_cuentaventa where lpin_cuentaventa.doccab_id='".$rs_listatx->fields["doccab_id"]."'";
	$rs_detalle3c = $DB_gogess->executec($busca_detalle3c);
	
	
	$categoriapr='';
	if($rs_detalle1c->fields["totalfac"]>0 and $rs_detalle2c->fields["totalfac1"]==0)
	{	  
	    $busca_detalle1categ="select * from beko_documentodetalle inner join efacsistema_producto on prod_codigo=docdet_codprincipal  where beko_documentodetalle.doccab_id='".$rs_listatx->fields["doccab_id"]."'";
		$rs_detalle1categ = $DB_gogess->executec($busca_detalle1categ);
		if($rs_detalle1categ)
		{
		   while (!$rs_detalle1categ->EOF) 
				{
				    $busca_catex="select * from efacfactura_categproducto where catgp_id='".$rs_detalle1categ->fields["catgp_id"]."'";
					$rs_bcatex = $DB_gogess->executec($busca_catex);
					
					$colorx='';
					if($rs_bcatex->fields["catgp_nombre"]=='INSUMOS' or $rs_bcatex->fields["catgp_nombre"]=='MEDICAMENTOS')
					{
					  $colorx=" style='color:#FF0000' ";
					}
					
					$categoriapr.="<span ".$colorx." ><b>".$rs_bcatex->fields["catgp_nombre"]."</b> <br> ".$rs_detalle1categ->fields["docdet_descripcion"]."<br></span>";
					
					
				
				   $rs_detalle1categ->MoveNext();
				}
		}  
	   
	   
	     $conta_caso1++;   
	   
	}
	
	$categoriapr2='';
	if($rs_detalle1c->fields["totalfac"]==0 and $rs_detalle2c->fields["totalfac1"]>0)
	{
	
	    $busca_detalle1categx="select * from beko_mhdetallefactura  where beko_mhdetallefactura.doccab_id='".$rs_listatx->fields["doccab_id"]."'";
		$rs_detalle1categx = $DB_gogess->executec($busca_detalle1categx);
		if($rs_detalle1categx)
		{
		   while (!$rs_detalle1categx->EOF) 
				{
				    					
					$categoriapr2.="<span>".$rs_detalle1categx->fields["mhdetfac_descripcion"]."<br></span>";				
					
				
				   $rs_detalle1categx->MoveNext();
				}
		} 
	    
	   $conta_caso2++;   
	
	}
	
	
	$categoriapr3='';
	if($rs_detalle3c->fields["totalfac3"]>0)
	{
	
	    $busca_detalle1categx3="select * from lpin_cuentaventa where lpin_cuentaventa.doccab_id='".$rs_listatx->fields["doccab_id"]."'";
		$rs_detalle1categx3 = $DB_gogess->executec($busca_detalle1categx3);
		if($rs_detalle1categx3)
		{
		   while (!$rs_detalle1categx3->EOF) 
				{
				    					
					$categoriapr3.="<span>".$rs_detalle1categx3->fields["planv_codigoc"]."<br></span>";				
					
				
				   $rs_detalle1categx3->MoveNext();
				}
		} 
	    
	   $conta_caso3++;   
	
	}
	/*$busca_detalle1="select * from beko_documentodetalle where beko_documentodetalle.doccab_id='".$rs_listatx->fields["doccab_id"]."'";
	$rs_detalle1 = $DB_gogess->executec($busca_detalle1);
	if($rs_detalle1)
	{
	   while (!$rs_detalle1->EOF) 
			{
			
			
			}
	}		
	
	
	
	$busca_detalle2="select * from beko_mhdetallefactura where beko_documentodetalle.doccab_id='".$rs_listatx->fields["doccab_id"]."'";
	if($rs_detalle1)
	{
	   while (!$rs_detalle1->EOF) 
			{
			
			
			}
	}
	*/
	
	
	 
	 if($bandera==1)
	 {
			?>
  <tr>
    <td><?php echo $contador; ?></td>
	<td nowrap="nowrap"><?php echo $rs_listatx->fields["tipocmp_codigo"]; ?></td>
    <td nowrap="nowrap" style=mso-number-format:"@" ><?php echo $rs_listatx->fields["doccab_ndocumento"]; ?></td>
    <td nowrap="nowrap" style=mso-number-format:"@"  ><?php echo $rs_listatx->fields["doccab_rucci_cliente"]; ?></td>
    <td><?php echo $rs_listatx->fields["doccab_nombrerazon_cliente"]; ?></td>
	<td><?php echo $rs_listatx->fields["doccab_apellidorazon_cliente"]; ?></td>
	<td style=mso-number-format:"@" ><?php echo $rs_listatx->fields["doccab_identificacionpaciente"]; ?></td>
	<td><?php echo $rs_listatx->fields["doccab_total"]; ?></td>
	<td><?php echo $rs_listatx->fields["cprecuenta1"]; ?></td>
	<td><?php echo $rs_listatx->fields["cprecuenta2"]; ?></td>
	<td><?php echo $categoriapr; ?></td>
	<td><?php echo $categoriapr2; ?></td>
	<td><?php echo $categoriapr3; ?></td>
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
<br /><br />
CASO1: <?php echo $conta_caso1; ?>
<br /><br />
CASO2: <?php echo $conta_caso2; ?>
<br /><br />
CASO3: <?php echo $conta_caso3; ?>

</body>
</html>
