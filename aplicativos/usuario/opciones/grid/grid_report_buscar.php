<?php
ini_set("session.gc_maxlifetime","14400");
session_start();
$director="../../../../";
include ("../../../../cfgclases/clases.php");

?>
<style type="text/css">
<!--
.Estilo2 {font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<?php 
$subindice="_report";
$linkbuscar= 'onclick=desplegar_grid_buscar() style=cursor:pointer';
?>
<div align="center">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td width="117" class="Estilo2">Nombre:</td>
    <td width="227" class="Estilo2" ><input name="rept_nombre_val" type="text" class="Estilo2" id="rept_nombre_val" size="20" /></td>
  </tr>
  <tr>
    <td class="Estilo2">Estado: </td>
    <td class="Estilo2" >
	<select name="rept_activo_val" class="Estilo2" id="rept_activo_val">	
	<?php
	          printf("<option value=''>---Seleccionar--</option>");  
			  $objformulario->fill_cmb("ca_sino","value,etiqueta",$rept_activo_val,"",$DB_gogess);
           ?>
	</select>
	</td>
  </tr>
  <tr>
    <td colspan="2" class="Estilo2" <?php echo $linkbuscar ?> ><div align="center"><img src="images/opciones/buscar_ejecuta.png" width="99" height="29"></div></td>
    </tr>
</table>
</div>

<div id="grid<?php echo $subindice ?>" > </div>

<script type="text/javascript">
<!--
$( "#fechafac_val" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>
<script type="text/javascript">
<!--

desplegar_grid();

//  End -->
</script>


