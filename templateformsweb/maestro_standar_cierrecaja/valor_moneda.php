<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

if($_SESSION['ces1313777_sessid_inicio'])
{
$tmoned_id=$_POST["tmoned_id"];
$ingefec_cantidad=$_POST["ingefec_cantidad"];

$busca_valor="select * from cesdb_arcombos.cmb_tipomoneda where tmoned_id='".$tmoned_id."'";
$rs_valor = $DB_gogess->executec($busca_valor,array());

$cuenta_valor=$ingefec_cantidad*$rs_valor->fields["tmoned_valor"];

?>
<script language="javascript">
<!--

$('#ingefec_valorx').val('<?php echo $cuenta_valor; ?>');


//-->
</script>

<?php

}

?>