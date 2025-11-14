<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//echo $_POST["fecha_inicioval"];



$buscat_us="select * from app_usuario where usua_id='".$_POST["usua_idvalx"]."'";
$rs_buscus = $DB_gogess->executec($buscat_us,array());

$especi_id=$rs_buscus->fields["especi_id"];

//echo ;
$n_terapiasval=$_POST["n_terapiasval"]-1;
$dias_selecciona='';
$horas_selecciona='';

$terap_motivoval=$_POST["terap_motivoval"];

$hora_l=array();
$hora_l[1]=$_POST["hora_lunes"];
$hora_l[2]=$_POST["hora_martes"];
$hora_l[3]=$_POST["hora_miercoles"];
$hora_l[4]=$_POST["hora_jueves"];
$hora_l[5]=$_POST["hora_viernes"];
$hora_l[6]=$_POST["hora_sabado"];

//print_r($hora_l);

if($_POST["checkbox_lunes"]=='true')
{
   $dias_selecciona="1,";
}

if($_POST["checkbox_martes"]=='true')
{
   $dias_selecciona.="2,";
}

if($_POST["checkbox_miercoles"]=='true')
{
   $dias_selecciona.="3,";
}

if($_POST["checkbox_jueves"]=='true')
{
  $dias_selecciona.="4,";
}

if($_POST["checkbox_viernes"]=='true')
{
  $dias_selecciona.="5,";
}

if($_POST["checkbox_sabado"]=='true')
{
  $dias_selecciona.="6,";
}



//echo $dias_selecciona."<br>";

$arreglo_seleccionado=array();
$arreglo_seleccionado=explode(",",$dias_selecciona);



//print_r($arreglo_seleccionado);
$fecha_inicioval=$_POST["fecha_inicioval"];
//echo ;



//faesa_terapiasregistro
$mod_date=strtotime($fecha_inicioval."- 1 days");
$mod_date = date("Y-m-d",$mod_date);
$array_diasfecha=array();
$array_horasfecha=array();

$i = 0;

do {	

	$strnumdate='';
	$strnumdate=strtotime($mod_date."+ 1 days");
	$obtine_dia=date("N",$strnumdate);
	$mod_date = date("Y-m-d",$strnumdate);	

	if (in_array($obtine_dia, $arreglo_seleccionado)) {
   // echo "Existe dia";
	//echo $obtine_dia."<br>";	
	//echo $mod_date."<br>";
	 $array_horasfecha[$i]=$hora_l[$obtine_dia];
	 $array_diasfecha[$i]=$mod_date;
	 $i++;
     }
	

} while ($i <= $n_terapiasval);


//print_r($array_diasfecha);
$bandera="";
for($z=0;$z<count($array_diasfecha);$z++)
{

if($_POST["clie_id"])
{
 $inserta_datos="insert into faesa_terapiasregistro (atenc_hc,clie_id,terap_fecha,terap_hora,terap_autorizacion,especi_id,usua_id,centro_id,usuar_id,terap_fecharegistro,terap_motivo) values ('".$_POST["atenc_hc"]."','".$_POST["clie_id"]."','".$array_diasfecha[$z]."','".$array_horasfecha[$z]."','".$_POST["n_autorizacionval"]."','".$especi_id."','".$_POST["usua_idvalx"]."','".$_POST["centro_id"]."','".$_POST["usuar_id"]."','".date("Y-m-d")."','".$terap_motivoval."')";

//echo $inserta_datos."<br>";
$rs_okinserta = $DB_gogess->executec($inserta_datos,array());

	if(!($rs_okinserta))
	{
	 echo "<span style='color:#FF0000' ><center>Fecha y Hora Ocupada ".$array_diasfecha[$z]." - ".$array_horasfecha[$z]."<br></center></span>";
	 $bandera="1";
	}
}
else
{
    echo "<span style='color:#FF0000' ><center>Paciente no seleccionado o historia clinica ingresado incorrectamente...<br></center></span>";
    $bandera="1";
}

}
if($bandera==1)
{
echo '
<script type="text/javascript">
<!--
alert("No se pudeo agendar unas fechas ver al final el detalle");
//  End -->
</script>';

}
?>