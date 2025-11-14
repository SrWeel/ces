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

$docdet_precioux=$_POST["docdet_precioux"];
$docdet_cantidadx=$_POST["docdet_cantidadx"];
$docdet_descuentox=$_POST["docdet_descuentox"];

//calcula data

$total_fila=($docdet_precioux*$docdet_cantidadx)-$docdet_descuentox;
$total_fila=round($total_fila,2);
//calcula data
   


?>

<script language="javascript">
<!--

$('#docdet_totalx').val('<?php echo $total_fila;  ?>');


//-->
</script>

<?php

}

?>