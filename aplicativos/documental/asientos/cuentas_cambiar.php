<link href="../../../templates/page//menu/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../../templates/page/dependencies/bootstrap/css/bootstrap.min.css" type="text/css">
<link href="../../../templates/page//menu/css/hoe.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link type="text/css" href="../../../templates/page/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<link type="text/css" href="../../../templates/page/css/jquery.dataTables.min.css" rel="stylesheet" />	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../../../templates/page//menu/js/1.11.2.jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../../../templates/page//menu/js/bootstrap.min.js"></script>
<link type="text/css" href="../../../templates/page/css/responsive.dataTables.min.css" rel="stylesheet" />	
<link type="text/css" href="../../../templates/page/css/buttons.dataTables.min.css" rel="stylesheet" />	
<link rel="stylesheet" href="../../../templates/page/css/core.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../../../templates/page//css/jquery.datetimepicker.min.css" >
<script src="../../../templates/page//js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery.printPage.js"></script>
<link rel="stylesheet" href="../../../templates/page/css/wickedpicker.min.css" type="text/css">
<script src="../../../templates/page/js/jMonthCalendar.js" type="text/javascript"></script>
<script src="../../../templates/page/js/wickedpicker.min.js" type="text/javascript"></script>

<script src="../../../templates/page//menu/js/hoe.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery.form.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery.dataTables.min.js"></script> 
<script language="javascript" type="text/javascript" src="../../../templates/page/js/ui.mask.js"></script>
<script type="text/javascript" src="../../../templates/page/js/dataTables.responsive.min.js"></script> 
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

?>
<table width="500" border="1" align="center" cellpadding="2" cellspacing="2">
<tr>
							<td>Proveedor</td>
							<td>Factura</td>
							<td>Actual</td>
							<td>Nombre</td>
							<td>Valor</td>
							<td>&nbsp;</td>
</tr>
<?php
$contador=0;
$busca_listatx="SELECT * FROM dns_compras left join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id where compra_nfactura in ('001-001-000079215','001-001-000079431','001-001-000000047','001-001-000000046','001-001-000000148','001-002-000010956','001-001-000000043','001-001-000000042','002-001-000000022','002-001-000000033','002-001-000000034','002-001-000000036','002-001-000000037','002-001-000000039','002-001-000000049','002-001-000000044','002-001-000000048','002-001-000000052','002-001-000000058','002-001-000000065','002-001-000000067','002-001-000000074','002-001-000002036','013-902-000469951','013-903-000472897','013-903-000472995','013-903-000473439','013-904-000510525','013-902-000472746','042-001-000307934','042-001-000310289','042-003-000190998','001-001-000208352','003-003-000007809','003-003-000007787','003-003-000007590','019-501-000036774','045-503-000024316','001-001-000000030','001-001-000000032','001-001-000013503','001-001-000000033','001-001-000000034','001-002-000021508','001-002-000021413','001-002-000009620') and provee_nombre not in ('NAVARRETE JIMENEZ GARY GLENN','INVERSIONES MEDICAL') ";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
			  $lista_cuenta="select * from lpin_cuentacompra where compra_enlace='".$rs_listatx->fields["compra_enlace"]."'";
			  $rs_cuenta = $DB_gogess->executec($lista_cuenta);
			  if($rs_cuenta)
				{
				   while (!$rs_cuenta->EOF) 
						{
						
						$busca_ncuenta="select * from lpin_plancuentas where planc_codigoc='".$rs_cuenta->fields["planc_codigoc"]."'";
						$rs_ncue = $DB_gogess->executec($busca_ncuenta);

$nproveedor=$rs_listatx->fields["provee_nombrecomercial"];						
if(!($rs_listatx->fields["provee_nombrecomercial"]))
{
  $nproveedor=$rs_listatx->fields["provee_nombre"];
}

$contador++;
						?>
						 <tr>
							<td nowrap><?php echo $contador; ?></td>
							<td nowrap><?php echo $nproveedor; ?></td>
							<td nowrap><?php echo $rs_listatx->fields["compra_nfactura"]; ?></td>
							<td nowrap><?php echo $rs_cuenta->fields["planc_codigoc"]; ?></td>
							<td nowrap><?php echo $rs_ncue->fields["planc_nombre"]; ?></td>
							<td nowrap><?php echo $rs_cuenta->fields["cuecomp_subtotal"]; ?></td>
							<td><input type="button" name="Submit" value="Cambiar" onclick="cambiar_cuenta('<?php echo $rs_cuenta->fields["cuecomp_id"]; ?>')" /></td>
  </tr>
						<?php
						
						 $rs_cuenta->MoveNext();	
						}
				}		
			  
			
			   $rs_listatx->MoveNext();	
			}
	}		
?>
</table>
<?php

}

?>

<div id="asiento_cr"></div>

<script type="text/javascript">
<!--


function cambiar_cuenta(cuecomp_id)
{
   $("#asiento_cr").load("cambiarc.php",{
      cuecomp_id:cuecomp_id,

  },function(result){  

	   
  });  
  $("#asiento_cr").html("......");  


}

//  End -->
</script>