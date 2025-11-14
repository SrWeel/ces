<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();
$proveeve_id=$_POST["proveeve_id"];

if($_SESSION['ces1313777_sessid_inicio'])
{

$campo_1=$_POST["campo_1"];
$enlace=$_POST["enlace"];

$doccab_id=trim($_POST["doccab_id"]);

if($doccab_id)
{
$update_lista="update beko_documentodetalle set  porcevr_id='".$campo_1."' where doccab_id = '".$doccab_id."'";
$rs_lista = $DB_gogess->executec($update_lista,array());

}


}
?>