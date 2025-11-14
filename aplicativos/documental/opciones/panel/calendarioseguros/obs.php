<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$terap_id=$_POST["pVar1"];

$busca_datos="select * from faesa_terapiasregistro where terap_id='".$terap_id."'";
$rs_bdata = $DB_gogess->executec($busca_datos,array());

?>
<center><textarea name="obs_asistencia" cols="30" rows="5" id="obs_asistencia"><?php echo $rs_bdata->fields["terap_noasistemotivo"]; ?></textarea><br>
  <input type="button" name="Button" value="Guardar" onClick="g_asis()" >
</center>
<div id="g_asistencia"></div>

<script type="text/javascript">
<!--
function g_asis()
{  
  $("#g_asistencia").load("aplicativos/documental/opciones/panel/calendarioseguros/g_asistencia.php",{   
	 terap_id:'<?php echo $terap_id; ?>',
	 obs_asistencia:$('#obs_asistencia').val()	 

  },function(result){  

  });  

  $("#g_asistencia").html("Espere un momento..."); 
}
//  End -->
</script>

<?php
}
?>