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
    $userid = $data->idus;
	$hoyfecha=date("Y-m-d");
	//$userid =103;
	$req_data = $db->query("select distinct fich_nombre,vetr_nombre,sala_nombre,cit_fecha,cit_hora from  app_cita inner join app_fichamascota on app_cita.fich_id=app_fichamascota.fich_id inner join app_cliente on app_fichamascota.clie_id=app_cliente.clie_id inner join app_veterinario on app_cita.vetr_id=app_veterinario.vetr_id inner join app_salas on app_cita.sala_id=app_salas.sala_id  where app_fichamascota.clie_id=$userid and cit_fecha>='$hoyfecha' order by cit_fecha desc limit 7");
    
	

/*$fp = fopen("fichero.txt", "w");
fputs($fp, "select distinct fich_nombre,vetr_nombre,sala_nombre,cit_fecha,cit_hora from  app_cita inner join app_fichamascota on app_cita.fich_id=app_fichamascota.fich_id inner join app_cliente on app_fichamascota.clie_id=app_cliente.clie_id inner join app_veterinario on app_cita.vetr_id=app_veterinario.vetr_id inner join app_salas on app_cita.sala_id=app_salas.sala_id  where app_fichamascota.clie_id=$userid order by cit_fecha desc");
fclose($fp);*/
	
	$req_data = $req_data->fetchAll();
	$entrega=array();
	$i=0;
	foreach ($req_data as $row) {
       //$entrega[$i]=array($row["requ_id"],$row["requ_observacion"],$row["cant_nombre"],$row["requ_paracuando"],$row["fpagcl_nombre"],$row["provee_nombre"],$row["requ_fecharegistro"],$row["totalmanosl"],$row["total_aclara"],$row["fecha_fin"],$row["resta_fechas"],$row["total_aprobados"],$row["requ_grafico"]);
       $bandera=1;
	   $i++;
    }

	if($bandera==1)
	{
	echo json_encode($req_data);
	} else {
	echo "ERROR";
	}
?>