<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once('../lib/nusoap.php');

$cliente = new nusoap_client("https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl", true);

$resultado = $cliente->call(
     "autorizacionComprobante", 
      array(
            'claveAccesoComprobante' => '0605201404179003329500110010020000000142104011516'
            )
);
$error = $cliente->getError(); 
print_r($error);
print_r($resultado);
$ncomprobantes=$resultado["RespuestaAutorizacionComprobante"]["numeroComprobantes"];


if($ncomprobantes>1)
{

for($i=0;$i<$ncomprobantes;$i++)
{
  
  $estado_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["estado"];
  $num_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["numeroAutorizacion"];
  $fecha_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["fechaAutorizacion"];
  $ambiente_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"][$i]["ambiente"];

  if($estado_aut=='AUTORIZADO')
  {
   
    $i=$ncomprobantes+5;
  }
}


}
else
{

$estado_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["estado"];
   $num_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["numeroAutorizacion"];
  $fecha_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["fechaAutorizacion"];
  $ambiente_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["ambiente"];


}

 echo $estado_aut;

//$estado_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["estado"];
//$motivo_aut=$resultado["RespuestaAutorizacionComprobante"]["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"][0]["mensaje"];
//echo $estado_aut."<br>";
//echo $motivo_aut;

if($estado_aut='NO AUTORIZADO')
{


}
if($estado_aut='AUTORIZADO')
{


}


/*

try {
    $client = new SoapClient("https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl");
    $param = array(
                    'claveAccesoComprobante' => '0405201401179003329500110010020000000074150118216'
                    );
 
    $ready1 = $client->autorizacionComprobante($param);
   // $ready = $client->autorizacionComprobante($param)->RespuestaRecepcionComprobante->estado;
	
	
    var_dump($ready1); //Verificar si hay resultado
 
 
 
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_WARNING);
}

*/
?>