<?php

//function cal_days_in_month($calendar, $month, $year) {
  //  return (int)date("t", strtotime("$year-$month-01"));
//}


function calcular_edad($fechan,$fechafin){
$resultado=array();
$separa_anios=array();
$valor_anio=0;
$valor_mes=0;
$dia_valor=0;

$fechainicial = new DateTime($fechan);
$fechafinal = new DateTime($fechafin);
$diferencia = $fechainicial->diff($fechafinal);
$meses = ( $diferencia->y * 12 ) + $diferencia->m;
$dia_valor=$diferencia->d;

$anios=$meses/12;
$separa_anios=explode(".",$anios);
$valor_anio=@$separa_anios[0];
$valor_mes=("0.".@$separa_anios[1])*12;
$resultado["anio"]=$valor_anio;
$resultado["mes"]=round($valor_mes);
$resultado["dia"]=$dia_valor;
return $resultado;
}


$nombre_mes["01"]='ENE';
$nombre_mes["02"]='FEB';
$nombre_mes["03"]='MAR';
$nombre_mes["04"]='ABR';
$nombre_mes["05"]='MAY';
$nombre_mes["06"]='JUN';
$nombre_mes["07"]='JUL';
$nombre_mes["08"]='AGO';
$nombre_mes["09"]='SEP';
$nombre_mes["10"]='OCT';
$nombre_mes["11"]='NOV';
$nombre_mes["12"]='DIC';


class NumerosEnLetras
{
    private static $UNIDADES = [
        '',
        'un ',
        'dos ',
        'tres ',
        'cuatro ',
        'cinco ',
        'seis ',
        'siete ',
        'ocho ',
        'nueve ',
        'diez ',
        'once ',
        'doce ',
        'trece ',
        'catorce ',
        'quince ',
        'dieciseis ',
        'diecisiete ',
        'dieciocho ',
        'diecinueve ',
        'veinte '
    ];
    private static $DECENAS = [
        'venti',
        'treinta ',
        'cuarenta ',
        'cincuenta ',
        'sesenta ',
        'setenta ',
        'ochenta ',
        'noventa ',
        'cien '
    ];
    private static $CENTENAS = [
        'ciento ',
        'doscientos ',
        'trescientos ',
        'cuatrocientos ',
        'quinientos ',
        'seiscientos ',
        'setecientos ',
        'ochocientos ',
        'novecientos '
    ];
    public static function convertir($number, $currency = '', $format = false, $decimals = '')
    {
        $base_number = $number;
        $converted = '';
        $decimales = '';
        if (($base_number < 0) || ($base_number > 999999999)) {
            return 'No es posible convertir el numero en letras';
        }
        $div_decimales = explode('.',$base_number);
		
        if(count($div_decimales) >= 2){
            $base_number = $div_decimales[0];
            $decNumberStr = $div_decimales[1];
			
			if($decNumberStr<10)
			{
				$decNumberStr=$decNumberStr."0";
				
			}
		
            if(strlen($decNumberStr) == 2){
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decCientos = substr($decNumberStrFill, 6);
                $decimales = self::convertGroup($decCientos);
            }
        }
		
        $numberStr = (string) $base_number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'un millon ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%smillones ', self::convertGroup($millones));
            }
        }
        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'mil ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%smil ', self::convertGroup($miles));
            }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'un ';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', self::convertGroup($cientos));
            }
        }
        if($format){
            if(empty($decNumberStr)){
                $valor_convertido = number_format($number, 3, ',', '.') . ' (' . ucfirst($converted) . '00/100 '.$currency.')';
            } else {
                $valor_convertido = number_format($number, 3, ',', '.') . ' (' . ucfirst($converted) . $decNumberStr . '/100 '.$currency.')';
            }
        }else{
            if(empty($decimales)){
                $valor_convertido = ucfirst($converted) . $currency;
            } else {
                $valor_convertido = ucfirst($converted) . $currency. ' con ' . $decimales . $decimals;
            }
        }
        return $valor_convertido;
    }
    private static function convertGroup($n)
    {
        $output = '';
        if ($n == '100') {
            $output = "cien ";
        } else if ($n[0] !== '0') {
            $output = self::$CENTENAS[$n[0] - 1];
        }
        $k = intval(substr($n,1));
        if ($k <= 20) {
            $output .= self::$UNIDADES[$k];
        } else {
            if(($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sy %s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            }
        }
        return $output;
    }
	
	
	
	 public static function convertirnum($number, $currency = '', $format = false, $decimals = '')
    {
        $base_number = $number;
        $converted = '';
        $decimales = '';
        if (($base_number < 0) || ($base_number > 999999999)) {
            return 'No es posible convertir el numero en letras';
        }
        $div_decimales = explode('.',$base_number);
		
        if(count($div_decimales) >= 2){
            $base_number = $div_decimales[0];
            $decNumberStr = $div_decimales[1];
			
			if($decNumberStr<10)
			{
				$decNumberStr=$decNumberStr."0";
				
			}
		
            if(strlen($decNumberStr) == 2){
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decCientos = substr($decNumberStrFill, 6);
                $decimales = self::convertGroup($decCientos);
            }
        }
		
        $numberStr = (string) $base_number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'un millon ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%smillones ', self::convertGroup($millones));
            }
        }
        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'mil ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%smil ', self::convertGroup($miles));
            }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'un ';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', self::convertGroup($cientos));
            }
        }
        if($format){
            if(empty($decNumberStr)){
                $valor_convertido = ' (' . ucfirst($converted).')';
            } else {
                $valor_convertido = ' (' . ucfirst($converted).')';
            }
        }else{
            if(empty($decimales)){
                $valor_convertido = ucfirst($converted) . $currency;
            } else {
                $valor_convertido = ucfirst($converted) . $currency. ' con ' . $decimales . $decimals;
            }
        }
        return $valor_convertido;
    }
	
	
	
}
?>