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

$busca_politica="select * from faesa_politicasasistencia where centro_id=1 order by polasis_id desc limit 1";
$rs_politica = $DB_gogess->executec($busca_politica,array());
$anios_paravaca=$rs_politica->fields["polasis_tiempominimovaca"]; 
?>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td bgcolor="#BFDCE3"><strong>Fecha de Ingreso </strong></td>
    <td bgcolor="#BFDCE3"><strong>A&ntilde;os </strong></td>
    <td bgcolor="#BFDCE3"><strong>Dias Vacaciones </strong></td>
  </tr>
  <tr>
    <td bgcolor="#E8F2F7"><?php echo $info_fechaingreso; ?></td>
    <td bgcolor="#E8F2F7"><?php  echo $anio_mes["anio"]." a&ntilde;os ".$anio_mes["mes"]." meses"; ?></td>
    <td bgcolor="#E8F2F7"><?php
	$dias_vacaciones=0;
	if($anio_mes["anio"]>=$anios_paravaca)
	{
	   $dias_vacaciones=$rs_politica->fields["polasis_alcumplirelanio"];
	}
	$numero_aumenta=0;	
	if($anio_mes["anio"]>=$rs_politica->fields["polasis_anioaumentauno"])
	{
	    $numero_aumenta=$anio_mes["anio"]-$rs_politica->fields["polasis_anioaumentauno"];
	}
	echo $dias_vacaciones+$numero_aumenta;

	?></td>
  </tr>
</table>
<br />


<?php
}
?>

