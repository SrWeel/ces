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
    $sql = $data->sql;
	

	
	$req_data = $db->query($sql);
    
//$fp = fopen("fichero.txt", "w");
//fputs($fp, "SELECT 	requ_id,requ_observacion,cant_nombre,requ_paracuando,fpagcl_nombre,provee_nombre,requ_fecharegistro,totalmanosl,total_aclara,fecha_fin,resta_fechas,total_aprobados FROM app_requerimiento_vista WHERE 	usua_id=$userid");
//fclose($fp);
	$req_data = $req_data->fetchAll();
	$entrega=array();
	$i=0;
	foreach ($req_data as $row) {
       
	  //echo "h"; //$entrega[$i]=array($row["requ_id"],$row["requ_observacion"],$row["cant_nombre"],$row["requ_paracuando"],$row["fpagcl_nombre"],$row["provee_nombre"],$row["requ_fecharegistro"],$row["totalmanosl"],$row["total_aclara"],$row["fecha_fin"],$row["resta_fechas"],$row["total_aprobados"],$row["requ_grafico"]);
       $bandera=1;
	   $i++;
    }

//	print_r($req_data);
	
	if($bandera==1)
	{
	echo json_encode($req_data);
	} else {
	echo "ERROR";
	}
?>