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

$centro_id=$_POST["centro_id"];
$cuadrobm_id=$_POST["cuadrobm_id"];
$precio='';
$impuesto='';
$tari_codigo='';
$prod_preciocosto='';


$datos_produ="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$_POST["cuadrobm_id"]."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());

//$impu_codigo=$rs_produ->fields["impu_codigo"];
//$tari_codigo=$rs_produ->fields["tari_codigo"];

$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."'";
$rs_stactua = $DB_gogess->executec($stockactual);

$busca_und="select uniddesg_id from dns_stockactual where centro_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."' order by stock_id  desc limit 1";
$rs_und = $DB_gogess->executec($busca_und);

$unid_idx=$rs_und->fields["uniddesg_id"];

?>

<script language="javascript">
<!--
$('#unid_idx').val('<?php echo $unid_idx; ?>');
$('#ajuspr_cantidadx').val('<?php echo $rs_stactua->fields["stactual"]; ?>');


//-->
</script>

<?php

}

?>