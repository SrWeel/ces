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
 
function buscar_insumo()
{

$("#list_insumo").load("templateformsweb/maestro_standar_lq/lista_insumo_barra.php",{
valor_b:$('#valor_b').val()
 },function(result){       
			 
  });  
  $("#list_insumo").html("Espere un momento...");

}

function agregar_insumo(idinsumo)
{
	if($('#cant_val').val()<=0)
		{
			
			alert("Por favor para cantidad el valor debe ser minimo 1");
			return false;
		}
	
$("#agregar_insumo").load("templateformsweb/maestro_standar_lq/agregar_insumo.php",{
cant_val:$('#cant_val').val(),
produ_id:idinsumo,
enlace:'<?php echo $_POST["pVar1"]; ?>'
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
<div id="list_insumo"> </div>
<div id="agregar_insumo"> </div>


<script language="javascript">
<!--
 $("#valor_b").keypress(function(e) {
       if(e.which == 13) {
          // Acciones a realizar, por ej: enviar formulario.
         //alert("Holaaa");
		 buscar_insumo();
		 
		 $('#valor_b').val("");
       }
    });
	
	
	$("#valor_b").focus();

//-->
</script>