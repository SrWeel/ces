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
	
	$imagen = $data->imagen;
	
	$fp = fopen("fichero.txt", "w");
fputs($fp, $imagen);
fclose($fp);
	
	function base64ToImage($base64_string, $output_file) {
      $file = fopen($output_file, "wb");
  
      $data = explode(',', $base64_string);
  
      fwrite($file, base64_decode($data[1]));
      fclose($file);
  
      return $output_file;
   }

    echo base64ToImage($imagen,"imagen_prueba.jpg");


?>