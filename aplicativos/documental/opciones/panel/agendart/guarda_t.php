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

$actualiza="update faesa_terapiasregistro set terap_nfactura='".$_POST["valor_fisica"]."' where terap_id=".$_POST["terap_id"];
$rs_act = $DB_gogess->executec($actualiza,array());

if($rs_act)
{
echo "Actualizado";
}

}
?>