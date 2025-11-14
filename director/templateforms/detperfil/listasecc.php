<?php
echo '<select name="secp_idas" id="secp_idas">';
$objformulario->fill_cmb("gogess_seccp","secp_id,etiqueta",$vbus,$orden,$DB_gogess);
echo '</select>';
?>
<input type="button" name="Submit" value="Asignar Bloqueo perfil" onClick="asignarsecc();">
<input type="button" name="Submit2" value="Quitar Bloqueo" onClick="quitarsecc();">
