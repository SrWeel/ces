<?php
    //$id=$_POST["plantrai_codigox"];
    $app_key  = 'Zgl9tbumnDxPsSid9XsjPxEcmtarwIQP19T5hb1uOvM';
	$utoken = 'a2e24405-b100-4789-aa6a-e248422b776d';
	
	$contentType = 'text/xml';
    $method = 'GET';
    $auth = '';
    $header1 = 'Authorization: Zgl9tbumnDxPsSid9XsjPxEcmtarwIQP19T5hb1uOvM';
    $charset= 'ISO-8859-1';
	
	$data = array(
    'codigo' => '4pzb8OyD1ip4aEwN'
);

$payload = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.contifico.com/sistema/api/v1/producto/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLINFO_HEADER_OUT, true);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-type: ' . 
                $contentType,
                $header1));
$response =curl_exec($ch);

$arreglo_data=array();
$arreglo_data=json_decode($response, true);

print_r($arreglo_data);

?>
