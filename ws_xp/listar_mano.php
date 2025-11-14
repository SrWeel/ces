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
	
$bandera=0;
$requ_id = $data->id_requerimiento;


$lista_manos="select requ_id,app_manolevantada.usua_id,if(usua_archivo='','logo_img.png',usua_archivo) as usua_archivo,usua_nombre,usua_apellido from app_manolevantada inner join app_usuario on app_manolevantada.usua_id=app_usuario.usua_id where requ_id=".$requ_id." and manol_aceptado=1";
$req_data = $db->query($lista_manos);
$req_data = $req_data->fetchAll();

foreach ($req_data as $row) {
			//$badera++;
		//$concatena_cat.=$row["catag_nombre"].",";
 $bandera=1;
 
}

if($bandera==1)
	{
	echo json_encode($req_data);
	} else {
	echo "ERROR";
	}

?>