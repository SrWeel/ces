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
    $requ_id = $data->id_requerimiento;
	
//$fp = fopen("fichero.txt", "w");
//fputs($fp, "SELECT 	requ_id,requ_observacion,cant_nombre,requ_paracuando,fpagcl_nombre,provee_nombre,requ_fecharegistro,totalmanosl,total_aclara,fecha_fin,resta_fechas,total_aprobados FROM app_requerimiento_vista WHERE 	usua_id=$userid");
//fclose($fp);	
   
function busca_categoria($idpersona,$categoria,$db)
{
 
 $badera=0;
 $concatena_cat='';
 $resultado=array();
 
 $lista_cate_exp="select app_servicios.catag_id,catag_nombre from app_servicios inner join  app_catalogo on app_servicios.catag_id=app_catalogo.catag_id where app_servicios.usua_id=".$idpersona." and app_servicios.catag_id in (".$categoria."0)";
 $req_data = $db->query($lista_cate_exp);
 $req_data = $req_data->fetchAll();
 
 foreach ($req_data as $row) {
		
		$badera++;
		$concatena_cat.=$row["catag_nombre"].",";

 }
 
 $resultado["bandera"]=$badera;
 $resultado["concatena_cat"]=$concatena_cat;
 return $resultado;

}

    $usuario_id=0;
	//$userid =103;
	$req_data = $db->query("select requ_id,usua_id,requ_categoria,requ_observacion from app_requerimiento where requ_id=$requ_id");
	$req_data = $req_data->fetchAll();
	$entrega=array();
	$i=0;
	foreach ($req_data as $row) {
	   
	   $usuario_id=$row["usua_id"];
	   $requ_categoria=$row["requ_categoria"];
       //$entrega[$i]=array($row["requ_id"],$row["requ_observacion"],$row["cant_nombre"],$row["requ_paracuando"],$row["fpagcl_nombre"],$row["provee_nombre"],$row["requ_fecharegistro"],$row["totalmanosl"],$row["total_aclara"],$row["fecha_fin"],$row["resta_fechas"],$row["total_aprobados"],$row["requ_grafico"]);
       $bandera=1;
	   $i++;
    }

    $resulta_bu=busca_categoria($usuario_id,$requ_categoria,$db);
  if($resulta_bu)
  {
  $bandera=1;
  }
   $resultado_tr=array(

	"opcion"=>"0",

	"mensaje"=>$resulta_bu["concatena_cat"]

	);
	

	if($bandera==1)
	{
	echo json_encode($resultado_tr);
	} else {
	echo "ERROR";
	}
?>