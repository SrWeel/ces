<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//$busca_cliente="select * from dns_atencion where atenc_hc='".$_POST["hc_code"]."'";
//$rs_cliente = $DB_gogess->executec($busca_cliente,array());

?>
<script language="javascript">
<!--

function ver_detalleterapias()
{

$("#detalle_terapias").load("aplicativos/documental/opciones/panel/agendart/detalle_terapias.php",{

centro_id:'<?php echo $_POST["centro_id"]; ?>',
especi_idx:'<?php echo $_POST["especi_idx"]; ?>',
usua_idvalx:'<?php echo $_POST["usua_idvalx"]; ?>'

 },function(result){       


  });  


$("#detalle_terapias").html("Espere un momento...");


}



function ver_gridterapias()
{

/*
$("#lista_terapias").load("aplicativos/documental/opciones/panel/agendar/grid_listaterapias.php",{
atenc_hc:'<?php //echo $_POST["hc_code"]; ?>',
centro_id:'<?php //echo $_POST["centro_id"]; ?>'
 },function(result){       


  });  


$("#lista_terapias").html("Espere un momento...");*/


}


//-->
</script>

<div id="detalle_terapias"></div>

<script language="javascript">
<!--
ver_detalleterapias();
//-->
</script>