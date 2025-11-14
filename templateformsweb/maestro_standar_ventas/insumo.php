<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

?>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.css_cantidad {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 20px;
}

-->
</style>
<script language="javascript">
<!--


function ejecuta_despachar(cuadrobm_id,centro_id,maximop,clie_id)
{
	
  
  abrir_standar("templateformsweb/maestro_standar_ventas/lotes.php","Despacho","divBody_pdespacho","divDialog_pdespacho",580,500,$('#doccab_id').val(),'beko_documentocabecera',centro_id,'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',$('#proveeve_id').val(),maximop,cuadrobm_id);
  
}


function desplegar_insumoevaluacion()
{
   $("#list_evaluacion").load("templateformsweb/maestro_standar_ventas/lista_evaluacion.php",{
valor_b:$('#valor_b').val(),
ci_paga:$('#doccab_rucci_cliente').val()
 },function(result){       
			 
  });  
  $("#list_evaluacion").html("Espere un momento...");

}
 
function buscar_insumo()
{

	if($('#proveeve_id').val()=='')
		{
			
			alert("Por favor seleccione un cliente");
			return false;
		}
		

$("#list_insumo").load("templateformsweb/maestro_standar_ventas/lista_insumo.php",{
valor_b:$('#valor_b').val(),
ci_paga:$('#doccab_rucci_cliente').val(),
proveeve_id:$('#proveeve_id').val()
 },function(result){       
			 
  });  
  $("#list_insumo").html("Espere un momento...");

}

function agregar_insumo(idinsumo,ci)
{
	if($('#cant_val').val()<=0)
		{
			
			alert("Por favor para cantidad el valor debe ser minimo 1");
			return false;
		}
		
$("#agregar_insumo").load("templateformsweb/maestro_standar_ventas/agregar_insumo.php",{
cant_val:$('#cant_val').val(),
cuadrobm_id:idinsumo,
enlace:'<?php echo $_POST["pVar1"]; ?>',
ci_paga:ci
 },function(result){       
			
			grid_extras_10271('<?php echo $_POST["pVar1"]; ?>',0,0)
			 
  });  
  $("#agregar_insumo").html("Espere un momento...");


}

//agergar evaluacion

function agregar_evaluacion(idinsumo,ci)
{
	if($('#cant_val').val()<=0)
		{
			
			alert("Por favor para cantidad el valor debe ser minimo 1");
			return false;
		}
	
$("#agregar_insumo").load("templateformsweb/maestro_standar_ventas/agregar_evaluacion.php",{
cant_val:$('#cant_val').val(),
cuadrobm_id:idinsumo,
enlace:'<?php echo $_POST["pVar1"]; ?>',
ci_paga:ci
 },function(result){       
			
			grid_factura(0);
			 
  });  
  $("#agregar_insumo").html("Espere un momento...");


}


//-->
</script>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td><input name="valor_b" type="text" id="valor_b" size="40"></td>
    <td><input type="button" name="Submit" value="Buscar" onClick="buscar_insumo()" ></td>
    <td>&nbsp;</td>
  </tr>
</table>
<div align="center"><br>
   <!-- <strong class="css_cantidad">CANTIDAD:</strong> -->
  <input name="cant_val" type="hidden" class="css_cantidad" id="cant_val" value="1" size="10">
 
  
  <br><br>
</div>
<div id="list_evaluacion" ></div>
<div id="list_insumo"> </div>
<div id="agregar_insumo"> </div>

<div id="divBody_pdespacho"></div>
<script language="javascript">
<!--
//desplegar_insumoevaluacion();
//-->
</script>