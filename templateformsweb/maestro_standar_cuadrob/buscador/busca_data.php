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

$gridfield_id=$_POST["pVar1"];


$obtine_data="select * from gogess_gridfield where 	gridfield_id='".$gridfield_id."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());


?>
<table width="400" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">Buscar: 
        <input name="b_data" type="text" id="b_data" value="">
        <input type="button" name="Submit" value="Buscar" onClick="buscar_datavalor()">
    </div></td>
  </tr>
  <tr>
    <td><div id="despliega_data"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<script type="text/javascript">
<!--

function buscar_datavalor()
{

	  $("#despliega_data").load("templateformsweb/maestro_standar_cuadrob/buscador/listado.php",{
        b_data:$('#b_data').val(),
		gridfield_id:'<?php echo $gridfield_id; ?>'
	  },function(result){  
	
	
	  });  
	
	  $("#despliega_data").html("Espere un momento..."); 

}

buscar_datavalor();
//  End -->
</script>

