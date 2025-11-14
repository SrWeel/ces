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
    $pais_id = $data->pais_id;
    $cant_id = $data->cant_id;
    $requ_observacion = $data->requ_observacion;
	$categorias=$data->checkItems;
    $requ_sector = $data->requ_sector;
    $requ_barrio = $data->requ_barrio;
    $requ_paracuando = $data->requ_paracuando;
    $fpagcl_id = $data->fpagcl_id;
	$provee_id = $data->provee_id;
	$tiempres_id = $data->tiempres_id;
	$usua_id = $data->usua_id;
	$requ_fecharegistro=date("Y-m-d");
	
	
	$lista_categ="select * from  app_catalogo order by catag_nombre asc";
	$req_data = $db->query($lista_categ);
	$req_data = $req_data->fetchAll();
	$icuenta=1;
	
	
	
	foreach ($req_data as $row) {
	
	   if(in_array(utf8_encode($row["catag_id"]), $categorias))
	   {
	    $numera_categ[$icuenta]=$icuenta;
	   }
	   else
	   {
	    $numera_categ[$icuenta]=0;
	   }
	   
       
       $icuenta++;
	   
    }
	


	$resultado_tr=array(

	"opcion"=>"",

	"mensaje"=>""

	);

	

	$campo_1=1;
    $campo_2=1;
    $campo_3=1;
    $campo_4=1;
	$campo_5=1;
	$campo_6=1;
	$campo_7=1;
	$campo_8=1;
	$campo_9=1;
	$campo_10=1;
	$campo_11=1;
    $resultado_valida=1;
    $ennot_id=0;
	$requ_grafico='';
	$requ_estado='';
	

	if($pais_id=='')
    {

	  $campo_1=0;

	}

	if($cant_id=='')
    {

	  $campo_2=0;

	}

	if($requ_observacion=='')

	{

	  $campo_3=0;

	}

	if($requ_sector=='')

	{

	  $campo_4=0;

	}
    
	if($requ_barrio=='')
	{
	   $campo_5=0;
	
	}
	
	if($requ_paracuando=='')
	{
	   $campo_6=0;
	
	}
	
	if(count($categorias)<1)
	{
	   $campo_7=0;
	
	}
	
	if($fpagcl_id=='')
	{
	  $campo_8=0;
	}
	
	
	if($provee_id=='')
	{
	  $campo_9=0;
	}
	
	if($tiempres_id=='')
	{
	  $campo_10=0;
	}
	
	if($usua_id=='')
	{
	  $campo_11=0;
	}
	

	$resultado_valida=$campo_1*$campo_2*$campo_3*$campo_4*$campo_5*$campo_6*$campo_7*$campo_8*$campo_9*$campo_10*$campo_11;

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

	$fp = fopen("fichero.txt", "w");
fputs($fp,$pais_id."-".$cant_id."-".$requ_observacion."-".implode(",",$numera_categ)."-".$requ_sector."-".$requ_barrio."-".$requ_paracuando."-".$fpagcl_id."-".$provee_id."-".$tiempres_id."-".$usua_id);
fclose($fp);

$requ_categoria=implode(",",$numera_categ);

$query = $db->prepare("update app_requerimiento set usua_id=:usua_id,requ_observacion=:requ_observacion, requ_categoria=:requ_categoria, tiempres_id=:tiempres_id, pais_id=:pais_id, cant_id=:cant_id, requ_sector=:requ_sector, requ_barrio=:requ_barrio, requ_paracuando=:requ_paracuando, fpagcl_id=:fpagcl_id, provee_id=:provee_id, requ_grafico=:requ_grafico, requ_fecharegistro=:requ_fecharegistro where requ_id=:requ_id");

$execute=$query->execute(array(
	":usua_id" => str_replace('"','',$usua_id),
	":requ_observacion" => utf8_decode($requ_observacion),
	":requ_categoria" => $requ_categoria,
	":tiempres_id" => $tiempres_id,
	":pais_id" => $pais_id,
	":cant_id" => $cant_id,
	":requ_sector" => utf8_decode($requ_sector),
	":requ_barrio" => utf8_decode($requ_barrio),
	":requ_paracuando" => utf8_decode($requ_paracuando),
	":fpagcl_id" => $fpagcl_id,
	":provee_id" => $provee_id,
	":requ_grafico" => $requ_grafico,
	":requ_fecharegistro" => $requ_fecharegistro,
	":requ_id" => $requ_id
));
	
//print_r($db->errorInfo());

	 if($execute)
       {

		$resultado_tr=array(

		"opcion"=>"1",

		"mensaje"=>"Registro actualizado con exito"

		);

	}
  else
   {

		$resultado_tr=array(

		"opcion"=>"0",

		"mensaje"=>"No tiene acceso a internet1"

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