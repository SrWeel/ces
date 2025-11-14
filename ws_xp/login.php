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
    //echo json_encode($data);
	$password = md5($data->password);
    $username = $data->username;
	
	$userInfo = $db->query("SELECT 	clie_email as usua_email,clie_nombre as usua_nombre,clie_id as usua_id FROM app_cliente WHERE 	clie_email='$username' AND clie_clave='$password'");
    $userInfo = $userInfo->fetchAll();
	
	foreach ($userInfo as $row) {
        $nombre=$row["usua_nombre"];
		$id_usuario=$row["usua_id"];
    }

	
	$token; 
	if (count($userInfo) == 1){
		//This means that the user is logged in and let's givem a token :D :D :D
		$token = $username. " | " . uniqid() . uniqid() . uniqid();
		
	$q = "UPDATE app_cliente SET clie_token=:token WHERE clie_email=:email AND clie_clave=:password";
	$query = $db->prepare($q);
	$execute = $query->execute(array(
		":token" => $token,
		":email" => $username,
		":password" => $password
	)); 
	
	$entrega=array(
	"token"=>$token,
	"nombre"=>$nombre,
	"idus"=>$id_usuario
	);
	
    echo json_encode($entrega);
	} else {
	echo "ERROR";
	}
	

	
?>