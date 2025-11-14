<?php
function calcular_edad($fechan,$fechafin){
$resultado=array();
$separa_anios=array();
$valor_anio=0;
$valor_mes=0;
$fechainicial = new DateTime($fechan);
$fechafinal = new DateTime($fechafin);
$diferencia = $fechainicial->diff($fechafinal);
$meses = ( $diferencia->y * 12 ) + $diferencia->m;

$anios=$meses/12;
$separa_anios=explode(".",$anios);
$valor_anio=@$separa_anios[0];
//echo "0.".@$separa_anios[1];
$valor_mes="0.".@$separa_anios[1];
$valor_mes=round($valor_mes*12);

$resultado["anio"]=$valor_anio;
$resultado["mes"]=$valor_mes;

return $resultado;
}
$num_mes=array();
$num_mes=calcular_edad($_POST["clie_fechanacimiento"],date("Y-m-d"));
echo "Edad: ".$num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
?>