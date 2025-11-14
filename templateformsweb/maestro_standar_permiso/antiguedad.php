<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$obj_funciones=new util_funciones();

if($_SESSION['ces1313777_sessid_inicio'])
{

$clie_id=$_POST["clie_id"];
$obtiene_anios="select * from app_cliente inner join grid_infolaboral3 on app_cliente.clie_enlace=grid_infolaboral3.standar_enlace where app_cliente.clie_id='".$clie_id."' order by info_id desc limit 1";
$rs_anios=$DB_gogess->executec($obtiene_anios,array());

$info_fechaingreso=$rs_anios->fields["info_fechaingreso"];
$fecha_hoy=date("Y-m-d");

$anio_mes=array();
$anio_mes["anio"]='';
$anio_mes["mes"]='';

if($info_fechaingreso)
{
$anio_mes=$obj_funciones->calcular_tiempoaniomes($info_fechaingreso,$fecha_hoy);
}
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#8EB4CA"><span style="color: #FFFFFF">ANTIGUEDAD</span></td>
  </tr>
  <tr>
    <td width="50%"><span style="font-weight: bold">A&Ntilde;OS</span></td>
    <td width="50%"><?php echo $anio_mes["anio"]; ?></td>
  </tr>
  <tr>
    <td><span style="font-weight: bold">MESES</span></td>
    <td><?php echo $anio_mes["mes"]; ?></td>
  </tr>
</table>
<br />
<?php
$meses_val=0;
$meses_val=$anio_mes["anio"]*12;
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#8EB4CA"><span style="color: #FFFFFF">TIEMPOS DE SERVICIO</span></td>
  </tr>
  <tr>
    <td width="50%"><span style="font-weight: bold">MESES</span></td>
    <td width="50%"><?php echo $anio_mes["mes"]+$meses_val; ?></td>
  </tr>
  <tr>
    <td width="50%"><span style="font-weight: bold">N. APORTES AL IESS</span></td>
    <td width="50%"><?php echo $anio_mes["mes"]+$meses_val; ?></td>
  </tr>
</table>
<br />
<?php

$busca_valor="select * from conco_rubrosg left join grid_parametrosrubros4 on conco_rubrosg.rubrg_enlace=grid_parametrosrubros4.standar_enlace where para_grupoocupacional='".$rs_anios->fields["info_grupoocupacional"]."' and para_regimenlaboral='".$rs_anios->fields["info_regimenlaboral"]."' and 	tiporub_id=1";

$rs_sueldo=$DB_gogess->executec($busca_valor,array());

$valor_sueldo=0;
$valor_sueldo=$rs_sueldo->fields["para_valor"];

if(!($valor_sueldo))
{
$busca_valor="select * from conco_rubrosg where rubrg_activo=1 and tiporub_id=1";
$rs_sueldo=$DB_gogess->executec($busca_valor,array()); 
$valor_sueldo=0;
$valor_sueldo=$rs_sueldo->fields["rubrg_valor"];
}
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#8EB4CA"><span style="color: #FFFFFF">REMUNERACION</span></td>
  </tr>
  <tr>
    <td width="50%"><span style="font-weight: bold">VALOR</span></td>
    <td width="50%"><?php echo $valor_sueldo;  ?>$</td>
  </tr>

</table>

<?php
}
?>

