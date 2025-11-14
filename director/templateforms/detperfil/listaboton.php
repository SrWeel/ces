<?php


echo '<select name="tab_idas" id="tab_idas">';
$objformulario->fill_cmb("gogess_sistable","tab_name,tab_name",$vbus,$orden,$DB_gogess);
echo '</select>';

echo '<select name="select" name="tipobo" id="tipobo">
  <option value="n" selected>Nuevo</option>
  <option value="g">Guardar</option>
  <option value="b">Borrar</option>
  <option value="bu">Buscar</option>
  <option value="im">Imprimir</option>
</select>';

?>
<input type="button" name="Submit" value="Asignar Bloqueo perfil" onClick="asignarboton();">
<input type="button" name="Submit2" value="Quitar Bloqueo" onClick="quitarboton();">
