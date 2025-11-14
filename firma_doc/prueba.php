<?php

//ini_set('display_errors',1);
//error_reporting(E_ALL);




$doc['xml']=base64_encode ('<?xml version="1.0" encoding="UTF-8" ?>
<factura version="1.0.0" id="comprobante" >
<infoTributaria>
<ambiente>1</ambiente>
<tipoEmision>1</tipoEmision>
<razonSocial>LLUMIQUINGA CRISTHIAN</razonSocial>
<nombreComercial>LLUMIQUINGA CRISTHIAN</nombreComercial>
<ruc>1712546769001</ruc>
<claveAcceso>2708201401171254676900110010010000002032295322413</claveAcceso>
<codDoc>01</codDoc>
<estab>001</estab>
<ptoEmi>001</ptoEmi>
<secuencial>000000203</secuencial>
<dirMatriz>ELOY ALFARO N32-614 Y BELGICA</dirMatriz>
</infoTributaria>
<infoFactura>
<fechaEmision>27/08/2014</fechaEmision>
<dirEstablecimiento>ELOY ALFARO N32-614 Y BELGICA</dirEstablecimiento>
<obligadoContabilidad>SI</obligadoContabilidad>
<tipoIdentificacionComprador>04</tipoIdentificacionComprador>
<razonSocialComprador>Jhon Zumba</razonSocialComprador>
<identificacionComprador>1710843424001</identificacionComprador>
<totalSinImpuestos>267.00</totalSinImpuestos>
<totalDescuento>0.00</totalDescuento>
<totalConImpuestos>
<totalImpuesto>
<codigo>2</codigo>
<codigoPorcentaje>2</codigoPorcentaje>
<baseImponible>267.00</baseImponible>
<valor>32.04</valor>
</totalImpuesto>
</totalConImpuestos>
<propina>0.00</propina>
<importeTotal>299.04</importeTotal>
<moneda>DOLAR</moneda>
</infoFactura>
<detalles>
<detalle>
<codigoPrincipal>PR001</codigoPrincipal>
<codigoAuxiliar>PR001</codigoAuxiliar>
<descripcion>CAJA DE HERRAMIENTAS</descripcion>
<cantidad>3.00</cantidad>
<precioUnitario>89.00</precioUnitario>
<descuento>0.00</descuento>
<precioTotalSinImpuesto>267.00</precioTotalSinImpuesto>
<impuestos>
<impuesto>
<codigo>2</codigo>
<codigoPorcentaje>2</codigoPorcentaje>
<tarifa>12.00</tarifa>
<baseImponible>267.00</baseImponible>
<valor>32.04</valor>
</impuesto>
</impuestos>
</detalle>
</detalles>
<infoAdicional>
<campoAdicional nombre="direccionComprador">Cotocollao</campoAdicional>
<campoAdicional nombre="telefonoComprador">2525789</campoAdicional>
<campoAdicional nombre="CorreoCliente">falider@hotmail.com</campoAdicional>
</infoAdicional>
</factura>');




$doc['usuario']="faesa";
$doc['clave']=md5("123456");

echo 'http://186.4.157.126:75/doc_sign/server.php?wsdl<br>';
/*
    require_once('lib/nusoap.php');
    $cliente = new nusoap_client('http://186.4.157.126:75/doc_sign/server.php?wsdl');
    $resultado = $cliente->call('SignDoc', array('Documento' =>$doc));
    print_r($resultado);



$url = "http://186.4.157.126:75/doc_sign/server.php?wsdl";
try {
 $client = new SoapClient($url, ['trace' => true, 'cache_wsdl' => WSDL_CACHE_MEMORY]);
 $result = $client->SignDoc($doc);
 print_r($result);
} catch ( SoapFault $e ) {
 echo $e->getMessage();
}
echo PHP_EOL;	*/
// options for ssl in php 5.6.5
$opts = array(
    'ssl' => array(
        'ciphers' => 'RC4-SHA',
        'verify_peer' => false,
        'verify_peer_name' => false
    )
);

// SOAP 1.2 client
$params = array(
    'encoding' => 'UTF-8',
    'verifypeer' => false,
    'verifyhost' => false,
    'soap_version' => SOAP_1_2,
    'trace' => 1,
    'exceptions' => 1,
    'connection_timeout' => 180,
    'stream_context' => stream_context_create($opts)
);


try {
$client = new SoapClient("http://186.4.157.126:75/doc_sign/server.php?wsdl", $params );
var_dump($client->__getFunctions());
} catch ( SoapFault $e ) {
 echo $e->getMessage();
}



$options = array(
    'cache_wsdl' => 0,
    'trace' => 1,
    'stream_context' => stream_context_create(array(
          'ssl' => array(
               'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
          )
    )));



$client = new SoapClient("http://186.4.157.126:75/doc_sign/server.php?wsdl", $options);
//var_dump($client->__getFunctions());
$result = $client->SignDoc($doc);
print_r($result);


//echo htmlentities(file_get_contents('http://186.4.157.126:75/doc_sign/server.php?wsdl'));
/*
$servicio="http://186.4.157.126:75/doc_sign/server.php?wsdl"; //url del servicio
$client = new SoapClient($servicio, $doc);
$result = $client->SignDoc($parametros);//llamamos al métdo que nos interesa con los parámetros 
	 */
 // echo base64_decode($resultado["xmlresp"]);
?>