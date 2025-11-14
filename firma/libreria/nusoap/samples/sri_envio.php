<?php
require_once('../lib/nusoap.php');
function leer_contenido_completo($url){
   //abrimos el fichero, puede ser de texto o una URL
   $fichero_url = fopen ($url, "r");
   $texto = "";
   //bucle para ir recibiendo todo el contenido del fichero en bloques de 1024 bytes
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   return $texto;
} 

$salida_xml=leer_contenido_completo("1711467884179003329500120140520034342446.xml");

//echo $salida_xml;

$cliente = new nusoap_client("https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl", true);

$resultado = $cliente->call(
     "validarComprobante", 
      array(
            'xml' => base64_encode($salida_xml)
            )
);
$error = $cliente->getError(); 
print_r($resultado);
//print_r($error);

/*

try {
$client = new SoapClient("https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl");
    $param = array(
                    'xml' => $salida_xml
                    );

$ready1 = $client->validarComprobante($param);


$arreglolista=objectToArray($ready1);
print_r($arreglolista)."<br>";
$ready_estado=$arreglolista["RespuestaRecepcionComprobante"]["estado"];

if($ready_estado=='DEVUELTA')
{

//$mensajev=$arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["mensaje"];
$motivo=str_replace("'"," ",$arreglolista["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["informacionAdicional"]);

}

//echo $mensajev."<br>";
//echo $motivo."<br>";
					
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_WARNING);
}
	
*/
?>