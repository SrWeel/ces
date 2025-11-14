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


$permid_idtabla=$_POST["plantra_id"];
$permid_tabla=$_POST["tabla"];
$permid_acepta=1;
$permid_motivo=$_POST["txt_motivo"];
$permid_fecharegistro=date("Y-m-d H:i:s");
$usua_id=$_POST["usua_id"];
$centro_id=$_POST["centro_id"];

$insert_data="insert into cesdb_arextension.dns_permisosdespacho (permid_idtabla,permid_tabla,permid_acepta,permid_motivo,permid_fecharegistro,usua_id,centro_id) values ('".$permid_idtabla."','".$permid_tabla."','".$permid_acepta."','".$permid_motivo."','".$permid_fecharegistro."','".$usua_id."','".$centro_id."')";

$rs_ddata= $DB_gogess->executec($insert_data,array());

?>