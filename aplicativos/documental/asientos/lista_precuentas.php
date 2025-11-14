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
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E9F1F5"><div align="center"></div></td>
	<td bgcolor="#E9F1F5"><div align="center">CI</div></td>
     <td bgcolor="#E9F1F5"><div align="center">Codigo Precuenta</div></td>	
	<td bgcolor="#E9F1F5"><div align="center">PACIENTE</div></td>
    <td bgcolor="#E9F1F5"><div align="center">OBSERVACION</div></td>
    <td bgcolor="#E9F1F5"><div align="center">FECHA INICIO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">FECHA FIN</div></td>
	<td bgcolor="#E9F1F5"><div align="center">ESTADO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">FACTURAR</div></td>
	<td bgcolor="#E9F1F5"><div align="center">ITEMS</div></td>
	<td bgcolor="#E9F1F5"><div align="center">ASIENTOS</div></td>
	<td bgcolor="#E9F1F5"><div align="center">SELECCIONAR</div></td>
    <td bgcolor="#E9F1F5">&nbsp;</td>
    <td bgcolor="#E9F1F5"><div align="center">Asiento contable </div></td>
  </tr>
<?php
$contador_pre=0;
$contador=0;
 $comulla_simple="'";
 $tabla_valordata="";
 $tabla_valordata="'dns_precuenta'";
  
$lista_bprecuenta="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id where (year(precu_fecharegistro) >2022 or year(precu_fechainicio) >2022 )  order by precu_id asc";
$rs_bprecuenta = $DB_gogess->executec($lista_bprecuenta,array());

