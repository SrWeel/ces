<?php

$objformulario->form_format_tabla($table,$DB_gogess);



if ($objformulario->tab_archivo)

{



echo '<SCRIPT LANGUAGE=javascript>

<!--



function subirarchiv(campogeneral) {

window.open("/pichinchahumana/modules/archivos/archivo.php?campogeneral="+campogeneral,campogeneral,"width=600,height=100,scrollbars=NO");



}



//-->

</SCRIPT>';





}

echo '<script src="../../../../../libreria/ajax/selectuser_combog.js"></script>';



?>