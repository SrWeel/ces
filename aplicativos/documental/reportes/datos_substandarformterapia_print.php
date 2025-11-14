<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$evolu_id=$_GET["pVar1"];
$usua_id=$_GET["pVar2"];

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";


//saca datos de la tabla

$lista_evolucion="select * from faesa_evolucion where evolu_id=?";
$rs_evolucion = $DB_gogess->executec($lista_evolucion,array($evolu_id));


$atenc_id=$rs_evolucion->fields["atenc_id"];
$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$rs_evolucion->fields["clie_id"];
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//busca datos del paciente

//datos usuario
$datos_usuario="select * from  app_usuario where usua_id=".$usua_id;
$rs_usuario = $DB_gogess->executec($datos_usuario,array());

//datos usuario

?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reporte</title>

<link type="text/css" href="../../../templates/page/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script src="../../../templates/page/menu/js/1.11.2.jquery.min.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../../templates/page/js/jquery.form.js"></script>
<style type="text/css">
<!--

.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.css_titulo{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.css_texto{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;

}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo1 {font-size: 10px}
.Estilo2 {font-size: 8px}
.Estilo4 {font-size: 10px; font-weight: bold; }

-->

</style>



</head>
<body>
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

  <div align="center"><img src="../../../images/informe_logo.jpg" width="161" height="70" />
  </div>
  <div align="right" id="fechaval" >
  <?php
  $nciudad='';
  $nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$rs_usuario->fields["centro_id"],$DB_gogess);
  
   ?>
  </div>
  <br />
  <center> 
  <B> EVOLUCI&Oacute;N TERAPIAS </B> </center><br /><br />
  <table width="100%" border="1" cellpadding="1" cellspacing="0">
    <tr>
      <td bgcolor="#E1ECF4"><div align="center">ESTABLECIMIENTO</div></td>
      <td bgcolor="#E1ECF4"><div align="center">NOMBRE</div></td>
      <td bgcolor="#E1ECF4"><div align="center">APELLIDO</div></td>
      <td bgcolor="#E1ECF4"><div align="center">SEXO (M-F) </div></td>
      <td bgcolor="#E1ECF4"><div align="center">No HOJA </div></td>
      <td bgcolor="#E1ECF4"><div align="center">No HISTORIA CLINICA </div></td>
    </tr>
    <tr>
      <td>FAESA <?php echo $nciudad ?></td>
      <td><span class="texto_caja">
        <?php  echo utf8_encode($rs_dcliente->fields["clie_nombre"]); ?>
      </span></td>
      <td><span class="texto_caja">
        <?php  echo utf8_encode($rs_dcliente->fields["clie_apellido"]); ?>
      </span></td>
      <td> <?php  echo $rs_dcliente->fields["clie_genero"]; ?></td>
      <td>&nbsp;</td>
      <td><?php  echo $rs_evolucion->fields["evolu_hc"]; ?></td>
    </tr>
  </table>
  <BR />
<b>M&Eacute;DICO: <?php echo $nmedico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$usua_id,$DB_gogess);  ?></b>
  
 <br /> 
 Observaciones generales: <?php echo utf8_encode($rs_evolucion->fields["evolu_observacion"]); ?>
 <br />  <br />
<table border="1" cellpadding="2" cellspacing="0" class="table table-bordered"  style="width:100%" >

  <tr>
    <td colspan="3" bgcolor="#E1ECF4"><strong>1 EVOLUCI&Oacute;N</strong></td>
    <td colspan="2" bgcolor="#E1ECF4"><strong>2 PRESCRIPCIONES</strong><span class="Estilo1"> FIRMAR AL PIE DE CADA PRESCRIPCI&Oacute;N </span></td>
    </tr>
  <tr>
	<td bgcolor="#E1ECF4"><div align="center"><strong>FECHA</strong></div></td>
    <td bgcolor="#E1ECF4"><div align="center"><strong>HORA</strong></div></td>
    <td width="300" bgcolor="#E1ECF4"><div align="center"><strong>NOTAS DE EVOLUCI&Oacute;N </strong></div></td>
	<td width="450" bgcolor="#E1ECF4"><div align="center"><strong>FARMACO TERAPIA E INDICACIONES <BR />
	  </strong><span class="Estilo1">PARA ENFERMERIA Y OTRO PERSONAL </span></div></td>
    <td bgcolor="#E1ECF4" width="90" ><div align="center"><strong>ADMINISTR.</strong><span class="Estilo1"> <BR />
      FARMACOS Y OTROS</span> </div></td>
  </tr>

<?php
$cuenta=0;
if($_SESSION['ces1313777_sessid_inicio']==74)
{
$lista_servicios="select evoludet_id,evolu_enlace,evoludet_fecha,evoludet_hora,evoludet_notas,evoludet_farmaindica,evoludet_farmaotros,evoludet_fecharegistro from faesa_evoluciondetalle where evolu_enlace='".$rs_evolucion->fields["evolu_enlace"]."' and (evoludet_fecha>='".$_GET["fechai"]."' and evoludet_fecha<='".$_GET["fechaf"]."') order by evoludet_fecha asc";
}
else
{
$lista_servicios="select evoludet_id,evolu_enlace,evoludet_fecha,evoludet_hora,evoludet_notas,evoludet_farmaindica,evoludet_farmaotros,evoludet_fecharegistro from faesa_evoluciondetalle where evolu_enlace='".$rs_evolucion->fields["evolu_enlace"]."' and usua_id=".$usua_id." and (evoludet_fecha>='".$_GET["fechai"]."' and evoludet_fecha<='".$_GET["fechaf"]."') order by evoludet_fecha asc";

}
$fecha_cab='';
 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

	    $cuenta++;

  ?>

  <tr>	
	<td height="110" valign="top"><?php echo $rs_data->fields["evoludet_fecha"]; ?></td>
    <td valign="top"><?php echo $rs_data->fields["evoludet_hora"]; ?></td>
    <td valign="top"><?php echo $rs_data->fields["evoludet_notas"]; ?></td>
	<td valign="top"><?php echo $rs_data->fields["evoludet_farmaindica"]; ?></td>
	<td  width="120"  valign="top"><?php echo $rs_data->fields["evoludet_farmaotros"]; ?></td>
  </tr>

  <?php
$fecha_cab=$rs_data->fields["evoludet_fecha"];
   $rs_data->MoveNext();	   

	  }

  }

  ?>
</table>  
<span class="Estilo2">SNS-NSP / HCU-form.005 / 2008</span><BR />
<span class="Estilo4">EVOLUCION Y PRESCRIPCIONES (1)</span>  
<?php		
	$fecha_cabv=$objvarios->fechaCastellano($fecha_cab);	
?>	
<script type="text/javascript">
<!--
$('#fechaval').html('<?php echo $nciudad.", ".$fecha_cabv; ?>');
//  End -->
</script>

</div>
<?php

}			

?>
</body>
</html>

