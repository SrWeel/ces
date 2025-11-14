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
	$filtro = $data->idfiltro;
	$filtro =4;
	
//lista ofertas

if($filtro==1)
{
//echo $lista_servicios="select app_requerimiento.tiempres_id,requ_grafico,requ_paracuando,provee_id,fpagcl_id,app_requerimiento.requ_id,app_requerimiento.requ_categoria,requ_observacion,requ_fecharegistro,ADDDATE(requ_fecharegistro, INTERVAL tiempres_horas DAY) as fecha_fin,requ_barrio,requ_sector,IFNULL(app_manolevantada.usua_id,0) as usuamano_id,IFNULL(manol_aceptado,0) as manol_aceptado ,IFNULL(manol_nointeresa,0) as manol_nointeresa from app_requerimiento inner join app_tiemporespuesta on app_requerimiento.tiempres_id=app_tiemporespuesta.tiempres_id left join app_manolevantada on app_requerimiento.requ_id=app_manolevantada.requ_id where ((IFNULL(app_manolevantada.usua_id,0)!=".@$_SESSION['ces1313777_sessid_inicio']." and IFNULL(app_requerimiento.usua_id,0)!=".@$_SESSION['ces1313777_sessid_inicio'].") or (IFNULL(manol_nointeresa,0)=0 and IFNULL(manol_aceptado,0)=0 and IFNULL(app_requerimiento.usua_id,0)!=".@$_SESSION['ces1313777_sessid_inicio'].") ) order by app_requerimiento.requ_id desc";

$lista_servicios="select fpagcl_id,provee_id,cant_id,app_requerimiento.tiempres_id,IF(requ_grafico='','logo_img.png', REPLACE(SUBSTRING(SUBSTRING_INDEX(requ_grafico, ',', 2), LENGTH(SUBSTRING_INDEX(requ_grafico, ',', 2-1))+1), ',', '')) as requ_grafico,requ_paracuando,provee_id,fpagcl_id,app_requerimiento.requ_id,app_requerimiento.requ_categoria,requ_observacion,requ_fecharegistro,ADDTIME(`app_requerimiento`.`requ_fecharegistro`, concat(`app_tiemporespuesta`.`tiempres_horas`,':00:00')) as fecha_fin,requ_barrio,requ_sector,IFNULL(app_manolevantada.usua_id,0) as usuamano_id,IFNULL(manol_aceptado,0) as manol_aceptado ,IFNULL(manol_nointeresa,0) as manol_nointeresa,(`app_tiemporespuesta`.`tiempres_horas` - HOUR(TIMEDIFF(NOW(), `app_requerimiento`.`requ_fecharegistro`))) as horas_quedan from app_requerimiento inner join app_tiemporespuesta on app_requerimiento.tiempres_id=app_tiemporespuesta.tiempres_id left join app_manolevantada on app_requerimiento.requ_id=app_manolevantada.requ_id 
where ((
IFNULL(app_manolevantada.usua_id,0)=0 and IFNULL(app_manolevantada.manol_aceptado,0)=0 and IFNULL(app_manolevantada.manol_nointeresa,0)=0 and app_requerimiento.usua_id!=".@$userid."
)  or (
IFNULL(app_manolevantada.usua_id,0)!=".@$userid." 
and IFNULL(app_manolevantada.manol_aceptado,0)=0 and 
IFNULL(app_manolevantada.manol_nointeresa,0)=0 and app_requerimiento.usua_id!=".@$userid."
) or (IFNULL(app_manolevantada.usua_id,0)=".@$userid." and IFNULL(app_manolevantada.manol_aceptado,0)=0 and  app_requerimiento.usua_id!=".@$userid." )) and (`app_tiemporespuesta`.`tiempres_horas` - HOUR(TIMEDIFF(NOW(), `app_requerimiento`.`requ_fecharegistro`))) >0 order by app_requerimiento.requ_id desc";

 }
 
if($filtro==2)
{
$lista_servicios="select fpagcl_id,provee_id,cant_id,app_requerimiento.tiempres_id,IF(requ_grafico='','logo_img.png', REPLACE(SUBSTRING(SUBSTRING_INDEX(requ_grafico, ',', 2), LENGTH(SUBSTRING_INDEX(requ_grafico, ',', 2-1))+1), ',', '')) as requ_grafico,requ_paracuando,provee_id,fpagcl_id,app_requerimiento.requ_id,app_requerimiento.requ_categoria,requ_observacion,requ_fecharegistro,ADDTIME(`app_requerimiento`.`requ_fecharegistro`, concat(`app_tiemporespuesta`.`tiempres_horas`,':00:00')) as fecha_fin,requ_barrio,requ_sector,IFNULL(app_manolevantada.usua_id,0) as usuamano_id,IFNULL(manol_aceptado,0) as manol_aceptado ,IFNULL(manol_nointeresa,0) as manol_nointeresa,IFNULL(manol_aprobadocliente,0) as manol_aprobadocliente,(`app_tiemporespuesta`.`tiempres_horas` - HOUR(TIMEDIFF(NOW(), `app_requerimiento`.`requ_fecharegistro`))) as horas_quedan from app_requerimiento inner join app_tiemporespuesta on app_requerimiento.tiempres_id=app_tiemporespuesta.tiempres_id left join app_manolevantada on app_requerimiento.requ_id=app_manolevantada.requ_id where IFNULL(app_manolevantada.usua_id,0)=".@$userid." and IFNULL(manol_aceptado,0)=1 and IFNULL(manol_aprobadocliente,0)=0 and IFNULL(app_requerimiento.usua_id,0)!=".@$userid." order by app_requerimiento.requ_id desc";
 }
 
