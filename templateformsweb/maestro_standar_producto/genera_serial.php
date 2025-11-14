<?php
function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}
 
$tismpo_str=date("Ymdhsi");
$serial=strtoupper(generarCodigo(10)).$tismpo_str;
?><input name="val_serial" type="hidden" id="val_serial" value="<?php echo $serial; ?>">