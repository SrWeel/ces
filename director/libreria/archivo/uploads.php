<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=344000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['sessidadm1777_pichincha'])
{
  
$director="../../";

include ("../../cfgclases/clases.php");
$comillasimple="'";
//Conexion a la base de datos

$hoyfecha=date("Y-m-d H:i:s");
$hoyfechac=date("Y-m-d");

$patharch=trim($objformulario->replace_cmb("gogess_datosg","em_id,em_patharchivo","where em_id =",1,$DB_gogess));



function crearThumbJPEG($rutaImagen,$rutaDestino,$anchoThumb = 200, $altoThumb = 150, $calidad = 50,$tipo){



        //$original = imagecreatefromjpeg($rutaImagen);

		$original='';
        $alto_desado=0;
		switch ($tipo) {

        case "jpg":

                $original = imagecreatefromjpeg($rutaImagen);

        break;

        case "png":

                $original = imagecreatefrompng($rutaImagen);

        break;

        case "gif":

                $original = imagecreatefromgif($rutaImagen);

        break;
		
		case "JPG":

                $original = imagecreatefromjpeg($rutaImagen);

        break;

        case "PNG":

                $original = imagecreatefrompng($rutaImagen);

        break;

        case "GIF":

                $original = imagecreatefromgif($rutaImagen);

        break;
		
		

}

        if ($original !== false){

           $ancho = imagesx($original);
           $alto = imagesy($original);
		   if(!($altoThumb))
           { 
		     $alto_desado=($anchoThumb*$alto)/$ancho;
		     $altoThumb=round($alto_desado);
		   }
		   
		   $thumb = imageCreatetrueColor($anchoThumb,$altoThumb);

           if ($thumb !== false){

              imagecopyresampled($thumb,$original,0,0,0,0,$anchoThumb,$altoThumb,$ancho,$alto);
              $resultado = imagejpeg($thumb,$rutaDestino,$calidad);

              return $resultado;

           }

        }

        return false;

        

     }  


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
$narchivo=$aleat.basename( $_FILES[$_POST["ncampo"].'imagen']['name']);
$target_path = $destination_path."gogess_data".$aleat.".".$file_type;  
$target_pathtmb = $destination_path."gogess_data".$aleat."_tmb.".$file_type;
$target_path_r = $destination_path."gogess_data".$aleat.".".$file_type; 


$archivo_val=$aleat.".".$file_type; 
$target_pathdesc = $pathgdesc.$aleat.".".$file_type;
$nuevo_nombrearchivo='';
$nuevo_nombrearchivo="gogess_data".$aleat.".".$file_type;


//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
 
    //obtenemos el archivo a subir
    $file = $_FILES[$_POST["ncampo"].'imagen']['name'];
 
    //comprobamos si existe un directorio para subir el archivo
     
    //comprobamos si el archivo ha subido
    if ($file && move_uploaded_file($_FILES[$_POST["ncampo"].'imagen']['tmp_name'],$target_path))
    {
       
	   if($_POST["anchoor"]>0)
	   {
	   crearThumbJPEG($target_path,$target_pathtmb,$_POST["anchot"], $_POST["altot"], $calidad = 80,$file_type);   
	   crearThumbJPEG($target_path,$target_path_r,$_POST["anchoor"], $_POST["altoor"], $calidad = 80,$file_type);
	   }
	   sleep(3);//retrasamos la petición 3 segundos
      
	    echo preg_replace("/[\n|\r|\n\r]/",'',$nuevo_nombrearchivo);//devolvemos el nombre del archivo para pintar la imagen
    }
	
	
	
}else{
    throw new Exception("Error Processing Request", 1);   
}

}
?>