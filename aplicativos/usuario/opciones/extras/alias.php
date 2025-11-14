<?php
function normaliza ($cadena){
 
$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyyby';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
	
}

$txt_valor=strtolower(str_replace(" ","-",$_POST["title"]));

$tatores= normaliza($txt_valor);
?>
<input name="alias_valor" type="hidden" id="alias_valor" value="<?php echo $tatores ?>" />