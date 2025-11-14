<?php
echo "HOla";
$service_url = 'http://186.4.157.126:75/doc_sign/sign.php';     
$curl = curl_init($service_url);
$curl_post_data = array(
        'status' => 'test message',
        'dos' => 'agent@example.com'
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
$curl_response = curl_exec($curl);
echo $curl_response;
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
echo $curl_response;

$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
var_export($decoded->mensaje);
 

?>