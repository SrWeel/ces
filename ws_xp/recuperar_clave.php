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
	//---funciones
	
	function generateRandomString($length = 7) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    } 
	$clave_aleatoria=generateRandomString(7);
	//---funciones
	
    //echo json_encode($data);
    $usua_email = $data->usua_email;
	
	

	
	$userInfo = $db->query("SELECT usua_email,usua_nombre,usua_id FROM app_usuario WHERE usua_email='$usua_email'");
    $userInfo = $userInfo->fetchAll();
	
	foreach ($userInfo as $row) {
        $nombre=$row["usua_nombre"];
		$id_usuario=$row["usua_id"];
    }

	
	$token; 
	if (count($userInfo) == 1){
		//This means that the user is logged in and let's givem a token :D :D :D
		$token = $username. " | " . uniqid() . uniqid() . uniqid();
		
	$q = "UPDATE app_usuario SET usua_clave=:nclave WHERE usua_email=:email and usua_id=:id_usuario";
	
//$fp = fopen("fichero.txt", "w");
//fputs($fp, "UPDATE app_usuario SET usua_clave=$clave_aleatoria WHERE usua_email=$usua_email and usua_id=$id_usuario");
//fclose($fp);
	
	
	$query = $db->prepare($q);
	$execute = $query->execute(array(
		":nclave" => md5($clave_aleatoria),
		":email" => $usua_email,
		":id_usuario"=>$id_usuario
	)); 
	
	if($execute)
	{
		$resultado_tr=array(
		"opcion"=>"1",
		"mensaje"=>"Ingrese a su cuenta de email para obtener su clave temporal"
		);
	}
	else
	{
	    $resultado_tr=array(
		"opcion"=>"0",
		"mensaje"=>"No esta conectado a internet verifique"
		);
	
	
	}
	
   
	} else {
	
	 $resultado_tr=array(
		"opcion"=>"0",
		"mensaje"=>"No esta conectado a internet verifique"
		);
	
	
	}
	 echo json_encode($resultado_tr);

	
?>