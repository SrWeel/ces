<?php
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<?php
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");
//Conexion a la base de datos

$hoyfecha=date("Y-m-d H:i:s");
$hoyfechac=date("Y-m-d");

$patharch='/ros/files/';



function crear_semilla() {
		   list($usec, $sec) = explode(' ', microtime());
		   return (float) $sec + ((float) $usec * 100000);
		}

		srand(crear_semilla());					
		// Generamos la clave					
		$clave="";
		$max_chars = round(5,5);  // tendrá entre 7 y 10 caracteres
		$chars = array();
		for ($ia="a"; $ia<"z"; $ia++) $chars[] = $ia;  // creamos vector de letras
		$chars[] = "z";
		$clave="";
		$letras="";
         for ($ic=0; $ic<@$max_chars; $ic++) {
						$clave .= round(rand(0, 9));
						$letras.= @$chars[round(rand(0, 28))];
					}
		$an=date("Ymd");
		$letras=strtoupper($letras);
		$aleat=$clave.$letras.$an; 
		
		
$nombre_archivo = $_FILES[$_POST["ncampo"].'imagen']['name'];
$tipo_archivo = $_FILES[$_POST["ncampo"].'imagen']['type'];
$tamano_archivo = $_FILES[$_POST["ncampo"].'imagen']['size'];


$file_typearr = explode(".",$nombre_archivo);
$nsep=count($file_typearr);
$file_type = $file_typearr[$nsep-1];

$pathg=$_SERVER['DOCUMENT_ROOT'].$patharch;
$pathgdesc=$patharch;
$destination_path=$pathg;  
$result = 0;  
$narchivo=$aleat.basename($_FILES[$_POST["ncampo"].'imagen']['name']);
$target_path = $destination_path.$aleat.".".$file_type;  
$archivo_val=$aleat.".".$file_type; 
$target_pathdesc = $pathgdesc.$aleat.".".$file_type;
$nuevo_nombrearchivo='';
$nuevo_nombrearchivo=$aleat.".".$file_type;



//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
 
    //obtenemos el archivo a subir
    $file = $_FILES[$_POST["ncampo"].'imagen']['name'];
 
    //comprobamos si existe un directorio para subir el archivo
     
	 
	/*  $fp = fopen("fichero.txt", "w");

fputs($fp, $target_path);

fclose($fp);*/
	 
    //comprobamos si el archivo ha subido
    if ($file && move_uploaded_file($_FILES[$_POST["ncampo"].'imagen']['tmp_name'],$target_path))
    {
       sleep(3);//retrasamos la petición 3 segundos
       echo $nuevo_nombrearchivo;//devolvemos el nombre del archivo para pintar la imagen
	   
	   include("dll/key_perform_ind.php");
	   
    }
	
	
	
	
	
	
	
}else{
    throw new Exception("Error Processing Request", 1);   
}
?>