<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
ini_set('memory_limit', '-1');
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$path_archivo="../../archivo/";
//Imagen inicial horizontal
$toma_lafoto="select clie_foto as foto from app_cliente where clie_id=".$_POST["clie_id"];
$ok_foto=$DB_gogess->executec($toma_lafoto);

$foto_agirar=$ok_foto->fields["foto"];

$busca_siyafue=explode("_",$foto_agirar);



if($busca_siyafue[0]=='GIRA')
{
	
	$image_rotate = $path_archivo.$foto_agirar;
	$guarda_foto=$foto_agirar;
}
else
{
	
    $image_rotate = $path_archivo."GIRA_".$foto_agirar;	
	$guarda_foto="GIRA_".$foto_agirar;	
}

$image = $path_archivo.$foto_agirar;
//Destino de la nueva imagen vertical
//$image_rotate = $path_archivo."GIRA_".$foto_agirar;
 
//Definimos los grados de rotacion
$degrees = $_POST["grados"];
 
//Creamos una nueva imagen a partir del fichero inicial
$source = imagecreatefromjpeg($image);
 
//Rotamos la imagen 90 grados
$rotate = imagerotate($source, $degrees, 0);
 
//Creamos el archivo jpg vertical
imagejpeg($rotate, $image_rotate);


$guarda_nuevaimagen="update app_cliente set clie_foto='".$guarda_foto."' where clie_id=".$_POST["clie_id"];

$ok=$DB_gogess->executec($guarda_nuevaimagen);

?>