if($filtro==3)
{
$lista_servicios="select fpagcl_id,provee_id,cant_id,app_requerimiento.tiempres_id,IF(requ_grafico='','logo_img.png', REPLACE(SUBSTRING(SUBSTRING_INDEX(requ_grafico, ',', 2), LENGTH(SUBSTRING_INDEX(requ_grafico, ',', 2-1))+1), ',', '')) as requ_grafico,requ_paracuando,provee_id,fpagcl_id,app_requerimiento.requ_id,app_requerimiento.requ_categoria,requ_observacion,requ_fecharegistro,ADDTIME(`app_requerimiento`.`requ_fecharegistro`, concat(`app_tiemporespuesta`.`tiempres_horas`,':00:00')) as fecha_fin,requ_barrio,requ_sector,IFNULL(app_manolevantada.usua_id,0) as usuamano_id,IFNULL(manol_aceptado,0) as manol_aceptado ,IFNULL(manol_nointeresa,0) as manol_nointeresa,(`app_tiemporespuesta`.`tiempres_horas` - HOUR(TIMEDIFF(NOW(), `app_requerimiento`.`requ_fecharegistro`))) as horas_quedan from app_requerimiento inner join app_tiemporespuesta on app_requerimiento.tiempres_id=app_tiemporespuesta.tiempres_id left join app_manolevantada on app_requerimiento.requ_id=app_manolevantada.requ_id where (IFNULL(app_manolevantada.usua_id,0)=".@$userid." and IFNULL(manol_nointeresa,0)=1 and IFNULL(app_requerimiento.usua_id,0)!=".@$userid.") and (`app_tiemporespuesta`.`tiempres_horas` - HOUR(TIMEDIFF(NOW(), `app_requerimiento`.`requ_fecharegistro`))) >0 order by app_requerimiento.requ_id desc";
 }
 
if($filtro==4)
{
 $lista_servicios="select fpagcl_id,provee_id,cant_id,app_requerimiento.usua_id as usuareq_id,app_requerimiento.tiempres_id,IF(requ_grafico='','logo_img.png', REPLACE(SUBSTRING(SUBSTRING_INDEX(requ_grafico, ',', 2), LENGTH(SUBSTRING_INDEX(requ_grafico, ',', 2-1))+1), ',', '')) as requ_grafico,requ_paracuando,provee_id,fpagcl_id,app_requerimiento.requ_id,app_requerimiento.requ_categoria,requ_observacion,requ_fecharegistro,ADDTIME(`app_requerimiento`.`requ_fecharegistro`, concat(`app_tiemporespuesta`.`tiempres_horas`,':00:00')) as fecha_fin,requ_barrio,requ_sector,IFNULL(app_manolevantada.usua_id,0) as usuamano_id,IFNULL(manol_aceptado,0) as manol_aceptado ,IFNULL(manol_nointeresa,0) as manol_nointeresa,IFNULL(manol_aprobadocliente,0) as manol_aprobadocliente,manol_fechaapruebacliente,(`app_tiemporespuesta`.`tiempres_horas` - HOUR(TIMEDIFF(NOW(), `app_requerimiento`.`requ_fecharegistro`))) as horas_quedan from app_requerimiento inner join app_tiemporespuesta on app_requerimiento.tiempres_id=app_tiemporespuesta.tiempres_id left join app_manolevantada on app_requerimiento.requ_id=app_manolevantada.requ_id where IFNULL(app_manolevantada.usua_id,0)=".@$userid." and IFNULL(manol_aceptado,0)=1 and IFNULL(manol_aprobadocliente,0)=1 and IFNULL(app_requerimiento.usua_id,0)!=".@$userid." order by app_requerimiento.requ_id desc";
 }

//lista ofertas

	
	
//$userid =103;
$req_data = $db->query($lista_servicios);
    
	

//$fp = fopen("fichero.txt", "w");
//fputs($fp, "SELECT 	requ_id,requ_observacion,cant_nombre,requ_paracuando,fpagcl_nombre,provee_nombre,requ_fecharegistro,totalmanosl,total_aclara,fecha_fin,resta_fechas,total_aprobados FROM app_requerimiento_vista WHERE 	usua_id=$userid");
//fclose($fp);
	
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