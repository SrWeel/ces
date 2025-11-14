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

$ajuspr_cantidadx=$_POST["ajuspr_cantidadx"];
$ajuspr_crealx=$_POST["ajuspr_crealx"];

//calcula data
$total_fila=$ajuspr_cantidadx-$ajuspr_crealx;

//calcula data
   


?>

<script language="javascript">
<!--

$('#ajuspr_diferenciax').val('<?php echo $total_fila;  ?>');


//-->
</script>

<?php

}

?>