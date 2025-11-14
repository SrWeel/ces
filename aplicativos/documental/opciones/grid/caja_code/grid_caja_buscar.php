<?php 
$director="../../../../";
include ("../../../../cfgclases/clases.php");
$subindice="_caja";
$linkbuscar= 'onclick=desplegar_grid_buscar() style=cursor:pointer';
$numeroregistros=30;
?>
<style type="text/css">
<!--
.Estilo2 {font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<div align="center">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td width="117" class="Estilo2">C&oacute;digo:</td>
    <td width="227"><input name="codigo_val" type="text" class="Estilo2" id="codigo_val" size="20" /></td>
  </tr>
  <tr>
    <td class="Estilo2">Nombre: </td>
    <td><input name="nombre_val" type="text" class="Estilo2" id="nombre_val" size="20" /></td>
  </tr>
  <tr>
    <td class="Estilo2"  >Activo:</td>
    <td  ><select name="activo_val" id="activo_val" class="Estilo2" >
	<?php
	          printf("<option value='-1'>---Seleccionar--</option>");  
			  $objformulario->fill_cmb("sibase_sino","value,etiqueta",$activo_val," order by value asc",$DB_gogess);
           ?>
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="Estilo2" <?php echo $linkbuscar ?> ><div align="center"><img src="images/opciones/buscar_ejecuta.png" width="99" height="29"></div></td>
    </tr>
</table>
</div>

<div id="grid<?php echo $subindice ?>" > 
<input name="inicio_lista" type="hidden" id="inicio_lista" value="0" />
<input name="fin_lista" type="hidden" id="fin_lista" value="<?php echo $numeroregistros ?>" />

</div>

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


