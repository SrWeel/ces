
<?php


echo '<select name="men_idas" id="men_idas">';
$objformulario->fill_cmb("gogess_menu","men_id,men_titulo",$vbus,$orden,$DB_gogess);
echo '</select>';
?>
<input type="button" name="Submit" value="Asignar Bloqueo perfil" onClick="asignarmenu();">
<input type="button" name="Submit2" value="Quitar Bloqueo" onClick="quitarmenu();">
