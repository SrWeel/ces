<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$detapre_id=$_POST["detapre_id"];

$busca_precuenta="select * from dns_preddetalleparteoperatorio where detapre_id='".$detapre_id."'";
$rs_precuenta= $DB_gogess->executec($busca_precuenta,array());
$moviin_id=$rs_precuenta->fields["moviin_id"];
$precu_id=$rs_precuenta->fields["precu_id"];


$busca_medi="delete from dns_preddetalleparteoperatorio where detapre_id='".$detapre_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());


?>

