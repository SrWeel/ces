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
    $requ_id = $data->requ_id;
	
	
	


	$resultado_tr=array(

	"opcion"=>"",

	"mensaje"=>""

	);

	

	$campo_1=1;
  
    $resultado_valida=1;
    $ennot_id=0;
	$requ_grafico='';
	$requ_estado='';
	

	if($requ_id=='')
    {

	  $campo_1=0;

	}


	$resultado_valida=$campo_1;

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
	
	
//-----------------verifca si esta libre
		
	$req_busca = $db->query("SELECT manol_id from app_manolevantada where requ_id=$requ_id");
    $req_busca = $req_busca->fetchAll();
	$libre_data=0;
	$ik=0;
	foreach ($req_busca as $rowk) {
       
	   $libre_data=$rowk["manol_id"];
      
	   $ik++;
    }
	
//-----------------verifica si esta libre

if($libre_data==0)
{

//-----------------borra datos--------
$query = $db->prepare("delete from app_requerimiento where requ_id=:requ_id");
$execute=$query->execute(array(
	":requ_id" => $requ_id
));
//print_r($db->errorInfo());

  if($execute)
       {

		$resultado_tr=array(

		"opcion"=>"1",

		"mensaje"=>"Registro borrado con exito"

		);

	}
  else
   {

		$resultado_tr=array(

		"opcion"=>"0",

		"mensaje"=>"No tiene acceso a internet1"

		);

	

	}
//--------------------Borra datos----------	

}	
else
{

		$resultado_tr=array(

		"opcion"=>"0",

		"mensaje"=>"Requerimiento no se puede borrar"

		);


}	

	

	} catch (Exception $e) {

  	

	$resultado_tr=array(

	"opcion"=>"0",

	"mensaje"=>"No tiene acceso a internet2"

	);

		

		

		

	}

//----------------------------------------

}

echo json_encode($resultado_tr);
?>