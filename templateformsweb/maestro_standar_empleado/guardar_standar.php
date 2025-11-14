<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$enlace=$_POST["enlace"];
$base=$_POST["base"];
$table=$_POST["table"];
$campo=$_POST["campo"];
$valorcampo=$_POST["valorcampo"];
$sub_index=$_POST["sub_index"];

    
$busca_dataex="select standar_enlace from ".$base.".".$table." where standar_enlace='".$enlace."'";
$rs_dataex = $DB_gogess->executec($busca_dataex,array());

if(@$rs_dataex->fields["standar_enlace"])
{
  $actu_li="update ".$base.".".$table." set ".$campo."='".$valorcampo."' where standar_enlace='".$enlace."'";  
    
}
else
{
  $actu_li="insert into ".$base.".".$table." (standar_enlace,usua_id,".$sub_index."fecharegistro,".$campo.") values ('".$enlace."','".$_SESSION['ces1313777_sessid_inicio']."','".date("Y-m-d H:i:s")."','".$valorcampo."')";
}

$rs_obtiene = $DB_gogess->executec($actu_li,array());

?>