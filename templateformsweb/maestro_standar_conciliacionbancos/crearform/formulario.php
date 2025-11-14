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
$fie_id=$_POST["pVar1"];
$valor=$_POST["pVar2"];

if($_SESSION['ces1313777_sessid_inicio'])
{
?>
<div id="div_formdata"></div>


<script language="javascript">
<!--

function ver_editform()
{

$("#div_formdata").load("aplicativos/documental/opciones/grid/standarform/grid_nuevo_standarform.php",{
 
 fie_id:'<?php echo $fie_id; ?>',
 valor:'<?php echo $valor; ?>'

 },function(result){       


  });  

$("#div_formdata").html("Espere un momento...");

}

ver_editform();

//-->
</script>

<?php
}
?>

