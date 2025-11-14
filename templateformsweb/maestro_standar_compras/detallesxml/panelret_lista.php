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

$compra_id=$_POST["pVar2"];

?>

<div align="center"><br />
  Fecha Emisi&oacute;n Retenci&oacute;n:
  <input name="fecha_emisionret" type="text" id="fecha_emisionret" value="" /><br /><br />
  Susteno del Comprobante: <input name="compretcab_codsustento" type="text" id="compretcab_codsustento" value="01" /><br /><br />
  <input type="button" name="Submit" value="GENERAR RETENCION" onclick="generar_retenciondata(0)" /> 
  <input type="button" name="Submit" value="ACTUALIZAR RETENCION" onclick="generar_retenciondata(1)" />
</div>


<div id="lista_detallesxmldata">

</div>
<br /><br />
<div id="lista_retenciones">

</div>



<script type="text/javascript">
<!--

function generar_retenciondata(actualizar)
{
     if($('#fecha_emisionret').val()=='')
	 {
	   alert("Por favor llene la fecha de EMSION");
	   return false;
	 }
	 
	 if($('#compretcab_codsustento').val()=='')
	 {
	   alert("Susteno del Comprobante obligatorio");
	   return false;
	 }
	 
	 $("#lista_detallesxmldata").load("templateformsweb/maestro_standar_compras/xmlpdf/generar.php",{
         compra_id:'<?php echo $compra_id; ?>',
		 fecha_emisionret:$('#fecha_emisionret').val(),
		 compretcab_codsustento:$('#compretcab_codsustento').val(),
		 actualizar:actualizar
	  },function(result){  
	  //alert($('#provee_id').val());	     
		   lista_retencion();   
	  });  
	
	  $("#lista_detallesxmldata").html("...");  

}

$( '#fecha_emisionret' ).datepicker({dateFormat: 'yy-mm-dd'});



function lista_retencion()
{

    $("#lista_retenciones").load("templateformsweb/maestro_standar_compras/xmlpdf/lista_rete.php",{
         compra_id:'<?php echo $compra_id; ?>',
		 fecha_emisionret:$('#fecha_emisionret').val(),
		 compretcab_codsustento:$('#compretcab_codsustento').val()
	  },function(result){  
	  //alert($('#provee_id').val());	     
		    
	  });  
	
	  $("#lista_retenciones").html("...");  

}

lista_retencion();

$('#fecha_emisionret').val($('#compra_fecha').val());


//  End -->
</script>