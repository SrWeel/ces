<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();
$doccab_id=$_POST["pVar1"];
//1 cobro
//2 pago
$tipo=$_POST["pVar2"];

if($_SESSION['ces1313777_sessid_inicio'])
{
?>
<div id="div_formdatacp"></div>
<script language="javascript">
<!--

function ver_editformpl()
{

$("#div_formdatacp").load("aplicativos/documental/opciones/grid/standarformcobropago/grid_nuevo_standarform.php",{
 
 doccab_id:'<?php echo $doccab_id; ?>',
 tipo:'<?php echo $tipo; ?>'

 },function(result){       


  });  

$("#div_formdatacp").html("Espere un momento...");

}

ver_editformpl();

//-->
</script>

<?php
}
?>

