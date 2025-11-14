<?php
//parametros
$formapago_code["01"]="Sin Utili. Sist. Financiero";
$formapago_code["02"]="CHEQUE PROPIO";
$formapago_code["03"]="CHEQUE CERTIFICADO";
$formapago_code["04"]="CHEQUE DE GERENCIA";
$formapago_code["05"]="CHEQUE DEL EXTERIOR";
$formapago_code["06"]="DEBITO DE CUENTA";
$formapago_code["07"]="TRANSFERENCIA PROPIO BANCO";
$formapago_code["08"]="TRANSFERENCIA OTRO BANCO NACIONAL";
$formapago_code["09"]="TRANSFERENCIA BANCO EXTERIOR";
$formapago_code["10"]="TARJETA DE CREDITO NACIONAL";
$formapago_code["11"]="TARJETA DE CREDITO INTERNACIONAL";
$formapago_code["12"]="GIRO";
$formapago_code["13"]="DEPOSITO EN CUENTA (CORRIENTE/AHORROS)";
$formapago_code["14"]="ENDOSO DE INVERSION";
$formapago_code["15"]="COMPENSACION DE DEUDAS";
$formapago_code["16"]="TARJETA DE DEBITO";
$formapago_code["17"]="DINERO ELECTRONICO";
$formapago_code["18"]="TARJETA PREPAGO";
$formapago_code["18"]="TARJETA PREPAGO";
$formapago_code["19"]="TARJETA DE CREDITO";
$formapago_code["20"]="OTROS CON UTIL. SIST. FINANC.";
$formapago_code["21"]="ENDOSO DE TITULOS";
//code comprobantes
$comprobante_code["01"]="FACTURA";
$comprobante_code["04"]="NOTA DE CR&Eacute;DITO";
$comprobante_code["05"]="NOTA DE D&Eacute;BITO";
$comprobante_code["06"]="GU&Iacute;A DE REMISI&Iacute;N";
$comprobante_code["07"]="COMPROBANTE DE RETENCI&Oacute;N";
//code ambiente
$ambiente_code["1"]="PRUEBAS";
$ambiente_code["2"]="PRODUCCION";
//code emision
$tipoemision_code["1"]="Emisi&oacute;n Normal";
$tipoemision_code["2"]="Emisi&oacute;n por Indisponibilidad del Sistema";
//code identificacion
$tipoidentificacion_code["04"]="RUC";
$tipoidentificacion_code["05"]="CEDULA";
$tipoidentificacion_code["06"]="PASAPORTE";
$tipoidentificacion_code["07"]="CONSUMIDOR FINAL";
$tipoidentificacion_code["08"]="IDENTIFICACION  DELEXTERIOR";
$tipoidentificacion_code["09"]="PLACA";
//Impuestos
$impuesto_code["2"]="IVA";
$impuesto_code["3"]="ICE";
$impuesto_code["5"]="IRBPNR";

$tarifaiva_code["0"]="0%";
$tarifaiva_code["2"]="12%";
$tarifaiva_code["3"]="14%";
$tarifaiva_code["4"]="15%";
$tarifaiva_code["5"]="5%";
$tarifaiva_code["6"]="No Objeto de Impuesto";
$tarifaiva_code["7"]="Exento de IVA";
$tarifaiva_code["8"]="IVA diferenciado";
$tarifaiva_code["10"]="13%";

//impuesto retencion
$retencion_code["1"]="RENTA";
$retencion_code["2"]="IVA";
$retencion_code["6"]="ISD";
//parametros
function fecha_mes($mes)
{
   switch ($mes) {
    case '01':
        $mesn='Ene';
        break;
    case '02':
        $mesn='Feb';
        break;
    case '03':
        $mesn='Mar';
        break;
    case '04':
        $mesn='Abr';
        break;
	 case '05':
        $mesn='May';
        break;
	 case '06':
        $mesn='Jun';
        break;
	case '07':
        $mesn='Jul';
        break;	
	case '08':
        $mesn='Ago';
        break;
	case '09':
        $mesn='Sep';
        break;
	case '10':
        $mesn='Oct';
        break;
	case '11':
        $mesn='Nov';
        break;
	case '12':
        $mesn='Dic';
        break;														
    default:
       $mesn='';
      }
	  
	  return  $mesn;
}

?>