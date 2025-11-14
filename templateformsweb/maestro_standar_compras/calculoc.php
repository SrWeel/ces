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

$cuecomp_preciounitariox=$_POST["cuecomp_preciounitariox"];
$cuecomp_cantidadx=$_POST["cuecomp_cantidadx"];
$cuecomp_descuentox=$_POST["cuecomp_descuentox"];
$cuecomp_descuentodolarx=$_POST["cuecomp_descuentodolarx"];

//calcula data
$total_fila=($cuecomp_preciounitariox*$cuecomp_cantidadx)-$cuecomp_descuentodolarx;
$total_fila=number_format($total_fila,2,'.','');
//calcula data
   


?>

<script language="javascript">
<!--

$('#cuecomp_subtotalx').val('<?php echo $total_fila;  ?>');


//-->
</script>

<?php

}

?>