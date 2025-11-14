<?php
$tiempossss=5414000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include("../../cfg/apicfg.php");

$app_key  = 'Zgl9tbumnDxPsSid9XsjPxEcmtarwIQP19T5hb1uOvM';
$utoken = '015f463f-b58c-4c9b-9dce-e79e838a6de6';
	
$contentType = 'text/xml';
$method = 'GET';
$auth = '';
$header1 = 'Authorization: '.$app_key;
$charset= 'ISO-8859-1';

	
	$data = array(
    'codigo' => '4pzb8OyD1ip4aEwN'
);

$payload = json_encode($data);
$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "https://api.contifico.com/sistema/api/v1/producto/".$id."/");
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
<script type="text/javascript">
<!--

$('#plantrai_nombredispositivox').val('<?php echo $arreglo_data["nombre"]; ?>');

$('#plantrai_preciox').val('<?php echo $arreglo_data["pvp1"]; ?>');

//  End -->
</script>