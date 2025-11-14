<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_inicio'])
{

$precio='';
$impuesto='';
$tari_codigo='';
$prod_preciocosto='';


$datos_produ="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$_POST["cuadrobm_id"]."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());

$impu_codigo=$rs_produ->fields["impu_codigo"];
$tari_codigo=$rs_produ->fields["tari_codigo"];

?>

<script language="javascript">
<!--

$('#prcomp_impucodigox').val('<?php echo $impu_codigo;  ?>');
$('#prcomp_taricodigox').val('<?php echo $tari_codigo;  ?>');


//-->
</script>

<?php

}

?>