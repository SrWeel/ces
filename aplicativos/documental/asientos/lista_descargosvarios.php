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
	<td bgcolor="#E9F1F5"><div align="center">N COMPROBANTE</div></td>
     <td bgcolor="#E9F1F5"><div align="center">MEMO</div></td>	
	<td bgcolor="#E9F1F5"><div align="center">REPRESENTANTE</div></td>
    <td bgcolor="#E9F1F5"><div align="center">MOVIMIENTO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">TIPO MOVIMIENTO</div></td>
    <td bgcolor="#E9F1F5"><div align="center">FECHA</div></td>
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
 $tabla_valordata="'dns_egresocentros'";
  
$lista_bprecuenta="select * from dns_egresocentros left join dns_centrosalud on dns_egresocentros.centrod_id=dns_centrosalud.centro_id where dns_egresocentros.emp_id='1' and tipom_id=2 and egrec_tipo=1 order by egrec_id desc";
$rs_bprecuenta = $DB_gogess->executec($lista_bprecuenta,array());

if($rs_bprecuenta)
 {
	while (!$rs_bprecuenta->EOF) { 
	
	
	
	//busca detalles	
	$cantidad_dest=0;
	//$busca_deta="select count(*) as tdetalles from dns_detalleprecuenta where precu_id='".$rs_bprecuenta->fields["precu_id"]."' and detapre_tipo in (1,2)";
	
	$busca_deta="select count(*) as tdetalles from dns_temporaldespacho inner join dns_cuadrobasicomedicamentos on dns_temporaldespacho.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id inner join dns_principalmovimientoinventario on dns_temporaldespacho.moviin_id=dns_principalmovimientoinventario.moviin_id where dns_temporaldespacho.egrec_id='".$rs_bprecuenta->fields["egrec_id"]."'";
	
	$rs_bdeta = $DB_gogess->executec($busca_deta,array());
	$cantidad_dest=$rs_bdeta->fields["tdetalles"];
	//busca detalles
	
	$contador++;
	
	$clie_id=$rs_bprecuenta->fields["clie_id"];
	
	
	$campo_valor="";
	$campo_valor="'egrec_id'";
	$ide_producto='egrec_id';
	$ncampo_val='dns_egresocentros';
	
	if($cantidad_dest>0)
	{
	$contador_pre++;
	
	
	
		
	$busca_tipom="select * from dns_tipomovimiento where tipom_id='".$rs_bprecuenta->fields["tipom_id"]."'";
    $rs_bdtipom = $DB_gogess->executec($busca_tipom);
	
	$busca_tipom1="select * from dns_motivomovimiento where tipomov_id='".$rs_bprecuenta->fields["tipomov_id"]."'";
    $rs_bdtipom1 = $DB_gogess->executec($busca_tipom1);
	?>

  <tr>
   <td><?php echo $contador_pre; ?></td> 
	<td><?php echo $rs_bprecuenta->fields["egrec_id"]; ?></td>
	<td><?php echo $rs_bprecuenta->fields["egrec_nmemo"]; ?></td>
	<td><?php echo $rs_bprecuenta->fields["egrec_representante"]; ?></td>
	<td><?php echo $rs_bdtipom->fields["tipom_nombre"]; ?></td>
	<td><?php echo $rs_bdtipom1->fields["tipomov_nombre"]; ?></td>
	<td><?php echo $rs_bprecuenta->fields["egrec_fecha"]; ?></td>		 
	<td><?php echo $cantidad_dest; ?></td>	
	<td>
	 <?php

	 $lista_asientoscreados="select count(*) as totalas from  lpin_comprobantecontable where comcont_tabla='dns_egresocentros' and comcont_idtabla='".$rs_bprecuenta->fields["egrec_id"]."'";
     $registros_dataasientos = $DB_gogess->executec($lista_asientoscreados,array());
     
	 echo $registros_dataasientos->fields["totalas"];
	 ?>
	 
	 </td>
	 <td>	 
	 <input name="valor_id<?php echo $contador_pre; ?>" type="hidden" id="valor_id<?php echo $contador_pre; ?>" value="<?php echo $rs_bprecuenta->fields["egrec_id"]; ?>" />
	 <div id="asiento_cv<?php echo $contador_pre; ?>">&nbsp;</div>	 </td>
     <td><div align="center">
       <input type="button" name="Submit" value="GENERAR ASIENTO" onclick="genera_asientof1('<?php echo $contador_pre; ?>')" />
     </div></td>
     <td><div align="center">
       <input type="button" name="Submit2" value="VER" onclick="ver_asientoc('<?php echo $rs_bprecuenta->fields["egrec_id"]; ?>')" />
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
  
	urlasiento='egresosvarios/ejecuta_pordescargo.php';

   $("#asiento_cv"+num).load(urlasiento,{
      valor_id:$('#valor_id'+num).val(),
	  nombre_campoid:'egrec_id',
	  tabla:'dns_egresocentros',
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
   urlasiento='egresosvarios/ejecuta_pordescargo.php';
   
   $("#asiento_cv"+num).load(urlasiento,{
      valor_id:$('#valor_id'+num).val(),
	  nombre_campoid:'egrec_id',
	  tabla:'dns_egresocentros',
	  mnupan_id:'0'

  },function(result){  
     
    genera_asientof1(num+1);
     
  });  
  $("#asiento_cv"+num).html("......");  
}


//genera_asientof1(1);
//asiento venta retencion



function ver_asientoc(egrec_id)
{
   //if($('#doccab_ndocumento').val()!='-documento-')
	 //{
      myWindow3=window.open('../../../pdfasientos/pdfasientoegresosv.php?xml=' + egrec_id,'ventana_asientocontable','width=850,height=700,scrollbars=YES');
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
