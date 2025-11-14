<?php
$subindice="_equipoing";
?>
<script type="text/javascript">
<!--
function desplegar_gr()
{
	
	
   $("#grid<?php echo $subindice; ?>").load("aplications/usuario/opciones/extras/grid_equipo/grid<?php echo $subindice; ?>_bu.php",{
bu_nombre:$('#bu_nombre').val(),
bu_numparte:$('#bu_numparte').val(),
bu_numserie:$('#bu_numserie').val()
  },function(result){  

  });  
  $("#grid<?php echo $subindice; ?>").html("Espere un momento...");  

}
//  End -->
</script>


<style type="text/css">
<!--
.Estilo1 {font-size: 11px}
.Estilo5 {font-size: 11px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="291" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="131" class="Estilo1"><span class="Estilo5">Nombre Equipo: </span></td>
        <td width="160"><input name="bu_nombre" type="text" id="bu_nombre"></td>
      </tr>
      <tr>
        <td height="23" class="Estilo1"><span class="Estilo5">N&uacute;mero de Parte: </span></td>
        <td><input name="bu_numparte" type="text" id="bu_numparte"></td>
      </tr>
      <tr>
        <td class="Estilo1"><span class="Estilo5">N&uacute;mero de Serie: </span></td>
        <td><input name="bu_numserie" type="text" id="bu_numserie"></td>
      </tr>
    </table></td>
    <td><input type="submit" name="Submit" value="Buscar Equipo" onClick="desplegar_gr()" ></td>
  </tr>
  <tr>
    <td colspan="2">
	<div id=grid<?php echo $subindice; ?> align="center" ></div>
	
	
	</td>
  </tr>
</table>
<?php

?>

<script type="text/javascript">
<!--
 desplegar_gr();

//  End -->
</script>