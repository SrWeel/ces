<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$cuecomp_id=$_POST["cuecomp_id"];

 $act_cuenta="update lpin_cuentacompra set planc_codigoc='1.2.1.16' where cuecomp_id='".$cuecomp_id."'";
$rs_ok = $DB_gogess->executec($act_cuenta,array());

}


?>