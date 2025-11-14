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

<button type="button" class="mb-sm btn btn-primary" onclick="ver_editformpl()" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>


<div id="div_formdatacp"></div>

<div align="center" id="grid_cp" ></div>

<script language="javascript">
<!--

function ver_formpldata(id)
{

$("#div_formdatacp").load("aplicativos/documental/opciones/grid/standarformcobropago/grid_nuevo_standarform2.php",{
 
 doccab_id:'<?php echo $doccab_id; ?>',
 tipo:'<?php echo $tipo; ?>',
 id:id

 },function(result){       


  });  

$("#div_formdatacp").html("Espere un momento...");

}


function ver_editformpl()
{

$("#div_formdatacp").load("aplicativos/documental/opciones/grid/standarformcobropago/grid_nuevo_standarform2.php",{
 
 doccab_id:'<?php echo $doccab_id; ?>',
 tipo:'<?php echo $tipo; ?>',
 id:'0'

 },function(result){       


  });  

$("#div_formdatacp").html("Espere un momento...");

}

//ver_editformpl();


function desplegar_grid_cp()
{

$("#grid_cp").load("aplicativos/documental/opciones/grid/standarformcobropago/grid_cobrospagos3.php",{
  
  doccab_id:'<?php echo $doccab_id; ?>',
  tipo:'<?php echo $tipo; ?>',
  pVar2:"",
  pVar3:"184",
  indice_grid:"_standarformcobropago",
  namemodulo:"standarformcobropago"

  },function(result){  

  });  

  $("#grid_cp").html("Espere un momento");  

}

desplegar_grid_cp();

//-->
</script>

<?php
}
?>

