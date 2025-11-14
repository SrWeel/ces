<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=544000000;

ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director="../../director/";
include ("../../director/cfgclases/clases.php");

$cedula = $_REQUEST["cedulaPaciente"];

$sql = <<<SQL
    SELECT APPC.clie_id, APPC.clie_rucci FROM app_cliente APPC WHERE APPC.clie_rucci = '{$cedula}'
SQL;
$rs = $DB_gogess->Execute($sql);
if($rs->EOF){
    echo json_encode(["action"=>"registrar", "cedula"=>$cedula]);
} else {
    echo json_encode(["action"=>"agendar", "clieID"=>$rs->fields["clie_id"]]);
}
?>