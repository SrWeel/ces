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
    <td bgcolor="#F0F0F0"><strong>GENERA ASIENTO VENTA </strong></td>
	<td bgcolor="#F0F0F0"><strong>GENERA ASIENTO RETENCION </strong></td>
  </tr>
<?php

$busca_listatx="select * from beko_documentocabecera where month(doccab_fechaemision_cliente)>1";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
	$contador++;		
			?>
  <tr>
    <td><?php echo $contador; ?></td>
	<td><?php echo $rs_listatx->fields["doccab_ndocumento"]; ?></td>
    <td><?php echo $rs_listatx->fields["doccab_clavedeaccesos"]; ?></td>
    <td><?php echo $rs_listatx->fields["doccab_fechaemision_cliente"]; ?></td>
    <td><?php echo $rs_listatx->fields["doccab_estadosri"]; ?></td>
    <td><input name="valor_id<?php echo $contador; ?>" type="hidden" id="valor_id<?php echo $contador; ?>" value="<?php echo $rs_listatx->fields["doccab_id"]; ?>" />
	<input name="tipocmp_codigo<?php echo $contador; ?>" type="hidden" id="tipocmp_codigo<?php echo $contador; ?>" value="<?php echo $rs_listatx->fields["tipocmp_codigo"]; ?>" />
	
    <div id="asiento_cv<?php echo $contador; ?>">&nbsp;</div></td>
	<td><div id="asiento_cr<?php echo $contador; ?>">&nbsp;</div></td>
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

<script src="../../../templates/page//menu/js/hoe.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery.form.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery.dataTables.min.js"></script> 
<script language="javascript" type="text/javascript" src="../../../templates/page/js/ui.mask.js"></script>
<script type="text/javascript" src="../../../templates/page/js/dataTables.responsive.min.js"></script> 

<script type="text/javascript">
<!--

//asiento ventas
function genera_asientof1(num)
{

   var urlasiento;
   urlasiento='';
    if($('#tipocmp_codigo'+num).val()=='01')
	{
	   urlasiento='ventas/ejecuta_ventas.php';	
	}
	
	if($('#tipocmp_codigo'+num).val()=='04')
	{
	   urlasiento='ventas/ejecuta_nc.php';	
	}
	

   $("#asiento_cv"+num).load(urlasiento,{
      valor_id:$('#valor_id'+num).val(),
	  nombre_campoid:'doccab_id',
	  tabla:'beko_documentocabecera',
	  mnupan_id:'183'

  },function(result){  
     
     genera_asientof2(num+1);
     
  });  
  $("#asiento_cv"+num).html("......"); 

}

function genera_asientof2(num)
{

  var urlasiento;
   urlasiento='';
    if($('#tipocmp_codigo'+num).val()=='01')
	{
	   urlasiento='ventas/ejecuta_ventas.php';	
	}
	
	if($('#tipocmp_codigo'+num).val()=='04')
	{
	   urlasiento='ventas/ejecuta_nc.php';	
	}


   $("#asiento_cv"+num).load(urlasiento,{
      valor_id:$('#valor_id'+num).val(),
	  nombre_campoid:'doccab_id',
	  tabla:'beko_documentocabecera',
	  mnupan_id:'183'

  },function(result){  
     
     genera_asientof1(num+1);
     
  });  
  $("#asiento_cv"+num).html("......");  


}


genera_asientof1(1);
//asiento venta retencion



function genera_asientoretencionf1(num)
{

   $("#asiento_cr"+num).load("ventas/ejecuta_ventasretencion.php",{
      valor_id:$('#valor_id'+num).val(),
	  nombre_campoid:'doccab_id',
	  tabla:'beko_documentocabecera',
	  mnupan_id:'183'

  },function(result){  

      genera_asientoretencionf2(num+1);
  });  
  $("#asiento_cr"+num).html("......");  


}

function genera_asientoretencionf2(num)
{
   $("#asiento_cr"+num).load("ventas/ejecuta_ventasretencion.php",{
      valor_id:$('#valor_id'+num).val(),
	  nombre_campoid:'doccab_id',
	  tabla:'beko_documentocabecera',
	  mnupan_id:'183'

  },function(result){  

       genera_asientoretencionf1(num+1);
	   
  });  
  $("#asiento_cr"+num).html("......");  


}

genera_asientoretencionf1(1);

//  End -->
</script>


</body>
</html>
