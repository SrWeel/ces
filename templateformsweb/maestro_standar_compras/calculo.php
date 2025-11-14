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

$prcomp_preciounitariox=$_POST["prcomp_preciounitariox"];
$prcomp_cantidadx=$_POST["prcomp_cantidadx"];
$prcomp_descuentox=$_POST["prcomp_descuentox"];
$prcomp_descuentodolarx=$_POST["prcomp_descuentodolarx"];

//calcula data
$total_fila=($prcomp_preciounitariox*$prcomp_cantidadx)-$prcomp_descuentodolarx;
$total_fila=round($total_fila,2);
//calcula data
   


?>

<script language="javascript">
<!--

$('#prcomp_subtotalx').val('<?php echo $total_fila;  ?>');


//-->
</script>

<?php

}

?>