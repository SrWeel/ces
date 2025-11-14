<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

/*echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["id"]."<br>";
echo $_POST["valor"]."<br>";*/

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$sqltotal="";


$compra_id=$_POST["compra_id"];
$anulado=$_POST["anulado"];

if($compra_id>0)
{

if($anulado==1)
{
$actualiza="update dns_compras set compra_anulado=1,compra_fechaanulado='".date("Y-m-d H:i:s")."',usuaanula_id='".$_SESSION['ces1313777_sessid_inicio']."' where compra_id='".$compra_id."'";
$rs_bdata = $DB_gogess->executec($actualiza,array());
}
else
{
$actualiza="update dns_compras set compra_anulado=0,compra_fechaanulado=NULL where compra_id='".$compra_id."'";
$rs_bdata = $DB_gogess->executec($actualiza,array());
}


}



}
?>