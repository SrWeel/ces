<?php
echo '<select name="tab_nameas" id="tab_nameas">';
$objformulario->fill_cmb("gogess_sistable","tab_name,tab_name",$vbus,$orden,$DB_gogess);
echo '</select>';
?>
<input type="button" name="Submit" value="Asignar Bloqueo perfil" onClick="asignartabla();">
<input type="button" name="Submit2" value="Quitar Bloqueo" onClick="quitartabla();">
