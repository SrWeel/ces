<?php

$campos["radio"]["contenido"]='<input name="-id-" id="-id-" type="radio" value="-valor-" -funcion- -seleccion- >';
$campos["radio"]["contenido_jquery"]="$('input:radio[name=-nombre-]:checked').is(':checked')";


$campos["textarea"]["contenido"]='<textarea name="-id-" cols="-ancho-" rows="-alto-" id="-id-"  -funcion- >-valor-</textarea>';
$campos["textarea"]["contenido_jquery"]="$('#-nombre-').val()";

$campos["checkbox"]["contenido"]='<input name="-id-" type="checkbox" id="-id-" value="-valor-" -funcion- -seleccion-  >';
$campos["checkbox"]["contenido_jquery"]="$('input:checkbox[name=-nombre-]:checked').is(':checked')";


$campos["text"]["contenido"]='<input name="-id-" type="text" id="-id-" value="-valor-" size="-ancho-" -funcion- >';
$campos["text"]["contenido_jquery"]="$('#-nombre-').val()";




?>