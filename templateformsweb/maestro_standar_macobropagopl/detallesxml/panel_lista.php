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

$compra_claveacceso=$_POST["pVar2"];


?>
<div id="lista_detallesxmldata">

</div>

<script type="text/javascript">
<!--

function despliega_lista()
{
     
	 $("#lista_detallesxmldata").load("templateformsweb/maestro_standar_compras/detallesxml/lista.php",{
          pVar2:'<?php echo $compra_claveacceso; ?>',
		  compra_numeroproceso:$('#compra_numeroproceso').val()
	  },function(result){  

		    
	  });  
	
	  $("#lista_detallesxmldata").html("...");  

}

despliega_lista();

//  End -->
</script>