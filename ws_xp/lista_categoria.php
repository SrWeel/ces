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
    $pais_id = $data->pais_id;
	$pais_id=1;
	//$userid =103;
	//echo "SELECT 	cant_id,cant_nombre from app_canton where pais_id=$pais_id and cant_activo=1 order by cant_nombre asc";
	$req_data = $db->query("SELECT catag_id,catag_nombre from app_catalogo order by catag_nombre asc");
    
	
	$req_data = $req_data->fetchAll();
	$entrega=array();
	$i=0;
	foreach ($req_data as $row) {
       
	   $concatena_data.="{'text':'".utf8_encode($row["catag_nombre"])."'},";
       $bandera=1;
	   $i++;
    }
	
	$concatena_data=substr($concatena_data,0,-1);

	if($bandera==1)
	{
	echo json_encode($req_data);
	//echo "[".$concatena_data."]";
	} else {
	echo "ERROR";
	}
?>