<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="54445000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$egrec_id=$_POST["egrec_id"];

$busca_estado="select * from dns_invegresosvarios where egrec_id='".$egrec_id."'";
$rs_estdo = $DB_gogess->executec($busca_estado);

if(@$rs_estdo->fields["egrec_recibido"]!=1)
{

$regresa_data="update dns_invegresosvarios set egrec_procesado=0 where egrec_id='".$egrec_id."'";
$rs_data = $DB_gogess->executec($regresa_data,array());

$eliminainv_data="DELETE FROM dns_movimientoinventario WHERE tempdspcent_id in (SELECT tempdsp_id FROM dns_invtemporaldespacho WHERE egrec_id ='".$egrec_id."')";
$rs_el = $DB_gogess->executec($eliminainv_data,array());

}

}
?>