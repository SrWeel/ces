<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_inicio'])
{

$cueven_preciounitariox=$_POST["cueven_preciounitariox"];
$cueven_cantidadx=$_POST["cueven_cantidadx"];
$cueven_descuentox=$_POST["cueven_descuentox"];
$cueven_descuentodolarx=$_POST["cueven_descuentodolarx"];

//calcula data
$total_fila=($cueven_preciounitariox*$cueven_cantidadx)-$cueven_descuentodolarx;
$total_fila=number_format($total_fila,2,'.','');
//calcula data
   


?>

<script language="javascript">
<!--

$('#cueven_subtotalx').val('<?php echo $total_fila;  ?>');


//-->
</script>

<?php

}

?>