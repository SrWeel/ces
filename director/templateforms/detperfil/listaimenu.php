<?php


echo '<select name="men_idas" id="men_idas" onClick="showUser_imenu(window.document.form_gogess_detperfil.men_idas.value,0,0,0,0,0,0,0,0,0,0)">';
echo '<option value="0" selected>--Seleccionar--</option>';
$objformulario->fill_cmb("gogess_menu","men_id,men_titulo",$vbus,$orden,$DB_gogess);
echo '</select>';



?>

<div id=txtHint_imenu></div>
<input type="button" name="Submit" value="Asignar Bloqueo perfil" onClick="asignarimenu();">
<input type="button" name="Submit2" value="Quitar Bloqueo" onClick="quitarimenu();">
