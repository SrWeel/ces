<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$compra_id=$_POST["pVar2"];

$busca_detalles="select * from dns_compras where compra_id='".$compra_id."'";
$rs_bdet = $DB_gogess->executec($busca_detalles,array());

?>
<div id="lista_detallesxmldata">

</div>

<script type="text/javascript">
<!--

function despliega_lista()
{
     
	 $("#lista_detallesxmldata").load("eq/lista.php",{
          compra_id:'<?php echo $compra_id; ?>'
	  },function(result){  

		    
	  });  
	
	  $("#lista_detallesxmldata").html("...");  

}

despliega_lista();

//  End -->
</script>