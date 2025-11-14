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
	$bandera=0;
    $usua_nombre = $data->usua_nombre;
	$usua_apellido = $data->usua_apellido;
	$usua_clave = $data->usua_clave;
	$usua_clave1 = $data->usua_clave1;
	$usua_email = $data->usua_email;
	$usua_apruebapolitica = $data->usua_apruebapolitica;
	$usua_fecharegistro=date("Y-m-d");
	//$userid =103;
	//,usua_apruebapolitica;
	$resultado_tr=array(
	"opcion"=>"",
	"mensaje"=>""
	);
	
	$campo_1=1;
	$campo_2=2;
	$campo_3=3;
	$campo_4=4;
	$resultado_valida=1;
	
	if($usua_nombre=='')
	{
	  $campo_1=0;
	}
	if($usua_apellido=='')
	{
	  $campo_2=0;
	}
	if($usua_clave=='')
	{
	  $campo_3=0;
	}
	if($usua_email=='')
	{
	  $campo_4=0;
	}
	
	$resultado_valida=$campo_1*$campo_2*$campo_3*$campo_4;
	if($resultado_valida==0)
	{
	
	$resultado_tr=array(
	"opcion"=>"0",
	"mensaje"=>"Los campos con * son obligatorios"
	);
	
	}
	else
	{
	//----------------------------------------
	try {
	
	$query = $db->prepare("insert into app_usuario (usua_nombre,usua_apellido,usua_clave,usua_email,usua_esusuario,usua_fecharegistro,emp_id,usua_apruebapolitica) values (:usua_nombre,:usua_apellido,:usua_clave,:usua_email,:usua_esusuario,:usua_fecharegistro,1,:usua_apruebapolitica)");
	$execute=$query->execute(array(
		":usua_nombre" => $usua_nombre,
		":usua_apellido" => $usua_apellido,
		":usua_clave" => md5($usua_clave),
		":usua_email" => $usua_email,
		":usua_esusuario" => "1",
		":usua_fecharegistro" => $usua_fecharegistro,
		":usua_apruebapolitica"=>$usua_apruebapolitica
	));
	
//$fp = fopen("fichero.txt", "w");
//fputs($fp, "insert into app_usuario (usua_nombre,usua_apellido,usua_clave,usua_email,usua_esusuario,usua_fecharegistro) values (:usua_nombre,:usua_apellido,:usua_clave,:usua_emai,:usua_esusuario,:usua_fecharegistro)");
//fclose($fp);
	
	if($execute)
	{
		$resultado_tr=array(
		"opcion"=>"1",
		"mensaje"=>"Registro realizado con exito"
		);
	}
	else
	{
		$resultado_tr=array(
		"opcion"=>"0",
		"mensaje"=>"Usuario ya existe"
		);
	
	}
	
	} catch (Exception $e) {
  	
	$resultado_tr=array(
	"opcion"=>"0",
	"mensaje"=>"Usuario ya existe"
	);
		
		
		
	}
//----------------------------------------
}


echo json_encode($resultado_tr);
?>