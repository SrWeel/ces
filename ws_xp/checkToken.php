<?php 
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

    include("config.php");
    $data = json_decode(file_get_contents("php://input"));
   $token = $data->token;
	$check = $db->query("SELECT * FROM app_cliente WHERE clie_token='$token'");
	
	 //$fp = fopen("fichero.txt", "w");
//fputs($fp,"SELECT * FROM app_usuario WHERE usua_token='$token'");
//fclose($fp);

	$check = $check->fetchAll();
	if (count($check) == 1){
		echo "authorized";
	} else {
		echo "unauthorized";
	}
	

	
?>