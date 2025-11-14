<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=544444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");

include("cfgmodulo.php");
$subntable=$nombre_modulo;

$templateformsactual='maestro_standar_anamnesisclinica';
$templateforms='maestro_standar_'.$nombre_modulo.'anam';

$organo_actual="cesdb_arextension.dns_gridorgano";
$organo="cesdb_arextension.dns_".$subntable."gridorgano";

//cesdb_arextension.dns_gridorgano

//lista organos y sistemas
$organos_actualfile="gridstandarall.php";
$organosfile="gridstandarall.php";

$url="panel/".$organos_actualfile;
$lee_panel=$objvarios->leer_contenido_completo($url);

echo $organo_actual."<br>";
echo $organo;
$lee_panel=str_replace(trim($organo_actual),trim($organo),$lee_panel);

$archivo="../templateformsweb/".$templateforms."/".$organosfile;

$id = fopen($archivo, 'w+');
$cadena = $lee_panel;
fwrite($id, $cadena);
fclose($id); 

//lista organos y sistemas

?>