<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
// $_POST["anio_idg"]."<br>";
// $_POST["mes_idg"]."<br>";
// $_POST["semana_idg"]."<br>";
// $_POST["areag"]."<br>";
// $_POST["usua_idvaltx"]."<br>";


$numerodias = cal_days_in_month(CAL_GREGORIAN, $_GET["mes_idg"], $_GET["anio_idg"]);

for($ivl=1;$ivl<=$numerodias;$ivl++)
{

  $semana_dia[date('W',  mktime(0,0,0,$_GET["mes_idg"],$ivl,$_GET["anio_idg"]))][$ivl]=$_GET["anio_idg"]."-".str_pad($_GET["mes_idg"], 2, "0", STR_PAD_LEFT)."-".str_pad($ivl, 2, "0", STR_PAD_LEFT);
  
  
  $semana_num[$ivl] = date('W',  mktime(0,0,0,$_GET["mes_idg"],$ivl,$_GET["anio_idg"]));  
  
}

if($_GET["semana_idg"])
{
   $lista_semana[0]=$_GET["semana_idg"];
}
else
{
   $lista_semana =array();
   $lista_semana = array_values(array_unique($semana_num));
}
//echo count($lista_semana);
//---------------------------------------
for($ivalor=0;$ivalor<count($lista_semana);$ivalor++)
{
   include("semana_print.php");
}
//---------------------------------------


}
else
{
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado, ingrese su usuario y clave y vuelva a seleccionar la opci&oacute;n</div>';
//enviar
//$varable_enviafunc=base64_encode("desplegar_grid_atencion();");
$varable_enviafunc='';
//enviar
echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession"></div>
';


}
?>