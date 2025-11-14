<?php
//echo $_POST["pVar1"];
//echo $_POST["pVar2"];
//echo $_POST["pVar3"];
?>
<script type="text/javascript">
<!--

function buscar_val()
{
 
  $("#despliegue_busqueda").load("libreria/extra/resultadob.php",{
  
    buscar_val:$('#buscarval').val(),tablabusca:'<?php echo $_POST["pVar1"] ?>',camposbusca:'<?php echo $_POST["pVar2"] ?>',campodevuelve:'<?php echo $_POST["pVar3"] ?>',campoviene:'<?php echo $_POST["pVar4"] ?>'
  
  
  },function(result){  

  });  
  $("#despliegue_busqueda").html("Espere un momento...");

}

function seleccionar_valor(valor)
{

   $('#<?php echo $_POST["pVar4"] ?>').val(valor);
   
    $('#divDialogo_popup').dialog( "close" );
   
}

//  End -->
</script>


<table width="480" border="0" align="center" cellspacing="0">
  <tr>
    <td><div align="center">
      <input name="buscarval" type="text" id="buscarval" size="40" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif" >
      <input type="button" name="Submit" value="Buscar" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif" onClick="buscar_val()" >
    </div></td>
  </tr>
  <tr>
    <td>
	<div id=despliegue_busqueda> 
	
	
	</div>	
	</td>
  </tr>
</table>
