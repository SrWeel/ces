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

function desplegar_insumoevaluacion()
{
   $("#list_evaluacion").load("templateformsweb/maestro_standar_lq/lista_evaluacion.php",{
valor_b:$('#valor_b').val(),
ci_paga:$('#doccab_rucci_cliente').val()
 },function(result){       
			 
  });  
  $("#list_evaluacion").html("Espere un momento...");

}
 
function buscar_insumo()
{

$("#list_insumo").load("templateformsweb/maestro_standar_lq/lista_insumo.php",{
valor_b:$('#valor_b').val(),
ci_paga:$('#doccab_rucci_cliente').val()
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
	
$("#agregar_insumo").load("templateformsweb/maestro_standar_lq/agregar_insumo.php",{
cant_val:$('#cant_val').val(),
prod_id:idinsumo,
enlace:'<?php echo $_POST["pVar1"]; ?>',
ci_paga:ci
 },function(result){       
			
			grid_factura(0);
			 
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
	
$("#agregar_insumo").load("templateformsweb/maestro_standar_lq/agregar_evaluacion.php",{
cant_val:$('#cant_val').val(),
prod_id:idinsumo,
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
    <strong class="css_cantidad">CANTIDAD:</strong>
  <input name="cant_val" type="text" class="css_cantidad" id="cant_val" value="1" size="10">
 
  
  <br><br>
</div>
<div id="list_evaluacion" ></div>
<div id="list_insumo"> </div>
<div id="agregar_insumo"> </div>


<script language="javascript">
<!--
desplegar_insumoevaluacion();
//-->
</script>