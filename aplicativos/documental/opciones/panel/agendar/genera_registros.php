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

//echo ;
$n_terapiasval=$_POST["n_terapiasval"]-1;
$dias_selecciona='';
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

	 $array_diasfecha[$i]=$mod_date;

	 $i++;

     }

	

	

	

} while ($i <= $n_terapiasval);


//print_r($array_diasfecha);
$bandera="";
for($z=0;$z<count($array_diasfecha);$z++)
{


 $inserta_datos="insert into faesa_terapiasregistro (atenc_hc,clie_id,terap_fecha,terap_hora,terap_autorizacion,especi_id,usua_id,centro_id,usuar_id,terap_fecharegistro) values ('".$_POST["atenc_hc"]."','".$_POST["clie_id"]."','".$array_diasfecha[$z]."','".$_POST["hora_val"]."','".$_POST["n_autorizacionval"]."','".$_POST["especi_idx"]."','".$_POST["usua_idvalx"]."','".$_POST["centro_id"]."','".$_POST["usuar_id"]."','".date("Y-m-d")."')";

$rs_okinserta = $DB_gogess->executec($inserta_datos,array());

	if(!($rs_okinserta))
	{
	 echo "<span style='color:#FF0000' ><center>Fecha y Hora Ocupada ".$array_diasfecha[$z]." - ".$_POST["hora_val"]."<br></center></span>";
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