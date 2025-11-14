<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if($_SESSION["sessidadm1109_frank"])
{
/***VARIABLES POR GET ***/

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
$$tags[$i]=$valores[$i];
}

/***VARIABLES POR POST ***/

$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero2;$i++){ 
$$tags2[$i]=$valores2[$i]; 
}
//echo $kam_id;
?>
<?php 
//Llamando objetos
$director="../../";

include("../../cfgclases/clases.php");
//Conexion a la base de datos
  
  $patharch=trim($objformulario->replace_cmb("gogess_datosg","em_id,em_patharchivo","where em_id =",1,$DB_gogess));
  
?>
<?php  
//Creando clave aleatoria para archivo 
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
         for ($ic=0; $ic<$max_chars; $ic++) {
						$clave .= round(rand(0, 9));
						$letras.= $chars[round(rand(0, 28))];
					}
		$an=date("Ymd");
		$letras=strtoupper($letras);
		$aleat=$clave.$letras.$an; 

 //Finalizar clave aleatorio
$nombre_archivo = $_FILES['myfile']['name'];
$tipo_archivo = $_FILES['myfile']['type'];
$tamano_archivo = $_FILES['myfile']['size'];


$file_typearr = explode("[.]",$nombre_archivo);
$nsep=count($file_typearr);
$file_type = $file_typearr[$nsep-1];

 
 $pathg=$_SERVER['DOCUMENT_ROOT'].$patharch;
 $pathgdesc=$patharch;
 $destination_path=$pathg;  
 $result = 0;  
 $narchivo=$aleat.basename( $_FILES['myfile']['name']);
 $target_path = $destination_path.$aleat.".".$file_type;  
 $nombrearchiv=$aleat.".".$file_type;
 $target_pathdesc = $pathgdesc.$aleat.".".$file_type;
 

 if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {  
 $result = 1;  
 }  
 sleep(1); 
 
 //include("resultadosbu.php"); 
 ?>  
 
 <?php
 //echo $target_path;


if (file_exists($nombre_archivo)) {
///Verfica existencia de archivo   
}	
else
{
//echo "No existe";
}  



?>
 
<script language="javascript" type="text/javascript">  
window.top.window.stopUpload(<?php echo $result; ?>,"<?php echo  $nombrearchiv ?>",0);  
 </script> 
 
<?php
}
else
{
echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>A caducado la sesi&oacute;n vuelva a ingresar al sistema presione F5</b></div>";
}
?> 