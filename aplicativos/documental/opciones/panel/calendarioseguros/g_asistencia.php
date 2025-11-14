<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$terap_id=$_POST["terap_id"];
$obs_asistencia=$_POST["obs_asistencia"];

$actualiza_valor="update faesa_terapiasregistro set terap_noasistemotivo='".$obs_asistencia."' where terap_id='".$terap_id."'";
$rs_acvalor = $DB_gogess->executec($actualiza_valor,array());

}
?>	  