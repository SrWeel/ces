<?php
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{
  $director="../../../../";
  include ("../../../../cfgclases/clases.php");
  $idempresa=$objformulario->replace_cmb("factur_usuarios","usua_id,em_id","where usua_id=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);
	//Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
	$ruta="xml/";
	$texto=$_POST['texto'];
	
	function crear_semilla() {
		   list($usec, $sec) = explode(' ', microtime());
		   return (float) $sec + ((float) $usec * 100000);
		}
	srand(crear_semilla());	
	$clave="";
		$max_chars = round(5,5);  // tendrá entre 7 y 10 caracteres
		$chars = array();
		for ($ia="a"; $ia<"z"; $ia++) $chars[] = $ia;  // creamos vector de letras
		$chars[] = "z";
		$clave="";
		$letras="";
         for ($ic=0; $ic<$max_chars; $ic++) {
						$clave .= round(rand(0, 9));
						$letras.= $chars[round(rand(0, 28))];
					}
		$an=date("Ymd");
		$letras=strtoupper($letras);
		$aleat=$clave.$letras.$an."_".$idempresa; 
		
		
		

	
	foreach ($_FILES as $key) {
	
	
		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
		
		   
		   
			$file_typearr = split("[.]",$key['name']);
			$nsep=count($file_typearr);
			$file_type = $file_typearr[$nsep-1];		
		    $nombrenarchivo=$aleat.".".$file_type;
			
			$nombre = $nombrenarchivo;//Obtenemos el nombre del archivo
			
			
			
			$temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
			move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
			//El echo es para que lo reciba jquery y lo ponga en el div "cargados"
			echo "
				<div id='subido'>
					<h12><strong>Nombre del archivo: $nombre</strong></h2><br />
					<h12><strong>Tama&ntilde;o del archivo: $tamano</strong></h2><br />
					<h12><strong>Texto: $texto</strong></h2><br />
					<hr>
				</div>
				";
		}else{
			echo $key['error']; //Si no se cargo mostramos el error
		}
	}

}	
?>