if($rs_bprecuenta)
 {
	while (!$rs_bprecuenta->EOF) { 
	
	//busca detalles	
	$cantidad_dest=0;
	$busca_deta="select count(*) as tdetalles from dns_detalleprecuenta where precu_id='".$rs_bprecuenta->fields["precu_id"]."' and detapre_tipo in (1,2)";
	$rs_bdeta = $DB_gogess->executec($busca_deta,array());
	$cantidad_dest=$rs_bdeta->fields["tdetalles"];
	//busca detalles
	
	$contador++;
	
	$clie_id=$rs_bprecuenta->fields["clie_id"];
	$precu_id=$rs_bprecuenta->fields["precu_id"];
	$atenc_enlace=$rs_bprecuenta->fields["atenc_enlace"];
	
	$lista_aten="select * from dns_atencion where atenc_enlace='".$atenc_enlace."'";
	$rs_aten = $DB_gogess->executec($lista_aten,array());
	
	$atenc_id=$rs_aten->fields["atenc_id"];
	$e_estado='';
	$e_estadof='';
	if($rs_bprecuenta->fields["precu_activo"]=='2')
	{
	$e_estado='CERRADO';
	}
	
	if($rs_bprecuenta->fields["precu_activo"]=='1')
	{
	$e_estado='ABIERTO';
	}
	
	if($rs_bprecuenta->fields["precu_facturar"]=='1')
	{
	$e_estadof='PARA FACTURAR';
	}
	
	$lista_txt=$rs_bprecuenta->fields["precu_observacion"]." Fi:".$rs_bprecuenta->fields["precu_fechainicio"]." Ff:".$rs_bprecuenta->fields["precu_fechafinal"];
	
	
	$campo_valor="";
	$campo_valor="'precu_id'";
	$ide_producto='precu_id';
	$ncampo_val='dns_precuenta';
	
	if($cantidad_dest>0)
	{
	$contador_pre++;
	?>

  <tr>
   <td><?php echo $contador_pre; ?></td> 
	<td><?php echo $rs_bprecuenta->fields["clie_rucci"]; ?></td>
	<td><div align="center"><?php echo str_pad($rs_bprecuenta->fields["precu_id"], 10, "0", STR_PAD_LEFT); ?></div></td>
	<td><?php echo $rs_bprecuenta->fields["clie_nombre"].' '.$rs_bprecuenta->fields["clie_apellido"]; ?></td>
    <td><?php echo $rs_bprecuenta->fields["precu_observacion"]; ?></td>
    <td nowrap="nowrap"><?php echo $rs_bprecuenta->fields["precu_fechainicio"]; ?></td>
	 <td nowrap="nowrap"><?php echo $rs_bprecuenta->fields["precu_fechafinal"]; ?></td>
	 
	<td>
	<?php
	$ncampo_val='precu_activo';
	
	$busca_tipox="select * from dns_estadoprecuenta where estap_id='".$rs_bprecuenta->fields[$ncampo_val]."'";
    $rs_bdtipox = $DB_gogess->executec($busca_tipox);
	
	$estap_nombre=$rs_bdtipox->fields["estap_nombre"];
	
    echo $estap_nombre;
	?>	</td> 
	
	<td nowrap="nowrap">
	<?php
	$ncampo_val='precu_facturar';
	
	$busca_tipox1="select * from dns_estadofactura where estapf_id='".$rs_bprecuenta->fields[$ncampo_val]."'";
    $rs_bdtipox1 = $DB_gogess->executec($busca_tipox1);
	
	$estapf_nombre=$rs_bdtipox1->fields["estapf_nombre"];
	
    echo $estapf_nombre;
	
	?>	</td>
	 <td> 
	 <?php echo $cantidad_dest; ?>	 </td>
	
	 <td>
	 <?php

	 $lista_asientoscreados="select count(*) as totalas from  lpin_comprobantecontable where comcont_tabla='dns_precuenta' and comcont_idtabla='".$rs_bprecuenta->fields["precu_id"]."'";
     $registros_dataasientos = $DB_gogess->executec($lista_asientoscreados,array());
     
	 echo $registros_dataasientos->fields["totalas"];
	 ?>
	 
	 </td>
	 <td>	 
	 <input name="valor_id<?php echo $contador_pre; ?>" type="hidden" id="valor_id<?php echo $contador_pre; ?>" value="<?php echo $rs_bprecuenta->fields["precu_id"]; ?>" />
	 <div id="asiento_cv<?php echo $contador_pre; ?>">&nbsp;</div>	 </td>
     <td><div align="center">
       <input type="button" name="Submit" value="GENERAR ASIENTO" onclick="genera_asientof1('<?php echo $contador_pre; ?>')" />
     </div></td>
     <td><div align="center">
       <input type="button" name="Submit2" value="VER" onclick="ver_asientoc('<?php echo $rs_bprecuenta->fields["precu_id"]; ?>')" />
     </div></td>
  </tr>

	 
	 <?php	
	 
	 }
	
	   $rs_bprecuenta->MoveNext();	
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
  
	urlasiento='precuenta/ejecuta_pordescargo.php';

   $("#asiento_cv"+num).load(urlasiento,{
      valor_id:$('#valor_id'+num).val(),
	  nombre_campoid:'precu_id',
	  tabla:'dns_precuenta',
	  mnupan_id:'0'

  },function(result){  
     
    genera_asientof2(num+1);
     
  });  
  $("#asiento_cv"+num).html("......"); 
}

function genera_asientof2(num)
{

  var urlasiento;
   urlasiento='';
   urlasiento='precuenta/ejecuta_pordescargo.php';
   
   $("#asiento_cv"+num).load(urlasiento,{
      valor_id:$('#valor_id'+num).val(),
	  nombre_campoid:'precu_id',
	  tabla:'dns_precuenta',
	  mnupan_id:'0'

  },function(result){  
     
    genera_asientof1(num+1);
     
  });  
  $("#asiento_cv"+num).html("......");  
}


genera_asientof1(1);
//asiento venta retencion



function ver_asientoc(precu_id)
{
   //if($('#doccab_ndocumento').val()!='-documento-')
	 //{
      myWindow3=window.open('../../../pdfasientos/pdfasientoprecuenta.php?xml=' + precu_id,'ventana_asientocontable','width=850,height=700,scrollbars=YES');
      myWindow3.focus();
    // }
  // else
   //{
   //alert("Por favor guarde el resgistro para ver el asiento contable");     
  // }
}

//  End -->
</script>


</body>
</html>
