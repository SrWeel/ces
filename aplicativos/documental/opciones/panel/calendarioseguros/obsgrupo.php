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

$asigm_id=$_POST["pVar1"];
$clie_id=$_POST["pVar2"];
$centro_id=$_POST["pVar3"];
$usua_id=$_POST["pVar4"];
$fecha_valor=$_POST["pVar5"];

//$busca_datos="select * from faesa_terapiasregistro where terap_id='".$terap_id."'";
//$rs_bdata = $DB_gogess->executec($busca_datos,array());

$busca_asistencia="select * from cereni_asistenciagrupo where asigm_id='".$asigm_id."' and clie_id='".$clie_id."' and centro_id='".$centro_id."' and asig_fecha='".$fecha_valor."'";
$rs_bcasietg = $DB_gogess->executec($busca_asistencia,array());
		

?>
<center><textarea name="obs_asistencia" cols="30" rows="5" id="obs_asistencia"><?php echo $rs_bcasietg->fields["asig_obsnoasiste"]; ?></textarea><br>
  <input type="button" name="Button" value="Guardar" onClick="g_asisgrupo()" >
</center>
<div id="g_asistenciag"></div>

<script type="text/javascript">
<!--
function g_asisgrupo()
{  
  $("#g_asistenciag").load("aplicativos/documental/opciones/panel/calendarioseguros/g_asistenciag.php",{   
	 asigm_id:'<?php echo $asigm_id; ?>',
	 clie_id:'<?php echo $clie_id; ?>',
	 centro_id:'<?php echo $centro_id; ?>',
	 usua_id:'<?php echo $usua_id; ?>',
	 asig_fecha:'<?php echo $fecha_valor; ?>',
	 obs_asistencia:$('#obs_asistencia').val()	 

  },function(result){  

  });  

  $("#g_asistenciag").html("Espere un momento..."); 
}
//  End -->
</script>

<?php
}
?>