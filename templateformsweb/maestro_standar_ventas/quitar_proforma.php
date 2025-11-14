<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();


$id_item=$_POST["id_item"];


$quitar="delete from beko_proformamhdetallefactura where mhdetfac_id='".$id_item."'";
$rs_quitar = $DB_gogess->executec($quitar,array());


}
?>
