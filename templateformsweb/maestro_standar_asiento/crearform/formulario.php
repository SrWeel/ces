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

<div align="center">CEDULA PACIENTE:
  <input name="cedula_paciente" type="text" id="cedula_paciente" value="" />
  <input type="button" name="Submit" value="Tomar Datos" onclick="busca_paciente()" />
  <hr />
</div>
<div id="div_formdata"></div>
<div id="div_formpaciente"></div>
<div id="div_buscapacienter"></div>


<script language="javascript">
<!--

function ver_editformencontrado(valor)
{

$("#div_formdata").load("aplicativos/documental/opciones/grid/standarformprov/grid_nuevo_standarform.php",{
 
 fie_id:'<?php echo $fie_id; ?>',
 valor:valor

 },function(result){       


  });  

$("#div_formdata").html("Espere un momento...");

}


function ver_editform()
{

$("#div_formdata").load("aplicativos/documental/opciones/grid/standarformprov/grid_nuevo_standarform.php",{
 
 fie_id:'<?php echo $fie_id; ?>',
 valor:'<?php echo $valor; ?>'

 },function(result){       


  });  

$("#div_formdata").html("Espere un momento...");

}

ver_editform();

function busca_paciente()
{

$("#div_formpaciente").load("templateformsweb/maestro_standar_ventas/buscadorform/busca_paciente.php",{
 
 cedula_paciente:$('#cedula_paciente').val()

 },function(result){       


  });  

$("#div_formpaciente").html("Espere un momento...");

}






//-->
</script>

<?php
}
?>

